<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    protected $fillable = ['station_id', 'date', 'available_slots'];

    // ΠΟΛΥ ΣΗΜΑΝΤΙΚΟ: Μετατρέπει το JSON της βάσης σε PHP array αυτόματα
    protected $casts = [
        'available_slots' => 'array',
        'date' => 'date'
    ];

    public function station() {
        return $this->belongsTo(Station::class);
    }
}
