<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:meet_the_team-list|meet_the_team-create|meet_the_team-edit|meet_the_team-delete', ['only' => ['index','store']]);
        $this->middleware('permission:meet_the_team-create', ['only' => ['create','store']]);
        $this->middleware('permission:meet_the_team-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:meet_the_team-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Team::orderby('id', 'desc')->where('id', '>', 0);
            if ($request['search'] != "") {
                $query->where('name', 'like', '%' . $request['search'] . '%');
            }
            if ($request['status'] != "All") {
                if ($request['status'] == 2) {
                    $request['status'] = 0;
                }
                $query->where('status', $request['status']);
            }
            $teams = $query->paginate(10);
            return (string) view('admin.team.search', compact('teams'));
        }
        $page_title = 'Meet the Team';
        $teams = Team::orderby('id', 'desc')->paginate(10);
        return view('admin.team.index', compact("teams", "page_title"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Add Meet the Team';
        return view('admin.team.create', compact('page_title'));
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
            'designation' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb
        ]);

        $team = new Team();

        if (isset($request->image)) {
            $photo = date('d-m-Y-His').'.'.$request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('/admin/assets/images/team'), $photo);
            $team->image = $photo;
        }

        $team->name = $request->name; 
        $team->designation = $request->designation; 
        $team->save();

        return redirect()->route('meet_the_team.index')->with('message', 'Team Added Successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page_title = 'View Meet the Team';
        $team = Team::where('id', $id)->first();
        return view('admin.team.show', compact("team", "page_title"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_title = 'Edit Meet the Team';
        $team = Team::where('id', $id)->first();
        return view('admin.team.edit', compact("team", "page_title"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update = Team::where('id', $id)->first();
        $validator = $request->validate([
            'name' => 'required',
            'designation' => 'required',
        ]);

        if (isset($request->image)) {
            $photo = date('d-m-Y-His').'.'.$request->file('image')->getClientOriginalExtension();
            $Image = $request->image->move(public_path('/admin/assets/images/team'), $photo);
            $update->image = $photo;
        }

        $update->name = $request->name; 
        $update->designation = $request->designation;
        $update->status = $request->status;
        $update->update();

        return redirect()->route('meet_the_team.index')->with('message', 'Team Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $team = Team::where('id', $id)->first();
        if ($team) {
            $team->delete();
            return true;
        } else {
            return response()->json(['message' => 'Failed '], 404);
        }
    }
}
