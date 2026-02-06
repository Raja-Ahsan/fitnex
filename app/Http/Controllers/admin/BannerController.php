<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:banner-list|banner-create|banner-edit|banner-delete', ['only' => ['index','store']]);
        $this->middleware('permission:banner-create', ['only' => ['create','store']]);
        $this->middleware('permission:banner-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:banner-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $query=Banner::orderby('id' , 'desc')->where('id' ,'>' , 0);
            if($request['search'] != ""){
                $query->where('name', 'like', '%'. $request['search'] .'%');
            }
            if($request['status'] != "All"){
                if($request['status']==2){
                    $request['status']==0;
                }
                $query->where('status' ,$request['status']);
            }
            $banners=$query->paginate(10);
            $pages = $this->getPages();
            return (string) view('admin.banner.search' , compact('banners', 'pages'));
        }

        $page_title= 'All Banner';
        $pages = $this->getPages();
        $banners = Banner::orderby('id' , 'desc')->paginate(10);
        return view('admin.banner.index' , compact('banners', 'page_title', 'pages'));
    }

    private function getPages()
    {
        return [
            'about-us' => 'About Us',
            'trainers' => 'Trainers',
            'trainer.detail' => 'Trainer Detail',
            'blog' => 'Blog',
            'contact-us' => 'Contact Us',
            'term-of-service' => 'Terms Of Service',
            'privacy-policy' => 'Privacy Policy',
            'refund-policy' => 'Refund Policy',
            'appointments.create' => 'Appointments',
            'registration' => 'Registration',
            'login' => 'Login',
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title= "Add Banner";
        $pages = $this->getPages();
        return view('admin.banner.create' , compact('page_title', 'pages'));
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
            // 'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
        ]);

        $banner = new Banner();

        if(isset($request->image)){
            $photo=date('y-m-d-His').'.'.$request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('/admin/assets/images/banner'), $photo);
            $banner->image = $photo;
        }
        $banner->name = $request->name;
        $banner->slug = $request->slug;
        $banner->short_description = $request->short_description;
        $banner->description = $request->description;
        $banner->save();

        return redirect()->route('banner.index')->with('message' , 'Banner added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_title= 'Edit Banner';
        $banners=Banner::where('id' , $id)->first();
        $pages = [
            'about-us' => 'About Us',
            'trainers' => 'Trainers',
            'trainer.detail' => 'Trainer Detail',
            'blogs' => 'Blogs',
            'contact-us' => 'Contact Us',
            'appointments.create' => 'Appointments',
            'term-of-service' => 'Terms Of Service', 
            'privacy-policy' => 'Privacy Policy', 
            'refund-policy' => 'Refund Policy',
            'registration' => 'Registration',
            'login' => 'Login',
        ];
        return view('admin.banner.edit' , compact('banners' , 'page_title', 'pages'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $updates = Banner::where('id', $id)->first();
            $validator = $request->validate([
                'name' => 'required|max:100',
            ]);

        if(isset($request->image)){
            $photo=date('y-m-d-His').'.'.$request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('/admin/assets/images/banner'), $photo);
            $updates->image = $photo;
        }
        $updates->name = $request->name;
        $updates->slug = $request->slug;
        $updates->short_description = $request->short_description;
        $updates->description = $request->description;
        $updates->status = $request->status;
        $updates->update();

        return redirect()->route('banner.index')->with('message' , 'Banner updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner=Banner::where('id' , $id)->first();
        if($banner){
            $banner->delete();
            return true;
        }
        else{
            return response()->json(['message' => 'Failed'], 404);
        }
    }
}
