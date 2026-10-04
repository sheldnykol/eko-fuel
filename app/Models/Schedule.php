<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = ['station_id', 'date', 'available_slots'];

    protected $casts = [
        'available_slots' => 'array',
        'date' => 'date'
    ];

    public function station() {
        return $this->belongsTo(Station::class);
    }
}
