<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    use HasFactory;
    protected $table = 'bookings';
    protected $fillable = [
        'id',
        'customer_name',
        'booking_datetime',
        'booking_status',
        'payment_status',
        'user_id',
        'created_at',
        'updated_at',
    ];
}
