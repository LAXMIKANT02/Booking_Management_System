<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Webpage;

class WebpageController extends Controller
{
    public function index()
    {
        $pages = Webpage::paginate(50);
        return view('adminDashboard.webpage.index', compact( 'pages'));
    }

    public function add($id)
    {
        return view('adminDashboard.webpage.show', ['id' => $id]);
    }

    public function save(Request $request)
    {
        return redirect()->route('webpage.index');
    }

    public function edit($id)
    {
        return view('adminDashboard.webpage.edit', ['id' => $id]);
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('webpage.index');
    }

    public function viewDelete($id)
    {
        return view('adminDashboard.webpage.show', ['id' => $id]);
    }

    public function delete($id)
    {
        return redirect()->route('webpage.index');
    }

    public function landing()
    {
        return view('index');
    }

    public function viewPage($page)
    {
        $data = Webpage::where('slug', $page)->first();
        $pages = Webpage::limit(100)->get(); 
        return view('adminDashboard.dynamic', ['data' => $data, 'pages' => $pages]);
    }
}
