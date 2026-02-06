<?php

namespace App\Http\Controllers\admin;

use App\Models\OurSponsor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class OurSponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:our_sponsor-list|our_sponsor-create|our_sponsor-edit|our_sponsor-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:our_sponsor-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:our_sponsor-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:our_sponsor-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = OurSponsor::orderby('id', 'desc')->where('id', '>', 0);
            if ($request['search'] != "") {
                $query->where('title', 'like', '%' . $request['search'] . '%');
            }
            if ($request['status'] != "All") {
                if ($request['status'] == 2) {
                    $request['status'] = 0;
                }
                $query->where('status', $request['status']);
            }
            $models = $query->paginate(10);
            return (string) view('admin.our_sponsor.search', compact('models'));
        }
        $page_title = 'All Our Sponsors';
        $models = OurSponsor::orderby('id', 'desc')->paginate(10);
        return View('admin.our_sponsor.index', compact("models", "page_title"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Add Our Sponsor';
        return View('admin.our_sponsor.create', compact('page_title'));
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
            'title' => 'required|max:100',
            'image' => 'mimes:jpeg,jpg,png,gif',
        ]);

        $model = new OurSponsor();

        if (isset($request->image)) {
            $photo = date('YmdHis').'.'.$request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('/admin/assets/images/our_sponsor'), $photo);
            $model->image = $photo;
        }

        $model->created_by = Auth::user()->id;
        $model->title = $request->title;
        $model->save();

        return redirect()->route('our_sponsor.index')->with('message', 'Our Sponsor Added Successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OurSponsor  $ourSponsor
     * @return \Illuminate\Http\Response
     */
    public function show(OurSponsor $ourSponsor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OurSponsor  $ourSponsor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_title = 'Edit Our Sponsor';
        $model = OurSponsor::where('id', $id)->first();
        return View('admin.our_sponsor.edit', compact('model','page_title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OurSponsor  $ourSponsor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validator = $request->validate([
            'title' => 'required|max:100',
            'image' => 'mimes:jpeg,jpg,png,gif',
        ]);

        $update = OurSponsor::where('id', $id)->first();

        if (isset($request->image)) {
            $photo = date('YmdHis').'.'.$request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('/admin/assets/images/our_sponsor'), $photo);
            $update->image = $photo;
        }

        $update->title = $request->title;
        $update->status = $request->status;
        $update->update();

        return redirect()->route('our_sponsor.index')->with('message', 'Our Sponsor Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OurSponsor  $ourSponsor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = OurSponsor::where('id', $id)->first();
        if ($model) {
            $model->delete();
            return true;
        } else {
            return response()->json(['message' => 'Failed '], 404);
        }
    }
}
