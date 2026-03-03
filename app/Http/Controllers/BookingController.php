<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bikes = Bike::where('status','available')->get();
        return view('bikes.index', compact('bikes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Bike $bike)
    {
        // Check if bike is already booked
        $alreadyBooked = Booking::where('bike_id', $bike->id)
            ->where('status', 'active')
            ->exists();

        if ($alreadyBooked) {
            return back()->with('error', 'Bike already booked');
        }

        // Calculate Total Amount
        $startDate = \Carbon\Carbon::parse($request->start_date);
        $endDate = \Carbon\Carbon::parse($request->end_date);
        $days = $startDate->diffInDays($endDate) ?: 1;
        $totalAmount = $bike->price_per_day * $days;

        // Create booking
        Booking::create([
            'user_id' => auth()->id(),
            'bike_id' => $bike->id,
            'start_date' => $request->start_date,
            'start_time' => $request->start_time,
            'end_date' => $request->end_date,
            'end_time' => $request->end_time,
            'pickup_location' => $request->pickup_location,
            'drop_location' => $request->drop_location,
            'total_amount' => $totalAmount,
            'status' => 'active',
        ]);

        // Update bike status
        $bike->update([
            'status' => 'rented'
        ]);

        return back()->with('success', 'Bike booked successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }

    public function myBookings()
    {
        $bookings = \App\Models\Booking::where('user_id', auth()->id())->get();
        return view('user.my-bookings', compact('bookings'));
    }

    public function generateBill($id)
    {
        $booking = Booking::with(['user', 'bike', 'payment'])->findOrFail($id);

        // Ensure the logged-in user owns this booking
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('user.bill', compact('booking'));
    }

    public function submitReview(Request $request, $id)
    {
        $request->validate([
            'sentiment' => 'required|integer|min:1|max:4',
            'review' => 'nullable|string|max:1000',
        ]);

        $booking = Booking::findOrFail($id);
        
        // Ensure user owns this booking
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $booking->update([
            'sentiment' => $request->sentiment,
            'review' => $request->review,
        ]);

        return back()->with('success', 'Thank you for your review!');
    }
}
