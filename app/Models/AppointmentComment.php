<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AppointmentComment extends Model
{
    use HasFactory;

    protected $fillable = ['appointment_id', 'user_id', 'body'];


    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
        
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
