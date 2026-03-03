<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    protected $fillable = [
        'name',
        'type',
        'image',
        'price_per_day',
        'status',
    ];
}
