<?php

namespace App\Http\Controllers;

use App\Mail\AppointmentConfirmation;
use App\Mail\BookingSubmittedMail;
use App\Models\Appointment;
use App\Models\Station;
use App\Support\BookingRules;
use Carbon\Carbon;
use Illuminate\Contracts\Cache\LockTimeoutException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $lastDate = BookingRules::lastBookableDate()->toDateString();

        $validated = $request->validate([
            'station_id' => 'required|exists:stations,id',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => ['required', 'regex:/^69[0-9]{8}$/'],
            'customer_email' => 'required|email|max:255',
            'license_plate' => 'required|string|max:20',
            'vehicle_type' => ['required', Rule::in(BookingRules::VEHICLE_TYPES)],
            'appointment_date' => "required|date_format:Y-m-d|after_or_equal:today|before_or_equal:$lastDate",
            'appointment_time' => 'required|date_format:H:i',
            'wash_type' => ['required', Rule::in(array_keys(BookingRules::PRICES['ΙΧ']))],
            'comments' => 'nullable|string|max:250',
            'extras' => 'nullable|array',
            'extras.*' => ['string', Rule::in([BookingRules::FAST_TRACK, ...array_keys(BookingRules::EXTRAS)])],
        ], [
            'customer_phone.regex' => 'Το κινητό πρέπει να ξεκινάει από 69 και να έχει 10 ψηφία.',
            'appointment_date.after_or_equal' => 'Η ημερομηνία δεν μπορεί να είναι στο παρελθόν.',
            'appointment_date.before_or_equal' => 'Μπορείτε να κλείσετε ραντεβού έως ' . BookingRules::BOOKING_WINDOW_DAYS . ' ημέρες μπροστά.',
            'appointment_time.required' => 'Επιλέξτε ώρα ραντεβού.',
            'wash_type.required' => 'Επιλέξτε πακέτο πλυσίματος.',
            'extras.*.in' => 'Μη έγκυρη επιπλέον υπηρεσία.',
        ]);

        $date = Carbon::parse($validated['appointment_date']);
        $time = $validated['appointment_time'];
        $vehicle = $validated['vehicle_type'];
        $wash = $validated['wash_type'];
        $extras = array_values(array_unique($validated['extras'] ?? []));

        if (! isset(BookingRules::PRICES[$vehicle][$wash])) {
            return back()->withErrors(['wash_type' => 'Το πακέτο αυτό δεν είναι διαθέσιμο για ' . $vehicle . '.'])->withInput();
        }
        $washDays = BookingRules::WASH_DAYS[$wash] ?? null;
        if (! BookingRules::allowedOnDay($washDays, $date)) {
            return back()->withErrors(['wash_type' => 'Το πακέτο αυτό γίνεται μόνο ' . BookingRules::daysLabel($washDays) . '.'])->withInput();
        }

        foreach ($extras as $extra) {
            $days = BookingRules::EXTRAS[$extra]['days'] ?? null;
            if (! BookingRules::allowedOnDay($days, $date)) {
                return back()->withErrors(['extras' => "Η υπηρεσία \"$extra\" είναι διαθέσιμη μόνο " . BookingRules::daysLabel($days) . '.'])->withInput();
            }
        }

        if (! in_array($time, BookingRules::slotsFor($validated['station_id'], $date->toDateString()), true)) {
            return back()->withErrors(['appointment_time' => 'Η ώρα αυτή δεν είναι διαθέσιμη για την ημέρα που επιλέξατε.'])->withInput();
        }
        if ($date->isToday() && $time <= now()->format('H:i')) {
            return back()->withErrors(['appointment_time' => 'Η ώρα που επιλέξατε έχει ήδη περάσει.'])->withInput();
        }

        $validated['customer_name'] = mb_strtoupper($validated['customer_name'], 'UTF-8');
        $validated['license_plate'] = mb_strtoupper(preg_replace('/\s+/', '', $validated['license_plate']), 'UTF-8');
        $validated['comments'] = filled($validated['comments'] ?? null) ? mb_strtoupper($validated['comments'], 'UTF-8') : null;
        $validated['extras'] = $extras ? implode(', ', $extras) : 'Χωρίς Extras';
        $validated['appointment_time'] = $time . ':00';

        $lock = Cache::lock("booking:{$validated['station_id']}:{$date->toDateString()}", 10);

        try {
            $lock->block(5);

            if (in_array($time, BookingRules::bookedTimes($validated['station_id'], $date->toDateString()), true)) {
                return back()->withErrors(['appointment_time' => 'Δυστυχώς η ώρα αυτή μόλις κλείστηκε από άλλον πελάτη. Επιλέξτε άλλη ώρα.'])->withInput();
            }

            $appointment = Appointment::create($validated);
        } catch (LockTimeoutException $e) {
            return back()->withErrors(['appointment_time' => 'Υπάρχει αυξημένη κίνηση. Παρακαλώ δοκιμάστε ξανά.'])->withInput();
        } finally {
            $lock->release();
        }

        Log::info('Νέο ραντεβού πλυντηρίου #' . $appointment->id);

        $this->sendSms(
            $appointment->customer_phone,
            $appointment->appointment_date,
            $appointment->appointment_time
        );

        try {
            Mail::to($appointment->customer_email)->send(new AppointmentConfirmation($appointment));
        } catch (\Exception $e) {
            Log::error('Δεν στάλθηκε το email επιβεβαίωσης στον πελάτη: ' . $e->getMessage());
        }

        try {
            Mail::to(config('mail.admin_address'))->send(
                new BookingSubmittedMail($appointment, route('admin.dashboard', ['date' => $date->toDateString()]))
            );
        } catch (\Exception $e) {
            Log::error('Δεν στάλθηκε η ειδοποίηση κράτησης στον διαχειριστή: ' . $e->getMessage());
        }

        return redirect()->route('pages.booking')
            ->with('success', 'Η κράτησή σας ολοκληρώθηκε!')
            ->with('appointment_date', $appointment->appointment_date)
            ->with('appointment_time', $appointment->appointment_time)
            ->with('customer_name', $appointment->customer_name)
            ->with('cancel_url', $appointment->cancelUrl());
    }

    public function checkAvailability(Request $request)
    {
        if (! $request->filled(['station_id', 'appointment_date'])) {
            return response()->json([]);
        }

        return response()->json(BookingRules::bookedTimes($request->station_id, $request->appointment_date));
    }

    public function index()
    {
        $stations = Station::where('name', 'LIKE', '%ΒΟΛΟΥ%')->get();
        $station = $stations->first();
        $now = now()->format('H:i');

        $days = collect(BookingRules::bookableDays())->map(function (Carbon $day) use ($station, $now) {
            $free = 0;
            if ($station) {
                $booked = BookingRules::bookedTimes($station->id, $day->toDateString());
                $free = collect(BookingRules::slotsFor($station->id, $day->toDateString()))
                    ->reject(fn ($slot) => in_array($slot, $booked, true) || ($day->isToday() && $slot <= $now))
                    ->count();
            }

            return [
                'date' => $day->toDateString(),
                'dow' => $day->dayOfWeek,
                'label' => ($day->isToday() ? 'Σήμερα, ' : ($day->isTomorrow() ? 'Αύριο, ' : ''))
                    . BookingRules::DAY_SHORT[$day->dayOfWeek] . ' ' . $day->format('d/m'),
                'free' => $free,
            ];
        });

        return view('pages.booking', compact('stations', 'days'));
    }

    public function getAvailableSlots(Request $request)
    {
        $date = $request->date;
        $stationId = $request->station_id;

        if (! $date || ! $stationId || ! preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            return response()->json(['all_slots' => [], 'booked_slots' => []]);
        }

        return response()->json([
            'all_slots' => BookingRules::slotsFor($stationId, $date),
            'booked_slots' => BookingRules::bookedTimes($stationId, $date),
        ]);
    }

    private function sendSms($phone, $date, $time)
    {
        if (! config('services.easysms.enabled')) {
            Log::info("SMS απενεργοποιημένο (EASYSMS_ENABLED=false). Δεν στάλθηκε SMS στο $phone.");
            return;
        }

        $apiKey = config('services.easysms.key');

        $phone = preg_replace('/[^0-9]/', '', $phone);
        if (strlen($phone) == 10) {
            $phone = '30' . $phone;
        }

        $formattedTime = date('H:i', strtotime($time));
        $formattedDate = date('d/m', strtotime($date));

        $message = "EΚΟ ΔΡΑΜΗ  (ΟΔΟΣ ΒΟΛΟΥ): ΤΟ ΡΑΝΤΕΒΟΥ ΕΓΚΡΙΘΗΚΕ ΓΙΑ $formattedDate ΣΤΙΣ $formattedTime.";

        try {
            $response = Http::get("https://easysms.gr/api/sms/send", [
                'key'    => $apiKey,
                'to'     => $phone,
                'text'   => $message,
                'from'   => 'EKO ΛΑΡΙΣΑ | ΑΦΟΙ ΔΡΑΜΗ ',
                'type'   => 'json'
            ]);

            Log::info("EasySMS Response: " . $response->body());

            $result = $response->json();
            if (isset($result['status']) && $result['status'] == 'error' && $result['error'] == '40') {
                Log::warning("Sender ID rejected. Retrying with phone number as sender.");
                Http::get("https://easysms.gr/api/sms/send", [
                    'key'  => $apiKey,
                    'to'   => $phone,
                    'text' => $message,
                    'from' => '306948720413',
                    'type' => 'json'
                ]);
            }

        } catch (\Exception $e) {
            Log::error("EasySMS Exception: " . $e->getMessage());
        }
    }
}