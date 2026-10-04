@php
    use App\Support\BookingRules;
    use Carbon\Carbon;

    $station = config('stations.' . $appointment->station_id);
    $extras = trim((string) $appointment->extras);
@endphp
<ul style="list-style: none; padding: 0; margin: 0 0 20px; line-height: 1.8; color: #334155; font-size: 15px">
    <li>
        <strong>Ημερομηνία:</strong>
        {{ ucfirst(Carbon::parse($appointment->appointment_date)->locale('el')->translatedFormat('l d/m/Y')) }}
    </li>
    <li><strong>Ώρα:</strong> {{ substr($appointment->appointment_time, 0, 5) }}</li>
    @if ($station)
        <li><strong>Πρατήριο:</strong> {{ $station['title'] }}, {{ $station['street'] }}, {{ $station['city'] }}</li>
    @endif
    <li><strong>Πακέτο:</strong> {{ BookingRules::WASH_LABELS[$appointment->wash_type] ?? $appointment->wash_type }}</li>
    @if ($extras !== '' && $extras !== 'Χωρίς Extras')
        <li><strong>Επιπλέον:</strong> {{ $extras }}</li>
    @endif
    <li><strong>Όχημα:</strong> {{ $appointment->license_plate }} ({{ $appointment->vehicle_type ?? 'ΙΧ' }})</li>
</ul>
