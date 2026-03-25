<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // Fetch all bookings with relationships to avoid N+1 and allow calculation
        $allBookings = \App\Models\Booking::with(['payment', 'bike'])
            ->where('user_id', $userId)
            ->get();

        $totalBookings = $allBookings->count();

        $activeBookings = $allBookings->filter(function ($booking) {
            return in_array(strtolower($booking->status), ['active', 'assigned', 'picked_up', 'pending']);
        })->count();

        $pastTrips = $allBookings->filter(function ($booking) {
            return in_array(strtolower($booking->status), ['completed', 'returned']) 
                || in_array(strtolower($booking->delivery_status), ['returned', 'delivered']);
        })->count();

        // Calculate total spent: Use payment amount if exists, else calculate based on duration
        $totalSpent = $allBookings->sum(function ($booking) {
            // Only count spent for completed/returned trips or if payment exists
            if ($booking->payment) {
                return $booking->payment->amount;
            }
            
            // Fallback: Calculate from duration * price (only for past/active trips, not pending/cancelled if any)
            // Case-insensitive check
            $validStatuses = ['completed', 'returned', 'active', 'picked_up', 'delivered', 'assigned'];
            if (in_array(strtolower($booking->status), $validStatuses)) {
                 $start = \Carbon\Carbon::parse($booking->start_date);
                 $end = \Carbon\Carbon::parse($booking->end_date);
                 $days = $start->diffInDays($end) ?: 1; // Minimum 1 day
                 return $days * ($booking->bike->price_per_day ?? 0);
            }
            return 0;
        });

        return view('user.dashboard', compact(
            'totalBookings',
            'activeBookings',
            'pastTrips',
            'totalSpent'
        ));
    }
}
