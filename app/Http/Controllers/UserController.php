<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\User;
use App\Models\WebPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Display the user dashboard for admin and regular users
    public function index()
    {
        return view('userDashboard.index');
    }

    // Add a new user - display form
    public function add()
    {
        return view('userDashboard.index');
    }

    // Save the new user
    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'user_type' => $request->input('user_type', 2),
        ]);

        return redirect()->route('user');
    }

    // Edit an existing user - display form
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('userDashboard.index', ['user' => $user]);
    }

    // Update user information
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->save();

        return redirect()->route('user');
    }

    // View user before deletion (confirmation page)
    public function viewDelete($id)
    {
        $user = User::findOrFail($id);
        return view('userDashboard.bookings.delete', ['user' => $user]);
    }

    // Delete a user
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user');
    }

    // View user profile (for the logged-in user or admin)
    public function getProfile()
    {
        $user = auth()->user(); // Get the currently authenticated user
        return view('userDashboard.profile.index', ['user' => $user]);
    }

    // Save user profile changes
    public function saveProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = auth()->user(); // Get the currently authenticated user
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->save();

        return redirect()->route('user.profile.get');
    }

    // Admin Dashboard - Display admin statistics
    public function adminDashboard()
    {
        $data = [
            'totalUsers' => User::count(),
            'adminUsers' => User::where('user_type', 1)->count(),
            'clientUsers' => User::where('user_type', 2)->count(),
            'totalBookings' => Bookings::count(),
            'completedBookings' => Bookings::where('booking_status', '3')->count(),
            'totalWebpages' => WebPage::count(),
            'activeWebpages' => WebPage::where('status', '1')->count(),
        ];

        $pages = WebPage::select('name', 'slug')->take(50)->get();

        return view('adminDashboard.index', ['data' => $data, 'pages' => $pages]);
    }

    // User Dashboard - Display bookings for the logged-in user
    public function userDashboard()
    {
        $user = auth()->user(); // Get the authenticated user

        // Fetch bookings related to the user
        $data = [
            'totalBookings' => Bookings::where('user_id', $user->id)->count(),
            'completedBookings' => Bookings::where('user_id', $user->id)->where('booking_status', '3')->count(),
        ];

        return view('userDashboard.layout.userBaseview', ['data' => $data]);
    }
}
