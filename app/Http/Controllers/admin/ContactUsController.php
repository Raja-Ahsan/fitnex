<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        if($request->ajax()){
            $query = ContactUs::orderby('id' , 'desc')->where('id' , '>' , 0);
			if($request['search'] != ""){
                $query->where('name' , 'like' , '%' . $request['search'] .'%');
            }
            if($request['status'] != 'All'){
                if($request['status']==2){
                    $request['status']== 0;
                }
            $query->where('status' , $request['status']);
            }   
            $models= $query->paginate(10);
            return (string) view('admin.contact_us.search' , compact('models'));
        }

        $page_title= 'Free Trial Signup';
        $models=ContactUs::orderby('id', 'desc')->paginate(10); 
        return view('admin.contact_us.index' , compact('page_title' , 'models'));
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
            'name' => 'required|max:100',
            'email' => 'required|max:100',
        ]);

        $model = new ContactUs();
        $model->name = $request->name;
        $model->email = $request->email;
        $model->phone = $request->phone;
       /*  $model->address = $request->address; */
        $model->message = $request->message;
        $model->service = $request->service;    
        $model->save();
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'success'
            ]);
        }
         
        return redirect()->back()->with('contactmessage', 'Your message has been sent. Thank you!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = ContactUs::where('id', $id)->first();
        if ($model) {
            $model->delete();
            return true;
        } else {
            return response()->json(['message' => 'Failed '], 404);
        }
    }
}
