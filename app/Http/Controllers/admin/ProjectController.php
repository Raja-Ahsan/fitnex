<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Category; 
use App\Models\Banner; 
use App\Models\ClientContact; 
use App\Models\DocumentRepository; 
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\ProjectSubmittedToAdmin;
use App\Notifications\NewProjectSubmitted;
use App\Mail\ProjectStatusUpdated;
use App\Notifications\ProjectStatusUpdatedNotification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use function Ramsey\Uuid\v2;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
        $this->middleware('permission:projects-list|projects-create|projects-edit|projects-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:projects-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:projects-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:projects-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $user = Auth::user(); // Get the currently authenticated user

        if ($request->ajax()) {
            $query = Project::orderBy('id', 'desc')->where('id', '>', 0);

            // Filter based on user role
            if ($user->role == 'Member' || $user->role == 'EPC Developer') {
                $query->where('created_by', $user->id); // Show only projects created by the current user
            }

            if ($request['search'] != "") {
                $query->where('name', 'like', '%' . $request['search'] . '%')
                    ->orWhere('company', 'like', '%' . $request['search'] . '%')
                    ->orWhere('start_date', 'like', '%' . $request['search'] . '%')
                    ->orWhere('status', 'like', '%' . $request['search'] . '%');
            }

            if ($request['status'] != "All") {
                if ($request['status'] == "pending") {
                    $request['status'] = 'pending';
                } 
                if ($request['status'] == "approved") {
                    $request['status'] = 'approved';
                } 
                if ($request['status'] == "rejected") {
                    $request['status'] = 'rejected';
                } 
                $query->where('status', $request['status']);
            }

            $models = $query->paginate(10);
            return (string) view('admin.projects.search', compact('models'));
        }

        $page_title = 'Project Listings';
        $models = Project::orderBy('id', 'desc');

        // Filter based on user role
        if ($user->role == 'Member' || $user->role == 'EPC Developer') {
            $models->where('created_by', $user->id); // Show only projects created by the current user
        }

        $models = $models->paginate(10);
        return view('admin.projects.index', compact('models', 'page_title'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Add Project Data';
        $categories = Category::where('status', 1)->get();   
        return view('admin.projects.create', compact('categories','page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'project_category_id' => 'required|array', // Ensure it's an array for multiple selections
            'project_category_id.*' => 'exists:categories,id', // Validate each category ID
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date', // Ensure end date is after start date
            'company' => 'required|string|max:255',
            'county' => 'required|array', // Ensure it's an array for multiple selections
            'county.*' => 'string|max:255', // Validate each county
            'description' => 'required|string',
            'poc_name' => 'required|string|max:255',
            'poc_phone' => 'required|string|max:20',
            'poc_email' => 'required|email|max:255',
            'key_links' => 'nullable|array',
            'key_links.*.url' => 'nullable|url',
            'key_links.*.label' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        //dd($request->all());

        // Create a new project record
        $model = new Project();

        // Handle the image upload for the project if an image is provided
        if ($request->hasFile('image')) {
            $photo = date('YmdHis') . '.' . $request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('/admin/assets/images/projects'), $photo);
            $model->image = $photo;
        }

        // Save the form data into the project table
        $model->created_by = Auth::user()->id;
        $model->name = $request->name;
        $model->project_category_id = json_encode($request->project_category_id); // Store as JSON
        $model->county = json_encode($request->county); // Store as JSON
        $model->start_date = $request->start_date;
        $model->end_date = $request->end_date;
        $model->company = $request->company;
        $model->description = $request->description;
        $model->poc_name = $request->poc_name;
        $model->poc_phone = $request->poc_phone;
        $model->poc_email = $request->poc_email;
        $model->key_links = json_encode($request->key_links); // Store as JSON
        $model->save(); // Save the project

        $model->size = null; // Default size (will be set later)

        // Handle the document file upload if files are uploaded
        $allFileNames = [];
        $allFileSizes = [];
        $totalSize = 0;

        if ($request->hasFile('document_file')) {
            foreach ($request->file('document_file') as $file) {
                $fileNameWithExtension = $file->getClientOriginalName();
                $fileSize = $file->getSize();
                $file->move(public_path('/admin/assets/images/documents'), $fileNameWithExtension);
                $allFileNames[] = $fileNameWithExtension;
                $allFileSizes[] = $fileSize;
                $totalSize += $fileSize;
            }
            $model->document_file = json_encode($allFileNames);
            $model->file_names = json_encode($allFileNames); // Optional: if you want to store separately
            $model->file_sizes = json_encode($allFileSizes); // Optional: if you want to store separately
        } else {
            // If no files uploaded, but hidden fields are present (shouldn't happen, but for safety)
            if ($request->file_names) {
                $model->file_names = $request->file_names;
            }
            if ($request->file_sizes) {
                $model->file_sizes = $request->file_sizes;
            }
        }

        // Store the total size of the uploaded files in the 'size' column in MB/GB
        if ($totalSize >= 1073741824) {
            $model->size = round($totalSize / 1073741824, 2) . ' GB';
        } elseif ($totalSize >= 1048576) {
            $model->size = round($totalSize / 1048576, 2) . ' MB';
        } elseif ($totalSize >= 1024) {
            $model->size = round($totalSize / 1024, 2) . ' KB';
        } else {
            $model->size = $totalSize . ' bytes';
        }

        $model->save(); // Save the project with the document_id

        if (auth()->user()->hasRole('Member') || auth()->user()->hasRole('EPC Developer')) {
            $admins = \App\Models\User::where('id', 1)
                ->orWhere('email', 'asjadmmc67@gmail.com')
                ->where('id', '!=', auth()->id())
                ->get();

            foreach ($admins as $admin) {
                $admin->notify(new \App\Notifications\NewProjectSubmitted($model, auth()->user()));
            }
        }
        return redirect()->route('projects.index')->with('message', 'Project and document added successfully!');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page_title = "Show Details";
        $project = Project::where('id', $id)->firstOrFail();
        $categories = Category::where('status', 1)->get();

        // Example: Related by category, exclude current project
        /* $related_projects = Project::where('category_id', $project->category_id)
            ->where('id', '!=', $project->id)
            ->latest()
            ->take(6)
            ->get(); */

        // Mark notification as read if accessed via notification
        /* if (auth()->user()) {
            $notification = auth()->user()->unreadNotifications()
                ->where('data->project_id', $id)
                ->first();
            if ($notification) {
                $notification->markAsRead();
            }
        } */

        return view('admin.projects.show', compact('project', 'categories', 'page_title'/* , 'related_projects' */));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     *  
     * 
     * 
     */
    public function projectShow($id)
    {
        $page_title = 'Project Post Details';

        // Fetch a single project by its ID
        $project = Project::find($id);
        if (!$project) {
            return redirect()->back()->withErrors(['error' => 'Project Post not found.']);
        }

        // Fetch the contractor details based on the project's created_by field
        $contractor_detail = User::find($project->created_by);

        $banner = Banner::where('id', 18)->where('status', 1)->first();
        // Fetch the related client contacts
        $client_contacts = ClientContact::where('status', 1)->where('user_id', $id)->get();
        $projects = Project::where('status', 1)->get();
        // Fetch related projects by matching any category in the JSON array project_category_id and only approved status
        /* $projectCategories = json_decode($project->project_category_id, true) ?? []; */
        $related_projects = Project::where('id', '!=', $project->id)
            ->where('status', 'approved')
            ->get();

        return view('admin.projects.details', compact('page_title','projects', 'contractor_detail', 'banner', 'project', 'client_contacts', 'related_projects'));
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_title = "Edit Project Data";
        $project = Project::where('id', $id)->first();
        // Mark notification as read if accessed via notification
        if (auth()->user()) {
            $notification = auth()->user()->unreadNotifications()
                ->where('data->project_id', $id)
                ->first();
            if ($notification) {
                $notification->markAsRead();
            }
        }
        // If project is not found, redirect or show an error
        if ($project === null) {
            return redirect()->route('projects.index')->with('error', 'Project not found.');
        }

        $categories = Category::where('status', 1)->get();
        return view('admin.projects.edit', compact('page_title', 'categories', 'project'));
    }

  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $rules = [
            'name' => 'required|string|max:255',
            'project_category_id' => 'required|array', // Ensure it's an array for multiple selections
            'project_category_id.*' => 'exists:categories,id', // Validate each category ID
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date', // Ensure end date is after start date
            'company' => 'required|string|max:255',
            'county' => 'required|array', // Ensure it's an array for multiple selections
            'county.*' => 'string|max:255', // Validate each county
            'description' => 'required|string',
            'poc_name' => 'required|string|max:255',
            'poc_phone' => 'required|string|max:20',
            'poc_email' => 'required|email|max:255',
            'key_links' => 'nullable|array',
            'key_links.*.url' => 'nullable|url',
            'key_links.*.label' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Ensure the image is valid
        ];

        // Add status and rejection reason validation only for admins
        if (Auth::user()->hasRole('Admin')) {
            $rules['status'] = 'required|string|in:pending,approved,rejected';
            $rules['rejection_reason'] = 'nullable|string|max:1000';
        }

        $request->validate($rules);

        // Retrieve the existing project record
        $model = Project::findOrFail($id); // Find the project by ID or fail if not found

       // Handle image upload
        if ($request->hasFile('image')) {
            if ($model->image && file_exists(public_path('/admin/assets/images/projects/' . $model->image))) {
                unlink(public_path('/admin/assets/images/projects/' . $model->image));
            }
            $filename = date('YmdHis') . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('/admin/assets/images/projects'), $filename);
            $model->image = $filename;
        }

        // Update the project details
        $model->name = $request->name;
        $model->project_category_id = json_encode($request->project_category_id); // Store as JSON
        $model->county = json_encode($request->county); // Store as JSON
        $model->start_date = $request->start_date;
        $model->end_date = $request->end_date;
        $model->company = $request->company;
        $model->description = $request->description;
        $model->poc_name = $request->poc_name;
        $model->poc_phone = $request->poc_phone;
        $model->poc_email = $request->poc_email;
        $model->key_links = json_encode($request->key_links); // Store as JSON

        // Only update status and rejection reason if the user is an Admin
        if (Auth::user()->hasRole('Admin')) {
            $model->status = $request->status; // Update the status
            if ($request->status === 'rejected') {
                $model->rejection_reason = $request->rejection_reason;
            } else {
                $model->rejection_reason = null;
            }
        }

        // Get the files the user kept
        $existingFiles = json_decode($model->document_file, true) ?? []; // Get existing files from DB
        $submittedFiles = $request->input('existing_files', []); // Get files that were submitted and kept
        $allFileNames = $submittedFiles; // Start with submitted (kept) files

        // Handle new uploads
        if ($request->hasFile('document_file')) {
            foreach ($request->file('document_file') as $file) {
                $fileNameWithExtension = $file->getClientOriginalName();
                $file->move(public_path('/admin/assets/images/documents'), $fileNameWithExtension);
                $allFileNames[] = $fileNameWithExtension;
            }
        }

        // Optionally, delete removed files from disk
        $oldFiles = json_decode($model->document_file, true) ?? [];
        $removedFiles = array_diff($oldFiles, $existingFiles);
        foreach ($removedFiles as $removedFile) {
            $filePath = public_path('/admin/assets/images/documents/' . $removedFile);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $model->document_file = json_encode($allFileNames);

        // Save the updated project record
        $model->save();

        // Only send notification/email if updated by Admin
        if (Auth::user()->hasRole('Admin') && in_array($model->status, ['approved', 'rejected'])) {
            $creator = \App\Models\User::find($model->created_by);
            if ($creator) {
                $reason = $model->status === 'rejected' ? $model->rejection_reason : null;
                $creator->notify(new \App\Notifications\ProjectStatusUpdatedNotification($model, $reason));
                \Mail::to($creator->email)->send(new \App\Mail\ProjectStatusUpdated($model, $reason));
            }
        }
        // Redirect with a success message
        return redirect()->route('projects.index')->with('message', 'Project and related documents updated successfully!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Project::where('id', $id)->first();

        if ($model) {
            // Find and delete associated notifications
            DB::table('notifications')
                ->where('data->project_id', $id);            
            // Log the number of notifications found for this project
            $deletedCount = DB::table('notifications')
                ->where('data->project_id', $id)
                ->delete();

            \Log::info('Attempted to delete notifications for project ID with direct where: ' . $id . '. Deleted count: ' . $deletedCount);

            // Now delete the project
            $model->delete();

            return true;
        } else {
            return response()->json(['message' => 'Failed '], 404);
        }
    }


    public function downloadPDF($id)
    {
        $project = Project::where('id', $id)->firstOrFail();

        $pdf = PDF::loadView('admin.projects.pdf', compact('project'));
        $formattedParentId = ucfirst($project->parent_id);
        return $pdf->download($formattedParentId .'-'. $project->name . '.pdf');
    }


     public function downloadProjectsPDF($id)
    {
        $project = Project::findOrFail($id); 
        $project_categories = Category::where('status', 1)->get(); 

        // Load the view and pass project and project_categories
        $pdf = PDF::loadView('admin.projects.projectpdf', compact('project', 'project_categories'));
        $fileName = 'project-details-' . '.pdf';

        return $pdf->download($fileName);
    }
}
