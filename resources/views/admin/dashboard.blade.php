@extends('admin.admin')

@section('admin_content')
    <div class="min-h-screen bg-slate-100 py-8">
        <div class="container mx-auto max-w-6xl px-4">
            {{-- HEADER: Φίλτρα & PDF --}}
            <div
                class="mb-6 flex flex-col justify-between gap-4 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm md:flex-row md:items-center"
            >
                <form
                    action="{{ route('admin.dashboard') }}"
                    method="GET"
                    id="dateFilterForm"
                    class="flex items-center gap-3"
                >
                    <label for="date" class="font-bold text-slate-700">Επιλογή Ημερομηνίας:</label>
                    <input
                        type="date"
                        name="date"
                        id="admin_date_input"
                        value="{{ $selectedDate }}"
                        onchange="document.getElementById('dateFilterForm').submit()"
                        class="rounded-xl border-slate-200 bg-slate-50 p-2 focus:border-red-500 focus:ring-red-500"
                    />
                </form>

                <div class="text-sm font-medium">
                    Προβολή για:
                    <span class="font-black text-red-600">{{ date('d/m/Y', strtotime($selectedDate)) }}</span>
                </div>

                <a
                    href="{{ route('admin.exportPDF', ['date' => $selectedDate]) }}"
                    class="flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-2 text-sm font-bold text-white shadow-sm transition-all hover:bg-emerald-700"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        class="h-5 w-5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"
                        />
                    </svg>
                    Κατέβασμα PDF
                </a>
            </div>

            {{-- CALENDAR WIDGET --}}
            <div class="mb-8 rounded-[2rem] border border-slate-200 bg-white p-6 shadow-xl">
                <div class="mb-6 flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-black tracking-tight text-slate-800 uppercase">
                            {{ $calendarDate->translatedFormat('F Y') }}
                        </h2>
                    </div>

                    <div class="flex items-center gap-2">
                        <a
                            href="{{ route('admin.dashboard', ['month' => $prevMonth->month, 'year' => $prevMonth->year]) }}"
                            class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-600 transition-all hover:bg-slate-50"
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
                                    d="M15 19l-7-7 7-7"
                                />
                            </svg>
                        </a>
                        <a
                            href="{{ route('admin.dashboard', ['date' => date('Y-m-d')]) }}"
                            class="px-3 text-xs font-bold text-slate-400 uppercase hover:text-red-600"
                        >
                            Σήμερα
                        </a>
                        <a
                            href="{{ route('admin.dashboard', ['month' => $nextMonth->month, 'year' => $nextMonth->year]) }}"
                            class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-600 transition-all hover:bg-slate-50"
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
                                    d="M9 5l7 7-7 7"
                                />
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="mb-2 grid grid-cols-7 gap-2">
                    @foreach (['Δευ', 'Τρι', 'Τετ', 'Πεμ', 'Παρ', 'Σαβ', 'Κυρ'] as $dayName)
                        <div class="text-center text-xs font-bold text-slate-300 uppercase">{{ $dayName }}</div>
                    @endforeach
                </div>

                <div class="grid grid-cols-7 gap-2">
                    @for ($i = 0; $i < $emptyDaysAtStart; $i++)
                        <div class="h-20 rounded-xl border border-dashed border-slate-100 bg-slate-50/50"></div>
                    @endfor

                    @foreach ($calendarDays as $date => $count)
                        @php
                            $isToday = $date == date('Y-m-d');
                            $isSelected = $date == $selectedDate;
                        @endphp

                        <a
                            href="{{ route('admin.dashboard', ['date' => $date, 'month' => $calendarDate->month, 'year' => $calendarDate->year]) }}"
                            class="{{ $isSelected ? 'border-red-500 bg-red-50 ring-2 ring-red-200' : 'border-slate-100 bg-slate-50 hover:bg-white hover:shadow-md' }} relative flex h-20 flex-col items-center justify-center rounded-xl border transition-all"
                        >
                            <span class="{{ $isSelected ? 'text-red-600' : 'text-slate-500' }} text-xs font-bold">
                                {{ date('j', strtotime($date)) }}
                            </span>

                            @if ($count > 0)
                                <span
                                    class="mt-1 flex h-6 w-6 items-center justify-center rounded-full bg-slate-900 text-[10px] font-black text-white"
                                >
                                    {{ $count }}
                                </span>
                            @else
                                <span class="mt-1 text-[10px] text-slate-300">-</span>
                            @endif

                            @if ($isToday)
                                <div class="absolute top-1 right-1 h-1.5 w-1.5 rounded-full bg-red-500"></div>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- STATS CARDS --}}
            <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-3">
                <div class="rounded-2xl border-l-4 border-emerald-500 bg-white p-6 shadow-sm">
                    <div class="flex items-center gap-4">
                        <div class="rounded-xl bg-emerald-50 p-3 text-emerald-600">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                class="h-6 w-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium tracking-wider text-slate-500 uppercase">Ολοκληρωμένα</p>
                            <p class="text-2xl font-black text-slate-900">{{ $stats['completed'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl border-l-4 border-yellow-500 bg-white p-6 shadow-sm">
                    <div class="flex items-center gap-4">
                        <div class="rounded-xl bg-yellow-50 p-3 text-yellow-600">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                class="h-6 w-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium tracking-wider text-slate-500 uppercase">Σε Αναμονή</p>
                            <p class="text-2xl font-black text-slate-900">{{ $stats['pending'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl border-l-4 border-red-500 bg-white p-6 shadow-sm">
                    <div class="flex items-center gap-4">
                        <div class="rounded-xl bg-red-50 p-3 text-red-600">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                class="h-6 w-6"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium tracking-wider text-slate-500 uppercase">Ακυρωμένα</p>
                            <p class="text-2xl font-black text-slate-900">{{ $stats['canceled'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- APPOINTMENTS HEADER --}}
            <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-center">
                <div>
                    <h1 class="text-3xl font-black text-slate-900">Λίστα Ραντεβού</h1>
                    <p class="font-medium text-slate-600">
                        Διαχείριση για {{ date('d/m/Y', strtotime($selectedDate)) }}
                    </p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white px-6 py-3 text-center shadow-sm md:text-left">
                    <span class="block text-sm font-bold tracking-wider text-slate-500 uppercase">Σύνολο Ημέρας</span>
                    <span class="text-2xl font-black text-red-600">{{ $appointments->count() }} Ραντεβού</span>
                </div>
            </div>

            @if (session('success'))
                <div
                    class="mb-6 rounded-xl border-l-4 border-emerald-500 bg-emerald-50 p-4 font-bold text-emerald-700 shadow-sm"
                >
                    ✓ {{ session('success') }}
                </div>
            @endif

            {{-- RESPONSIVE APPOINTMENTS CARDS (Αντικαθιστά τον Πίνακα) --}}
            <div class="space-y-4">
                @forelse ($appointments as $app)
                    <div
                        class="flex flex-col gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition-all hover:shadow-md md:flex-row md:items-center md:justify-between"
                    >
                        {{-- 1. Ώρα & Πελάτης --}}
                        <div class="flex items-center gap-4 md:w-1/4">
                            <div
                                class="flex h-16 w-16 shrink-0 flex-col items-center justify-center rounded-xl border border-slate-100 bg-slate-50 text-center"
                            >
                                <span class="text-lg font-black text-slate-800">
                                    {{ date('H:i', strtotime($app->appointment_time)) }}
                                </span>
                            </div>
                            <div>
                                <div class="text-lg font-bold text-slate-900">{{ $app->customer_name }}</div>
                                <a
                                    href="tel:{{ $app->customer_phone }}"
                                    class="flex items-center gap-1 text-sm font-bold text-slate-500 hover:text-red-600"
                                >
                                    📞 {{ $app->customer_phone }}
                                </a>
                            </div>
                        </div>

                        {{-- 2. Όχημα & Πακέτο Πλύσης --}}
                        <div class="flex flex-col gap-2 border-l-0 border-slate-100 md:w-1/4 md:border-l-2 md:pl-4">
                            <div class="flex flex-wrap items-center gap-2">
                                <span
                                    class="rounded-lg bg-slate-900 px-3 py-1 font-mono text-sm font-black tracking-widest text-white"
                                >
                                    {{ $app->license_plate }}
                                </span>
                                {{-- Εδώ εμφανίζεται το Vehicle Type --}}
                                <span class="rounded-lg bg-slate-200 px-2 py-1 text-xs font-black text-slate-600">
                                    {{ $app->vehicle_type ?? 'ΙΧ' }}
                                </span>
                            </div>
                            <div class="flex flex-wrap gap-2 text-xs">
                                <span
                                    class="rounded border border-red-300 bg-red-50 px-2 py-1 font-black text-red-600 uppercase shadow-sm"
                                >
                                    {{ $app->wash_type }}
                                </span>
                                @if ($app->extras && $app->extras !== 'Χωρίς Extras')
                                    <span
                                        class="rounded border border-emerald-300 bg-emerald-50 px-2 py-1 font-black text-emerald-700 uppercase shadow-sm"
                                    >
                                        + {{ $app->extras }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- 3. Σχόλιο Πελάτη --}}
                        <div class="flex flex-col md:w-1/4">
                            @if ($app->comments)
                                <div
                                    class="relative rounded-xl border border-amber-200 bg-amber-50 p-3 text-sm text-amber-900"
                                >
                                    <span
                                        class="absolute -top-2 left-3 bg-amber-50 px-1 text-[10px] font-black tracking-wider text-amber-600 uppercase"
                                    >
                                        Σχόλιο Πελάτη
                                    </span>
                                    <p class="leading-tight font-medium italic">{{ $app->comments }}</p>
                                </div>
                            @else
                                <span class="text-xs font-medium text-slate-400 italic">Δεν άφησε σχόλιο.</span>
                            @endif
                        </div>

                        {{-- 4. Status & Actions (Σημειώσεις Admin) --}}
                        <div
                            class="flex flex-col items-center gap-3 border-t border-slate-100 pt-4 sm:flex-row md:w-auto md:justify-end md:border-none md:pt-0"
                        >
                            <form
                                action="{{ route('admin.updateStatus', $app->id) }}"
                                method="POST"
                                class="w-full sm:w-auto"
                            >
                                @csrf
                                <select
                                    name="status"
                                    onchange="this.form.submit()"
                                    class="{{ $app->status == 1 ? 'text-amber-600' : ($app->status == 2 ? 'text-emerald-600' : 'text-slate-500') }} w-full rounded-xl border-slate-200 bg-slate-50 py-2.5 text-xs font-bold focus:border-red-500 focus:ring-red-500 sm:w-auto"
                                >
                                    <option value="1" {{ $app->status == 1 ? 'selected' : '' }}>⏳ Εκκρεμεί</option>
                                    <option value="2" {{ $app->status == 2 ? 'selected' : '' }}>
                                        ✅ Ολοκληρώθηκε
                                    </option>
                                    <option value="3" {{ $app->status == 3 ? 'selected' : '' }}>❌ Ακυρώθηκε</option>
                                </select>
                            </form>

                            <button
                                onclick="openCommentModal({{ $app->id }}, '{{ $app->license_plate }}')"
                                class="flex w-full items-center justify-center gap-1 rounded-xl bg-slate-800 px-4 py-2.5 text-xs font-bold text-white shadow-md transition-all hover:bg-slate-700 sm:w-auto"
                                title="Προσθήκη Σημείωσης Admin"
                            >
                                <span>📝</span>
                                Σημείωση
                            </button>
                        </div>
                    </div>
                @empty
                    <div
                        class="flex flex-col items-center justify-center rounded-[2rem] border border-dashed border-slate-300 bg-white py-16 text-center"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="mb-4 h-16 w-16 text-slate-200"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                            />
                        </svg>
                        <h3 class="text-lg font-black text-slate-700">Καμία Κράτηση</h3>
                        <p class="text-slate-500">Δεν υπάρχουν προγραμματισμένα ραντεβού για αυτή την ημερομηνία.</p>
                    </div>
                @endforelse
            </div>

            {{-- MODAL ΓΙΑ ΣΗΜΕΙΩΣΕΙΣ (Admin) --}}
            <div
                id="commentModal"
                class="fixed inset-0 z-50 flex hidden items-center justify-center bg-slate-900/50 p-4 backdrop-blur-sm transition-opacity"
            >
                <div
                    class="w-full max-w-lg transform overflow-hidden rounded-[2rem] bg-white shadow-2xl transition-all"
                >
                    <div class="flex items-center justify-between border-b border-slate-100 bg-slate-50 p-6">
                        <h3 class="text-lg font-black text-slate-800">
                            Σημειώσεις Οχήματος:
                            <span id="modalPlate" class="rounded bg-slate-900 px-2 py-1 font-mono text-white"></span>
                        </h3>
                        <button
                            onclick="closeCommentModal()"
                            class="rounded-full bg-slate-200 p-2 text-slate-500 transition-colors hover:bg-red-100 hover:text-red-600"
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

                    <form id="commentForm" method="POST" class="p-6">
                        @csrf
                        <div class="mb-4">
                            <label class="mb-2 block text-sm font-bold text-slate-700">Νέα Σημείωση (Admin Log)</label>
                            <textarea
                                name="body"
                                rows="4"
                                class="w-full rounded-xl border-slate-200 bg-slate-50 p-4 text-sm focus:border-red-500 focus:ring-red-500"
                                placeholder="Γράψτε μια σημείωση για αυτό το ραντεβού (π.χ. καθυστέρησε, ζήτησε κάτι έξτρα)..."
                                required
                            ></textarea>
                        </div>

                        <div class="mt-6 flex justify-end gap-3">
                            <button
                                type="button"
                                onclick="closeCommentModal()"
                                class="rounded-xl px-5 py-3 text-sm font-bold text-slate-500 transition-all hover:bg-slate-100"
                            >
                                Ακύρωση
                            </button>
                            <button
                                type="submit"
                                class="rounded-xl bg-red-600 px-6 py-3 text-sm font-black text-white shadow-lg shadow-red-500/30 transition-all hover:-translate-y-1 hover:bg-red-700"
                            >
                                Αποθήκευση Σημείωσης
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function openCommentModal(id, plate) {
        const modal = document.getElementById('commentModal')
        const form = document.getElementById('commentForm')
        const plateSpan = document.getElementById('modalPlate')

        form.action = `/admin/appointments/${id}/comments`
        plateSpan.innerText = plate

        modal.classList.remove('hidden')
    }

    function closeCommentModal() {
        document.getElementById('commentModal').classList.add('hidden')
    }
</script>
