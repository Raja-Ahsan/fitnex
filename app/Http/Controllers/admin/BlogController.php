<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\BlogCategory;
use App\Models\Category;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:blog-list|blog-create|blog-edit|blog-delete', ['only' => ['index','store']]);
        $this->middleware('permission:blog-create', ['only' => ['create','store']]);
        $this->middleware('permission:blog-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:blog-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if($request->ajax()){
            $query = Blog::orderby('id', 'desc')->where('id', '>', 0);
            if($request['search'] != ""){
                $query->where('title', 'like', '%'. $request['search'] .'%')
                    ->orWhere('category_slug', 'like', '%'. $request['search'] .'%');
            }
            if($request['status']!="All"){
                if($request['status']==2){
                    $request['status'] = 0;
                }
                $query->where('status', $request['status']);
            }
            $models = $query->paginate(10);
            return (string) view('admin.blog.search', compact('models'));
        }
        $page_title = 'All Blogs';
        $models = Blog::orderby('id', 'desc')->paginate(10);
        return view('admin.blog.index', compact("models", "page_title"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Add Blog';
        $categories = BlogCategory::get();
        return View('admin.blog.create', compact('page_title', 'categories'));
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
        ]);

        $model = new Blog();

        if (isset($request->post)) {
            $post = date('d-m-Y-His').'.'.$request->file('post')->getClientOriginalExtension();
            $request->post->move(public_path('/admin/assets/posts'), $post);
            $model->post = $post;
        }

        $model->created_by = Auth::user()->id;
        $model->category_slug = $request->category_slug;
        $model->title = $request->title;
        $model->slug = Str::slug($request->title);
        $model->description = $request->description; 
        $model->save();

        return redirect()->route('blog.index')->with('message', 'Blog Added Successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page_title = 'View Blog';
        $model = Blog::where('id', $id)->first();
        return view('admin.blog.show', compact("model", "page_title"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_title = 'Edit Blog';
        $model = Blog::where('id', $id)->first();
        $categories = BlogCategory::where('status', 1)->get();
        return view('admin.blog.edit', compact("model", "categories", "page_title"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'title' => 'required', 
        ]);

        $update = Blog::where('id', $id)->first();

        if (isset($request->post)) {
            $post = date('d-m-Y-His').'.'.$request->file('post')->getClientOriginalExtension();
            $request->post->move(public_path('/admin/assets/posts'), $post);
            $update->post = $post;
        }

        $update->category_slug = $request->category_slug;
        $update->title = $request->title;
        $update->slug = Str::slug($request->title);
        $update->description = $request->description; 
        $update->status = $request->status;
        $update->save();

        return redirect()->route('blog.index')->with('message', 'blog updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Blog::where('id', $id)->first();
        if ($model) {
            $model->delete();
            return true;
        } else {
            return response()->json(['message' => 'Failed '], 404);
        }
    }
}
