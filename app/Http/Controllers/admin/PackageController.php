<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Category;
use Illuminate\Http\Request;
use Auth;

class PackageController extends Controller
{


    function __construct()
    {
        $this->middleware('permission:package-list|package-create|package-edit|package-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:package-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:package-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:package-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Package::orderby('id', 'desc')->where('id', '>', 0);
            if ($request['search'] != "") {
                $query->where('title', 'like', '%' . $request['search'] . '%');
                $query->orWhere('package_for', 'like', '%' . $request['search'] . '%');
            }
            if ($request['status'] != "All") {
                if ($request['status'] == 2) {
                    $request['status'] = 0;
                }
                $query->where('status', $request['status']);
            }
            $models = $query->paginate(10);
            return (string) view('admin.package.search', compact('models'));
        }
        $page_title = 'All Packages';
        $models = Package::orderby('id', 'desc')->paginate(10);
        return view('admin.package.index', compact('models', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Add Packages';
        $categories = Category::where('status', 1)->get(); // Fetch categories
        return view('admin.package.create', compact('page_title', 'categories'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Define validation rules
        $validator = $request->validate([
            'title' => 'required',
           /*  'description' => 'required', */
            'price' => 'required', // Price should also be required
            'package_for' => 'required', // Ensure package_for is selected
            'period' => 'required', // Ensure period is selected
        ]);

        // Create a new Package instance
        $model = new Package();

        // Assign values to model attributes
        $model->created_by = Auth::user()->id;
        $model->title = $request->title;
        $model->package_for = $request->package_for;
        $model->price = $request->price;
        $model->period = $request->period;
        $model->description = $request->description;

        // Save the package
        $model->save();

        // Redirect back with a success message
        return redirect()->route('package.index')->with('message', 'Package Added Successfully!');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_title = ' Edit Packages';
        $model = Package::where('id', $id)->first();
        $categories = Category::where('status', 1)->get();
        return view('admin.package.edit', compact('page_title', 'model', 'categories'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the input data
        $validator = $request->validate([
            'title' => 'required',
            /* 'description' => 'required', */
            /* 'package_for' => 'required', */  // Add validation for 'package_for'
            'period' => 'required',  // Ensure 'period' is validated
            'price' => 'nullable|numeric',  // Price can be nullable but must be numeric if provided
           
        ]);

        // Find the package to update
        $update = Package::find($id);

        // Update the package data
        $update->title = $request->title;
        $update->package_for = $request->package_for;
        $update->price = $request->price;
        $update->period = $request->period;
        $update->description = $request->description;
        $update->status = $request->status;

        

        // Save the updated package
        $update->save();

        // Redirect to the package index with a success message
        return redirect()->route('package.index')->with('message', 'Package Updated Successfully!');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Package::where('id', $id)->first();
        if ($model) {
            $model->delete();
            return true;
        } else {
            return response()->json(['message' => 'Failed'], 404);
        }
    }
}
