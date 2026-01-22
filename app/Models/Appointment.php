<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'station_id',
        'customer_name',
        'customer_phone',
        'license_plate',
        'appointment_date',
        'appointment_time',
        'status',
        'booking_pin'
    ];
}
