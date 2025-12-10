<?php

namespace App\Http\Controllers\admin;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\GalleryDetail;
use App\Http\Controllers\Controller;
use file;
use Auth;


class GalleryController extends Controller
{

    function _construct()
    {
        $this->middleware('permission:gallery-list|gallery-create|gallery-edit|gallery-delete' , ['only' => ['index','store']]);
        $this->middleware('permission:gallery-create' , ['only' => ['create','store']]);
        $this->middleware('permission:gallery-edit' , ['only' => ['edit','update']]);
        $this->middleware('permission:gallery-delete' , ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $query=Gallery::orderby('id' , 'desc')->where('id' ,'>' , 0);
			if($request['search'] != ""){
                $query->where('slug', 'like', '%'. $request['search'] .'%');
            }
            if($request['status'] != "All"){
                if($request['status']==2){
                    $request['status']==0;
                }
                $query->where('status' ,$request['status']);
            }
            $galleries=$query->paginate(10);
            return (string) view('admin.gallery.search' , compact('galleries'));
        }

        $page_title= 'All Galleries';
       // $categories=Category::where('status' , 1)->get();
        $galleries = Gallery::orderby('id' , 'desc')->paginate(10);
        return view('admin.gallery.index' , compact('galleries', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title= "Add Gallery";
        $categories=Category::where('status' , 1)->get();
        return view('admin.gallery.create' , compact('page_title', 'categories'));
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
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
        ]);

        $galleries = new Gallery();

        if(isset($request->image)){
            $photo=date('y-m-d-His').'.'.$request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('/admin/assets/galleries/thumbnails'), $photo);
            $galleries->image = $photo;
        }
        $galleries->created_by = Auth::user()->id;
        $galleries->category_id = $request->category_id;
        $galleries->slug = $request->slug;
        $galleries->save();

		if($galleries && isset($request->images))
        {
            if ($files=$request->file('images')) {
                foreach($files as $file){
                    $photo = md5($file->getClientOriginalName().time()).'.'.$file->getClientOriginalExtension();
                    $file->move(public_path('/admin/assets/galleries/images'), $photo);

                    GalleryDetail::create([
                        'galleries_slug' => $galleries->slug,
                        'image' => $photo,
                    ]);
                }
            }
		}

        return redirect()->route('gallery.index')->with('message' , 'Gallery added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $galleries = Gallery::where('category_id', $id)->where('status', 1)->paginate(6);
        return view('website.gallery-detail', compact('galleries'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $page_title= "Edit Gallery";
        $galleries=Gallery::where('slug' , $slug)->first();
        $categories=Category::where('status' , 1)->get();
        return view('admin.gallery.edit' , compact('page_title' , 'galleries', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $updates = Gallery::where('slug', $slug)->first();
        $validator = $request->validate([
            //'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
        ]);

        if(isset($request->image)){
            $photo=date('y-m-d-His').'.'.$request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('/admin/assets/galleries/thumbnails'), $photo);
            $updates->image = $photo;
        }
        $updates->created_by = Auth::user()->id;
        $updates->category_id = $request->category_id;
        $updates->slug = $request->slug;
        $updates->status = $request->status;
        $updates->update();


		if($updates && isset($request->images))
        {
            if ($files=$request->file('images')) {
                foreach($files as $file){
                    $photo = md5($file->getClientOriginalName().time()).'.'.$file->getClientOriginalExtension();
                    $file->move(public_path('/admin/assets/galleries/images'), $photo);

                    GalleryDetail::create([
                        'galleries_slug' => $updates->slug,
                        'image' => $photo,
                    ]);
                }
            }
        }

        return redirect()->route('gallery.index')->with('message' , 'Gallery updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $galleries=Gallery::where('slug' , $slug)->first();
        if($galleries){
            $galleries->delete();
            return true;
        }
        else{
            return response()->json(['message' => 'Failed'], 404);
        }

    }

    public function removeGalleryImage(Request $request)
    {
        $model = GalleryDetail::where('id', $request->product_image_id)->delete();
        if($model){
            return true;
        }else{
            return false;
        }
    }

    public function getImages(Request $request)
    {
		$images = GalleryDetail::where('galleries_slug' , $request->slug)->get();
		return (string) view('admin.gallery.ajax', compact('images'));
    }
}
