<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        return view('booking.index');
    }

    public function userBookings($id)
    {
        return view('booking.show', ['id' => $id]);
    }
    public function add($id)
    {
        return view('booking.show', ['id' => $id]);
    }

    public function save(Request $request)
    {
        return redirect()->route('booking.index');
    }

    public function getBookingById($id)
    {
        return view('booking.edit', ['id' => $id]);
    }

    public function updateBookingBId(Request $request, $id)
    {
        return redirect()->route('booking.index');
    }

    public function viewDelete($id)
    {
        return view('booking.show', ['id' => $id]);
    }

    public function delete($id)
    {
        return redirect()->route('booking.index');
    }
}
