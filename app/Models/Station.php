<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Station extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'city'];

    //Σύνδεση με τα Προϊόντα: Ένα πρατήριο έχει πολλά προϊόντα

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Σύνδεση με τα Ραντεβού: Ένα πρατήριο έχει πολλά ραντεβού

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
