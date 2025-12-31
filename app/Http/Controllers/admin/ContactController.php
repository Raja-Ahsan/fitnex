<?php

namespace App\Http\Controllers\admin;

use App\Models\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\ContactUs;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function _construct()
    {
        $this->middleware('permission:contact-list|contact-create|contact-edit|contact-delete' , ['only' => ['index','store']]);
        $this->middleware('permission:contact-create' , ['only' => ['create','store']]);
        $this->middleware('permission:contact-edit' , ['only' => ['edit','update']]);
        $this->middleware('permission:contact-delete' , ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $query=Contact::orderby('id' , 'desc')->where('id' ,'>' , 0);
            if($request['search'] != ""){
                $query->where('name' , 'like' , '%' . $request['search'] .'%');
            }
            if($request['status'] != "All"){
                if($request['status']==2){
                    $request['status']==0;
                }
                $query->where('status' ,$request['status']);
            }
            $models = Contact::orderby('id' , 'desc')->paginate(10);
            return (string) view('admin.contact.search' , compact('models'));
        }

        $page_title= 'All Contact Us';

        $models = Contact::orderby('id' , 'desc')->paginate(10);
        return view('admin.contact.index' , compact('models', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title= "Add Contact";
        return view('admin.contact.create' , compact('page_title'));
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
            'phone' => 'required|max:100',
            'message' => 'required|max:1000',
        ]);

        $model = new Contact();

        $model->name = $request->name;
        $model->email = $request->email;
        $model->phone = $request->phone;
        $model->message = $request->message;
        $model->save();

        try {
            $toAddress = config('mail.from.address');
            if (!empty($toAddress)) {
                Mail::to($toAddress)->send(new ContactUs($model));
            }
        } catch (\Exception $e) {
            Log::error('Failed to send contact email: ' . $e->getMessage());
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'success'
            ]);
        }

        return redirect()->back()->with('message', 'Your message has been sent successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model=Contact::where('id' , $id)->first();
        if($model){
            $model->delete();
            return true;
        }
        else{
            return response()->json(['message' => 'Failed'], 404);
        }
    }
}
