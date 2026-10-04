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
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;
use App\Support\BookingRules;
 
class AdminController extends Controller
{
    public function index(Request $request)
    {
        $selectedDate = $request->query('date', date('Y-m-d'));
        if (! preg_match('/^\d{4}-\d{2}-\d{2}$/', $selectedDate)) {
            $selectedDate = date('Y-m-d');
        }
        $selected = \Carbon\Carbon::parse($selectedDate);

        $month = (int) $request->query('month', $selected->month);
        $year = (int) $request->query('year', $selected->year);

        $calendarDate = \Carbon\Carbon::createFromDate($year, $month, 1);

        $startOfMonth = $calendarDate->copy()->startOfMonth();
        $endOfMonth = $calendarDate->copy()->endOfMonth();

        $emptyDaysAtStart = $startOfMonth->dayOfWeekIso - 1;

        $monthlyCounts = Appointment::whereBetween('appointment_date', [$startOfMonth->format('Y-m-d'), $endOfMonth->format('Y-m-d')])
            ->where('status', '!=', BookingRules::STATUS_CANCELLED)
            ->selectRaw('appointment_date, count(*) as total')
            ->groupBy('appointment_date')
            ->pluck('total', 'appointment_date');

        $calendarDays = [];
        for ($date = $startOfMonth->copy(); $date->lte($endOfMonth); $date->addDay()) {
            $calendarDays[$date->format('Y-m-d')] = $monthlyCounts[$date->format('Y-m-d')] ?? 0;
        }

        $prevMonth = $calendarDate->copy()->subMonth();
        $nextMonth = $calendarDate->copy()->addMonth();

        $appointments = Appointment::with(['comments.user'])
            ->where('appointment_date', $selectedDate)
            ->orderBy('appointment_time', 'asc')
            ->get();

        $stats = [
            'total' => $appointments->where('status', '!=', BookingRules::STATUS_CANCELLED)->count(),
            'pending' => $appointments->where('status', 1)->count(),
            'completed' => $appointments->where('status', 2)->count(),
            'canceled' => $appointments->where('status', 3)->count(),
        ];

        $upcomingCount = Appointment::where('status', 1)
            ->whereBetween('appointment_date', [now()->toDateString(), now()->addDays(6)->toDateString()])
            ->count();

        return view('admin.dashboard', compact(
            'appointments',
            'selectedDate',
            'stats',
            'calendarDays',
            'calendarDate',
            'prevMonth',
            'nextMonth',
            'emptyDaysAtStart',
            'upcomingCount'
        ));
    }

    public function updateStatus(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $validated = $request->validate([
            'status' => 'required|integer|in:1,2,3',
        ], [
            'status.*' => 'Μη έγκυρη κατάσταση ραντεβού.',
        ]);
        $newStatus = (int) $validated['status'];
        $date = \Carbon\Carbon::parse($appointment->appointment_date)->toDateString();

        if ((int) $appointment->status === BookingRules::STATUS_CANCELLED && $newStatus !== BookingRules::STATUS_CANCELLED) {
            $taken = Appointment::where('station_id', $appointment->station_id)
                ->whereDate('appointment_date', $date)
                ->where('appointment_time', $appointment->appointment_time)
                ->where('status', '!=', BookingRules::STATUS_CANCELLED)
                ->where('id', '!=', $appointment->id)
                ->exists();

            if ($taken) {
                return redirect()->route('admin.dashboard', ['date' => $date])
                    ->withErrors(['status' => 'Η ώρα ' . substr($appointment->appointment_time, 0, 5) . ' έχει ήδη κλειστεί από άλλο ραντεβού. Το ραντεβού παραμένει ακυρωμένο.']);
            }
        }

        $appointment->status = $newStatus;
        $appointment->save();

        return redirect()->route('admin.dashboard', ['date' => $date])
                         ->with('success', 'Το ραντεβού του ' . $appointment->customer_name . ' ενημερώθηκε.');
    }

