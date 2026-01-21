<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StationController extends Controller
{
    public function show($id){
        $stations = [
            1 => [
                'name' =>'ΕΚΟ ΒΟΛΟΥ 12, ΛΑΡΙΣΑ',
                'image' => 'eko_station_1.jpg',
                'address' => 'ΒΟΛΟΥ 12, ΛΑΡΙΣΑ',
                'prices' => [
                    'amolyvdhi_100' => '1.98 €',
                    'amolyvdhi_95' => '1.78 €',
                    'diesel_economy' => '1.78 €',
                    'diesel_avio' => '1.98 €',
                    'auto_gas' => '1.23 €',
                    'petrelaio' => '1.56 €',
                ],
                'services' => ['Πλυντήριο Αυτοκινήτων', 'Προϊόντα Καταστήματος'],
            ],
            2 => [                
                'name' =>'ΕΚΟ 1ο ΧΛΜ Π.Ε.Ο ΛΑΡΙΣΑΣ-ΑΘΗΝΩΝ Κ. ΚΑΡΑΜΑΝΛΗ 102',
                'image' => 'eko2.jpg',
                'address' => '1ο ΧΛΜ Π.Ε.Ο ΛΑΡΙΣΑΣ-ΑΘΗΝΩΝ Κ. ΚΑΡΑΜΑΝΛΗ 102',
                'prices' => [
                    'amolyvdhi_100' => '1.98 €',
                    'amolyvdhi_95' => '1.78 €',
                    'diesel_economy' => '1.78 €',
                    'diesel_avio' => '1.98 €',
                    'auto_gas' => '1.23 €',
                    'petrelaio' => '1.56 €',
                ],
                'services' => ['Προϊόντα Καταστήματος'],
            ],
            
        ];

        $station = $stations[$id] ?? null;
        if(!$station) {
            abort(404);
        }
        return view('stations.show', compact("station"));
    }
}
