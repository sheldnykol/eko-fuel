<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    return view('admin.dashboard', compact('appointments', 'selectedDate'));
  }

  public function updateStatus(Request $request, $id)
  {
    $appointment = Appointment::findOrFail($id);
    $appointment->update(['status' => $request->status]);

    return back()->with('success', 'Η κατάσταση ενημερώθηκε!');
  }
  public function stats(){
    $topCustomers = Appointment::select('customer_name', 'customer_phone', DB::raw('count(*) as total'))
        ->groupBy('customer_name', 'customer_phone')
        ->orderBy('total', 'desc')
        ->limit(10)
        ->get();
    
    $monthlyStats = Appointment::select(
            DB::raw('MONTH(appointment_date) as month'),
            DB::raw('count(*) as count')  
        )
        ->whereYear('appointment_date', date('Y'))
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
    return view('admin.stats', compact('topCustomers', 'monthlyStats', 'labels', 'data'));

  }
}
