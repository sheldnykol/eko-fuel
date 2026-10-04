<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class CancellationController extends Controller
{
    public const DEADLINE_HOURS = 12;

    public function index(Request $request)
    {
        $appointments = null;

        if ($request->hasAny(['customer_phone', 'license_plate'])) {
            $validated = $request->validate([
                'customer_phone' => ['required', 'regex:/^69\d{8}$/'],
                'license_plate' => 'required|string|max:20',
            ], [
                'customer_phone.required' => 'Συμπληρώστε το κινητό της κράτησης.',
                'customer_phone.regex' => 'Το κινητό πρέπει να ξεκινάει από 69 και να έχει 10 ψηφία.',
                'license_plate.required' => 'Συμπληρώστε την πινακίδα της κράτησης.',
            ]);

            $plate = Appointment::normalizePlate($validated['license_plate']);

            $appointments = Appointment::where('customer_phone', $validated['customer_phone'])
                ->where('status', 1)
                ->whereDate('appointment_date', '>=', Carbon::today())
                ->orderBy('appointment_date')
                ->orderBy('appointment_time')
                ->get()
                ->filter(fn (Appointment $appointment) => Appointment::normalizePlate($appointment->license_plate) === $plate)
                ->values();

            if ($appointments->isEmpty()) {
                return redirect()->route('cancellation.page')
                    ->withErrors(['customer_phone' => 'Δεν βρέθηκε ενεργό ραντεβού με αυτό το κινητό και αυτή την πινακίδα.'])
                    ->withInput();
            }
        }

        return view('pages.cancellation', [
            'appointments' => $appointments,
            'single' => null,
        ]);
    }

    public function confirm(Appointment $appointment)
    {
        return view('pages.cancellation', [
            'appointments' => null,
            'single' => $appointment,
        ]);
    }

    public function cancel(Appointment $appointment)
    {
        if ((int) $appointment->status !== 1) {
            return redirect()->route('cancellation.page')
                ->withErrors(['cancellation' => 'Το ραντεβού έχει ήδη ακυρωθεί ή ολοκληρωθεί.']);
        }

        if (! self::isCancellable($appointment)) {
            return redirect()->route('cancellation.page')
                ->withErrors(['cancellation' => 'Το ραντεβού δεν μπορεί να ακυρωθεί online, γιατί υπολείπονται λιγότερες από ' . self::DEADLINE_HOURS . ' ώρες. Καλέστε μας στο 2410 283954.']);
        }

        $appointment->status = 3;
        $appointment->save();

        return redirect()->route('cancellation.page')
            ->with('success', 'Το ραντεβού της ' . Carbon::parse($appointment->appointment_date)->format('d/m/Y') . ' στις ' . substr($appointment->appointment_time, 0, 5) . ' ακυρώθηκε.');
    }

    public static function isCancellable(Appointment $appointment): bool
    {
        return now()->lessThan($appointment->startsAt()->subHours(self::DEADLINE_HOURS));
    }

    public static function performUrl(Appointment $appointment): string
    {
        return URL::temporarySignedRoute('cancellation.perform', now()->addMinutes(30), ['appointment' => $appointment->id]);
    }
}
