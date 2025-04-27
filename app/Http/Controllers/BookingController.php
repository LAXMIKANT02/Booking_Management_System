<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookings; 
use App\Models\User; 

class BookingController extends Controller
{
    public function index()
    {
        // Fetch bookings with user data for admin
        $query = Bookings::select('bookings.*', 'users.name as user_name', 'users.email as user_email');
        $query->leftJoin('users', 'bookings.user_id', '=', 'users.id');
        $data = $query->get();

        // Check if the authenticated user is an admin or not
        if(auth()->user()->user_type == 1) {
            // Return admin view
            return view('admindashboard.bookings.index', ['bookings' => $data]);
        } else {
            // Return user view
            return view('userdashboard.bookings.index', ['bookings' => $data]);
        }
    }

    public function userBookings()
    {
        // Fetch all bookings for the authenticated user
        $bookings = Bookings::where('user_id', auth()->id())->get();
        
        // Return the correct view for user bookings
        return view('userdashboard.bookings.index', compact('bookings'));
    }

    public function add()
    {
        // Fetch users for the admin to assign to bookings
        $data = User::paginate(10); // Pagination added
        return view('admindashboard.bookings.addEdit', ['data' => $data]);
    }

    public function save(Request $request)
    {
        // Validate input fields
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'booking_date' => 'required|date',
            'booking_time' => 'required',
            'status' => 'required|in:pending,confirmed,cancelled'
        ], [
            'user_id.required' => 'User selection is required.',
            'booking_date.required' => 'Booking date is required.',
            'booking_time.required' => 'Booking time is required.',
            'status.required' => 'Booking status is required.',
            'status.in' => 'Invalid status value.'
        ]);

        // Save the booking
        $booking = new Bookings();
        $booking->user_id = $request->input('user_id');
        $booking->booking_date = $request->input('booking_date');
        $booking->booking_time = $request->input('booking_time');
        $booking->status = $request->input('status');
        $booking->save();

        // Redirect back to the booking index
        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }

    public function getBookingById($id)
    {
        // Fetch the booking by ID
        $booking = Bookings::find($id); // Fetch the booking by ID
        if (!$booking) {
            return redirect()->route('bookings.index')->with('error', 'Booking not found.');
        }
        return view('admindashboard.bookings.addEdit', ['booking' => $booking]); // Pass the booking data to the view
    }

    public function updateBookingById(Request $request, $id)
    {
        // Validate input fields
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'booking_date' => 'required|date',
            'booking_time' => 'required',
            'status' => 'required|in:pending,confirmed,cancelled'
        ]);

        // Find the booking
        $booking = Bookings::find($id);
        if (!$booking) {
            return redirect()->route('bookings.index')->with('error', 'Booking not found.');
        }

        // Update booking details
        $booking->user_id = $request->input('user_id');
        $booking->booking_date = $request->input('booking_date');
        $booking->booking_time = $request->input('booking_time');
        $booking->status = $request->input('status');
        $booking->save();

        // Redirect back to the booking index
        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    }

    public function viewDelete($id)
    {
        // Fetch the booking by ID
        $booking = Bookings::find($id);
        if (!$booking) {
            return redirect()->route('bookings.index')->with('error', 'Booking not found.');
        }
        return view('bookings.show', ['booking' => $booking]); // Pass the booking data to the view
    }

    public function delete($id)
    {
        // Find and delete the booking
        $booking = Bookings::find($id);
        if (!$booking) {
            return redirect()->route('bookings.index')->with('error', 'Booking not found.');
        }

        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }
    
}
