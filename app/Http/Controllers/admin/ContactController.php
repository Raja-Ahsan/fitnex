<?php

namespace App\Http\Controllers\admin;

use App\Models\Contact;
use App\Http\Controllers\Controller;
use App\Mail\ContactUs;
use App\Services\ContactNotificationMailService;
use Illuminate\Http\Request;
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
     * Store a newly created contact
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // store contact
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

        $mailResult = ContactNotificationMailService::send(new ContactUs($model));

        if ($request->ajax()) {
            if (!$mailResult['ok']) {
                return response()->json([
                    'success' => false,
                    'saved' => true,
                    'email_sent' => false,
                    'message' => $mailResult['message'],
                ], 422);
            }

            return response()->json([
                'success' => true,
                'saved' => true,
                'email_sent' => true,
                'message' => 'Thank you! Your message was received and we have been notified by email.',
            ]);
        }

        if (!$mailResult['ok']) {
            return redirect()->back()->with(
                'warning',
                'Your message was saved, but the notification email could not be sent. ' . $mailResult['message']
            );
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
