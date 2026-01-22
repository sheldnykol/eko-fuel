<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function store(Request $request){
        //Validation
        $validated = $request->validate([
            'station_id' => 'required',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|digits:10', // Αποδέχεται ΜΟΝΟ αριθμούς και ακριβώς 10 ψηφία
            'license_plate' => 'required|string',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
        ], [
            // Προαιρετικά: Μηνύματα στα ελληνικά
            'customer_phone.digits' => 'Το τηλέφωνο πρέπει να είναι ακριβώς 10 ψηφία.',
            'appointment_date.after_or_equal' => 'Η ημερομηνία δεν μπορεί να είναι στο παρελθόν.',
        ]);
        //Check Availabiliy for Double Booking
        $isBooked = Appointment::where('station_id', $request->station_id)
                ->where('appointment_date', $request->appointment_date)
                ->where('appointment_time', $request->appointment_time)
                ->exists();
        if ($isBooked) {
            return back()->withErrors(['appointment_time' => 'Δυστηχώς η ώρα αυτή έχει ήδη κλειστεί από άλλον χρήστη.'])->withInput();
        }

        //Pin creation 
        $pin = strtoupper(Str::random(6));
        //CAPS
        $validated['customer_name'] = mb_strtoupper($request->customer_name, 'UTF-8');
        $validated['license_plate'] = mb_strtoupper(str_replace(' ', '', $request->license_plate), 'UTF-8');
        
        //Add pin to array
        $validated['booking_pin'] = $pin;

        // Αν η ώρα έρχεται ως "10:00", την κάνουμε "10:00:00" για τη MySQL
        if (strlen($validated['appointment_time']) == 5) {
        $validated['appointment_time'] .= ':00';
    }
        //Save to DB 
        Appointment::create($validated);
        //Νο ability to book prev hours-dates
        $currentTime = date('H:i');
        $today = date('Y-m-d');

        if ($request->appointment_date == $today && $request->appointment_time < $currentTime) {
            return back()->withErrors(['appointment_time' => 'Η ώρα που επιλέξατε έχει ήδη περάσει.'])->withInput();
        }

        //Success Alert
        return back()->with('success','Η κράτησή σας ολοκληρώθηκε με επιτυχία!')
        ->with('pin', $pin);
    }

    public function checkAvailability(Request $request)
        { 
        // Παίρνουμε τις ώρες που είναι ήδη κρατημένες για το συγκεκριμένο πρατήριο και ημερομηνία
        $bookedTimes = Appointment::where('station_id', $request->station_id)
            ->where('appointment_date', $request->appointment_date)
            ->pluck('appointment_time') // Παίρνει μόνο την κολόνα των ωρών
            ->toArray();

        return response()->json($bookedTimes);
        }

    public function index()
        {
            // Φέρνουμε μόνο το πρατήριο που μας ενδιαφέρει
            $stations = \App\Models\Station::where('name', 'LIKE', '%ΒΟΛΟΥ%')->get();
            
            return view('pages.booking', compact('stations'));
        }
}


