<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Webpage;

class WebpageController extends Controller
{
    public function index()
    {
        $pages = WebPage::paginate(50);
        return view('adminDashboard.webpage.index', compact( 'pages'));
    }

    public function add($id)
    {
        return view('adminDashboard.webpage.show', ['id' => $id]);
    }

    public function save(Request $request)
    {
        $user = new WebPage([
        'name' => $request->get('page_name'),
            'slug' => $request->get('page_slug'),
            'html' => $request->get('page_content'),
            'status' => $request->get('page_status'),
            'created_by' =>Auth::user()->user_type,
        ]);
        if ($user->save()) {
            return redirect()->route('webpage.index')->with('success', 'Webpage created successfully.');
        } else {
            return redirect()->route('webpage.index')->with('error', 'Failed to create webpage.');
        }
    }

    public function edit($id)
    {
        $data = WebPage::findOrFail($id);
        return view('adminDashboard.webpage.addEdit', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $page = WebPage::findOrFail($id);
        $page->name = $request->get('page_name');
        $page->slug = $request->get('page_slug');
        $page->html = $request->get('page_content');
        $page->status = $request->get('page_status');
        $page->updated_by = Auth::user()->id;
        $page->save();
        return redirect()->route('webpage.index')->with('success', 'Webpage updated successfully.');
    }

    public function viewDelete($id)
    {
        $data = WebPage::findOrFail($id);
        return view('adminDashboard.webpage.viewDelete', ['data' => $data]);
    }

    public function delete($id)
    {
        $page = WebPage::findOrFail($id);
        if ($page->delete()) {
            return redirect()->route('webpage.index')->with('success', 'Webpage deleted successfully.');
        } else {
            return redirect()->route('webpage.index')->with('error', 'Failed to delete webpage.');
        }
    }

    public function landing()
    {
        return view('index');
    }

    public function viewPage($page)
    {
        $data = WebPage::where('slug', $page)->first();
        $pages = WebPage::limit(100)->get(); 
        return view('dynamic', ['data' => $data, 'pages' => $pages]);
    }
}
