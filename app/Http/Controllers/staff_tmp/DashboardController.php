<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Bike;
use App\Models\Booking;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBikes = Bike::count();
        $bikesMaintenance = Bike::where('status', 'maintenance')->count();
        $activeBookings = Booking::where('status', 'active')->count(); // Assuming 'active' is a status

        // Fetch recent bookings with relationships
        $recentBookings = Booking::with(['user', 'bike'])
            ->latest()
            ->take(5)
            ->get();

        // Fetch delivery boys for assignment dropdown
        $deliveryBoys = User::where('role', 'delivery')->get();

        return view('staff.dashboard', compact(
            'totalBikes',
            'bikesMaintenance',
            'activeBookings',
            'recentBookings',
            'deliveryBoys'
        ));
    }

    public function assignDelivery(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'delivery_boy_id' => 'required|exists:users,id',
        ]);

        $booking = Booking::findOrFail($request->booking_id);
        $booking->delivery_boy_id = $request->delivery_boy_id;
        $booking->delivery_status = 'assigned';
        $booking->status = 'assigned'; // Optional: valid status?
        $booking->save();

        return back()->with('success', 'Delivery assigned successfully.');
    }

    public function updatePrice(Request $request, $id)
    {
        $request->validate([
            'damage_charges' => 'nullable|numeric|min:0',
            'status' => 'required|string',
        ]);

        $booking = Booking::findOrFail($id);
        
        if ($request->filled('damage_charges')) {
            $booking->damage_charges = $request->damage_charges;
        }

        $booking->status = $request->status;
        $booking->save();

        return back()->with('success', 'Booking updated successfully.');
    }
}
