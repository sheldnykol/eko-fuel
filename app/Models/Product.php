<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Ορίζουμε ποια πεδία επιτρέπεται να "γεμίσουμε" από τη φόρμα
    protected $fillable = [
        'station_id',
        'name',
        'price',
        'product_type',
        'category',
        'image'
    ];
}