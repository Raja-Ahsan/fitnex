<?php

namespace App\Http\Controllers\admin;

use App\Models\ClientContact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\MemberContactedEpcDeveloper;
use Illuminate\Support\Facades\Mail;

class ClientContactController extends Controller
{
    //client_contact

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function _construct()
    {
        $this->middleware('permission:client_contact-list|client_contact-create|client_contact-edit|client_contact-delete', ['only' => ['index','store']]);
        $this->middleware('permission:client_contact-create', ['only' => ['create','store']]);
        $this->middleware('permission:client_contact-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:client_contact-delete', ['only' => ['destroy']]);
    }


    public function index(Request $request)
    {
        $user = Auth::user();
        $query = ClientContact::orderby('id', 'desc');

        // If EPC Developer, show contacts sent to them (epc_developer_id)
        if ($user->hasRole('EPC Developer')) {
            $query->where('epc_developer_id', $user->id);
        } else {
            // For other users, show their own sent contacts
            $query->where('user_id', $user->id);
        }

        // AJAX search and filter
        if ($request->ajax()) {
            if ($request['search'] != "") {
                $query->where('name', 'like', '%' . $request['search'] . '%')
                    ->orWhere('email', 'like', '%' . $request['search'] . '%')
                    ->orWhere('phone', 'like', '%' . $request['search'] . '%');
            }
            if ($request['status'] != "All") {
                $status = $request['status'] == 2 ? 0 : $request['status'];
                $query->where('status', $status);
            }
            $models = $query->paginate(10);
            return (string) view('admin.client_contact.search', compact('models'));
        }

        $page_title = 'All Contact Me';
        $models = $query->paginate(10);
        return view('admin.client_contact.index', compact('models', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = "Add Contact";
        return view('admin.client_contact.create', compact('page_title'));
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
            'epc_developer_id' => 'required|integer|exists:users,id',
            'user_id' => 'required|integer|exists:users,id',
            'name' => 'required|max:100',
            'project_id' => 'required|integer|exists:projects,id',
            'email' => 'required|max:100',
            'phone' => 'required|max:100',
            'message' => 'required|max:1000',
        ]);

        $model = new ClientContact();
        $model->user_id = $request->user_id;
        $model->epc_developer_id = $request->epc_developer_id;
        $model->name = $request->name;
        $model->project_id = $request->project_id;
        $model->email = $request->email;
        $model->phone = $request->phone;
        $model->message = $request->message;
        $model->save();

        // Send email to EPC Developer
        $epcDeveloper = \App\Models\User::find($request->epc_developer_id);
        $member = \App\Models\User::find($request->user_id);
        if ($epcDeveloper && $member) {
            Mail::to($epcDeveloper->email)->send(new MemberContactedEpcDeveloper($model, $member));
        }

        return redirect()->back()->with('message', ' You Contact Me Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClientContact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = ClientContact::where('id', $id)->first();
        if($model) {
            $model->delete();
            return true;
        } else {
            return response()->json(['message' => 'Failed'], 404);
        }
    }
}