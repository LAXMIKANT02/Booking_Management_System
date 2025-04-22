<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebpageController extends Controller
{
    public function index()
    {
        return view('webpage.index');
    }

    public function add($id)
    {
        return view('webpage.show', ['id' => $id]);
    }
    public function save(Request $request)
    {
        return redirect()->route('webpage.index');
    }
    public function edit($id)
    {
        return view('webpage.edit', ['id' => $id]);
    }
    public function update(Request $request, $id)
    {
        return redirect()->route('webpage.index');
    }
    public function viewDelete($id)
    {
        return view('webpage.show', ['id' => $id]);
    }
    public function delete($id)
    {
        return redirect()->route('webpage.index');
    }

    public function landing($id)
    {
        return view('webpage.show', ['id' => $id]);
    }

    public function viewPage($page)
    {
        return view('webpage.show', ['page' => $page]);
    }
}
