<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     function __construct()
     {
         $this->middleware('permission:event-list|event-create|event-edit|event-delete', ['only' => ['index','store']]);
         $this->middleware('permission:event-create', ['only' => ['create','store']]);
         $this->middleware('permission:event-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:event-delete', ['only' => ['destroy']]);
     }
     public function index(Request $request)
     {
         if($request->ajax()){
             $query = Event::orderby('id', 'desc')->where('id', '>', 0);
             if($request['search'] != ""){
                 $query->where('title', 'like', '%'. $request['search'] .'%');
             }
             if($request['status']!="All"){
                 if($request['status']==2){
                     $request['status'] = 0;
                 }
                 $query->where('status', $request['status']);
             }
             $models = $query->paginate(10);
             return (string) view('admin.events.search', compact('models'));
         }
         $page_title = 'All Events';
         $models = Event::orderby('id', 'desc')->paginate(10);
         return view('admin.events.index', compact("models","page_title"));
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Add Events';
        return view('admin.events.create', compact('page_title'));
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
            'title' => 'required|max:100',
            'host' => 'required|max:100',
            'date' => 'required|max:100',
            'time' => 'required|max:100',
            'end_time' => 'required|max:100',
            'location' => 'required|max:100',
            'location_link' => 'required|max:100',
            'registration_link' => 'required|max:100',
        ]);

        $model = new Event();
        $model->created_by = Auth::user()->id;
        $model->title = $request->title;
        $model->host = $request->host;
        $model->date = $request->date;
        $model->time = $request->time;
        $model->end_time = $request->end_time;
        $model->location = $request->location;
        $model->location_link = $request->location_link;
        $model->registration_link = $request->registration_link;
        $model->save();

        return redirect()->route('event.index')->with('message', 'Event Added Successfully !');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page_title= 'Show Event';
        $event=Event::where('id' , $id)->first();
        return view('admin.events.show' , compact('page_title' , 'event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_title = 'Edit Events';
        $event = Event::where('id', $id)->first();
        return view('admin.events.edit', compact('event','page_title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'title' => 'required|max:100',
            'host' => 'required|max:100',
            'date' => 'required|max:100',
            'time' => 'required|max:100',
            'end_time' => 'required|max:100',
            'location' => 'required|max:100',
            'location_link' => 'required|max:100',
            'registration_link' => 'required|max:100',
        ]);

        $update = Event::where('id', $id)->first();
        $update->title = $request->title;
        $update->host = $request->host;
        $update->date = $request->date;
        $update->time = $request->time;
        $update->end_time = $request->end_time;
        $update->location = $request->location;
        $update->location_link = $request->location_link;
        $update->registration_link = $request->registration_link;
        $update->status = $request->status;
        $update->update();

        return redirect()->route('event.index')->with('message', 'Event Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Event::where('id', $id)->first();
        if ($model) {
            $model->delete();
            return true;
        } else {
            return response()->json(['message' => 'Failed '], 404);
        }
    }
}
