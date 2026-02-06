<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use Illuminate\Http\Request;
use Auth;

class CareerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // function __construct()
    // {
    //     $this->middleware('permission:career-list|career-create', ['only' => ['index','store']]);
    //     $this->middleware('permission:career-create', ['only' => ['create','store']]);
    //     $this->middleware('permission:career-delete', ['only' => ['destroy']]);
    // }

    public function index(Request $request)
    {
        if($request->ajax()){
            $query = Career::orderby('id' , 'desc')->where('id' , '>' , 0);
			if($request['search'] != ""){
                $query->where('first_name', 'like', '%'. $request['search'] .'%')
                    ->orWhere('last_name', 'like', '%'. $request['search'] .'%')
                    ->orWhere('email', 'like', '%'. $request['search'] .'%');
            }
			
            if($request['status'] != 'All'){
                if($request['status']==2){
                    $request['status']== 0;
                }
            $query->where('status' , $request['status']);
            }
            $models= $query->paginate(10);
            return (string) view('admin.career.search' , compact('models'));
        }

            $page_title= 'All Career';
            $models=Career::where('status' , 1)->paginate(10);
            return view('admin.career.index' , compact('page_title' , 'models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'email' => 'required|max:100',
            'phone' => 'required|max:100',
            'address' => 'required|max:100',
            'city' => 'required|max:100',
            'state' => 'required|max:100',
            'postal' => 'required|max:100',

        ]);

        $model = new Career();

        if(isset($request->CV_file)){
            $photo=date('y-m-d-His').'.'.$request->file('CV_file')->getClientOriginalExtension();
            $request->CV_file->move(public_path('/admin/assets/images/file'), $photo);
            $model->CV_file = $photo;
        }

        $model->first_name = $request->first_name;
        $model->last_name = $request->last_name;
        $model->email = $request->email;
        $model->phone = $request->phone;
        $model->address = $request->address;
        $model->city = $request->city;
        $model->state = $request->state;
        $model->postal = $request->postal;
        $model->save();

        return redirect()->back()->with('message', 'Career Added Successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $page_title= 'All Career';
        $models=Career::where('id' , $id)->first();
        return view('admin.career.show' , compact('page_title' , 'models'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function edit(Career $career)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Career $career)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Career::where('id', $id)->first();
        if ($model) {
            $model->delete();
            return true;
        } else {
            return response()->json(['message' => 'Failed '], 404);
        }
    }
}
