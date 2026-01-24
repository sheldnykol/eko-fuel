<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create()
{
    // Εδώ κανονικά θα καλούσες το array από τον StationController 
    // ή από ένα κοινό σημείο (π.χ. config/stations.php)
    $stations = [
        1 => ['name' => 'ΕΚΟ ΒΟΛΟΥ 12, ΛΑΡΙΣΑ'],
        2 => ['name' => 'ΕΚΟ Κ. ΚΑΡΑΜΑΝΛΗ 102, ΛΑΡΙΣΑ']
    ];

    return view('admin.products.create', compact('stations'));
}

public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required',
        'station_id' => 'required',
        'price' => 'required|numeric',
        'category' => 'nullable',
        'product_type' => 'required',
        'image' => 'nullable|image|max:2048'
    ]);

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('products', 'public');
    }

    \App\Models\Product::create($data);

    return redirect()->route('admin.products.index')->with('success', 'Το προϊόν δημιουργήθηκε!');
}
}
