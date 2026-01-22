<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            \App\Models\Station::create([
            'name' => 'ΕΚΟ ΒΟΛΟΥ 12',
            'address' => 'Βόλου 12, Λάρισα',
            'city' => 'Λάρισα'
            ]);

            \App\Models\Station::create([
            'name' => 'ΕΚΟ ΚΑΡΑΜΑΝΛΗ 102',
            'address' => '1ο ΧΛΜ Π.Ε.Ο ΛΑΡΙΣΑΣ-ΑΘΗΝΩΝ Κ. ΚΑΡΑΜΑΝΛΗ 102',
            'city' => 'Λάρισα'
            ]);
    }
}
