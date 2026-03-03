<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('delivery_boy_id', auth()->id())->get();
        return view('delivery.dashboard', compact('bookings'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:picked_up,delivered,returned,pending,assigned',
        ]);

        $booking = Booking::findOrFail($id);

        if ($booking->delivery_boy_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $booking->delivery_status = $request->status;

        // Sync main booking status
        if ($request->status === 'delivered') {
            $booking->status = 'active';
        } elseif ($request->status === 'returned') {
            $booking->status = 'completed';
        }

        $booking->save();

        return back()->with('success', 'Status updated successfully!');
    }
}
