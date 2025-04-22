<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Authcontroller extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function signup()
    {
        return view('auth.signup');
    }

    public function authenticate(Request $request)
    {
        return redirect()->route('dashboard.user');
    }

    public function createUser(Request $request)
    {
       
        return redirect()->route('login');
    }

    public function logout()
    {
       
        return redirect()->route('webpage.view');
    }
}
