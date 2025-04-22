<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function add($id)
    {
        return view('user.show', ['id' => $id]);
    }


    public function save(Request $request)
    {
  
        return redirect()->route('user.index');
    }

    public function edit($id)
    {
        return view('user.edit', ['id' => $id]);
    }

    public function update(Request $request, $id)
    {
      
        return redirect()->route('user.index');
    }

    public function viewDelete($id)
    {
        return view('user.show', ['id' => $id]);
    }

    public function delete($id)
    {
      
        return redirect()->route('user.index');
    }
    public function getProfile($id)
    {
        return view('user.show', ['id' => $id]);
    }
    public function saveProfile($id)
    {
        return view('user.show', ['id' => $id]);
    }


    public function adminDashboard($id)
    {
        return view('user.show', ['id' => $id]);
    }
    public function userDashboard($id)
    {
        return view('user.show', ['id' => $id]);
    }
}
