<?php

namespace App\Http\Controllers\admin;

use App\Models\Testimonial;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;

class TestimonialController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:testimonial-list|testimonial-create|testimonial-edit|testimonial-delete', ['only' => ['index','store']]);
        $this->middleware('permission:testimonial-create', ['only' => ['create','store']]);
        $this->middleware('permission:testimonial-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:testimonial-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if($request->ajax()){
            $query = Testimonial::orderby('id', 'desc')->where('id', '>', 0);
            if($request['search'] != ""){
                $query->where('name', 'like', '%'. $request['search'] .'%');
            }
            if($request['status']!="All"){
                if($request['status']==2){
                    $request['status'] = 0;
                }
                $query->where('status', $request['status']);
            }
            $testimonials = $query->paginate(10);
            return (string) view('admin.testimonial.search', compact('testimonials'));
        }
        $page_title = 'All Testimonials';
        $testimonials = Testimonial::orderby('id', 'desc')->paginate(10);
        return view('admin.testimonial.index', compact("testimonials", "page_title"));
    }

    public function create()
    {
        $page_title = 'Add Testimonial';
        return view('admin.testimonial.create', compact('page_title'));
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
            'comment' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif,webp|required|max:10000' // max 10000kb
        ]);

        $testimonail = new Testimonial();

        if (isset($request->image)) {
            $photo = date('d-m-Y-His').'.'.$request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('/admin/assets/images/testimonials'), $photo);
            $testimonail->image = $photo;
        }

        $testimonail->name = $request->name;
        $testimonail->slug = \Str::slug($request->name);
        $testimonail->designation = $request->designation;
        $testimonail->rating = $request->rating;
        $testimonail->comment = $request->comment;
        $testimonail->save();

        return redirect()->route('testimonial.index')->with('message', 'Testimonial Added Successfully !');
    }

    public function edit($slug)
    {
        $page_title = 'Edit Testimonial';
        $testimonial = Testimonial::where('slug', $slug)->first();
        return view('admin.testimonial.edit', compact("testimonial", "page_title"));
    }

    public function update(Request $request, $slug)
    {
        $update = Testimonial::where('slug', $slug)->first();
        $validator = $request->validate([
            'name' => 'required',
            'comment' => 'required',
        ]);

        if (isset($request->image)) {
            $photo = date('d-m-Y-His').'.'.$request->file('image')->getClientOriginalExtension();
            $Image = $request->image->move(public_path('/admin/assets/images/testimonials'), $photo);
            $update->image = $photo;
        }

        $update->name = $request->name;
        $update->slug = \Str::slug($request->name);
        $update->designation = $request->designation;
        $update->rating = $request->rating;
        $update->comment = $request->comment;
        $update->status = $request->status;
        $update->update();

        return redirect()->route('testimonial.index')->with('message', 'Testimonial Updated Successfully !');
    }

    public function destroy($slug)
    {
        $testimonial = Testimonial::where('slug', $slug)->first();
        if ($testimonial) {
            $testimonial->delete();
            return true;
        } else {
            return response()->json(['message' => 'Failed '], 404);
        }
    }
}
