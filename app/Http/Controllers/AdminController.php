<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Appointment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
  public function index(Request $request)
  {
    // Αν ο χρήστης διάλεξε ημερομηνία, την παίρνουμε. Αλλιώς, παίρνουμε το σήμερα.
    $selectedDate = $request->query('date', date('Y-m-d'));

    // Φέρνουμε τα ραντεβού για τη συγκεκριμένη ημερομηνία
    $appointments = Appointment::where('appointment_date', $selectedDate)
      ->orderBy('appointment_time', 'asc')
      ->get();

    //more stats for dashboard
    $stats = [
        'pending' => $appointments->where('status', 1)->count(),
        'completed' => $appointments->where('status', 2)->count(),
        'canceled' => $appointments->where('status', 3)->count(),

    ];


    return view('admin.dashboard', compact('appointments', 'selectedDate', 'stats'));
  }

  public function updateStatus(Request $request, $id)
  {
    $appointment = Appointment::findOrFail($id);
    $appointment->update(['status' => $request->status]);

    return back()->with('success', 'Η κατάσταση ενημερώθηκε!');
  }
  public function stats(Request $request){
    //Getting the year from Url , else the current year
    $selectedYear = $request->query('year', date('Y'));
    
    $availableYears = Appointment::selectRaw('Year(appointment_date) as year')
        ->distinct()
        ->orderBy('year', 'desc')
        ->pluck('year');

    

    $topCustomers = Appointment::select('customer_name', 'customer_phone', DB::raw('count(*) as total'))
        ->whereYear('appointment_date', $selectedYear)//filter by year
        ->where('status', 2)
        ->groupBy('customer_name', 'customer_phone')
        ->orderBy('total', 'desc')
        ->limit(10)
        ->get();
    
    $monthlyStats = Appointment::select(
            DB::raw('MONTH(appointment_date) as month'),
            DB::raw('count(*) as count')  
        )
        ->whereYear('appointment_date', $selectedYear)//filter year
        ->where('status', 2)
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    $months = [
        1 => 'Ιαν', 2 => 'Φεβ', 3 => 'Μαρ', 4 => 'Απρ', 5 => 'Μάι', 6 => 'Ιούν',
        7 => 'Ιούλ', 8 => 'Αυγ', 9 => 'Σεπ', 10 => 'Οκτ', 11 => 'Νοέ', 12 => 'Δεκ'
    ];

    // Δημιουργούμε τις μεταβλητές που περιμένει το Blade
    $labels = $monthlyStats->map(fn($stat) => $months[$stat->month] ?? 'Μην. '.$stat->month);
    $data = $monthlyStats->pluck('count');
    // ---------------------------------------

    // Τώρα τις στέλνουμε όλες στο view
    return view('admin.stats', compact('topCustomers', 'monthlyStats', 'labels', 'data', 'selectedYear', 'availableYears'));

  }
  public function search(Request $request)
  {
    $query = $request->input('query');

    //We search for license plate | phone | name
    $appointments = Appointment::where('license_plate', 'LIKE', "%{$query}%")
        ->orWhere('customer_name', 'LIKE', "%{$query}%")
        ->orWhere('customer_phone', 'LIKE', "%{$query}%")
        ->orderBy('appointment_date', 'desc')
        ->get();
    
        return view('admin.search-results', compact('appointments', 'query'));
  }
  public function exportPDF(Request $request)
  {
    $date = $request->query('date', date('Y-m-d'));

    $appointments = Appointment::where('appointment_date', $date)
        ->where('status', 2)
        ->orderBy('appointment_time', 'asc')
        ->get();

    // Φτιάχνουμε το PDF χρησιμοποιώντας ένα ειδικό blade αρχείο
    $pdf = Pdf::loadView('admin.pdf-template', compact('appointments', 'date'))
              ->setPaper('a4', 'portrait');

    // Download το αρχείο με όνομα που περιέχει την ημερομηνία
    return $pdf->download("appointments-{$date}.pdf");
  }
  public function adminProducts(Request $request)
{
    // Παίρνουμε το station_id από το φίλτρο, αν υπάρχει
    $stationFilter = $request->query('station_id');

    // Φέρνουμε τα προϊόντα (με φίλτρο ή χωρίς)
    $products = Product::when($stationFilter, function ($query, $stationFilter) {
        return $query->where('station_id', $stationFilter);
    })->get();

    // Χρειαζόμαστε τα πρατήρια για το Select
    $stations = config('stations'); // Ή Station::all() αν τα έχεις σε βάση

    return view('admin.products.index', compact('products', 'stations', 'stationFilter'));
}
    public function storeProduct(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'station_id' => 'required|integer',
            'price' => 'required|numeric',
            'product_type' => 'required|in:retail,service',
            'category' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Αποθήκευση στο storage/app/public/products
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Το προϊόν προστέθηκε!');
    }

    public function destroyProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return back()->with('success', 'Το προϊόν διαγράφηκε!');
    }
    public function editProduct($id)
{
    $product = Product::findOrFail($id);
    $stations = config('stations');
    return view('admin.products.edit', compact('product', 'stations'));
}

public function updateProduct(Request $request, $id)
{
    $product = Product::findOrFail($id);
    
    $data = $request->validate([
        'name' => 'required',
        'station_id' => 'required',
        'price' => 'required|numeric',
        'product_type' => 'required',
        'category' => 'nullable',
        'image' => 'nullable|image|max:2048'
    ]);

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('products', 'public');
    }

    $product->update($data);

    return redirect()->route('admin.products.index')->with('success', 'Ενημερώθηκε επιτυχώς!');
}
}
