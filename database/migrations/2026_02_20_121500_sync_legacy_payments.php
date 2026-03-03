<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Booking;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $bookings = Booking::with('payment')->get();

        foreach ($bookings as $booking) {
            // Check if there is an associated payment record (legacy system)
            if ($booking->payment) {
                // If the booking has a payment record, we treat it as fully paid
                if ($booking->amount_paid == 0) {
                    $booking->amount_paid = $booking->payment->amount;
                    $booking->payment_status = 'full';
                    
                    // Also ensure total_amount is set if missing
                    if (is_null($booking->total_amount) || $booking->total_amount == 0) {
                        $booking->total_amount = $booking->payment->amount;
                    }

                    $booking->save();
                }
            } else {
                 // For bookings without payment, ensure total_amount is calculated if missing
                 if ((is_null($booking->total_amount) || $booking->total_amount == 0) && $booking->bike) {
                     $days = \Carbon\Carbon::parse($booking->start_date)->diffInDays(\Carbon\Carbon::parse($booking->end_date)) ?: 1;
                     $booking->total_amount = $booking->bike->price_per_day * $days;
                     $booking->save();
                 }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No revert needed for data fix
    }
};
