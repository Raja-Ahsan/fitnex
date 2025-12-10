<?php

namespace App\Http\Controllers\admin;
use App\Models\HomeSlider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;


class HomeSliderController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:homeslider-list|homeslider-create|homeslider-edit|homeslider-delete', ['only' => ['index','store']]);
        $this->middleware('permission:homeslider-create', ['only' => ['create','store']]);
        $this->middleware('permission:homeslider-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:homeslider-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        if($request->ajax()){
            $query = HomeSlider::orderby('id', 'desc')->where('id', '>', 0);
            if($request['search'] != ""){
                $query->where('name', 'like', '%'. $request['search'] .'%');
            }
            if($request['status']!="All"){
                if($request['status']==2){
                    $request['status'] = 0;
                }
                $query->where('status', $request['status']);
            }
            $homesliders = $query->paginate(10);
            return (string) view('admin.home_slider.search', compact('homesliders'));
        }
        $page_title = 'All Home Sliders';
        $homesliders = HomeSlider::orderby('id', 'desc')->paginate(10);
        return View('admin.home_slider.index', compact("homesliders", "page_title"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Add Home Slider';
        return View('admin.home_slider.create', compact('page_title'));
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
            'title' => 'required',
            'heading' => 'required',
            'description' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif',
        ]);

        $homeSlider = new HomeSlider();

        if (isset($request->image)) {
            $photo = date('d-m-Y-His').'.'.$request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('/admin/assets/images/HomeSlider'), $photo);
            $homeSlider->image = $photo;
        }

        $homeSlider->title = $request->title;
        /* $homeSlider->slug = \Str::slug($request->title); */
        $homeSlider->heading = $request->heading;
        $homeSlider->description = $request->description;
        $homeSlider->save();
        return redirect()->route('homeslider.index')->with('message', 'Home Slider Added Successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HomeSlider  $homeSlider
     * @return \Illuminate\Http\Response
     */
    public function show(HomeSlider $homeSlider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HomeSlider  $homeSlider
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_title = 'Edit Home Slider';
        $homeSlider = HomeSlider::where('id', $id)->first();
        return View('admin.home_slider.edit', compact("homeSlider", "page_title"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HomeSlider  $homeSlider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update = HomeSlider::where('id', $id)->first();
        $validator = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'heading' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif',
        ]);

        if (isset($request->image)) {
            $photo = date('d-m-Y-His').'.'.$request->file('image')->getClientOriginalExtension();
            $Image = $request->image->move(public_path('/admin/assets/images/HomeSlider'), $photo);
            $update->image = $photo;
        }

        $update->title = $request->title;
        /* $update->slug = \Str::slug($request->title); */
        $update->heading = $request->heading;
        $update->description = $request->description;
        $update->status = $request->status;
        $update->update();

        return redirect()->route('homeslider.index')->with('message', 'Home Slider Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HomeSlider  $homeSlider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $homeSlider = HomeSlider::where('id', $id)->first();
        if ($homeSlider) {
            $homeSlider->delete();
            return true;
        } else {
            return response()->json(['message' => 'Failed '], 404);
        }
    }
}
