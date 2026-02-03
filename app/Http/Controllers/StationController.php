<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Product;

class StationController extends Controller
{
    public function show($id){
        $stations = config('stations');

        $station = $stations[$id] ?? null;
        if(!$station) {
            abort(404);
        }
        return view('stations.show', compact("station"));
    }
    public function showProducts($id)
    {
        // Και εδώ διαβάζει από το ίδιο αρχείο
        $allStations = config('stations');
        $station = $allStations[$id] ?? abort(404);

        $products = Product::where('station_id', $id)->get();

        return view('pages.products', [
            'products' => $products,
            'station' => $station,
            'allStations' => $allStations,
            'id' => $id
        ]);
    }
    public function showStations()
    {
            $allStations = config('stations');
            
            Log::info("station", $allStations);
            $names = array_column($allStations, 'name');
            Log::info("Station Names", $names);
         return view('pages.contact', compact('allStations'));
    }
}
