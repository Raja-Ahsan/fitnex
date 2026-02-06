<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use App\Models\JobPostCategory;
use App\Models\User;
use App\Models\Banner;
use App\Models\ClientContact;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\State;
use Auth;

class JobPostController extends Controller
{


    function __construct()
    {
        $this->middleware('permission:jobpost-list|jobpost-create|jobpost-edit|jobpost-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:jobpost-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:jobpost-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:jobpost-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user(); // Get the authenticated user

        if ($request->ajax()) {
            $query = JobPost::orderby('id', 'desc')->where('id', '>', 0);

            // Apply search filter
            if ($request->has('search') && $request['search'] != "") {
                $query->where('name', 'like', '%' . $request['search'] . '%');
            }

            // Apply status filter
            if ($request->has('status') && $request['status'] != 'All') {
                $status = $request['status'] == 2 ? 0 : $request['status'];
                $query->where('status', $status);
            }

            // Restrict to own JobPost for Contractors
            if ($user->hasRole('Contractor')) {
                $query->where('created_by', $user->id); // Show only the JobPost created by this contractor
            }

            $jobposts = $query->paginate(10);
            return (string) view('admin.jobpost.search', compact('jobposts'));
        }

        // Non-AJAX request
        $page_title = 'All Jobs';

        if ($user->hasRole('Contractor')) {
            // Show only own jobposts for Contractors
            $jobposts = JobPost::where('created_by', $user->id)->orderby('id', 'desc')->paginate(10);
        } else {
            // Admins or other roles see all jobposts
            $jobposts = JobPost::orderby('id', 'desc')->paginate(10);
        }

        return view('admin.jobpost.index', compact('jobposts', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = "Add Job";
        $cities = City::where('status', 1)->get();
        $categories = JobPostCategory::where('status', 1)->get();
        return view('admin.jobpost.create', compact('page_title' , 'categories', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|max:100',
            // 'description' => 'required|max:100',
            //'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
        ]);

        $jobpost = new JobPost();

        if (isset($request->image)) {
            $photo = date('y-m-d-His') . '.' . $request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('/admin/assets/images/jobpost'), $photo);
            $jobpost->image = $photo;
        }
        /* $jobpost->created_by = Auth::user()->name; */
        $jobpost->created_by = Auth::user()->id;
        $jobpost->name = $request->name;
        $jobpost->job_category_id = $request->category_id;
        $jobpost->city_id = $request->city_id;
        $jobpost->state_id = $request->state_id;
        $jobpost->short_description = $request->short_description;
        $jobpost->description = $request->description;
        $jobpost->county = $request->county;
        $jobpost->save();

        return redirect()->route('jobpost.index')->with('message', 'Job Post added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobPost  $jobPost
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page_title = 'Job Post Details';

        // Fetch a single jobpost by its ID
        $jobpost = JobPost::find($id);
        if (!$jobpost) {
            return redirect()->back()->withErrors(['error' => 'Job Post not found.']);
        }

        // Fetch the contractor details based on the jobpost's created_by field
        $contractor_detail = User::find($jobpost->created_by);

        $banner = Banner::where('id', 18)->where('status', 1)->first();
        // Fetch the related client contacts
        $client_contacts = ClientContact::where('status', 1)->where('agent_id', $id)->get();
        $jobposts = JobPost::where('status', 1)->get();
        // Fetch related jobposts (assuming you want to fetch some related jobposts)
        $related_jobposts = JobPost::where('status', 1)->where('id', '!=', $id)->get();

        return view('admin.jobpost.details', compact('page_title','jobposts', 'contractor_detail', 'banner', 'jobpost', 'client_contacts', 'related_jobposts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobPost  $jobPost
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_title = 'Edit Job';
        $jobposts = JobPost::where('id', $id)->first();
        $categories = JobPostCategory::where('status', 1)->get();
        $cities = City::where('status', 1)->get();
        $states = State::where('city_id', $jobposts->city_id)->get();
        return view('admin.jobpost.edit', compact('jobposts', 'page_title', 'categories', 'cities', 'states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobPost  $jobPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updates = JobPost::where('id', $id)->first();
        $validator = $request->validate([
            'name' => 'required|max:100',
        ]);

        if (isset($request->image)) {
            $photo = date('y-m-d-His') . '.' . $request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('/admin/assets/images/jobpost'), $photo);
            $updates->image = $photo;
        }

        /* $updates->created_by = Auth::user()->name; */
        $updates->created_by = Auth::user()->id;
        $updates->name = $request->name;
        $updates->job_category_id = $request->category_id;
        $updates->city_id = $request->city_id;
        $updates->state_id = $request->state_id;
        $updates->short_description = $request->short_description;
        $updates->description = $request->description;
        $updates->county = $request->county;
        $updates->status = $request->status;
        $updates->update();

        return redirect()->route('jobpost.index')->with('message', 'Job Post updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobPost  $jobPost
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jobpost = JobPost::where('id', $id)->first();
        if ($jobpost) {
            $jobpost->delete();
            return true;
        } else {
            return response()->json(['message' => 'Failed'], 404);
        }
    }
}
