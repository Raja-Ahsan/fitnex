<?php

namespace App\Http\Controllers\admin;

use App\Models\Trainer;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Auth;

class TrainerController extends Controller
{


    function __construct()
    {
         $this->middleware('permission:trainer-list|trainer-create|trainer-edit|trainer-delete', ['only' => ['index','store']]);
         $this->middleware('permission:trainer-create', ['only' => ['create','store']]);
         $this->middleware('permission:trainer-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:trainer-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $query = Trainer::orderby('id' , 'desc')->where('id' , '>' , 0);
            if($request['search'] != ""){
                $query->where('name' , 'like' , '%' .$request['search'] .'%');
            }
            if($request['status'] != "All"){
                if($request['status']==2){
                    $request['status'] = 0;
                }
                $query->where('status' , $request['status']);
            }
            $trainers=$query->paginate(10);
            return (string) view('admin.trainer.search' , compact('trainers'));
        }

        $page_title ='All Trainers';
        $trainers= Trainer::orderby('id' , 'desc')->paginate(10);
        return view('admin.trainer.index' , compact('trainers' , 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page_title = 'Add Trainer'; 
        return view('admin.trainer.create', compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validator = $request->validate([
        'name' => 'required',
        'designation' => 'required',
        'email' => 'nullable|email',
        'phone' => 'nullable',
        'trainer_type' => 'required',
        'description' => 'required',
        'price' => 'required',
        'state' => 'required', 
        'city' => 'required',
        'google_calendar_id' => 'required',
        'image' => 'required|mimes:jpeg,jpg,png,gif,webp|max:10000',
    ]);

    $trainers = new Trainer();
    if ($request->hasFile('image')) {
        $photo = date('y-m-d-His') . '.' . $request->file('image')->getClientOriginalExtension();
        $request->image->move(public_path('/admin/assets/images/Trainers'), $photo);
        $trainers->image = $photo;
    }

    $trainers->created_by = Auth::user()->id;
    $trainers->name = $request->name;
    $trainers->designation = $request->designation;
    $trainers->email = $request->email;
    $trainers->phone = $request->phone;
    $trainers->trainer_type = $request->trainer_type;
    $trainers->description = $request->description;
    $trainers->price = $request->price;
    $trainers->rating = $request->rating;
    $trainers->specialization = json_encode($request->specialization);
    $trainers->city = $request->city;
    $trainers->state = $request->state;
    $trainers->facebook = $request->facebook;
    $trainers->twitter = $request->twitter;
    $trainers->instagram = $request->instagram;
    $trainers->linkedin = $request->linkedin;
    $trainers->youtube = $request->youtube;
    // Extract calendar ID from URL if full URL is provided
    $trainers->google_calendar_id = $this->extractCalendarId($request->google_calendar_id);
    $trainers->save();

    return redirect()->route('trainer.index')->with('message', 'Trainer added Successfully');
}


    /**
     * Display the specified resource.
     */
    public function show(Trainer $trainer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $page_title='Edit Trainer';
        $trainer= Trainer::where('id' , $id)->first(); 
        return view('admin.trainer.edit' , compact('page_title' , 'trainer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    { 
        
        $validator = $request->validate([
            'name' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif,webp|nullable|max:10000',
            'designation' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'trainer_type' => 'required',
            'description' => 'required',
            'price' => 'required',
            'state' => 'required', 
            'city' => 'required', 
            'google_calendar_id' => 'required',
        ]);


        $updates = Trainer::where('id' , $id)->first();
        if (isset($request->image)) {
            $photo = date('d-m-Y-His').'.'.$request->file('image')->getClientOriginalExtension();
            $Image = $request->image->move(public_path('/admin/assets/images/Trainers'), $photo);
            $updates->image = $photo;
        }

        $updates->created_by = Auth::user()->id;
        $updates->name = $request->name;
        $updates->designation = $request->designation;
        $updates->email = $request->email;
        $updates->phone = $request->phone;
        $updates->trainer_type = $request->trainer_type;
        $updates->description = $request->description;
        $updates->price = $request->price; 
        $updates->rating = $request->rating;
        $updates->specialization = json_encode($request->specialization);
        $updates->city = $request->city;
        $updates->state = $request->state;
        $updates->facebook = $request->facebook;
        $updates->twitter = $request->twitter;
        $updates->instagram = $request->instagram; 
        $updates->linkedin = $request->linkedin;
        $updates->youtube = $request->youtube;
        // Extract calendar ID from URL if full URL is provided
        $updates->google_calendar_id = $this->extractCalendarId($request->google_calendar_id);
        $updates->status = $request->status;
        $updates->update();

        return redirect()->route('trainer.index')->with('message' , 'Trainer updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $trainers = Trainer::where('id', $id)->first();
        if ($trainers) {
            $trainers->delete();
            return true;
        } else {
            return response()->json(['message' => 'Failed '], 404);
        }
    }

    /**
     * Extract Google Calendar ID from URL or return as is if already an ID
     * 
     * @param string|null $input
     * @return string|null
     */
    private function extractCalendarId($input)
    {
        if (empty($input)) {
            return null;
        }

        // If it's a Calendly URL or any other external calendar URL, return as is
        if (strpos($input, 'calendly.com') !== false || strpos($input, 'cal.com') !== false) {
            return $input;
        }

        // If it's already a calendar ID format (contains @ or is just an ID), return as is
        // But only if it DOESN'T look like a generic URL (unless it's a known Google URL)
        $isUrl = filter_var($input, FILTER_VALIDATE_URL);
        if (strpos($input, '@') !== false || !$isUrl) {
            return $input;
        }

        // Extract calendar ID from various Google Calendar URL formats
        // Format 1: https://calendar.app.google/vqjFXvdZs3cUJxry8
        if (preg_match('/calendar\.app\.google\/([a-zA-Z0-9_-]+)/', $input, $matches)) {
            return $matches[1];
        }

        // Format 2: https://calendar.google.com/calendar/embed?src=CALENDAR_ID
        if (preg_match('/[?&]src=([^&]+)/', $input, $matches)) {
            return urldecode($matches[1]);
        }

        // Format 3: https://www.googleapis.com/calendar/v3/calendars/CALENDAR_ID
        if (preg_match('/calendars\/([^\/\?]+)/', $input, $matches)) {
            return urldecode($matches[1]);
        }

        // Format 4: https://calendar.google.com/calendar/u/0/appointments/schedules/SCHEDULE_ID
        // Note: This is an appointments schedule link, not a calendar ID
        // The schedule ID can sometimes work, but the actual calendar ID is preferred
        if (preg_match('/appointments\/schedules\/([a-zA-Z0-9_-]+)/', $input, $matches)) {
            // Return the schedule ID - user should use the actual calendar ID instead
            // But we'll extract it in case they want to try it
            return $matches[1];
        }

        // Format 5: https://calendar.google.com/calendar/u/0?cid=CALENDAR_ID
        if (preg_match('/[?&]cid=([^&]+)/', $input, $matches)) {
            return urldecode($matches[1]);
        }

        // If it's a URL but didn't match Google patterns, and isn't a known calendar URL like Calendly,
        // we previously returned it as is. We will continue to do so, treating it as a raw Google Calendar ID or a direct link.
        return $input;
    }
}
