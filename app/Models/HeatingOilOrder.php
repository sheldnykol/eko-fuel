<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeatingOilOrder extends Model
{
    //Customer info from migration 
    protected $fillable =[    
        'customer_heatingOil_name',
        'customer_heatingOil_phone',
        'customer_heatingOil_afm',
        'customer_heatingOil_city',
        'customer_heatingOil_address',
        'customer_heatingOil_number_of_address',
        'heatingOil_quantity',
        'status'
    ];
}
