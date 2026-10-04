@extends('layouts.app')

@section('title', 'Ραντεβού για Πλυντήριο Αυτοκινήτου στη Λάρισα')
@section('meta_description', 'Κλείστε online ραντεβού για πλύσιμο αυτοκινήτου στο πλυντήριο EKO Βόλου 12 στη Λάρισα. Μέσα-έξω από 15€, βιολογικός καθαρισμός, Fast Track χωρίς αναμονή. Χωρίς εγγραφή.')

@php
    use App\Support\BookingRules;
    use App\Support\Seo;

    $station = $stations->first();
    $stationInfo = Seo::station(1);
    $oldExtras = old('extras', []);
    $field = 'h-10 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 focus:border-[#e21838] focus:ring-1 focus:ring-[#e21838] focus:outline-none disabled:bg-slate-50 disabled:text-slate-400';
    $label = 'mb-1 block text-[13px] font-medium text-slate-700';
@endphp

@push('schema')
    <script type="application/ld+json">{!! Seo::graph(Seo::stationSchema(1), Seo::breadcrumbs([['Αρχική', url('/')], ['Ραντεβού πλυντηρίου', route('pages.booking')]])) !!}</script>
@endpush

@section('content')
    <section class="bg-slate-50 py-8 sm:py-12">
        <div class="mx-auto grid max-w-5xl grid-cols-1 gap-6 px-4 lg:grid-cols-[minmax(0,1fr)_320px]">
            <div class="rounded-xl border border-slate-200 bg-white p-5 sm:p-6">
                @if (session('success'))
                    <div class="py-4 text-center">
                        <span class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                        </span>
                        <h1 class="text-lg font-bold text-slate-900">{{ session('success') }}</h1>
                        @if (session('appointment_date'))
                            <p class="mt-1 text-sm text-slate-600">
                                {{ ucfirst(\Carbon\Carbon::parse(session('appointment_date'))->locale('el')->translatedFormat('l d/m/Y')) }}
                                στις {{ substr(session('appointment_time'), 0, 5) }} · {{ $stationInfo['title'] }}
                            </p>
                        @endif
                        <p class="mt-1 text-[13px] text-slate-500">Θα λάβετε επιβεβαίωση με SMS και email.</p>

                        <div class="mt-5 flex flex-col justify-center gap-2 sm:flex-row">
                            <a href="{{ route('pages.booking') }}" class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">Νέα κράτηση</a>
                            @if (session('cancel_url'))
                                <a href="{{ session('cancel_url') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">Ακύρωση ραντεβού</a>
                            @endif
                        </div>
                    </div>
                @else
                    <h1 class="text-xl font-bold text-slate-900">Ραντεβού πλυντηρίου</h1>
                    <p class="mt-0.5 mb-5 text-sm text-slate-500">
                        {{ $stationInfo['title'] }}, {{ $stationInfo['street'] }}, {{ $stationInfo['city'] }} · χωρίς εγγραφή
                    </p>

                    @if ($errors->any())
                        <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-[13px] text-red-700" role="alert">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('booking.store') }}" method="POST" id="bookingForm" class="space-y-4">
                        @csrf

                        @if ($stations->count() === 1)
                            <input type="hidden" name="station_id" id="station_id" value="{{ $station->id }}" />
                        @else
                            <div>
                                <label for="station_id" class="{{ $label }}">Πρατήριο</label>
                                <select name="station_id" id="station_id" required class="{{ $field }}">
                                    @foreach ($stations as $item)
                                        <option value="{{ $item->id }}" @selected(old('station_id') == $item->id)>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label for="appointment_date" class="{{ $label }}">Ημερομηνία</label>
                                <select name="appointment_date" id="appointment_date" required class="{{ $field }}">
                                    @foreach ($days as $day)
                                        <option
                                            value="{{ $day['date'] }}"
                                            data-dow="{{ $day['dow'] }}"
                                            @disabled($day['free'] === 0)
                                            @selected(old('appointment_date') === $day['date'])
                                        >
                                            {{ $day['label'] }}{{ $day['free'] === 0 ? ' (πλήρες)' : '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="appointment_time" class="{{ $label }}">Ώρα</label>
                                <select name="appointment_time" id="appointment_time" required class="{{ $field }}">
                                    <option value="">Επιλέξτε</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label for="vehicle_type" class="{{ $label }}">Όχημα</label>
                                <select name="vehicle_type" id="vehicle_type" required class="{{ $field }}">
                                    @foreach (BookingRules::VEHICLE_LABELS as $value => $text)
                                        <option value="{{ $value }}" @selected(old('vehicle_type', 'ΙΧ') === $value)>{{ $text }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="license_plate" class="{{ $label }}">Πινακίδα</label>
                                <input
                                    type="text"
                                    name="license_plate"
                                    id="license_plate"
                                    value="{{ old('license_plate') }}"
                                    maxlength="20"
                                    autocomplete="off"
                                    autocapitalize="characters"
                                    placeholder="ΡΙΑ1234"
                                    required
                                    class="{{ $field }} uppercase"
                                />
                            </div>
                        </div>

                        <div>
                            <label for="wash_type" class="{{ $label }}">Πακέτο</label>
                            <select name="wash_type" id="wash_type" required class="{{ $field }}">
                                <option value="">Επιλέξτε πακέτο</option>
                                @foreach (BookingRules::WASH_LABELS as $value => $text)
                                    <option value="{{ $value }}" data-label="{{ $text }}" @selected(old('wash_type') === $value)>{{ $text }}</option>
                                @endforeach
                            </select>
                        </div>

                        <fieldset class="rounded-lg border border-slate-200">
                            <legend class="sr-only">Επιπλέον υπηρεσίες</legend>
                            <label class="flex cursor-pointer items-start gap-3 px-3 py-2.5">
                                <input
                                    type="checkbox"
                                    name="extras[]"
                                    value="{{ BookingRules::FAST_TRACK }}"
                                    class="mt-0.5 h-4 w-4 accent-[#e21838]"
                                    @checked(in_array(BookingRules::FAST_TRACK, $oldExtras, true))
                                />
                                <span class="text-sm">
                                    <span class="font-semibold text-slate-900">Fast Track +2€</span>
                                    <span class="block text-[13px] text-slate-500">Εξυπηρέτηση χωρίς αναμονή.</span>
                                </span>
                            </label>
                            <details class="group border-t border-slate-200" @if (count(array_diff($oldExtras, [BookingRules::FAST_TRACK]))) open @endif>
                                <summary class="flex cursor-pointer list-none items-center gap-1 px-3 py-2.5 text-sm font-medium text-slate-700">
                                    Επιπλέον υπηρεσίες <span class="font-normal text-slate-400">(προαιρετικά)</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-auto h-4 w-4 text-slate-400 transition-transform group-open:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" /></svg>
                                </summary>
                                <div class="grid grid-cols-1 gap-x-4 gap-y-2 px-3 pb-3 sm:grid-cols-2">
                                    @foreach (BookingRules::EXTRAS as $name => $extra)
                                        <label class="extra-option flex cursor-pointer items-center gap-2 text-[13px] text-slate-700" data-days="{{ json_encode($extra['days']) }}">
                                            <input
                                                type="checkbox"
                                                name="extras[]"
                                                value="{{ $name }}"
                                                class="h-4 w-4 accent-[#e21838] disabled:opacity-40"
                                                @checked(in_array($name, $oldExtras, true))
                                            />
                                            <span class="extra-text">{{ $name }}</span>
                                            @if ($extra['free'])
                                                <span class="text-[11px] font-medium text-emerald-600">δωρεάν</span>
                                            @endif
                                            @if ($extra['days'])
                                                <span class="text-[11px] text-slate-400">({{ BookingRules::daysShortLabel($extra['days']) }})</span>
                                            @endif
                                        </label>
                                    @endforeach
                                </div>
                            </details>
                        </fieldset>

                        <div>
                            <label for="customer_name" class="{{ $label }}">Ονοματεπώνυμο</label>
                            <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name') }}" autocomplete="name" required class="{{ $field }}" />
                        </div>

                        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                            <div>
                                <label for="customer_phone" class="{{ $label }}">Κινητό</label>
                                <input
                                    type="tel"
                                    name="customer_phone"
                                    id="customer_phone"
                                    value="{{ old('customer_phone') }}"
                                    inputmode="numeric"
                                    autocomplete="tel"
                                    maxlength="10"
                                    pattern="69[0-9]{8}"
                                    title="10 ψηφία, ξεκινάει από 69"
                                    placeholder="69XXXXXXXX"
                                    required
                                    class="{{ $field }}"
                                />
                            </div>
                            <div>
                                <label for="customer_email" class="{{ $label }}">Email</label>
                                <input type="email" name="customer_email" id="customer_email" value="{{ old('customer_email') }}" autocomplete="email" required class="{{ $field }}" />
                            </div>
                        </div>

                        <div>
                            <label for="comments" class="{{ $label }}">Σχόλια <span class="font-normal text-slate-400">(προαιρετικά)</span></label>
                            <textarea
                                name="comments"
                                id="comments"
                                rows="2"
                                maxlength="250"
                                class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 focus:border-[#e21838] focus:ring-1 focus:ring-[#e21838] focus:outline-none"
                            >{{ old('comments') }}</textarea>
                        </div>

                        <button type="submit" id="submitBtn" class="h-11 w-full rounded-lg bg-[#e21838] text-sm font-bold text-white hover:bg-[#c4142f] disabled:cursor-wait disabled:opacity-70">
                            Κλείσιμο ραντεβού
                        </button>
                        <p class="text-center text-xs text-slate-400">
                            Οι τιμές είναι ενδεικτικές και μπορεί να διαφέρουν ανάλογα με την κατάσταση του οχήματος.
                        </p>
                    </form>
                @endif
            </div>

            <aside class="space-y-4 text-sm">
                <div class="rounded-xl border border-slate-200 bg-white p-5">
                    <h2 class="mb-3 text-sm font-bold text-slate-900">Τιμές πλυσίματος (ΙΧ)</h2>
                    <dl class="divide-y divide-slate-100">
                        @foreach (BookingRules::PRICES['ΙΧ'] as $wash => $price)
                            <div class="flex justify-between py-1.5">
                                <dt class="text-slate-600">{{ BookingRules::WASH_LABELS[$wash] }}</dt>
                                <dd class="font-semibold text-slate-900">~{{ $price }}€</dd>
                            </div>
                        @endforeach
                    </dl>
                    <p class="mt-2 text-xs text-slate-500">Βιολογικός καθαρισμός: Τρίτη έως Πέμπτη. Ξεθάμπωμα φαναριών: Δευτέρα έως Πέμπτη.</p>
                    <a href="{{ url('/services') }}" class="mt-3 inline-block text-[13px] font-semibold text-[#e21838] hover:underline">Όλες οι τιμές</a>
                </div>

                <div class="rounded-xl border border-slate-200 bg-white p-5">
                    <h2 class="mb-2 text-sm font-bold text-slate-900">Πού θα μας βρείτε</h2>
                    <p class="text-slate-600">{{ $stationInfo['title'] }}<br />{{ $stationInfo['street'] }}, {{ $stationInfo['city'] }}</p>
                    <p class="mt-2 text-slate-600">Καθημερινά {{ $stationInfo['opens'] }} - {{ $stationInfo['closes'] }}</p>
                    <div class="mt-3 flex gap-3 text-[13px] font-semibold">
                        <a href="tel:{{ $stationInfo['phone'] }}" class="text-[#e21838] hover:underline">Κλήση</a>
                        <a href="{{ Seo::mapsUrl($stationInfo) }}" target="_blank" rel="noopener" class="text-[#e21838] hover:underline">Οδηγίες χάρτη</a>
                    </div>
                </div>

                <a href="{{ route('cancellation.page') }}" class="block rounded-xl border border-slate-200 bg-white p-4 text-[13px] text-slate-600 hover:border-slate-300">
                    Έχετε ήδη ραντεβού; <span class="font-semibold text-slate-900">Ακύρωση ραντεβού</span>
                </a>
            </aside>
        </div>
    </section>

    @unless (session('success'))
        <script>
            ;(function () {
                const PRICES = @json(BookingRules::PRICES);
                const WASH_DAYS = @json(BookingRules::WASH_DAYS);
                const DAY_SHORT = @json(BookingRules::DAY_SHORT);
                const SLOTS_URL = @json(url('/get-available-slots'));
                const OLD_TIME = @json(old('appointment_time'));

                const form = document.getElementById('bookingForm')
                const station = document.getElementById('station_id')
                const dateSelect = document.getElementById('appointment_date')
                const timeSelect = document.getElementById('appointment_time')
                const vehicleSelect = document.getElementById('vehicle_type')
                const washSelect = document.getElementById('wash_type')
                const phone = document.getElementById('customer_phone')
                const plate = document.getElementById('license_plate')
                let requestId = 0
                let preferredTime = OLD_TIME

                const dow = () => Number(dateSelect.selectedOptions[0]?.dataset.dow ?? -1)
                const allowedOn = days => !days || days.includes(dow())
                const range = days => `${DAY_SHORT[Math.min(...days)]}-${DAY_SHORT[Math.max(...days)]}`
                const athensNow = () =>
                    new Intl.DateTimeFormat('en-GB', { timeZone: 'Europe/Athens', hour: '2-digit', minute: '2-digit', hourCycle: 'h23' }).format(new Date())

                function setTimeOptions(options, placeholder) {
                    timeSelect.innerHTML = ''
                    const first = new Option(placeholder, '')
                    timeSelect.add(first)
                    options.forEach(o => {
                        const option = new Option(o.label, o.value)
                        option.disabled = o.disabled
                        timeSelect.add(option)
                    })
                }

                function loadSlots() {
                    const date = dateSelect.value
                    if (!date) return setTimeOptions([], 'Επιλέξτε ημερομηνία')
                    const current = ++requestId
                    timeSelect.disabled = true
                    setTimeOptions([], 'Φόρτωση...')

                    fetch(`${SLOTS_URL}?${new URLSearchParams({ date, station_id: station.value })}`, { headers: { Accept: 'application/json' } })
                        .then(r => (r.ok ? r.json() : Promise.reject(r.status)))
                        .then(data => {
                            if (current !== requestId) return
                            const isToday = date === dateSelect.options[0].value
                            const now = athensNow()
                            const options = data.all_slots
                                .filter(slot => !(isToday && slot <= now))
                                .map(slot => {
                                    const booked = data.booked_slots.includes(slot)
                                    return { value: slot, label: booked ? `${slot} (κλεισμένη)` : slot, disabled: booked }
                                })
                            const free = options.filter(o => !o.disabled)
                            setTimeOptions(options, free.length ? 'Επιλέξτε ώρα' : 'Καμία ελεύθερη ώρα')
                            timeSelect.disabled = false
                            if (preferredTime && free.some(o => o.value === preferredTime)) timeSelect.value = preferredTime
                            preferredTime = null
                        })
                        .catch(() => {
                            if (current !== requestId) return
                            setTimeOptions([], 'Σφάλμα φόρτωσης, δοκιμάστε ξανά')
                            timeSelect.disabled = false
                        })
                }

                function updateWash() {
                    const vehicle = vehicleSelect.value
                    ;[...washSelect.options].forEach(option => {
                        if (!option.value) return
                        const price = PRICES[vehicle]?.[option.value]
                        const days = WASH_DAYS[option.value]
                        const available = price !== undefined && allowedOn(days)
                        let text = option.dataset.label
                        if (price !== undefined) text += ` · ~${price}€`
                        if (price === undefined) text += ' (μη διαθέσιμο)'
                        else if (!allowedOn(days)) text += ` (μόνο ${range(days)})`
                        option.textContent = text
                        option.disabled = !available
                        if (!available && option.selected) washSelect.value = ''
                    })
                    if (vehicle === 'ΜΟΤΟ' && !washSelect.value) washSelect.value = 'ΕΞΩ'
                }

                function updateExtras() {
                    document.querySelectorAll('.extra-option').forEach(label => {
                        const input = label.querySelector('input')
                        const available = allowedOn(JSON.parse(label.dataset.days))
                        input.disabled = !available
                        if (!available) input.checked = false
                        label.classList.toggle('text-slate-400', !available)
                        label.classList.toggle('cursor-not-allowed', !available)
                    })
                }

                dateSelect.addEventListener('change', () => {
                    loadSlots()
                    updateWash()
                    updateExtras()
                })
                vehicleSelect.addEventListener('change', updateWash)
                station.addEventListener?.('change', loadSlots)
                phone.addEventListener('input', () => (phone.value = phone.value.replace(/\D/g, '').slice(0, 10)))
                plate.addEventListener('input', () => (plate.value = plate.value.replace(/\s/g, '').toUpperCase()))
                form.addEventListener('submit', () => {
                    const button = document.getElementById('submitBtn')
                    setTimeout(() => {
                        button.disabled = true
                        button.textContent = 'Αποστολή...'
                    }, 0)
                })

                if (dateSelect.selectedOptions[0]?.disabled) {
                    const firstFree = [...dateSelect.options].find(o => !o.disabled)
                    if (firstFree) dateSelect.value = firstFree.value
                }
                updateWash()
                updateExtras()
                loadSlots()
            })()
        </script>
    @endunless
@endsection