    public function stats(Request $request)
    {
        $selectedYear = (int) $request->query('year', date('Y'));

        $availableYears = Appointment::selectRaw('Year(appointment_date) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        if (! $availableYears->contains($selectedYear)) {
            $availableYears->prepend($selectedYear);
        }

        $topCustomers = Appointment::select('customer_name', 'customer_phone', DB::raw('count(*) as total'))
            ->whereYear('appointment_date', $selectedYear)
            ->where('status', 2)
            ->groupBy('customer_name', 'customer_phone')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();

        $byMonthStatus = Appointment::select(
                DB::raw('MONTH(appointment_date) as month'),
                'status',
                DB::raw('count(*) as count')
            )
            ->whereYear('appointment_date', $selectedYear)
            ->groupBy('month', 'status')
            ->get();

        $months = [
            1 => 'Ιαν', 2 => 'Φεβ', 3 => 'Μαρ', 4 => 'Απρ', 5 => 'Μάι', 6 => 'Ιούν',
            7 => 'Ιούλ', 8 => 'Αυγ', 9 => 'Σεπ', 10 => 'Οκτ', 11 => 'Νοέ', 12 => 'Δεκ'
        ];

        $labels = array_values($months);
        $data = [];
        $cancelledData = [];
        foreach (array_keys($months) as $m) {
            $data[] = (int) $byMonthStatus->where('month', $m)->where('status', 2)->sum('count');
            $cancelledData[] = (int) $byMonthStatus->where('month', $m)->where('status', 3)->sum('count');
        }

        $totals = [
            'completed' => array_sum($data),
            'cancelled' => array_sum($cancelledData),
            'all' => (int) $byMonthStatus->sum('count'),
            'customers' => Appointment::whereYear('appointment_date', $selectedYear)->where('status', 2)->distinct('customer_phone')->count('customer_phone'),
        ];
        $bestMonthIndex = $totals['completed'] ? array_search(max($data), $data) : null;
        $totals['best_month'] = $bestMonthIndex !== null ? $labels[$bestMonthIndex] . ' (' . $data[$bestMonthIndex] . ')' : '-';
        $totals['cancel_rate'] = $totals['all'] ? round($totals['cancelled'] / $totals['all'] * 100) : 0;

        return view('admin.stats', compact('topCustomers', 'labels', 'data', 'cancelledData', 'selectedYear', 'availableYears', 'totals'));
    }

    public function search(Request $request)
    {
        $query = trim((string) $request->input('query'));

        $appointments = $query === ''
            ? collect()
            : Appointment::where(function ($q) use ($query) {
                    $q->where('license_plate', 'LIKE', "%{$query}%")
                        ->orWhere('customer_name', 'LIKE', "%{$query}%")
                        ->orWhere('customer_phone', 'LIKE', "%{$query}%");
                })
                ->orderBy('appointment_date', 'desc')
                ->orderBy('appointment_time', 'desc')
                ->limit(100)
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
 
        $pdf = Pdf::loadView('admin.pdf-template', compact('appointments', 'date'))
                  ->setPaper('a4', 'portrait');
 
        return $pdf->download("appointments-{$date}.pdf");
    }
 
    public function adminProducts(Request $request)
    {
        $stationFilter = $request->query('station_id');

        $products = Product::when($stationFilter, fn ($query) => $query->where('station_id', $stationFilter))->get();
        $stations = $this->productStations();

        return view('admin.products.index', compact('products', 'stations', 'stationFilter'));
    }

    public function createProduct()
    {
        return view('admin.products.create', ['stations' => $this->productStations()]);
    }

    public function storeProduct(Request $request)
    {
        $data = $request->validate($this->productRules());

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Το προϊόν προστέθηκε.');
    }

    public function destroyProduct($id)
    {
        Product::findOrFail($id)->delete();

        return back()->with('success', 'Το προϊόν διαγράφηκε.');
    }

    public function editProduct($id)
    {
        return view('admin.products.edit', [
            'product' => Product::findOrFail($id),
            'stations' => $this->productStations(),
        ]);
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $data = $request->validate($this->productRules());

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        } else {
            unset($data['image']);
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Το προϊόν ενημερώθηκε.');
    }

    private function productStations(): array
    {
        return collect(config('stations'))->map(fn ($station) => ['name' => $station['title']])->all();
    }

