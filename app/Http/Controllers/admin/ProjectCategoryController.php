<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Models\ProjectCategory; 
use Auth;

class ProjectCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:project_category-list|project_category-create|project_category-edit|project_category-delete', ['only' => ['index','store']]);
        $this->middleware('permission:project_category-create', ['only' => ['create','store']]);
        $this->middleware('permission:project_category-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:project_category-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $query = ProjectCategory::orderby('id', 'ASC')->where('id', '>', 0);
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
            return (string) view('admin.project_category.search', compact('models'));
        }
        $page_title = 'All Project Categories';
        $models = ProjectCategory::orderby('id', 'ASC')->paginate(10);
        return view('admin.project_category.index', compact("models","page_title"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Add Project Category';
        $categories = ProjectCategory::orderby('id', 'desc')->where('status', 1)->get();
        return view('admin.project_category.create', compact('page_title','categories'));
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

        $model = new ProjectCategory();
		
		if (isset($request->image)) {
            $photo = date('YmdHis').'.'.$request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('/admin/assets/images/project_category'), $photo);
            $model->image = $photo;
        }
		$parent_id = $request->parent_id;
        if($parent_id == 0){
            $parent_id = 0;
        }

        $model->created_by = Auth::user()->id;
        $model->title = $request->title;
        $model->parent_id = $parent_id;
        /* $model->description = $request->description; */
        $model->slug = \Str::slug($request->title);
        $model->save();

        return redirect()->route('project_category.index')->with('message', 'Project Category Added Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectCategory  $projectCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectCategory $projectCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectCategory  $projectCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $page_title = 'Edit Game';
        $model = ProjectCategory::where('slug', $slug)->first();
        $categories = ProjectCategory::orderby('id', 'desc')->where('status', 1)->get();
        return view('admin.project_category.edit', compact("model", "page_title",'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectCategory  $projectCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $validator = $request->validate([
            'title' => 'required|max:100',
        ]);

        $update = ProjectCategory::where('slug', $slug)->first();
		
		if (isset($request->image)) {
            $photo = date('YmdHis').'.'.$request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('/admin/assets/images/project_category'), $photo);
            $update->image = $photo;
        }
		$parent_id = $request->parent_id;
        if($parent_id == 0){
            $parent_id = 0;
        }

        $update->title = $request->title;
        $update->parent_id = \Str::slug($parent_id);
        $update->slug = \Str::slug($request->title);
        /* $update->description = $request->description; */
        $update->status = $request->status;
        $update->update();

        return redirect()->route('project_category.index')->with('message', 'Project Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectCategory  $projectCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $model = ProjectCategory::where('slug', $slug)->first();
        if ($model) {
            $model->delete();
            return true;
        } else {
            return response()->json(['message' => 'Failed '], 404);
        }
    }
}
