<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, Booking $booking)
    {
        // 1. Validation
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        if ($booking->payment_status === 'full') {
            return back()->with('error', 'Booking is already fully paid.');
        }

        // 2. Calculate Amount
        $totalAmount = $booking->total_amount;
        $damageCharges = $booking->damage_charges ?? 0;
        $amountPaid = $booking->amount_paid ?? 0;
        
        $amountToPay = 0;
        $paymentType = '';

        if ($amountPaid == 0) {
            // Advance Payment (50%)
            $amountToPay = $totalAmount / 2;
            $paymentType = 'advance';
        } else {
            // Final Payment (Remaining Balance + Damage Charges)
            $amountToPay = ($totalAmount + $damageCharges) - $amountPaid;
            $paymentType = 'final';
        }

        if ($amountToPay <= 0) {
             // Should not happen unless logic error or already paid
             return back()->with('error', 'No pending amount to pay.');
        }

        // 3. Create Payment Record (Simulated)
        Payment::create([
            'booking_id' => $booking->id,
            'amount' => $amountToPay,
            'status' => 'paid',
            // 'transaction_id' => 'MOCK_' . \Str::random(10),
        ]);

        // 4. Update Booking Payment Status
        $booking->amount_paid += $amountToPay;
        
        if ($paymentType === 'advance') {
            $booking->payment_status = 'partial';
            // Optionally set status to 'active' if it was pending payment
            // $booking->status = 'active'; 
        } else {
            $booking->payment_status = 'full';
        }
        
        $booking->save();

        return back()->with('success', 'Payment successful! (' . ucfirst($paymentType) . ')');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
