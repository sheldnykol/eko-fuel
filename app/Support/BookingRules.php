<?php

namespace App\Support;

use App\Models\Appointment;
use App\Models\Schedule;
use Carbon\Carbon;

class BookingRules
{
    public const BOOKING_WINDOW_DAYS = 14;

    public const STATUS_CANCELLED = 3;

    public const DEFAULT_SLOTS = ['09:00', '10:00', '11:00', '12:00', '13:00', '14:00'];

    public const ADMIN_TIMES = [
        '08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30',
        '13:00', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30',
        '18:00', '18:30', '19:00', '19:30', '20:00',
    ];

    public const VEHICLE_TYPES = ['ΙΧ', 'ΤΖΙΠ', 'ΒΑΝ', 'ΜΟΤΟ'];

    public const VEHICLE_LABELS = [
        'ΙΧ' => 'Επιβατικό (ΙΧ)',
        'ΤΖΙΠ' => 'SUV / 4x4 (Τζιπ)',
        'ΒΑΝ' => 'Επαγγελματικό (Βαν)',
        'ΜΟΤΟ' => 'Μοτοσυκλέτα',
    ];

    public const WASH_LABELS = [
        'ΜΕΣΑ-ΕΞΩ' => 'Μέσα - Έξω',
        'ΕΞΩ' => 'Μόνο έξω',
        'ΜΕΣΑ' => 'Μόνο μέσα',
        'ΒΙΟΛΟΓΙΚΟΣ' => 'Βιολογικός καθαρισμός',
    ];

    public const PRICES = [
        'ΙΧ' => ['ΜΕΣΑ-ΕΞΩ' => 15, 'ΕΞΩ' => 7, 'ΜΕΣΑ' => 10, 'ΒΙΟΛΟΓΙΚΟΣ' => 70],
        'ΤΖΙΠ' => ['ΜΕΣΑ-ΕΞΩ' => 17, 'ΕΞΩ' => 9, 'ΜΕΣΑ' => 7, 'ΒΙΟΛΟΓΙΚΟΣ' => 70],
        'ΒΑΝ' => ['ΜΕΣΑ-ΕΞΩ' => 20, 'ΕΞΩ' => 10, 'ΜΕΣΑ' => 10, 'ΒΙΟΛΟΓΙΚΟΣ' => 70],
        'ΜΟΤΟ' => ['ΕΞΩ' => 6],
    ];

    public const WASH_DAYS = [
        'ΒΙΟΛΟΓΙΚΟΣ' => [2, 3, 4],
    ];

    public const FAST_TRACK = 'Fast Track (+2€)';

    public const EXTRAS = [
        'Ξεθάμπωμα Φαναριών' => ['free' => false, 'days' => [1, 2, 3, 4]],
        'Έλεγχος Ελαστικών' => ['free' => true, 'days' => null],
        'Αλλαγή Λαδιών' => ['free' => false, 'days' => null],
        'Έλεγχος Λαδιών' => ['free' => true, 'days' => null],
        'Απολύμανση Καμπίνας' => ['free' => false, 'days' => null],
        'Έλεγχος Ψυγείου' => ['free' => true, 'days' => null],
        'Αλλαγή Υαλοκαθαριστήρων' => ['free' => false, 'days' => null],
        'Προσθήκη Αντιψυκτικού' => ['free' => false, 'days' => null],
    ];

    public const DAY_NAMES = ['Κυριακή', 'Δευτέρα', 'Τρίτη', 'Τετάρτη', 'Πέμπτη', 'Παρασκευή', 'Σάββατο'];

    public const DAY_SHORT = ['Κυρ', 'Δευ', 'Τρί', 'Τετ', 'Πέμ', 'Παρ', 'Σάβ'];

    public static function lastBookableDate(): Carbon
    {
        return Carbon::today()->addDays(self::BOOKING_WINDOW_DAYS - 1);
    }

    public static function bookableDays(): array
    {
        return collect(range(0, self::BOOKING_WINDOW_DAYS - 1))
            ->map(fn (int $offset) => Carbon::today()->addDays($offset))
            ->all();
    }

    public static function minPrice(string $wash): ?int
    {
        $prices = array_filter(array_map(fn (array $byWash) => $byWash[$wash] ?? null, self::PRICES));

        return $prices ? min($prices) : null;
    }

    public static function slotsFor(int|string $stationId, string $date): array
    {
        $schedule = Schedule::where('station_id', $stationId)->whereDate('date', $date)->first();

        $slots = $schedule ? $schedule->available_slots : self::DEFAULT_SLOTS;
        sort($slots);

        return array_values($slots);
    }

    public static function bookedTimes(int|string $stationId, string $date): array
    {
        return Appointment::where('station_id', $stationId)
            ->whereDate('appointment_date', $date)
            ->where('status', '!=', self::STATUS_CANCELLED)
            ->pluck('appointment_time')
            ->map(fn ($time) => substr($time, 0, 5))
            ->unique()
            ->values()
            ->all();
    }

    public static function allowedOnDay(?array $days, Carbon $date): bool
    {
        return $days === null || in_array($date->dayOfWeek, $days, true);
    }

    public static function daysLabel(array $days): string
    {
        return self::DAY_NAMES[min($days)] . ' - ' . self::DAY_NAMES[max($days)];
    }

    public static function daysShortLabel(array $days): string
    {
        return self::DAY_SHORT[min($days)] . '-' . self::DAY_SHORT[max($days)];
    }
}
