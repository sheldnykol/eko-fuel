@extends('admin.admin')

@section('admin_title', 'Ωράριο Πλυντηρίου')

@section('admin_content')
    <x-admin.page-header
        title="Ωράριο Πλυντηρίου"
        subtitle="Αλλαγές έως και μία μέρα πριν. Οι ώρες με κλεισμένο ραντεβού κλειδώνουν αυτόματα."
    />

    <form action="{{ route('admin.schedules.store') }}" method="POST" id="scheduleForm" class="mx-auto max-w-4xl overflow-hidden rounded-xl border border-slate-200 bg-white">
        @csrf

        <div class="space-y-5 p-4 sm:p-5">
            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                <div>
                    <label for="station_id" class="mb-1 block text-[12px] font-medium text-slate-700">Πρατήριο</label>
                    <select
                        name="station_id"
                        id="station_id"
                        class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-[13px] focus:border-red-500 focus:ring-1 focus:ring-red-500 focus:outline-none"
                    >
                        @foreach ($stations as $station)
                            <option value="{{ $station->id }}" @selected(old('station_id', request('station_id')) == $station->id)>
                                {{ $station->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="date" class="mb-1 block text-[12px] font-medium text-slate-700">Ημερομηνία</label>
                    <input
                        type="date"
                        name="date"
                        id="date"
                        min="{{ $minDate }}"
                        value="{{ old('date', request('date', $minDate)) }}"
                        required
                        class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-[13px] focus:border-red-500 focus:ring-1 focus:ring-red-500 focus:outline-none"
                    />
                </div>
            </div>

            <div>
                <p class="mb-1.5 text-[12px] font-medium text-slate-700">Επόμενες 15 ημέρες</p>
                <div class="no-scrollbar -mx-1 flex gap-1.5 overflow-x-auto px-1 pb-1" id="quickDays"></div>
            </div>

            <div>
                <div class="mb-2 flex flex-wrap items-center justify-between gap-2">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="text-[13px] font-semibold text-slate-900">Διαθέσιμες ώρες</span>
                        <span id="dayStatus" class="rounded-full bg-slate-100 px-2 py-0.5 text-[11px] font-medium text-slate-600"></span>
                    </div>
                    <div class="flex gap-1.5">
                        <button type="button" id="selectAll" class="rounded-md border border-slate-200 px-2.5 py-1 text-[12px] font-medium text-slate-600 hover:bg-slate-50">Όλες</button>
                        <button type="button" id="selectNone" class="rounded-md border border-slate-200 px-2.5 py-1 text-[12px] font-medium text-slate-600 hover:bg-slate-50">Καμία</button>
                    </div>
                </div>

                <div class="grid grid-cols-4 gap-1.5 sm:grid-cols-6 lg:grid-cols-9" id="slotsGrid">
                    @foreach ($times as $time)
                        <label
                            data-time="{{ $time }}"
                            class="slot relative flex cursor-pointer items-center justify-center rounded-lg border border-slate-200 bg-white py-2 text-[13px] font-medium text-slate-500 tabular-nums transition-colors hover:border-slate-300 has-[:checked]:border-red-500 has-[:checked]:bg-red-50 has-[:checked]:text-red-700"
                        >
                            <input type="checkbox" name="available_slots[]" value="{{ $time }}" class="sr-only" @checked(in_array($time, old('available_slots', []))) />
                            {{ $time }}
                        </label>
                    @endforeach
                </div>

                <div class="mt-3 flex flex-wrap gap-x-4 gap-y-1 text-[11px] text-slate-500">
                    <span class="flex items-center gap-1.5"><span class="h-2.5 w-2.5 rounded-sm border border-red-500 bg-red-50"></span> Ανοιχτή ώρα</span>
                    <span class="flex items-center gap-1.5"><span class="h-2.5 w-2.5 rounded-sm border border-amber-400 bg-amber-50"></span> Κλεισμένο ραντεβού</span>
                    <span>Καμία ώρα = κλειστή μέρα</span>
                </div>
            </div>
        </div>

        <div class="flex flex-col-reverse gap-2 border-t border-slate-100 bg-slate-50/70 px-4 py-3 sm:flex-row sm:justify-end sm:px-5">
            <button
                type="submit"
                id="resetBtn"
                formaction="{{ route('admin.schedules.reset') }}"
                class="hidden rounded-lg border border-slate-200 bg-white px-3 py-2 text-[13px] font-medium text-slate-600 hover:bg-slate-50"
            >
                Επαναφορά προεπιλογής
            </button>
            <button type="submit" class="rounded-lg bg-slate-900 px-4 py-2 text-[13px] font-medium text-white hover:bg-slate-800">
                Αποθήκευση ωραρίου
            </button>
        </div>
    </form>

    <script>
        ;(function () {
            const dayUrl = @json(route('admin.schedules.day'));
            const minDate = @json($minDate);
            const hasOld = @json(old('date') !== null);
            const dayNames = ['Κυρ', 'Δευ', 'Τρί', 'Τετ', 'Πέμ', 'Παρ', 'Σάβ']

            const stationSelect = document.getElementById('station_id')
            const dateInput = document.getElementById('date')
            const quickDays = document.getElementById('quickDays')
            const dayStatus = document.getElementById('dayStatus')
            const resetBtn = document.getElementById('resetBtn')
            const slotLabels = [...document.querySelectorAll('#slotsGrid .slot')]

            const pad = n => String(n).padStart(2, '0')
            const toIso = d => `${d.getFullYear()}-${pad(d.getMonth() + 1)}-${pad(d.getDate())}`

            const start = new Date(minDate + 'T00:00:00')
            for (let i = 0; i < 15; i++) {
                const d = new Date(start)
                d.setDate(start.getDate() + i)
                const iso = toIso(d)
                const chip = document.createElement('button')
                chip.type = 'button'
                chip.dataset.date = iso
                chip.className =
                    'day-chip flex min-w-[3.25rem] shrink-0 flex-col items-center rounded-lg border border-slate-200 bg-white px-1.5 py-1.5 transition-colors hover:border-slate-300'
                chip.innerHTML = `<span class="text-[10px] font-medium text-slate-400 uppercase">${dayNames[d.getDay()]}</span><span class="text-[13px] font-semibold text-slate-700 tabular-nums">${pad(d.getDate())}/${pad(d.getMonth() + 1)}</span>`
                chip.addEventListener('click', () => {
                    dateInput.value = iso
                    loadDay()
                })
                quickDays.appendChild(chip)
            }

            function highlightChip() {
                document.querySelectorAll('.day-chip').forEach(c => {
                    const active = c.dataset.date === dateInput.value
                    c.classList.toggle('border-red-500', active)
                    c.classList.toggle('bg-red-50', active)
                    c.classList.toggle('border-slate-200', !active)
                    c.classList.toggle('bg-white', !active)
                })
            }

            function setSlots(slots, booked) {
                slotLabels.forEach(label => {
                    const time = label.dataset.time
                    const input = label.querySelector('input')
                    const isBooked = booked.includes(time)
                    input.checked = slots.includes(time) || isBooked
                    label.dataset.booked = isBooked ? '1' : ''
                    label.classList.toggle('border-amber-400!', isBooked)
                    label.classList.toggle('bg-amber-50!', isBooked)
                    label.classList.toggle('cursor-not-allowed', isBooked)
                    label.title = isBooked ? 'Υπάρχει κλεισμένο ραντεβού σε αυτή την ώρα' : ''
                    let badge = label.querySelector('.booked-badge')
                    if (isBooked && !badge) {
                        badge = document.createElement('span')
                        badge.className =
                            'booked-badge absolute -top-2 -right-1 rounded-full bg-amber-400 px-1.5 text-[9px] font-black text-white'
                        badge.textContent = 'ΚΛΕΙΣΜΕΝΟ'
                        label.appendChild(badge)
                    } else if (!isBooked && badge) {
                        badge.remove()
                    }
                })
            }

            slotLabels.forEach(label => {
                label.addEventListener('click', e => {
                    if (label.dataset.booked) e.preventDefault()
                })
            })

            document.getElementById('selectAll').addEventListener('click', () => {
                slotLabels.forEach(l => (l.querySelector('input').checked = true))
            })
            document.getElementById('selectNone').addEventListener('click', () => {
                slotLabels.forEach(l => (l.querySelector('input').checked = !!l.dataset.booked))
            })

            async function loadDay(keepChecks = false) {
                highlightChip()
                if (!dateInput.value || dateInput.value < minDate) {
                    dayStatus.textContent = 'Επιλέξτε ημερομηνία από αύριο και μετά'
                    return
                }
                dayStatus.textContent = 'Φόρτωση...'
                try {
                    const params = new URLSearchParams({ station_id: stationSelect.value, date: dateInput.value })
                    const res = await fetch(`${dayUrl}?${params}`, { headers: { Accept: 'application/json' } })
                    if (!res.ok) throw new Error(res.status)
                    const data = await res.json()

                    const current = slotLabels.filter(l => l.querySelector('input').checked).map(l => l.dataset.time)
                    setSlots(keepChecks ? current : data.slots, data.booked)

                    const bookedText = data.booked.length ? ` · ${data.booked.length} κλεισμένα` : ''
                    dayStatus.textContent =
                        (data.is_custom ? (data.slots.length ? 'Ειδικό ωράριο' : 'Κλειστή μέρα') : 'Προεπιλεγμένο ωράριο') +
                        bookedText
                    resetBtn.classList.toggle('hidden', !data.is_custom)
                } catch (e) {
                    dayStatus.textContent = 'Σφάλμα φόρτωσης ωραρίου'
                }
            }

            stationSelect.addEventListener('change', () => loadDay())
            dateInput.addEventListener('change', () => loadDay())

            loadDay(hasOld)
        })()
    </script>
@endsection
