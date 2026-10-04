<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Appointment extends Model
{
    protected $fillable = [
        'station_id',
        'customer_name',
        'customer_phone',
        'customer_email',
        'license_plate',
        'vehicle_type',
        'appointment_date',
        'appointment_time',
        'status',
        'booking_pin',
        'extras',
        'wash_type',
        'comments',
        'reminder_sent_at',
    ];

    protected $casts = [
        'reminder_sent_at' => 'datetime',
    ];

    private const GREEK_TO_LATIN = [
        'Α' => 'A', 'Β' => 'B', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Ι' => 'I', 'Κ' => 'K',
        'Μ' => 'M', 'Ν' => 'N', 'Ο' => 'O', 'Ρ' => 'P', 'Τ' => 'T', 'Υ' => 'Y', 'Χ' => 'X',
    ];

    public function comments()
    {
        return $this->hasMany(AppointmentComment::class)->latest();
    }

    public function startsAt(): Carbon
    {
        return Carbon::parse(Carbon::parse($this->appointment_date)->toDateString() . ' ' . $this->appointment_time);
    }

    public function cancelUrl(): string
    {
        return URL::temporarySignedRoute('cancellation.confirm', $this->startsAt(), ['appointment' => $this->id]);
    }

    public static function normalizePlate(?string $plate): string
    {
        $plate = mb_strtoupper(preg_replace('/[\s-]+/u', '', (string) $plate), 'UTF-8');

        return strtr($plate, self::GREEK_TO_LATIN);
    }
}
