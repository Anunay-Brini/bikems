<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'bike_id',
        'start_date',
        'end_date',
        'status',
        'pickup_location',
        'drop_location',
        'start_time',
        'end_time',
        'delivery_boy_id',
        'delivery_address',
        'delivery_status',
        'total_amount',
        'amount_paid',
        'damage_charges',
        'payment_status',
        'review',
        'sentiment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bike()
    {
        return $this->belongsTo(Bike::class);
    }

    public function deliveryBoy()
    {
        return $this->belongsTo(User::class, 'delivery_boy_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
