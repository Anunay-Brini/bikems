<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Booking;

$active = Booking::whereIn('status', ['active', 'picked_up'])->count();
echo "Active bookings: $active\n";
