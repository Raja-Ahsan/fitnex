<?php

namespace App\Http\Controllers\admin;

use App\Models\Agent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Auth;

class AgentController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:agents-list|agents-create|agents-edit|agents-delete', ['only' => ['index','store']]);
         $this->middleware('permission:agents-create', ['only' => ['create','store']]);
         $this->middleware('permission:agents-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:agents-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $query = Agent::orderby('id' , 'desc')->where('id' , '>' , 0);
            if($request['search'] != ""){
                $query->where('name' , 'like' , '%' .$request['search'] .'%');
            }
            if($request['status'] != "All"){
                if($request['status']==2){
                    $request['status'] = 0;
                }
                $query->where('status' , $request['status']);
            }
            $agents=$query->paginate(10);
            return (string) view('admin.agents.search' , compact('agents'));
        }

        $page_title ='All Agents';
        $agents= Agent::orderby('id' , 'desc')->paginate(10);
        return view('admin.agents.index' , compact('agents' , 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title= 'Add Agents';
        return view('admin.agents.create' , compact('page_title'));
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
            'name' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
            'designation' => 'required',
        ]);

        $agents = new Agent();

        if(isset($request->image)){
            $photo= date('d-m-Y-His').'.'.$request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('/admin/assets/images/Agents'), $photo);
            $agents->image = $photo;
        }

        $agents->created_by = Auth::user()->id;
        $agents->name = $request->name;
        $agents->slug = \Str::slug($request->name);
        $agents->designation = $request->designation;
        $agents->facebook = $request->facebook;
        $agents->twitter = $request->twitter;
        $agents->instagram = $request->instagram;
        $agents->behance = $request->behance;
        $agents->youtube = $request->youtube;
        $agents->save();

        return redirect()->route('agents.index')->with('message' , 'Agent added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function show(Agent $agent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $page_title='Edit Agents';
        $agents= Agent::where('slug' , $slug)->first();
        return view('admin.agents.edit' , compact('page_title' , 'agents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request , $slug)
    {
        $updates = Agent::where('slug', $slug)->first();
        $validator = $request->validate([
            'name' => 'required',
        ]);

        if (isset($request->image)) {
            $photo = date('d-m-Y-His').'.'.$request->file('image')->getClientOriginalExtension();
            $Image = $request->image->move(public_path('/admin/assets/images/Agents'), $photo);
            $updates->image = $photo;
        }

        $updates->name = $request->name;
        $updates->slug = \Str::slug($request->name);
        $updates->designation = $request->designation;
        $updates->facebook = $request->facebook;
        $updates->twitter = $request->twitter;
        $updates->instagram = $request->instagram;
        $updates->behance = $request->behance;
        $updates->youtube = $request->youtube;
        $updates->status = $request->status;
        $updates->update();

        return redirect()->route('agents.index')->with('message', 'Agent Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $agents = Agent::where('slug', $slug)->first();
        if ($agents) {
            $agents->delete();
            return true;
        } else {
            return response()->json(['message' => 'Failed '], 404);
        }
    }
}
