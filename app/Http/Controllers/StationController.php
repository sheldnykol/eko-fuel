<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Support\FuelPriceScraper;

class StationController extends Controller
{
    public function show($id)
    {
        $station = config("stations.$id") ?? abort(404);

        $station['prices'] = app(FuelPriceScraper::class)->cached($id);

        return view('stations.show', compact('station', 'id'));
    }

    public function showProducts($id)
    {
        $allStations = config('stations');
        $station = $allStations[$id] ?? abort(404);

        $products = Product::where('station_id', $id)->get();

        return view('pages.products', [
            'products' => $products,
            'station' => $station,
            'allStations' => $allStations,
            'id' => (int) $id,
        ]);
    }

    public function showStations()
    {
        return view('pages.contact', ['allStations' => config('stations')]);
    }
}
