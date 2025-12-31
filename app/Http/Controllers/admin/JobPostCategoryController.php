<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\JobPostCategory;
use Illuminate\Http\Request;
use Auth;


class JobPostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:jobcategory-list|jobcategory-create|jobcategory-edit|jobcategory-delete', ['only' => ['index','store']]);
        $this->middleware('permission:jobcategory-create', ['only' => ['create','store']]);
        $this->middleware('permission:jobcategory-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:jobcategory-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $query = JobPostCategory::orderby('id', 'ASC')->where('id', '>', 0);
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
            return (string) view('admin.jobcategory.search', compact('models'));
        }
        $page_title = 'All Job Post Categories';
        $models = JobPostCategory::orderby('id', 'ASC')->paginate(10);
        return view('admin.jobcategory.index', compact("models","page_title"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Add Job Post Category';
        $categories = JobPostCategory::orderby('id', 'desc')->where('status', 1)->get();
        return view('admin.jobcategory.create', compact('page_title','categories'));
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

        $model = new JobPostCategory();

        $model->created_by = Auth::user()->id;
        $model->title = $request->title;
        $model->save();

        return redirect()->route('jobcategory.index')->with('message', 'Job Post Category Added Successfully !');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobPostCategory  $jobPostCategory
     * @return \Illuminate\Http\Response
     */
    public function show(JobPostCategory $jobPostCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobPostCategory  $jobPostCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_title = 'Edit Job Post Category';
        $model = JobPostCategory::where('id', $id)->first();
        $categories = JobPostCategory::orderby('id', 'desc')->where('status', 1)->get();
        return view('admin.jobcategory.edit', compact("model", "page_title",'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobPostCategory  $jobPostCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'title' => 'required|max:100',
        ]);

        $update = JobPostCategory::where('id', $id)->first();
        $update->title = $request->title;
        $update->status = $request->status;
        $update->update();

        return redirect()->route('jobcategory.index')->with('message', 'Job Post Category Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobPostCategory  $jobPostCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = JobPostCategory::where('id', $id)->first();
        if ($model) {
            $model->delete();
            return true;
        } else {
            return response()->json(['message' => 'Failed '], 404);
        }
    }

}
