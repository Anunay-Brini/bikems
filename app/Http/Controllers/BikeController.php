<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class BikeController extends Controller
{
    public function pricing()
    {
        $bikes = Bike::where('status', 'available')->get();
        return view('pages.pricing', compact('bikes'));
    }

    /**
     * Display a listing of the resource (Admin).
     */
    public function index()
    {
        $bikes = Bike::all();
        return view('admin.bikes.index', compact('bikes'));
    }

    /**
     * Display a listing of bikes for Users.
     */
    public function browse()
    {
        $bikes = Bike::where('status', 'available')->get();
        return view('bikes.index', compact('bikes'));
    }

    /**
     * Handle bike booking.
     */
    /**
     * Show booking form.
     */
    public function bookingForm($id)
    {
        $bike = Bike::findOrFail($id);
        return view('user.bookings.create', compact('bike'));
    }

    /**
     * Handle bike booking.
     */
    public function storeBooking(Request $request, $id)
    {
        $request->validate([
            'pickup_location' => 'required|string|max:255',
            'drop_location' => 'required|string|max:255',
            'start_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'end_date' => 'required|date|after_or_equal:start_date',
            'end_time' => 'required',
        ]);

        $bike = Bike::findOrFail($id);

        if ($bike->status !== 'available') {
            return back()->with('error', 'Bike is not available.');
        }

        // Calculate total amount
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $days = max(1, $startDate->diffInDays($endDate));
        $totalAmount = $bike->price_per_day * $days;

        Booking::create([
            'user_id' => auth()->id(),
            'bike_id' => $bike->id,
            'pickup_location' => $request->pickup_location,
            'drop_location' => $request->drop_location,
            'start_date' => $request->start_date,
            'start_time' => $request->start_time,
            'end_date' => $request->end_date,
            'end_time' => $request->end_time,
            'status' => 'active',
            'total_amount' => $totalAmount, // Add total_amount
            'amount_paid' => 0, // Assuming 0 initially
            'payment_status' => 'pending', // Assuming pending initially
        ]);

        return redirect()->route('my.bookings')->with('success', 'Booking confirmed successfully!');
    }

    public function create()
    {
        return view('admin.bikes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'price_per_day' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        $imageData = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageData = 'data:' . $file->getMimeType() . ';base64,' . base64_encode(file_get_contents($file->getRealPath()));
        }

        Bike::create([
            'name' => $request->name,
            'type' => $request->type,
            'price_per_day' => $request->price_per_day,
            'image_data' => $imageData,
            'status' => 'available',
        ]);

        return redirect()->route('bikes.index')->with('success', 'Bike added successfully.');
    }
    
    // ... existing show, edit, update, destroy methods can remain as placeholders or be implemented later
    public function edit(Bike $bike)
    {
        return view('admin.bikes.edit', compact('bike'));
    }

    public function update(Request $request, Bike $bike)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'price_per_day' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'type' => $request->type,
            'price_per_day' => $request->price_per_day,
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image_data'] = 'data:' . $file->getMimeType() . ';base64,' . base64_encode(file_get_contents($file->getRealPath()));
        }

        $bike->update($data);

        return redirect()->route('bikes.index')->with('success', 'Bike updated successfully.');
    }

    public function destroy(Bike $bike)
    {
        if ($bike->image) {
            Storage::disk('public')->delete($bike->image);
        }
        $bike->delete();

        return redirect()->route('bikes.index')->with('success', 'Bike deleted successfully.');
    }
}
