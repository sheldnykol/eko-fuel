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
        'vehicle_type',
        'appointment_date',
        'appointment_time',
        'status',
        'booking_pin',
        'extras',
        'wash_type',
        'comments'
    ];

    public function comments()
        {
            // Χρησιμοποιούμε latest() για να έρχονται τα πιο πρόσφατα πρώτα (σαν chat)
            return $this->hasMany(AppointmentComment::class)->latest();
        }
}
// Hint 
//ti petuxa
// $appointment->comments -> Σου φέρνει όλα τα σχόλια του ραντεβού

// $comment->appointment -> Σου φέρνει σε ποιο ραντεβού ανήκει το σχόλιο