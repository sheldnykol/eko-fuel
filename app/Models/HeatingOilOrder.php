<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeatingOilOrder extends Model
{
    protected $fillable =[    
        'heatOil_name',
        'heatOil_phone',
        'heatOil_afm',
        'heatOil_city',
        'heatOil_address',
        'heatOil_number_address',
        'heatOil_quantity',
        'status'
    ];
}
