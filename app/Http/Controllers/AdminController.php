<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\New_;

class AdminController extends Controller
{
    //
    public function index()
    {
        // dd(Hash::make('Han@171102'));
        return view('admin.login');
    }

    public function dashboard()
    {
        // if (!Auth::guard('admin')->check()) {
        //     return redirect()->route('admin.login'); 
        // }
        return view('admin.dashboard');
    }

    public function form()
    {
        return view('admin.form');
    }

    public function table()
    {
        return view('admin.table');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        
        if(Auth::guard('admin')->attempt(['email'=>$request->email, 'password'=>$request->password]))
        {
            if(Auth::guard('admin')->user()->role!='admin')
            {
                Auth::guard('admin')->logout();
                return redirect()->route('admin.login')->with('error', 'Unautherise user');
            }
            return redirect()->route('admin.dashboard');
        }
        else
        {
            return redirect()->route('admin.login')->with('error', 'Incorrect email or password');
        }
    }

    public function register()
    {
        $user = new User();
        $user->name = 'Somorn';
        $user->email = 'somorn@gmail.com';
        $user->password = Hash::make('Somorn@100404');
        $user->save();
        return redirect()->route('admin.login')->with('success', 'User created');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        Session::flush();
        return redirect()->route('admin.login')->with('success', 'Logged out');
    }
}
