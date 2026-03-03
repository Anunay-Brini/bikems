<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use App\Models\Bike;
use App\Models\Booking;

$user = User::where('email', 'anunay@gmail.com')->first();
$bike = Bike::first();
$delivery = User::where('role', 'delivery')->first();

if (!$user || !$bike || !$delivery) {
    die("Error: User, Bike, or Delivery boy not found.\n");
}

$booking = Booking::create([
    'user_id' => $user->id,
    'bike_id' => $bike->id,
    'pickup_location' => 'Indira Nagar, Bengaluru',
    'drop_location' => 'Koramangala, Bengaluru',
    'start_date' => date('Y-m-d'),
    'end_date' => date('Y-m-d', strtotime('+2 days')),
    'start_time' => '10:00',
    'end_time' => '18:00',
    'status' => 'active',
    'delivery_boy_id' => $delivery->id,
    'delivery_status' => 'assigned'
]);

echo "Test Booking ID: {$booking->id} created successfully.\n";
