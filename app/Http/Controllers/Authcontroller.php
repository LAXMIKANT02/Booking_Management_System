<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Authcontroller extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function signup()
    {
        return view('auth.register');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt(array(
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ))) {
           if (Auth::user()->user_type == 1) {
                return redirect()->route('dashboard.admin');
            } elseif (Auth::user()->user_type == 2) {
                return redirect()->route('dashboard.user');
            } else {
                return redirect()->route('login')->with('error', 'Invalid User credentials');  
            }}
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone_no' => 'required|unique:users',
            'password' => 'required|confirmed',
            'confirm_password' => 'required'
        ]);
       $user = new User(
            [
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'phone_no' => $request->get('phone_no'),
                'password' => Hash::make($request->get('password')),
                'user_type' => 2
            ] );
            if ($user->save()) {
                return redirect()->route('login')->with('success', 'User created successfully.');
            } else {
                return redirect()->route('signup')->with('error', 'Failed to create User.');
            }
       
        
    }

    public function logout()
    {
       
        return redirect()->route('webpage.view');
    }
}
