<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\City;
use App\Models\State;
use App\Models\Payment;
use App\Models\Role as UserRole;
use Spatie\Permission\Models\Role;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Session;
use Spatie\Permission\Traits\HasRoles;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $user = Auth::user(); // Get the logged-in user

        // Initialize the query to fetch users
        $query = User::orderby('id', 'asc')->where('id', '>', 0);

        // Check if it's an AJAX request
        if ($request->ajax()) {

            // Apply search filter
            if ($request->has('search') && $request['search'] != "") {
                $query->where(function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request['search'] . '%')
                        ->orWhere('last_name', 'like', '%' . $request['search'] . '%')
                        ->orWhere('phone', 'like', '%' . $request['search'] . '%')
                        ->orWhere('email', 'like', '%' . $request['search'] . '%');
                });
            }

            // Apply status filter
            if ($request->has('status') && $request['status'] != 'All') {
                $status = $request['status'] == 2 ? 0 : $request['status'];
                $query->where('status', $status);
            }

            // Role-based filtering
            if ($user->hasRole('Trainer')) {
                $query->where('role', 'Trainer'); // Show only Contractors for logged-in EPC Developer
            } elseif ($user->hasRole('Admin')) {
                $query->where('role', '!=', 'Admin'); // Show all users except Admins for logged-in Admins
            }

            // Paginate and return the search results
            $users = $query->paginate(10);
            return (string) view('admin.user.search', compact('users'));
        }

        // Non-AJAX request filtering
        if ($user->hasRole('Trainer')) {
            // Set the page title
            $page_title = 'All Trainer';
            $users = User::where('role', 'Trainer')->paginate(10); // Only show Contractors
        } elseif ($user->hasRole('Admin')) {
            // Set the page title
            $page_title = 'All Users';
            $users = User::where('role', '!=', 'Admin')->paginate(10); // Show all users except Admins
        } else {
            $users = User::orderby('id', 'asc')->paginate(10); // Default case (if there are more roles)
        }

        // Return the view
        return view('admin.user.index', compact('users', 'page_title'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Add User';
        $roles = Role::orderby('id', 'asc')->get(['name', 'id']);
        return view('admin.user.create', compact('roles', 'page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('user.index')->with('message', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_title = 'Edit User';
        $user = User::with('roles')->find($id);
        $roles = Role::orderby('id', 'desc')->get(['name', 'id']);
        $userRole = $user->roles->pluck('name', 'name')->all();
        $user = User::where('id', $id)->first();
        return view('admin.user.edit', compact('user', 'roles', 'userRole', 'page_title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        if ($id) {
            $this->validate($request, [
                'status' => 'required',
                'top_rated' => 'required',

            ]);

            $user->status = $request->status;
            $user->top_rated = $request->top_rated;
            $user->leaderboard = $request->leaderboard;
            $user->update();
        } else {
            $this->validate($request, [
                'name' => 'required|max:200',
                'email' => 'required|max:200|email|unique:users,email,' . $id,
                'password' => 'same:confirm-password',
                'roles' => 'required'
            ]);

            $input = $request->all();
            if (!empty($input['password'])) {
                $input['password'] = Hash::make($input['password']);
            } else {
                $input = Arr::except($input, array('password'));
            }

            $user = User::find($id);
            $user->update($input);
            DB::table('model_has_roles')->where('model_id', $id)->delete();

            $user->assignRole($request->input('roles'));
        }

        return redirect()->route('user.index')->with('message', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*  public function destroy($id)
     {
         $ifdeleted = User::find($id)->delete();
         if ($ifdeleted) {
             return true;
         }
     } */
    public function destroy($id)
    {
        $model = User::where('id', $id)->first();
        if ($model) {
            $model->delete();
            return true;
        } else {
            return response()->json(['message' => 'Failed '], 404);
        }
    }

    public function MemberEditProfile()
    {
        $page_title = 'Edit Profile';
        $cities = City::where('status', 1)->get();
        $states = State::where('city_id')->get();
        $user = User::where('id', Auth::user()->id)->first();
        return view('website.member-dashboard.edit', compact('cities', 'states', 'user', 'page_title'));
    }
    public function EpcDeveloperEditProfile()
    {
        $page_title = 'Edit Profile';
        $cities = City::where('status', 1)->get();
        $states = State::where('city_id')->get();
        $user = User::where('id', Auth::user()->id)->first();
        return view('website.epcdeveloper-dashboard.edit', compact('cities', 'states', 'user', 'page_title'));
    }

    public function ContractorEditProfile()
    {
        $page_title = 'Edit Profile';
        $cities = City::where('status', 1)->get();
        $states = State::where('city_id')->get();
        $user = User::where('id', Auth::user()->id)->first();
        return view('website.contractor-dashboard.edit', compact('cities', 'states', 'user', 'page_title'));
    }

    public function userUpdateProfile(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $user->name = $request->name;
        /*  $user->middle_name = $request->middle_name; */
        $user->last_name = $request->last_name;
        $user->address = $request->address;
        $user->designation = $request->designation;
        $user->team = $request->team;
        $user->about_me = $request->about_me;
        $user->date_of_birth = $request->date_of_birth;
        $user->gender = $request->gender;
        $user->whatsapp = $request->whatsapp;
        $user->facebook = $request->facebook;
        $user->twitter = $request->twitter;
        $user->linkedin = $request->linkedin;
        // $user->instagram = $request->instagram;
        // $user->skype = $request->skype;
        // $user->youtube = $request->youtube;
        $user->city_id = $request->city_id;
        $user->state_id = $request->state_id;
        $user->zip_code = $request->zip_code;
        // $user->license = $request->license;
        if (isset($request->image)) {
            $photo = date('YmdHis') . '.' . $request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('/admin/assets/images/UserImage'), $photo);
            $user->image = $photo;
        }

        if (empty($request->name)) {
            $this->validate($request, [
                'name' => 'required',
                'city_id' => 'required',
                'state_id' => 'required',
            ]);
        }

        if (isset($request->password)) {
            $this->validate($request, [
                'name' => 'required',
                'password' => 'required|same:confirm-password',
            ]);

            $user->password = Hash::make($request->password);
        }

        $user->update();
        return redirect()->back()->with('message', 'Profile updated successfully');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $request->email)->first();

        if (!empty($user) && $user->status == 1) {
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                /* if ($user->hasRole('Admin')) {
                    return redirect()->route('dashboard');
                } else */
                if ($user->hasRole('Trainer')) {
                    return redirect()->route('dashboard');
                } else {
                    Auth::logout();
                    return redirect()->back()->with('error', 'Unauthorized role.');
                }
            } else {
                return redirect()->back()->with('error', 'Failed to login, try again!');
            }
        } elseif (!empty($user) && $user->status == 0) {
            return redirect()->back()->with('error', 'Your account is not active. Please verify your email.');
        } else {
            return redirect()->back()->with('error', 'User not found!');
        }
    }


    public function logOut()
    {
        Auth::logout();
        return redirect()->route('/');
    }
}
