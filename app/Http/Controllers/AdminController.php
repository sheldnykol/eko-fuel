<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Appointment;
use App\Models\Station;
use App\Models\AppointmentComment;
use App\Models\Schedule;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        Log::info("Request , " . $request); // /admin/dashboard?date=2026-02-20&month=2&year=2026
        $selectedDate = $request->query('date', date('Y-m-d'));//2026-02-20 
        
        $month = $request->query('month', date('m')); // 2
        
        $year = $request->query('year', date('Y')); // 2026

        $calendarDate = \Carbon\Carbon::createFromDate($year, $month, 1); // 2026-02-01 16:30:45 

        $startOfMonth = $calendarDate->copy()->startOfMonth(); // 2026-02-01 00:00:00  
        $endOfMonth = $calendarDate->copy()->endOfMonth(); // 2026-02-28 23:59:59  
        
        //SUNDAY = 7 , MONDAY = 1 
        $firstDayOfWeek = $startOfMonth->dayOfWeekIso; // 7
        $emptyDaysAtStart = $firstDayOfWeek - 1; // 7 - 1 = 6 ( 6 days which is from prev month we just show them to fill the calendar )


        //TESTING  toSql to see the actual sql query 
        // $query = Appointment::whereBetween('appointment_date', [$startOfMonth->format('Y-m-d'), $endOfMonth->format('Y-m-d')])->toSql();
        // Log::info($query);
        // $queryRaw = Appointment::whereBetween('appointment_date', [$startOfMonth->format('Y-m-d'), $endOfMonth->format('Y-m-d')])->toRawSql();
        // Log::info($queryRaw);

        //TESTING 
        //pluck
        //$products = Product::pluck('name', 'id');
        // result:  [1 => "iPhone", 2 => "Samsung", 3 => "Xiaomi"]
        //whereBetween
        //  ->where('appointment_date', '>=', '2026-02-01')
        // ->where('appointment_date', '<=', '2026-02-28')

        // $monthlyCounts = Appointment::whereBetween('appointment_date', [$startOfMonth->format('Y-m-d'), $endOfMonth->format('Y-m-d')])
        //     ->selectRaw('appointment_date, count(*) as total')
        //     ->groupBy('appointment_date')
        //     ->get(); 
        // WITH ->get()  ---> [{"appointment_date":"2026-02-02","total":1},{"appointment_date":"2026-02-24","total":1},{"appointment_date":"2026-02-03","total":2},{"appointment_date":"2026-02-10","total":1},{"appointment_date":"2026-02-09","total":1},{"appointment_date":"2026-02-11","total":1},{"appointment_date":"2026-02-18","total":7},{"appointment_date":"2026-02-19","total":6},{"appointment_date":"2026-02-20","total":4},{"appointment_date":"2026-02-21","total":4},{"appointment_date":"2026-02-26","total":1},{"appointment_date":"2026-02-27","total":6},{"appointment_date":"2026-02-28","total":2},{"appointment_date":"2026-02-25","total":1}]  
 
           
        $monthlyCounts = Appointment::whereBetween('appointment_date', [$startOfMonth->format('Y-m-d'), $endOfMonth->format('Y-m-d')])
            ->selectRaw('appointment_date, count(*) as total')
            ->groupBy('appointment_date')
            ->pluck('total', 'appointment_date');

        Log::info("MONTHLYCOUNTS  , ". $monthlyCounts); // {"2026-02-02":1,"2026-02-24":1,"2026-02-03":2,"2026-02-10":1,"2026-02-09":1,"2026-02-11":1,"2026-02-18":7,"2026-02-19":6,"2026-02-20":4,"2026-02-21":4,"2026-02-26":1,"2026-02-27":6,"2026-02-28":2,"2026-02-25":1}  

        $calendarDays = [];
        for ($date = $startOfMonth->copy(); $date->lte($endOfMonth); $date->addDay()) {
            $calendarDays[$date->format('Y-m-d')] = $monthlyCounts[$date->format('Y-m-d')] ?? 0;
        }
        Log::info("<CalendarDays  ARRAY:\n" . print_r($calendarDays, true));
        Log::info("JSON STRING: " . json_encode($calendarDays, JSON_PRETTY_PRINT));

        // Δεδομένα για τα βέλη "Επόμενο" - "Προηγούμενο"
        $prevMonth = $calendarDate->copy()->subMonth(); 
        $nextMonth = $calendarDate->copy()->addMonth();

        $appointments = Appointment::where('appointment_date', $selectedDate)->orderBy('appointment_time', 'asc')->get();
        $stats = [
            'pending' => $appointments->where('status', 1)->count(),
            'completed' => $appointments->where('status', 2)->count(),
            'canceled' => $appointments->where('status', 3)->count(),
        ];

        return view('admin.dashboard', compact(
            'appointments',
            'selectedDate', 
            'stats', 
            'calendarDays', 
            'calendarDate', 
            'prevMonth', 
            'nextMonth', 
            'emptyDaysAtStart'
        ));
    }
    public function updateStatus(Request $request, $id)
{
    // Βρίσκουμε το ραντεβού
    $appointment = Appointment::findOrFail($id);
    
    // Ενημερώνουμε το status
    $appointment->status = $request->input('status');
    $appointment->save();

    // Παίρνουμε την ημερομηνία από το κρυφό input (αν υπάρχει) για να μη χάσουμε την πλοήγηση
    $date = $request->input('selected_date', $appointment->appointment_date);

    // Επιστροφή στο dashboard στην ίδια ημερομηνία
    return redirect()->route('admin.dashboard', ['date' => $date])
                     ->with('success', 'Η κατάσταση του ραντεβού ενημερώθηκε επιτυχώς.');
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
    public function manageSchedules() {
        $stations = Station::all();
        // Ορίζουμε το ελάχιστο όριο: σήμερα + 14 ημέρες
        $minDate = now()->addDays(14)->format('Y-m-d');
        
        return view('admin.schedules.index', compact('stations', 'minDate'));
    }

    public function storeSchedule(Request $request) {
        $minDate = now()->addDays(14)->format('Y-m-d');

        $validated = $request->validate([
            'station_id' => 'required|exists:stations,id',
            'date' => "required|date|after_or_equal:$minDate",
            'available_slots' => 'required|array',
        ], [
            'date.after_or_equal' => 'Μπορείτε να αλλάξετε το πρόγραμμα μόνο για ημερομηνίες μετά τις ' . $minDate,
        ]);

        // Χρησιμοποιούμε updateOrCreate για να μην έχουμε διπλότυπα στην ίδια ημερομηνία
        Schedule::updateOrCreate(
            ['station_id' => $validated['station_id'], 'date' => $validated['date']],
            ['available_slots' => $validated['available_slots']]
        );

        return back()->with('success', 'Το πρόγραμμα ενημερώθηκε επιτυχώς!');
    }

    public function storeComment(Request $request, $id)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        //save in DB table 
        AppointmentComment::create([
            'appointment_id' => $id, //to id apo to url tou ranteboy
            'body' => $request->body,
            'user_id'=> auth()->id() //keimeno poy egra4e sto adminProducts
        ]);

        return back()->with('success', 'Το σχόλιο προστέθηκε!');
    }
    public function allComments()
    {
        $comments = AppointmentComment::with(['appointment','user'])->latest()->paginate(20);
        return view('admin.comments.index', compact('comments'));
    }
}
