<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBookings = \App\Models\Booking::count();
        $totalRevenue = \App\Models\Payment::sum('amount') ?? 0;
        $activeRentals = \App\Models\Booking::where('status', 'active')->count();

        // Get lists of staff and delivery users
        $staffUsers = \App\Models\User::where('role', 'staff')->get();
        $deliveryUsers = \App\Models\User::where('role', 'delivery')->get();
        
        // Get registered customers (to manage stuck users)
        $customerUsers = \App\Models\User::whereNotIn('role', ['admin', 'staff', 'delivery'])->get();

        $staffCount = $staffUsers->count();
        $deliveryCount = $deliveryUsers->count();

        // Get active bookings for tracking
        $activeBookingsList = \App\Models\Booking::with(['user', 'bike'])
            ->whereIn('status', ['active', 'picked_up'])
            ->latest()
            ->get();
            
        return view('admin.dashboard', compact(
            'totalBookings', 
            'totalRevenue', 
            'activeRentals', 
            'staffCount', 
            'deliveryCount', 
            'staffUsers', 
            'deliveryUsers', 
            'customerUsers',
            'activeBookingsList'
        ));
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:staff,delivery',
        ]);

        \App\Models\User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => \Illuminate\Support\Facades\Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.dashboard')->with('success', ucfirst($validated['role']) . ' created successfully.');
    }

    public function editUser(\App\Models\User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, \App\Models\User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'] ? \Illuminate\Support\Facades\Hash::make($validated['password']) : $user->password,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'User updated successfully.');
    }

    public function destroyUser(\App\Models\User $user)
    {
        $user->delete();
        return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully.');
    }
}
