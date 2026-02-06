<?php

namespace App\Http\Controllers\admin;

use App\Models\AboutUs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use File;

class AboutUsController extends Controller
{
    function _construct()
    {
    $this->middleware('permission:about-list|about-create|about-edit|about-delete' , ['only' => ['index' , 'store']]);
    $this->middleware('permission:about-create' , ['only' => ['create' , 'store']]);
    $this->middleware('permission:about-edit' , ['only' => ['edit' , 'update']]);
    $this->middleware('permission:about-delete' , ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $query=AboutUs::orderby('id' , 'desc')->where('status' , '>' , 0);
            if($request['search'] != ""){
                $query->where('heading' , 'like' , '%' .$request['search']. '%');
            }
            if($request['status'] != "All"){
                if($request['status']==2){
                    $request['status'] = 0;
                }
            $query->where('status' , $request['status']);
            }
        $abouts=$query->paginate(10);
        return (string) view('admin.about.search' , compact('abouts'));
        }
        
        $page_title="All About Us";
        $abouts=AboutUs::orderby('id' , 'desc')->paginate(10);
        return view('admin.about.index' , compact('abouts' , 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title="Add About Us";
        return view('admin.about.create' , compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validator=$request->validate([
        //     'heading' => 'required',
        //     'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
        // ]);

        $abouts = new AboutUs;

        if(isset($request->image)){
            $photo=date('y-m-d-His').'.'.$request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('/admin/assets/images/about'), $photo);
            $abouts->image=$photo;
        }
        
        $abouts->created_by = Auth::user()->id;
        $abouts->slug = \Str::slug($request->heading);
        $abouts->heading = $request->heading;
        $abouts->short_description = $request->short_description;
        $abouts->description = $request->description;
        $abouts->save();

        return redirect()->route('about.index')->with('message' , 'About Added Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function show(AboutUs $aboutUs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_title="Add About Us";
        $abouts=AboutUs::where('id' , $id)->first();
        return view('admin.about.edit' , compact('abouts' , 'page_title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /* $validator=$request->validate([
            'heading' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
        ]); */

        $updates = AboutUs::where('id', $id)->first();

        if(isset($request->image)){
            $photo=date('y-m-d-His').'.'.$request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('/admin/assets/images/about'), $photo);
            $updates->image=$photo;
        }

        $updates->created_by = Auth::user()->id;
        $updates->slug = \Str::slug($request->heading);
        $updates->heading = $request->heading;
        $updates->short_description = $request->short_description;
        $updates->description = $request->description;
        $updates->status = $request->status;
        $updates->update();

        return redirect()->route('about.index')->with('message' , 'About Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $abouts=AboutUs::where('slug' , $slug)->first();
        if($abouts){
            $abouts->delete();
            return true;
        }
        else{
            return response()->json(['message' => 'Failed'], 404);
        }
    }
}
