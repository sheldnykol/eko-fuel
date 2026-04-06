@extends('layouts.app')

@section('title', 'Online Κράτηση Ραντεβού | Πλυντήριο Αυτοκινήτων EKO | ΛΑΡΙΣΑ')
@section('meta_description', 'Κλείστε το ραντεβού σας για πλύσιμο αυτοκινήτου στην EKO εύκολα και γρήγορα.')

@section('content')
    <section class="min-h-screen bg-slate-50 py-12">
        <div class="container mx-auto max-w-lg px-4">
            <div class="rounded-[2.5rem] bg-white p-8 shadow-xl ring-1 ring-slate-200">
                <h2 class="mb-2 text-3xl font-black text-slate-900">Κράτηση Πλυντηρίου</h2>
                <p class="mb-8 text-slate-500">Γρήγορη κράτηση χωρίς εγγραφή.</p>

                {{-- Μήνυμα Επιτυχίας --}}
                @if (session('success'))
                    <div class="mb-8 overflow-hidden rounded-[2rem] bg-emerald-50 ring-1 ring-emerald-200">
                        <div class="p-6 text-center">
                            <div
                                class="mb-3 inline-flex h-12 w-12 items-center justify-center rounded-full bg-emerald-500 text-white"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="3"
                                        d="M5 13l4 4L19 7"
                                    />
                                </svg>
                            </div>
                            <h3 class="text-xl font-black text-emerald-900">{{ session('success') }}</h3>
                            <div class="mt-6 space-y-4">
                                <div
                                    class="mx-auto mt-6 grid max-w-[320px] grid-cols-2 gap-3 rounded-2xl bg-white/50 p-4 text-left ring-1 ring-emerald-100"
                                >
                                    <div>
                                        <p class="text-[10px] font-bold tracking-wider text-slate-400 uppercase">
                                            Ημερομηνία
                                        </p>
                                        <p class="text-sm font-bold text-slate-700">
                                            {{ \Carbon\Carbon::parse(session('appointment_date'))->format('d/m/Y') }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-bold tracking-wider text-slate-400 uppercase">Ώρα</p>
                                        <p class="text-sm font-bold text-slate-700">
                                            {{ \Carbon\Carbon::parse(session('appointment_time'))->format('H:i') }}
                                        </p>
                                    </div>
                                    <div class="col-span-2 pt-2">
                                        <p class="text-[10px] font-bold tracking-wider text-slate-400 uppercase">
                                            Οδηγός
                                        </p>
                                        <p class="text-sm font-bold text-slate-700">{{ session('customer_name') }}</p>
                                    </div>
                                </div>
                                <div
                                    class="mx-auto mt-4 max-w-[320px] rounded-xl bg-amber-50 p-3 ring-1 ring-amber-200"
                                >
                                    <p class="text-center text-[11px] font-bold text-amber-800">
                                        ⚠️ Παρακαλούμε για την ομαλή εξυπηρέτηση όλων, προσέλθετε στο πρατήριο
                                        <span class="underline">10 λεπτά νωρίτερα</span>
                                        από το ραντεβού σας.
                                    </p>
                                </div>
                                <p
                                    class="mt-4 animate-pulse text-[11px] font-black tracking-wider text-emerald-700 uppercase"
                                >
                                    Σας στάλθηκε SMS επιβεβαίωσης 📱
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- ΚΥΡΙΑ ΦΟΡΜΑ --}}
                {{-- Προσθέσαμε id="bookingForm" για να τη χειριστούμε με JS --}}
                <form action="{{ route('booking.store') }}" method="POST" class="space-y-5" id="bookingForm">
                    @csrf

                    {{-- Container για τα κρυφά inputs των extras που θα γεμίσουν από το JS --}}
                    <div id="hidden_extras_container"></div>

                    {{-- 1. Επιλογή Πρατηρίου --}}
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

                    {{-- 2. Στοιχεία Πελάτη --}}
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
                            placeholder="Τηλέφωνο"
                            required
                            class="w-full rounded-xl border-slate-200 bg-slate-50 p-4"
                        />
                        <input
                            type="text"
                            name="license_plate"
                            oninput="this.value = this.value.replace(/\s/g, '').toUpperCase()"
                            placeholder="Πινακίδα"
                            required
                            class="w-full rounded-xl border-slate-200 bg-slate-50 p-4 uppercase"
                        />
                    </div>

                    {{-- 3. Ημερομηνία και Ώρα --}}
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
                            <option value="">Επιλέξτε ημ/νία...</option>
                        </select>
                    </div>

                    {{-- 4. Τύπος Πλυσίματος --}}
                    <div>
                        <label class="mb-2 block text-sm font-bold text-slate-700">Τύπος Πλυσίματος</label>
                        <select
                            name="wash_type"
                            required
                            disabled
                            id="wash_type_select"
                            class="w-full cursor-not-allowed rounded-xl border-2 border-slate-200 bg-slate-200 p-4 opacity-50 transition-all"
                        >
                            <option value="">Επιλέξετε πακέτο...</option>
                            <option value="ΜΕΣΑ-ΕΞΩ">ΜΕΣΑ - ΕΞΩ (~15€)</option>
                            <option value="ΕΞΩ">ΜΟΝΟ ΕΞΩ (~7€)</option>
                            <option value="ΜΕΣΑ">ΜΟΝΟ ΜΕΣΑ (~10€)</option>
                            <optgroup label="Υπηρεσίες Βιολογικού (Τρ - Τε - Πε)" id="bio_group" style="display: none">
                                <option value="ΒΙΟΛΟΓΙΚΟΣ">ΒΙΟΛΟΓΙΚΟΣ ΜΟΝΟ (~60€)</option>
                                <option value="ΒΙΟΛΟΓΙΚΟΣ & ΜΕΣΑ-ΕΞΩ">ΒΙΟΛΟΓΙΚΟΣ & ΜΕΣΑ-ΕΞΩ (~70€)</option>
                            </optgroup>
                        </select>
                    </div>

                    {{-- 5. Σχόλια --}}
                    <div>
                        <textarea
                            name="comments"
                            rows="2"
                            placeholder="Σχόλια (Προαιρετικά)"
                            class="w-full rounded-xl border-slate-200 bg-slate-50 p-4 text-sm"
                        ></textarea>
                    </div>
                    <div class="px-6 pb-2 text-center">
                        <p class="text-[10px] text-slate-400 italic">
                            * Οι τιμές είναι ενδεικτικές και ενδέχεται να μεταβληθούν ανάλογα με το μέγεθος/κατάσταση του οχήματος.
                        </p>
                    </div>

                    {{-- Κουμπί Που Ανοίγει το Modal --}}
                    <button
                        type="button"
                        id="openModalBtn"
                        class="w-full transform rounded-2xl bg-[#e21838] py-5 font-black text-white shadow-lg shadow-red-500/30 transition-all hover:-translate-y-1 hover:bg-[#c4142f]"
                    >
                        ΣΥΝΕΧΕΙΑ
                    </button>
                </form>
            </div>
        </div>
    </section>

    {{-- ================= MODAL EXTRAS (POPUP) ================= --}}
    <div
        id="extrasModal"
        class="fixed inset-0 z-50 hidden h-full w-full overflow-y-auto bg-slate-900/80 backdrop-blur-sm transition-opacity"
    >
        <div class="relative top-10 mx-auto w-full max-w-2xl p-4 md:top-20">
            <div class="relative rounded-[2rem] bg-white shadow-2xl">
                {{-- Modal Header --}}
                <div class="border-b border-slate-100 p-6 text-center">
                    <h3 class="text-2xl font-black text-slate-800">Θέλετε κάτι έξτρα; 🚗</h3>
                    <p class="text-sm text-slate-500">Επιλέξτε επιπλέον υπηρεσίες για το όχημά σας</p>
                    <button
                        onclick="closeModal()"
                        class="absolute top-6 right-6 rounded-full bg-slate-100 p-2 text-slate-400 hover:bg-slate-200"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>

                {{-- Modal Body - Grid Υπηρεσιών --}}
                <div class="max-h-[60vh] overflow-y-auto p-6">
                    <div class="grid grid-cols-2 gap-4 md:grid-cols-3">
                        {{-- 1. Ξεθάμπωμα Φαναριών (ΑΠΛΟ) --}}
                        <div
                            class="group relative cursor-pointer rounded-xl border-2 border-slate-100 p-4 text-center transition-all hover:border-red-200 hover:bg-red-50"
                            onclick="toggleService(this, 'Ξεθάμπωμα Φαναριών')"
                        >
                            <div
                                class="mx-auto mb-2 flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-2xl"
                            >
                                💡
                            </div>
                            <h4 class="text-sm leading-tight font-bold text-slate-700">Ξεθάμπωμα Φαναριών</h4>
                        </div>

                        {{-- 2. Έλεγχος Ελαστικών (ΔΩΡΕΑΝ - ΜΟΝΙΜΟ ΤΑΜΠΕΛΑΚΙ) --}}
                        <div
                            class="group relative cursor-pointer rounded-xl border-2 border-slate-100 p-4 text-center transition-all hover:border-emerald-200 hover:bg-emerald-50"
                            onclick="toggleService(this, 'Έλεγχος Ελαστικών')"
                        >
                            {{-- Το ταμπελάκι είναι σταθερό δεξιά --}}
                            <span
                                class="pointer-events-none absolute top-2 right-2 rounded bg-emerald-100 px-1.5 py-0.5 text-[9px] font-bold text-emerald-700"
                            >
                                ΔΩΡΕΑΝ
                            </span>
                            <div
                                class="mx-auto mb-2 flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-2xl"
                            >
                                🛞
                            </div>
                            <h4 class="text-sm leading-tight font-bold text-slate-700">Έλεγχος Ελαστικών</h4>
                        </div>

                        {{-- 3. Αλλαγή Λαδιών (ΑΠΛΟ) --}}
                        <div
                            class="group relative cursor-pointer rounded-xl border-2 border-slate-100 p-4 text-center transition-all hover:border-red-200 hover:bg-red-50"
                            onclick="toggleService(this, 'Αλλαγή Λαδιών')"
                        >
                            <div
                                class="mx-auto mb-2 flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-2xl"
                            >
                                🛢️
                            </div>
                            <h4 class="text-sm leading-tight font-bold text-slate-700">Αλλαγή Λαδιών</h4>
                        </div>

                        {{-- 4. Έλεγχος Λαδιών (ΔΩΡΕΑΝ - ΜΟΝΙΜΟ ΤΑΜΠΕΛΑΚΙ) --}}
                        <div
                            class="group relative cursor-pointer rounded-xl border-2 border-slate-100 p-4 text-center transition-all hover:border-emerald-200 hover:bg-emerald-50"
                            onclick="toggleService(this, 'Έλεγχος Λαδιών')"
                        >
                            <span
                                class="pointer-events-none absolute top-2 right-2 rounded bg-emerald-100 px-1.5 py-0.5 text-[9px] font-bold text-emerald-700"
                            >
                                ΔΩΡΕΑΝ
                            </span>
                            <div
                                class="mx-auto mb-2 flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-2xl"
                            >
                                🔍
                            </div>
                            <h4 class="text-sm leading-tight font-bold text-slate-700">Έλεγχος Λαδιών</h4>
                        </div>

                        {{-- 5. Απολύμανση Καμπίνας (ΑΠΛΟ) --}}
                        <div
                            class="group relative cursor-pointer rounded-xl border-2 border-slate-100 p-4 text-center transition-all hover:border-red-200 hover:bg-red-50"
                            onclick="toggleService(this, 'Απολύμανση Καμπίνας')"
                        >
                            <div
                                class="mx-auto mb-2 flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-2xl"
                            >
                                🦠
                            </div>
                            <h4 class="text-sm leading-tight font-bold text-slate-700">Απολύμανση Καμπίνας</h4>
                        </div>

                        {{-- 6. Έλεγχος Ψυγείου (ΔΩΡΕΑΝ - ΜΟΝΙΜΟ ΤΑΜΠΕΛΑΚΙ) --}}
                        <div
                            class="group relative cursor-pointer rounded-xl border-2 border-slate-100 p-4 text-center transition-all hover:border-emerald-200 hover:bg-emerald-50"
                            onclick="toggleService(this, 'Έλεγχος Ψυγείου')"
                        >
                            <span
                                class="pointer-events-none absolute top-2 right-2 rounded bg-emerald-100 px-1.5 py-0.5 text-[9px] font-bold text-emerald-700"
                            >
                                ΔΩΡΕΑΝ
                            </span>
                            <div
                                class="mx-auto mb-2 flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-2xl"
                            >
                                🌡️
                            </div>
                            <h4 class="text-sm leading-tight font-bold text-slate-700">Έλεγχος Ψυγείου</h4>
                        </div>

                        {{-- 7. Αλλαγή Υαλοκαθαριστήρων (ΑΠΛΟ) --}}
                        <div
                            class="group relative cursor-pointer rounded-xl border-2 border-slate-100 p-4 text-center transition-all hover:border-red-200 hover:bg-red-50"
                            onclick="toggleService(this, 'Αλλαγή Υαλοκαθαριστήρων')"
                        >
                            <div
                                class="mx-auto mb-2 flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-2xl"
                            >
                                🌧️
                            </div>
                            <h4 class="text-sm leading-tight font-bold text-slate-700">Αλλαγή Υαλοκαθαριστήρων</h4>
                        </div>

                        {{-- 8. Αντιψυκτικό / Παραφλού (ΑΠΛΟ) --}}
                        <div
                            class="group relative cursor-pointer rounded-xl border-2 border-slate-100 p-4 text-center transition-all hover:border-red-200 hover:bg-red-50"
                            onclick="toggleService(this, 'Προσθήκη Αντιψυκτικού')"
                        >
                            <div
                                class="mx-auto mb-2 flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-2xl"
                            >
                                ❄️
                            </div>
                            <h4 class="text-sm leading-tight font-bold text-slate-700">Προσθήκη Αντιψυκτικού</h4>
                        </div>
                    </div>
                </div>

                {{-- Modal Footer --}}
                <div
                    class="flex flex-col gap-3 rounded-b-[2rem] bg-slate-50 p-6 md:flex-row md:items-center md:justify-between"
                >
                    <button onclick="submitFinalForm()" class="text-sm font-bold text-slate-500 hover:text-slate-800">
                        Όχι ευχαριστώ, μόνο κράτηση
                    </button>
                    <button
                        onclick="submitFinalForm()"
                        class="flex-1 rounded-xl bg-[#e21838] px-6 py-4 font-black text-white shadow-lg shadow-red-500/30 transition-all hover:bg-[#c4142f]"
                    >
                        ΟΛΟΚΛΗΡΩΣΗ ΚΡΑΤΗΣΗΣ
                        <span id="count_badge" class="ml-2 hidden rounded bg-white px-2 py-0.5 text-xs text-red-600">
                            0
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const dateInput = document.getElementById('date_input')
        const timeSelect = document.getElementById('time_select')
        const stationSelect = document.getElementById('station_select')
        const washSelect = document.getElementById('wash_type_select')
        const bioGroup = document.getElementById('bio_group')
        const modal = document.getElementById('extrasModal')
        const bookingForm = document.getElementById('bookingForm')
        const openModalBtn = document.getElementById('openModalBtn')
        const hiddenExtrasContainer = document.getElementById('hidden_extras_container')

        // Λίστα με τις επιλεγμένες extra υπηρεσίες
        let selectedServices = []

        // Modal
        openModalBtn.addEventListener('click', function () {
            // Έλεγχος εγκυρότητας της φόρμας πριν ανοίξει το modal
            if (bookingForm.checkValidity()) {
                modal.classList.remove('hidden')
                document.body.style.overflow = 'hidden' // Κλείδωμα scroll
            } else {
                bookingForm.reportValidity() // Εμφάνιση μηνυμάτων λάθους browser
            }
        })

        function closeModal() {
            modal.classList.add('hidden')
            document.body.style.overflow = 'auto'
        }

        // --- Logic: Toggle Services ---
        function toggleService(element, serviceName) {
            if (selectedServices.includes(serviceName)) {
                // --- ΑΦΑΙΡΕΣΗ ---
                selectedServices = selectedServices.filter(s => s !== serviceName)

                // Επαναφορά χρωμάτων
                element.classList.remove('border-red-500', 'bg-red-50', 'ring-2', 'ring-red-500')
                element.classList.add('border-slate-100')

                // Αφαίρεση του τικ
                const check = element.querySelector('.check-mark')
                if (check) check.remove()
            } else {
                // --- ΠΡΟΣΘΗΚΗ ---
                selectedServices.push(serviceName)

                // Προσθήκη χρωμάτων (Κόκκινο πλαίσιο)
                element.classList.remove('border-slate-100')
                element.classList.add('border-red-500', 'bg-red-50', 'ring-2', 'ring-red-500')

                // Προσθήκη Τικ (ΠΑΝΤΑ ΑΡΙΣΤΕΡΑ για να μην πέφτει πάνω στο "Δωρεάν")
                const check = document.createElement('div')
                check.className =
                    'check-mark absolute top-2 left-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs shadow-sm'
                check.innerHTML = '✓'
                element.appendChild(check)
            }

            // Update Counter Badge στο κουμπί
            const countBadge = document.getElementById('count_badge')
            if (selectedServices.length > 0) {
                countBadge.innerText = selectedServices.length
                countBadge.classList.remove('hidden')
            } else {
                countBadge.classList.add('hidden')
            }
        }

        // --- Logic: Final Submit ---
        function submitFinalForm() {
            // Καθαρισμός προηγούμενων inputs
            hiddenExtrasContainer.innerHTML = ''

            // Δημιουργία hidden inputs για κάθε επιλογή
            selectedServices.forEach(service => {
                const input = document.createElement('input')
                input.type = 'hidden'
                input.name = 'extras[]' // Array στο Laravel
                input.value = service
                hiddenExtrasContainer.appendChild(input)
            })

            // Υποβολή της φόρμας
            bookingForm.submit()
        }

        // --- Existing Logic: Dates/Slots/Wash Type ---
        // (Διατηρούμε τον κώδικα που είχες για τις ημερομηνίες και τα slots)
        const now = new Date()
        const offset = now.getTimezoneOffset() * 60000
        const todayStr = new Date(now - offset).toISOString().split('T')[0]
        const maxDate = new Date(now)
        maxDate.setDate(maxDate.getDate() + 13)
        const maxDateStr = maxDate.toISOString().split('T')[0]

        dateInput.setAttribute('min', todayStr)
        dateInput.setAttribute('max', maxDateStr)
        if (!dateInput.value || dateInput.value < todayStr) dateInput.value = todayStr

        function fetchSlots() {
            const selectedDate = dateInput.value
            const stationId = stationSelect.value
            timeSelect.innerHTML = ''

            if (!selectedDate || !stationId) {
                const opt = document.createElement('option')
                opt.text = 'Επιλέξτε πρατήριο/ημνία'
                timeSelect.appendChild(opt)
                return
            }

            // Εδώ υποθετικά καλείς το backend σου
            fetch(`/get-available-slots?date=${selectedDate}&station_id=${stationId}`)
                .then(r => r.json())
                .then(data => {
                    const currentNow = new Date()
                    const currentHM =
                        currentNow.getHours().toString().padStart(2, '0') +
                        ':' +
                        currentNow.getMinutes().toString().padStart(2, '0')
                    const isToday = selectedDate === todayStr

                    data.all_slots.forEach(slot => {
                        const option = document.createElement('option')
                        option.value = slot
                        const isBooked = data.booked_slots.some(b => b.startsWith(slot))
                        const isPast = isToday && slot < currentHM

                        if (isBooked) {
                            option.disabled = true
                            option.text = slot + ' [ΚΡΑΤΗΜΕΝΟ]'
                            option.style.color = 'red'
                        } else if (isPast) {
                            option.disabled = true
                            option.text = slot + ' [ΠΑΡΗΛΘΕ]'
                            option.style.color = 'gray'
                        } else {
                            option.text = slot
                        }
                        timeSelect.appendChild(option)
                    })
                })
                .catch(e => console.log(e))
        }

        function updateWashOptions() {
            if (!dateInput.value) {
                washSelect.disabled = true
                washSelect.classList.add('opacity-50', 'cursor-not-allowed')
                return
            }
            washSelect.disabled = false
            washSelect.classList.remove('opacity-50', 'cursor-not-allowed')

            const d = new Date(dateInput.value)
            const day = d.getDay() // 0=Κυρ, ... 2=Τρ, 3=Τε, 4=Πε

            if (day === 2 || day === 3 || day === 4) {
                bioGroup.style.display = 'block'
            } else {
                bioGroup.style.display = 'none'
                if (washSelect.value.includes('ΒΙΟΛΟΓΙΚΟΣ')) washSelect.value = ''
            }
        }

        dateInput.addEventListener('change', () => {
            updateWashOptions()
            fetchSlots()
        })
        stationSelect.addEventListener('change', fetchSlots)

        if (dateInput.value) {
            updateWashOptions()
            fetchSlots()
        }
    </script>
@endsection
