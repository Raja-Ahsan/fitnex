<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;

class AdminController extends Controller
{
    public function editProfile()
    {
        // Check if the user is authenticated and their name is not null
        if (!Auth::check() || empty(Auth::user()->name)) {
            return redirect()->route('admin.login');
        }
    
        return view('admin.dashboard.edit');
    }
    
    public function updateProfile(Request $request)
    {
        // Check if the user is authenticated and their name is not null
        if (!Auth::check() || empty(Auth::user()->name)) {
            return redirect()->route('admin.login');
        }
    
        $user = User::findOrFail(Auth::user()->id);
        $this->validate($request, [
            'name' => 'required',
        ]);
    
        $user->name = $request->name;
    
        if (!empty($request->password)) {
            $this->validate($request, [
                'password' => 'required|same:confirm-password',
            ]);
    
            $user->password = Hash::make($request->password);
        }
    
        $user->update();
    
        return redirect()->back()->with('message', 'Profile updated successfully');
    }

    public function login()
    {
        
        if(Auth::check()){
            return redirect()->route('dashboard');
        }
        $page_title = 'Log In';
        return view('admin-auth.login', compact('page_title'));
    }

    public function authenticate(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if(!empty($user) && $user->hasRole($request->user_type)){
            $credentials = $request->only('email', 'password');
            
            if (Auth::attempt($credentials)) {
                return redirect()->route('dashboard');
            }
            return redirect()->back()->with('error', 'Failed to login try again.!');
        }else{
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
    public function logOut()
    {
        
        if(Auth::check() && Auth::user()->hasRole('Admin')){
            Auth::logout();
            return redirect()->route('admin.login');
        }elseif(Auth::check() && Auth::user()->hasRole('Contractor')){
            Auth::logout();
            return redirect()->route('login');
        }else{
            Auth::logout();
            return redirect()->route('login');
        }

    }

    //Password reset
    public function forgotPassword()
    {
        $page_title = 'Forgot Password';
        return view('admin-auth.passwords.forgot-password', compact('page_title'));
    }
    public function passwordResetLink(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
        ]);

        $user = User::where('email', $request->email)->where('status', 1)->first();
        if(!empty($user)){
            $page_title = 'Change Password';
            do{
                $verify_token = uniqid();
            }while(User::where('verify_token', $verify_token)->first());

            $user->verify_token = $verify_token;
            $user->update();

            $details = [
                'from' => 'admin-password-reset',
                'title' => "Hello! ". $user->name,
                'body' => "You are receiving this email because we recieved a password reset request for your account.",
                'verify_token' => $user->verify_token,
            ];
			
            \Mail::to($user->email)->send(new \App\Mail\Email($details));
            return redirect()->route('admin.login')->with('message', 'We have emailed your password reset link!');
        }else{
            return redirect()->back()->with('error', 'Your account not found.');
        }
    }
    public function resetPassword($verify_token)
    {
        $page_title = 'Reset Password';
        $user = User::where('verify_token', $verify_token)->first();
        if($user->hasRole('Admin')){
            return view('admin-auth.passwords.change-password', compact('page_title', 'verify_token'));
        }else{
            return view('admin-auth.passwords.change-password', compact('page_title', 'verify_token'));
        }
    }
    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|same:confirm-password',
        ]);

        $user = User::where('verify_token', $request->verify_token)->first();
        $user->password = Hash::make($request->password);
        $user->verify_token = null;
        $user->update();

        if($user){
            return redirect()->route('admin.login')->with('message', 'You have updated password. You can login again.');
        }else{
            return redirect()->back()->with('error', 'Something went wrong try again');
        }
    }
}
