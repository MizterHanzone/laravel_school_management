<?php

namespace App\Http\Controllers;

use App\Models\Annoucement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //
    public function index()
    {
        return view('student.login');
    }

    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user(); // Get the authenticated user

            // Check if the user is not a student
            if ($user->role != 'student') {
                Auth::logout();
                return redirect()->route('student.login')->with('error', 'Unauthorized user');
            }

            // Redirect to the student dashboard if authenticated
            return redirect()->route('student.dashboard');
        } else {
            return redirect()->route('student.login')->with('error', 'Incorrect email or password');
        }
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('student.login')->with('success', 'Logged out');
    }

    public function dashboard()
    {
        $annoucements = Annoucement::where('type', 'student')->orderBy('id', 'desc')->limit(1)->get();
        // dd($annoucements);
        return view('student.dashboard', compact('annoucements'));
    }

    public function change_password()
    {
        return view('student.change_password');
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'old_password' => 'required|string|min:6',
            'new_password' => 'required|string|min:6',
            'confirm_password' => 'required|string|min:6|same:new_password',
        ]);

        $old_password = $request->old_password;
        $new_password = $request->new_password;
        
        $user = User::find(Auth::user()->id);
        // dd($user);
        if(Hash::check($old_password, $user->password)){
            $user->password = $new_password;
            $user->update();
            return redirect()->back()->with('success', 'Password changed successfully!');
        }else{
            return redirect()->back()->with('error', 'Old password do not have!');
        }
    }
}
