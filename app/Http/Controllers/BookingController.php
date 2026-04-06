<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Schedule;
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
            'wash_type' => 'required|string',
            'comments' => 'nullable|string|max:250',
            'extras' => 'nullable|array',
        ], [
            // Προαιρετικά: Μηνύματα στα ελληνικά
            'customer_phone.digits' => 'Το τηλέφωνο πρέπει να είναι ακριβώς 10 ψηφία.',
            'appointment_date.after_or_equal' => 'Η ημερομηνία δεν μπορεί να είναι στο παρελθόν.',
        ]);
        // 2. Διαχείριση των Extras
        // Μετατρέπουμε το array σε ένα κείμενο χωρισμένο με κόμματα για την βάση
        $extrasString = null;
        if ($request->has('extras')) {
            // Ενώνουμε τα στοιχεία του array σε ένα string
            $extrasString = implode(', ', $request->extras); 
            $validated['extras'] = $extrasString; // Προσοχή στο ; στο τέλος
        } else {
            // Αν δεν επέλεξε τίποτα, βάζουμε '0' ή null
            $validated['extras'] = 'Χωρίς Extras'; 
        }
        if($request->filled('comments')) {
            $validated['comments'] = mb_strtoupper($request->comments, 'UTF-8');
        }
        //Check Availabiliy for Double Booking
        $isBooked = Appointment::where('station_id', $request->station_id)
                ->where('appointment_date', $request->appointment_date)
                ->where('appointment_time', $request->appointment_time)
                ->exists();
        if ($isBooked) {
            return back()->withErrors(['appointment_time' => 'Δυστηχώς η ώρα αυτή έχει ήδη κλειστεί από άλλον χρήστη.'])->withInput();
        }

        //Pin creation 
        //$pin = strtoupper(Str::random(6));
        //CAPS
        $validated['customer_name'] = mb_strtoupper($request->customer_name, 'UTF-8');
        $validated['license_plate'] = mb_strtoupper(str_replace(' ', '', $request->license_plate), 'UTF-8');
        
        //Add pin to array
        //$validated['booking_pin'] = $pin;

        // Αν η ώρα έρχεται ως "10:00", την κάνουμε "10:00:00" για τη MySQL
        if (strlen($validated['appointment_time']) == 5) {
        $validated['appointment_time'] .= ':00';
    }
        //Save to DB 
        $appointment = Appointment::create($validated);
        Log::info("Date received: " . $appointment);

        $this->sendSms(
            $appointment->customer_phone,
            $appointment->appointment_date,
            $appointment->appointment_time
        );
       

        
        //Νο ability to book prev hours-dates
        $currentTime = date('H:i');
        $today = date('Y-m-d');

        if ($request->appointment_date == $today && $request->appointment_time < $currentTime) {
            return back()->withErrors(['appointment_time' => 'Η ώρα που επιλέξατε έχει ήδη περάσει.'])->withInput();
        }

        //Success Alert
        return back()->with('success', 'Η κράτησή σας ολοκληρώθηκε με επιτυχία!')
            ->with('appointment_date', $appointment->appointment_date)
            ->with('appointment_time', $appointment->appointment_time)
            ->with('customer_name', $appointment->customer_name);
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

    public function getAvailableSlots(Request $request) {
            Log::info($request->all());
            $date = $request->date;
            $stationId = $request->station_id;


            Log::info("--- New Slot Request ---");
            Log::info("Date received: " . $date);
            // Αν δεν έχουν σταλεί δεδομένα, γύρνα άδειο array για να μη σκάσει η JS
            if (!$date || !$stationId) {
                return response()->json(['all_slots' => [], 'booked_slots' => []]);
            }
            //echo($date);
            // 1 Searching for custom dates
            $customSchedule = Schedule::where('station_id', $stationId)
                ->where('date', $date)
                ->first();
            
            if ($customSchedule) {
            Log::info("Custom schedule found for station $stationId", [
                'slots' => $customSchedule->available_slots
                ]);
            Log::info('Schedule Data:', $customSchedule->toArray());
            } else {
                Log::warning("No custom schedule found for $date. Using defaults.");
            }
            
            // 2 returing default hours if no shedule Hours 
        
            $allSlots = $customSchedule 
                ? $customSchedule->available_slots 
                : ['09:00', '10:00', '11:00', '12:00', '13:00', '14:00'];
            Log::info('allSlots:', $allSlots);
            // 3 appointments exist?
            $bookedTimes = Appointment::where('station_id', $stationId)
                ->where('appointment_date', $date)
                ->pluck('appointment_time')
                ->toArray();
            Log::info('bookedTimes:', $bookedTimes);
            //  return json
            return response()->json([
                'all_slots' => $allSlots,
                'booked_slots' => $bookedTimes
            ]);
        }

    private function sendSms($phone, $date, $time)
    {
        // 1. Το κλειδί που μόλις πήρες
        $apiKey = 'o93aee50b792818'; 

        // 2. Καθαρισμός τηλεφώνου
        $phone = preg_replace('/[^0-9]/', '', $phone);
        if (strlen($phone) == 10) {
            $phone = '30' . $phone;
        }

        // 3. Καθαρισμός ώρας (από 10:00:00 σε 10:00)
        $formattedTime = date('H:i', strtotime($time));
        // Μετατροπή ημερομηνίας σε πιο φιλική μορφή (π.χ. 18/02)
        $formattedDate = date('d/m', strtotime($date));

        // 4. Το μήνυμα (Greeklish για σιγουριά και οικονομία χαρακτήρων)
        $message = "EKO DRAMI (Odos Volou): To rantevou gia plysimo egkri8ike gia $formattedDate stis $formattedTime.";

        try {
            $response = Http::get("https://easysms.gr/api/sms/send", [
                'key'    => $apiKey,
                'to'     => $phone,
                'text'   => $message,
                'from'   => 'EKO ΛΑΡΙΣΑ | ΑΦΟΙ ΔΡΑΜΗ ', // Δοκίμασε "EKO" ή το κινητό σου αν δεν έχεις εγκεκριμένο όνομα
                'type'   => 'json'
            ]);

            Log::info("EasySMS Response: " . $response->body());

            // Αν το status είναι error και το error είναι 40 (Invalid Sender), ξαναπροσπαθεί με το κινητό σου
            $result = $response->json();
            if (isset($result['status']) && $result['status'] == 'error' && $result['error'] == '40') {
                Log::warning("Sender ID rejected. Retrying with phone number as sender.");
                Http::get("https://easysms.gr/api/sms/send", [
                    'key'  => $apiKey,
                    'to'   => $phone,
                    'text' => $message,
                    'from' => '306948720413', // Βάζουμε το κινητό σου ως αποστολέα για να περάσει σίγουρα
                    'type' => 'json'
                ]);
            }

        } catch (\Exception $e) {
            Log::error("EasySMS Exception: " . $e->getMessage());
        }
    }
}


