<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showProducts(Request $request, $station_id)
    {
        $allStations = config('stations');

        if (!isset($allStations[$station_id])) {
            abort(404, 'Το πρατήριο δεν βρέθηκε.');
        }

        $category = $request->query('category');
        $query = Product::where('station_id', $station_id)->where('is_active', true);

        if ($category) {
            $query->where('category', $category);
        }

        $products = $query->get();

        return view('products.index', [
            'products'        => $products,
            'station'         => $allStations[$station_id],
            'allStations'     => $allStations,
            'id'              => $station_id,
            'currentCategory' => $category
        ]);
    }

    public function create()
    {
        $stations = config('stations');
        return view('admin.products.create', compact('stations'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $stations = config('stations');

        return view('admin.products.edit', compact('product', 'stations'));
    }
}