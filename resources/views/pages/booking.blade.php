@extends('layouts.app')

@section('content')
    <section class="min-h-screen bg-slate-50 py-12">
        <div class="container mx-auto max-w-lg px-4">
            <div class="rounded-[2.5rem] bg-white p-8 shadow-xl ring-1 ring-slate-200">
                <h2 class="mb-2 text-3xl font-black text-slate-900">Κράτηση Πλυντηρίου</h2>
                <p class="mb-8 text-slate-500">Γρήγορη κράτηση χωρίς εγγραφή.</p>

                @if (session('success'))
                    <div
                        class="mb-6 rounded-4xl border-2 border-emerald-200 bg-emerald-50 p-6 text-center text-emerald-800"
                    >
                        <h3 class="mb-1 text-xl font-black">{{ session('success') }}</h3>

                        {{-- ΕΔΩ ΕΜΦΑΝΙΖΕΤΑΙ ΤΟ PIN --}}
                        @if (session('pin'))
                            <p class="mt-4 mb-3 text-sm font-medium text-slate-600">Κωδικός Κράτησης (PIN):</p>
                            <div
                                class="inline-block rounded-2xl border-2 border-dashed border-emerald-300 bg-white px-8 py-3 text-3xl font-black tracking-[0.2em] text-emerald-600 shadow-sm"
                            >
                                {{ session('pin') }}
                            </div>
                            <p class="mt-4 text-[11px] font-bold tracking-wider uppercase opacity-60">
                                Παρακαλούμε αποθηκεύστε τον κωδικό σας
                            </p>
                        @endif
                    </div>
                @endif

                <form action="{{ route('booking.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label class="mb-2 block text-sm font-bold text-slate-700">Επιλέξτε Πρατήριο</label>
                        <select
                            name="station_id"
                            id="station_select"
                            required
                            class="w-full rounded-xl border-2 border-slate-100 bg-slate-50 px-4 py-3 transition-all outline-none focus:border-red-500 focus:ring-0"
                        >
                            <option value="">Παρακαλώ επιλέξτε...</option>
                            @foreach ($stations as $station)
                                <option value="{{ $station->id }}">
                                    {{ $station->name }} ({{ $station->address }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-1 gap-5">
                        <input
                            type="text"
                            name="customer_name"
                            oninput="this.value = this.value.toUpperCase()"
                            placeholder="Όνοματεπώνυμο"
                            required
                            class="w-full rounded-xl border-slate-200 bg-slate-50 p-4"
                        />

                        <input
                            type="tel"
                            name="customer_phone"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            maxlength="10"
                            pattern="[0-9]{10}"
                            inputmode="numeric"
                            placeholder="Τηλέφωνο (π.χ. 69...)"
                            required
                            class="w-full rounded-xl border-slate-200 bg-slate-50 p-4"
                        />

                        <input
                            type="text"
                            name="license_plate"
                            autocapitalize="characters"
                            oninput="this.value = this.value.replace(/\s/g, '')"
                            placeholder="Πινακίδα Οχήματος"
                            required
                            class="w-full rounded-xl border-slate-200 bg-slate-50 p-4 uppercase"
                        />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <input
                            type="date"
                            name="appointment_date"
                            id="date_input"
                            required
                            class="w-full rounded-xl border-slate-200 bg-slate-50 p-4 text-sm"
                        />

                        <select
                            name="appointment_time"
                            id="time_select"
                            required
                            class="w-full rounded-xl border-slate-200 bg-slate-50 p-4 text-sm"
                        >
                            <option value="09:00">09:00</option>
                            <option value="10:00">10:00</option>
                            <option value="11:00">11:00</option>
                            <option value="12:00">12:00</option>
                        </select>
                    </div>

                    <button
                        type="submit"
                        class="w-full transform rounded-2xl bg-[#e21838] py-5 font-black text-white shadow-lg shadow-red-500/30 transition-all hover:-translate-y-1 hover:bg-[#c4142f]"
                    >
                        ΕΠΙΒΕΒΑΙΩΣΗ ΚΡΑΤΗΣΗΣ
                    </button>
                </form>
            </div>
        </div>
    </section>

    <script>
        const dateInput = document.getElementById('date_input')
        const timeSelect = document.getElementById('time_select')
        const stationSelect = document.getElementById('station_select')

        // 1. Κλείδωμα παρελθοντικών ημερομηνιών στο ημερολόγιο
        const now = new Date()
        const todayStr = now.toISOString().split('T')[0]
        dateInput.setAttribute('min', todayStr)
        if (!dateInput.value) dateInput.value = todayStr

        function fetchBookedTimes() {
            const selectedDate = dateInput.value
            const stationId = stationSelect.value

            if (!selectedDate) return

            // Επαναφορά όλων των επιλογών
            Array.from(timeSelect.options).forEach(option => {
                option.disabled = false
                option.text = option.value
                option.style.color = 'black'
            })

            // Λήψη τρέχουσας ώρας (π.χ. "20:11")
            const currentTime = new Date()
            const currentHoursMinutes =
                currentTime.getHours().toString().padStart(2, '0') +
                ':' +
                currentTime.getMinutes().toString().padStart(2, '0')

            fetch(`/check-availability?appointment_date=${selectedDate}&station_id=${stationId}`)
                .then(response => response.json())
                .then(bookedTimes => {
                    Array.from(timeSelect.options).forEach(option => {
                        const optionValue = option.value // π.χ. "09:00"

                        // ΕΛΕΓΧΟΣ 1: Είναι η ημερομηνία ΣΗΜΕΡΑ και η ώρα έχει περάσει;
                        if (selectedDate === todayStr && optionValue <= currentHoursMinutes) {
                            option.disabled = true
                            option.text = optionValue + ' - [ΠΑΡΗΛΘΕ]'
                            option.style.color = '#94a3b8' // Γκρι χρώμα
                        }
                        // ΕΛΕΓΧΟΣ 2: Είναι η ώρα κρατημένη από άλλον;
                        else if (bookedTimes.some(time => time.startsWith(optionValue))) {
                            option.disabled = true
                            option.text = optionValue + ' - [ΚΡΑΤΗΜΕΝΟ]'
                            option.style.color = '#ef4444' // Κόκκινο χρώμα
                        }
                    })
                })
                .catch(error => console.error('Error:', error))
        }

        // Τρέξε το αμέσως
        fetchBookedTimes()

        dateInput.addEventListener('change', fetchBookedTimes)
        stationSelect.addEventListener('change', fetchBookedTimes)
    </script>
@endsection
