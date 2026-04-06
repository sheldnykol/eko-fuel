<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LpgOrder extends Model
{
//Customer info from migration 
protected $fillable =[    
    'lpg_name',
    'lpg_phone',
    'lpg_afm',
    'lpg_city',
    'lpg_type',
    'lpg_address',
    'lpg_number_address',
    'lpg_quantity',
    'status'
    ];
}
