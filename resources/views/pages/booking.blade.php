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
                            {{--
                                <option value="09:00">09:00</option>
                                <option value="10:00">10:00</option>
                                <option value="11:00">11:00</option>
                                <option value="12:00">12:00</option>
                            --}}
                        </select>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-bold text-slate-700">
                            Τύπος Πλυσίματος (Βιολογικός Καθαρισμός (Τρ - Τε - Πε))
                        </label>
                        <select
                            name="wash_type"
                            required
                            disabled
                            id="wash_type_select"
                            class="w-full rounded-xl border-2 border-slate-200 bg-slate-200 p-4 transition-all duration-300"
                        >
                            <option value="">Επιλέξετε πακέτο...</option>
                            <option value="ΜΕΣΑ=ΕΞΩ">ΜΕΣΑ - ΕΞΩ</option>
                            <option value="ΕΞΩ">ΜΟΝΟ ΕΞΩ</option>
                            <option value="ΜΕΣΑ">ΜΟΝΟ ΜΕΣΑ</option>
                            <optgroup
                                label="Υπηρεσίες Βιολογικού Καθαρισμού (Τρ - Τε - Πε)"
                                id="bio_group"
                                style="display: none"
                            >
                                <option value="ΒΙΟΛΟΓΙΚΟΣ">ΒΙΟΛΟΓΙΚΟΣ ΜΟΝΟ</option>
                                <option value="ΒΙΟΛΟΓΙΚΟΣ & ΜΕΣΑ-ΕΞΩ">ΒΙΟΛΟΓΙΚΟΣ & ΜΕΣΑ-ΕΞΩ</option>
                                <option value="ΒΙΟΛΟΓΙΚΟΣ & ΕΞΩ">ΒΙΟΛΟΓΙΚΟΣ & ΕΞΩ</option>
                                <option value="ΒΙΟΛΟΓΙΚΟΣ & ΜΕΣΑ">ΒΙΟΛΟΓΙΚΟΣ & ΜΕΣΑ</option>
                            </optgroup>
                        </select>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-bold text-slate-700">
                            Σχόλια / Παρατηρήσεις (Προαιρετικά)
                        </label>
                        <textarea
                            name="comments"
                            rows="2"
                            placeholder="π.χ. Ιδιαίτερη προσοχή στις ζάντες..."
                            class="w-full rounded-xl border-slate-200 bg-slate-50 p-4 text-sm"
                        ></textarea>
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

                // 1. Κλείδωμα παρελθοντικών ημερομηνιών
                // Παίρνουμε την ημερομηνία τοπικά (Local Time) και όχι UTC
                const now = new Date()
                console.log(now)
                const offset = now.getTimezoneOffset() * 60000
                console.log(offset)
                const todayStr = new Date(now - offset).toISOString().split('T')[0]
                console.log(todayStr)

                // Υπολογισμός της 13ης ημέρας από σήμερα (το όριο του πελάτη)
                const maxDate = new Date(now)
                console.log(maxDate)
                maxDate.setDate(maxDate.getDate() + 13)
                const maxDateStr = maxDate.toISOString().split('T')[0]
                console.log(maxDate)
                console.log(maxDateStr)

                dateInput.setAttribute('min', todayStr)
                dateInput.setAttribute('max', maxDateStr)

                // Αν η επιλεγμένη ημερομηνία είναι στο παρελθόν, πήγαινέ την στο σήμερα
                if (!dateInput.value || dateInput.value < todayStr) {
                    dateInput.value = todayStr
                }

                function fetchSlots() {
                    const selectedDate = dateInput.value
                    const stationId = stationSelect.value
                    if (!selectedDate || !stationId) return

                    fetch(`/get-available-slots?date=${selectedDate}&station_id=${stationId}`)
                        .then(response => response.json())
                        .then(data => {
                            timeSelect.innerHTML = ''

                            const now = new Date()
                            // Παίρνουμε την ώρα σε μορφή HH:mm (π.χ. 09:45)
                            const currentHM =
                                now.getHours().toString().padStart(2, '0') + ':' + now.getMinutes().toString().padStart(2, '0')
                            console.log(currentHM)
                            console.log(data.all_slots)
                            data.all_slots.forEach(slot => {
                                const option = document.createElement('option')
                                option.value = slot

                                // Προσοχή: το booked_slots μπορεί να έχει "09:00:00", εμείς ελέγχουμε το "09:00"
                                const isBooked = data.booked_slots.some(booked => booked.startsWith(slot))

                                // ΕΔΩ ΕΙΝΑΙ Ο ΕΛΕΓΧΟΣ:
                                const isToday = selectedDate === todayStr
                                const isPast = isToday && slot < currentHM

                                if (isBooked) {
                                    option.disabled = true
                                    option.text = `${slot} - [ΚΡΑΤΗΜΕΝΟ]`
                                    option.style.color = 'red'
                                } else if (isPast) {
                                    option.disabled = true
                                    option.text = `${slot} - [ΠΑΡΗΛΘΕ]`
                                    option.style.color = 'gray'
                                } else {
                                    option.text = slot
                                    option.style.color = 'black'
                                }

                                timeSelect.appendChild(option)
                            })
                        })
                }

                function updateWashOptions() {
                    const selectedDateValue = dateInput.value
                    console.log(selectedDateValue)
                    const washSelect = document.getElementById('wash_type_select')
                    const bioGroup = document.getElementById('bio_group')

                    if (!selectedDateValue) {
                        washSelect.disabled = true
                        {{--
                            washSelect.style.backgroundColor = '#e2e8f0' // slate-200
                            washSelect.style.cursor = 'not-allowed'
                            washSelect.style.opacity = '0.6'
                        --}}
                        washSelect.classList.add('opacity-50', 'cursor-not-allowed')
                        return
                    }
                    //
                    washSelect.disabled = false

                    {{--
                        washSelect.style.backgroundColor = '#f8fafc'; // slate-50 (όπως τα άλλα inputs)
                        
                        washSelect.style.cursor = 'pointer';
                        washSelect.style.opacity = '1';
                        washSelect.options[0].text = "Επιλέξτε πακέτο...";
                    --}}
                    washSelect.classList.remove('opacity-50', 'cursor-not-allowed')

                    const dateObj = new Date(selectedDateValue)
                    console.log(dateObj)
                    const dayOfWeek = dateObj.getDay()
                    console.log(dayOfWeek)

                    if (dayOfWeek === 2 || dayOfWeek === 3 || dayOfWeek === 4) {
                        bioGroup.style.display = 'block'
                    } else {
                        bioGroup.style.display = 'none'
                    }
                    if (washSelect.value.includes('ΒΙΟΛΟΓΙΚΟΣ')) {
                        washSelect.value = "";
                    }

                }

                // Event Listeners
                dateInput.addEventListener('change', updateWashOptions)
                if (dateInput.value) updateWashOptions()
                dateInput.addEventListener('change', fetchSlots)
                stationSelect.addEventListener('change', fetchSlots)

                // Αρχική κλήση
                fetchSlots()
    </script>
@endsection
