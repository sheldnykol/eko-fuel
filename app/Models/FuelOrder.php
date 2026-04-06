<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuelOrder extends Model
{
    //customer info from migration
    protected $fillable = [
        'fuel_name',
        'fuel_phone',
        'fuel_afm',
        'fuel_city',
        'fuel_address',
        'fuel_number_address',
        'fuel_type',
        'fuel_quantity',
        'status'


    ];
}
