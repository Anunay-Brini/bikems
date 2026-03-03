<?php

namespace App\Http\Controllers;

use App\Models\Booking;

class DeliveryDashboardController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('delivery_boy_id', auth()->id())->get();

        return view('delivery.dashboard', compact('bookings'));
    }
}
