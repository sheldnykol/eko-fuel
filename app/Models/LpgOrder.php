<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LpgOrder extends Model
{
    //Customer info from migration 
protected $fillable =[    
    'customer_lpg_name',
    'customer_lpg_phone',
    'customer_lpg_afm',
    'customer_lpg_city',
    'customer_lpg_address',
    'customer_lpg_number_of_address',
    'lpg_quantity',
    'status'
    ];
}
