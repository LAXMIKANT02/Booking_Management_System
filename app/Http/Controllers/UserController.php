<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\WebPage;

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


    public function adminDashboard()
    {
        $data['totalUsers'] = 0;
        $data['adminUsers'] = 0;
        $data['clientUsers'] = 0;
        $data['totalBookings'] = 0;
        $data['completedBookings'] = 0;
        $data['totalWebpages'] = 0;
        $data['activeWebpages'] = 0;
        $data['totalUsers'] = User::count();
        $data['adminUsers'] = user::where('user_type', 1)->count();
        $data['clientUsers'] = user::where('user_type', 2)->count();
        $data['totalBookings'] = Bookings::count();
        $data['completedBookings'] = Bookings::where('booking_status', '3')->count();
        $data['totalWebpages'] = WebPage::count();
        $data['activeWebpages'] = WebPage::where('status', '1')->count();

        $pages = WebPage::select('name', 'slug')->take(50)->get();
        return view('AdminDashboard.index',['data' => $data, 'pages' => $pages]);
    }
    public function userDashboard($id)
    {
        return view('user.dashboard', ['id' => $id]);
    }
}