    private function productRules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'station_id' => ['required', Rule::in(array_keys(config('stations')))],
            'price' => 'nullable|numeric|min:0',
            'product_type' => 'required|in:retail,service',
            'category' => 'required|in:lubricants,chemicals,accessories,maintenance,misc',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    public function manageSchedules()
    {
        $stations = Station::all();
        $minDate = now()->addDay()->format('Y-m-d');
        $times = BookingRules::ADMIN_TIMES;
        $defaultSlots = BookingRules::DEFAULT_SLOTS;

        return view('admin.schedules.index', compact('stations', 'minDate', 'times', 'defaultSlots'));
    }

    public function scheduleDay(Request $request)
    {
        $request->validate([
            'station_id' => 'required|exists:stations,id',
            'date' => 'required|date_format:Y-m-d',
        ]);

        $isCustom = Schedule::where('station_id', $request->station_id)->whereDate('date', $request->date)->exists();

        return response()->json([
            'slots' => BookingRules::slotsFor($request->station_id, $request->date),
            'booked' => BookingRules::bookedTimes($request->station_id, $request->date),
            'is_custom' => $isCustom,
        ]);
    }

    public function storeSchedule(Request $request)
    {
        $minDate = now()->addDay()->format('Y-m-d');

        $validated = $request->validate([
            'station_id' => 'required|exists:stations,id',
            'date' => "required|date_format:Y-m-d|after_or_equal:$minDate",
            'available_slots' => 'nullable|array',
            'available_slots.*' => ['string', Rule::in(BookingRules::ADMIN_TIMES)],
        ], [
            'date.after_or_equal' => 'Το ωράριο μπορεί να αλλάξει έως και μία μέρα πριν (από ' . \Carbon\Carbon::parse($minDate)->format('d/m/Y') . ' και μετά).',
        ]);

        $slots = array_values(array_unique($validated['available_slots'] ?? []));
        sort($slots);

        $booked = BookingRules::bookedTimes($validated['station_id'], $validated['date']);
        $removedBooked = array_diff($booked, $slots);

        if ($removedBooked) {
            return back()->withInput()->withErrors([
                'available_slots' => 'Δεν μπορείτε να αφαιρέσετε ώρες με κλεισμένο ραντεβού: ' . implode(', ', $removedBooked) . '. Ακυρώστε πρώτα το ραντεβού από το ημερολόγιο.',
            ]);
        }

        Schedule::updateOrCreate(
            ['station_id' => $validated['station_id'], 'date' => $validated['date']],
            ['available_slots' => $slots]
        );

        $label = \Carbon\Carbon::parse($validated['date'])->format('d/m/Y');
        $message = $slots
            ? "Το ωράριο για {$label} αποθηκεύτηκε (" . count($slots) . ' ώρες).'
            : "Η {$label} ορίστηκε ως κλειστή μέρα.";

        return redirect()->route('admin.schedules.index', ['station_id' => $validated['station_id'], 'date' => $validated['date']])
            ->with('success', $message);
    }

    public function resetSchedule(Request $request)
    {
        $minDate = now()->addDay()->format('Y-m-d');

        $validated = $request->validate([
            'station_id' => 'required|exists:stations,id',
            'date' => "required|date_format:Y-m-d|after_or_equal:$minDate",
        ]);

        $booked = BookingRules::bookedTimes($validated['station_id'], $validated['date']);
        $outsideDefault = array_diff($booked, BookingRules::DEFAULT_SLOTS);

        if ($outsideDefault) {
            return back()->withErrors([
                'available_slots' => 'Δεν γίνεται επαναφορά: υπάρχουν κλεισμένα ραντεβού σε ώρες εκτός προεπιλογής (' . implode(', ', $outsideDefault) . ').',
            ]);
        }

        Schedule::where('station_id', $validated['station_id'])->whereDate('date', $validated['date'])->delete();

        return redirect()->route('admin.schedules.index', $validated)
            ->with('success', 'Η ' . \Carbon\Carbon::parse($validated['date'])->format('d/m/Y') . ' επανήλθε στο προεπιλεγμένο ωράριο.');
    }

    public function storeComment(Request $request, $id)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);
 
        AppointmentComment::create([
            'appointment_id' => $id,
            'body' => $request->body,
            'user_id'=> auth()->id()
        ]);
 
        return back()->with('success', 'Το σχόλιο προστέθηκε!');
    }
 
    public function allComments()
    {
        $comments = AppointmentComment::with(['appointment','user'])->latest()->paginate(20);
        return view('admin.comments.index', compact('comments'));
    }
}
 