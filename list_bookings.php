<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Booking;

foreach (Booking::all() as $b) {
    echo "ID: {$b->id} | Total: " . ($b->total_amount ?? 'NULL') . " | Paid: " . ($b->amount_paid ?? 0) . " | Status: {$b->delivery_status}" . PHP_EOL;
}
