<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Webpage;

class WebpageController extends Controller
{
    public function index()
    {
        $pages = Webpage::paginate(50);
        return view('webpage.index',compact('pages'));
    
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

    public function landing()
    {
        $pages = Webpage::limit(100)->get();
        return view('index', compact('pages'));
      
    }

    public function viewPage($page)
    {
        $data = Webpage::where('slug', $page)->first();
        $pages = Webpage::limit(100)->get(); 
        return view('dynamic', compact('data', 'pages'));
        
    }
}
