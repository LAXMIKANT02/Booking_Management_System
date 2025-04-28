<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookings;
use App\Models\User;

class BookingController extends Controller
{
    public function index()
    {
        $query = Bookings::select('bookings.*', 'users.name as user_name', 'users.email as user_email');
        $query->leftJoin('users', 'bookings.user_id', '=', 'users.id');
        $data = $query->get();

        if (auth()->user()->user_type == 1) {
            return view('adminDashboard.bookings.index', ['bookings' => $data]);
        } else {
            return view('userDashboard.bookings.index', ['bookings' => $data]);
        }
    }

    public function userBookings()
    {
        $bookings = Bookings::where('user_id', auth()->id())->get();
        return view('userDashboard.bookings.index', compact('bookings'));
    }

    public function add()
    {
        $data = User::paginate(10);
        return view('adminDashboard.bookings.addEdit', ['data' => $data]);
    }

    public function save(Request $request)
    {
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

        $booking = new Bookings();
        $booking->user_id = $request->input('user_id');
        $booking->booking_date = $request->input('booking_date');
        $booking->booking_time = $request->input('booking_time');
        $booking->status = $request->input('status');
        $booking->save();

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }

    public function getBookingById($id)
    {
        $booking = Bookings::find($id);
        if (!$booking) {
            return redirect()->route('bookings.index')->with('error', 'Booking not found.');
        }
        return view('adminDashboard.bookings.addEdit', ['booking' => $booking]);
    }

    public function updateBookingById(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'booking_date' => 'required|date',
            'booking_time' => 'required',
            'status' => 'required|in:pending,confirmed,cancelled'
        ]);

        $booking = Bookings::find($id);
        if (!$booking) {
            return redirect()->route('bookings.index')->with('error', 'Booking not found.');
        }

        $booking->user_id = $request->input('user_id');
        $booking->booking_date = $request->input('booking_date');
        $booking->booking_time = $request->input('booking_time');
        $booking->status = $request->input('status');
        $booking->save();

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    }

    public function viewDelete($id)
    {
        $booking = Bookings::find($id);
        if (!$booking) {
            return redirect()->route('bookings.index')->with('error', 'Booking not found.');
        }
        return view('bookings.show', ['booking' => $booking]);
    }

    public function delete($id)
    {
        $booking = Bookings::find($id);
        if (!$booking) {
            return redirect()->route('bookings.index')->with('error', 'Booking not found.');
        }

        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }

    // ✨ New function for frontend "Book Now" form:
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Save the booking (you can create a special table later if you want)
        $booking = new Bookings();
        $booking->name = $validated['customer_name'];
        $booking->email = $validated['email'];
        $booking->subject = $validated['subject'];
        $booking->message = $validated['message'];
        $booking->booking_datetime = now(); 
        $booking->status = 'booking_status'; // default new booking status
        $booking->save();
        return redirect()->route('bookings.my')->with('success', 'Your booking request has been submitted successfully.');
    }
}
