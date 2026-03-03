<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Booking;
use Carbon\Carbon;

foreach (Booking::all() as $b) {
    if (!$b->total_amount || $b->total_amount == 0) {
        $start = Carbon::parse($b->start_date);
        $end = Carbon::parse($b->end_date);
        $days = $start->diffInDays($end) ?: 1;
        $b->total_amount = ($b->bike->price_per_day ?? 0) * $days;
        $b->save();
        echo "Fixed Booking #{$b->id}: Total set to {$b->total_amount}\n";
    }
}
