<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuelOrder extends Model
{
    //customer info from migration
    protected $fillable = [
        'customer_fuel_name',
        'customer_fuel_phone',
        'customer_fuel_afm',
        'customer_fuel_city',
        'customer_fuel_address',
        'customer_fuel_number_of_address',
        'fuel_type',
        'fuel_quantity',
        'status'


    ];
}
