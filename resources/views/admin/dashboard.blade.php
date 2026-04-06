@extends('admin.admin')
@section('admin_content')
    <div class="min-h-screen bg-slate-100 py-8">
        <div class="container mx-auto max-w-6xl px-4">
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
                    class="flex items-center gap-2 rounded-xl bg-emerald-600 px-4 py-2 text-sm font-bold text-white shadow-sm transition-all hover:bg-emerald-700"
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
                    Κατέβασμα PDF (Ημέρας)
                </a>
            </div>
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
            <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-center">
                <div>
                    <h1 class="text-3xl font-black text-slate-900">Admin Dashboard</h1>
                    <p class="font-medium text-slate-600">Διαχείριση Ραντεβού - {{ date('d/m/Y') }}</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white px-6 py-3 shadow-sm">
                    <span class="block text-sm font-bold tracking-wider text-slate-500 uppercase">Σύνολο Σήμερα</span>
                    <span class="text-2xl font-black text-red-600">{{ $appointments->count() }} Ραντεβού</span>
                </div>
            </div>

            @if (session('success'))
                <div
                    class="mb-6 rounded-r-xl border-l-4 border-emerald-500 bg-emerald-100 p-4 text-emerald-700 shadow-sm"
                >
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-xl">
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse text-left">
                        <thead>
                            <tr class="border-b border-slate-100 bg-slate-50">
                                <th class="px-6 py-4 text-xs font-bold tracking-widest text-slate-400 uppercase">
                                    Ώρα
                                </th>
                                <th class="px-6 py-4 text-xs font-bold tracking-widest text-slate-400 uppercase">
                                    Πελάτης / Τηλέφωνο
                                </th>
                                <th class="px-6 py-4 text-xs font-bold tracking-widest text-slate-400 uppercase">
                                    Πινακίδα
                                </th>
                                <th class="px-6 py-4 text-xs font-bold tracking-widest text-slate-400 uppercase">
                                    Πλύσιμο
                                </th>
                                <th class="px-6 py-4 text-xs font-bold tracking-widest text-slate-400 uppercase">
                                    Έξτρα
                                </th>
                                <th class="px-6 py-4 text-xs font-bold tracking-widest text-slate-400 uppercase">
                                    Κατάσταση
                                </th>
                                <th
                                    class="px-6 py-4 text-center text-xs font-bold tracking-widest text-slate-400 uppercase"
                                >
                                    Ενέργειες
                                </th>
                                <th
                                    class="px-6 py-4 text-center text-xs font-bold tracking-widest text-slate-400 uppercase"
                                >
                                    Γρήγορη Σημείωση
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-300">
                            @forelse ($appointments as $app)
                                <tr class="transition-colors hover:bg-slate-50">
                                    <td class="px-6 py-4">
                                        <span class="text-lg font-black text-slate-700">
                                            {{ date('H:i', strtotime($app->appointment_time)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-slate-900">{{ $app->customer_name }}</div>
                                        <div class="text-sm text-slate-500">{{ $app->customer_phone }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="rounded-lg bg-slate-900 px-3 py-1 font-mono font-bold tracking-tighter text-white"
                                        >
                                            {{ $app->license_plate }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="rounded border border-red-300 bg-red-50 px-2 py-1 font-mono font-black text-red-600 uppercase"
                                        >
                                            {{ $app->wash_type }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="rounded border border-red-100 bg-red-50 px-2 py-1 font-mono font-black text-red-600 uppercase"
                                        >
                                            @if ($app->extras)
                                                {{ $app->extras }}
                                            @else
                                                -
                                            @endif
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($app->status == 1)
                                            <span
                                                class="inline-flex items-center rounded-full bg-amber-100 px-2.5 py-0.5 text-xs font-bold text-amber-800 uppercase"
                                            >
                                                Εκκρεμεί
                                            </span>
                                        @elseif ($app->status == 2)
                                            <span
                                                class="inline-flex items-center rounded-full bg-emerald-100 px-2.5 py-0.5 text-xs font-bold text-emerald-800 uppercase"
                                            >
                                                Ολοκληρώθηκε
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-0.5 text-xs font-bold text-slate-500 uppercase"
                                            >
                                                Ακυρώθηκε
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <form
                                            action="{{ route('admin.updateStatus', $app->id) }}"
                                            method="POST"
                                            class="flex justify-center gap-2"
                                        >
                                            @csrf
                                            <select
                                                name="status"
                                                onchange="this.form.submit()"
                                                class="rounded-lg border-slate-200 bg-slate-50 text-xs focus:border-red-500 focus:ring-red-500"
                                            >
                                                <option value="1" {{ $app->status == 1 ? 'selected' : '' }}>
                                                    Εκκρεμεί
                                                </option>
                                                <option value="2" {{ $app->status == 2 ? 'selected' : '' }}>
                                                    Ολοκληρώθηκε
                                                </option>
                                                <option value="3" {{ $app->status == 3 ? 'selected' : '' }}>
                                                    Ακυρώθηκε
                                                </option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4">
                                        <button
                                            onclick="openCommentModal({{ $app->id }}, '{{ $app->license_plate }}')"
                                            class="rounded-lg p-2 text-slate-400 transition-colors hover:bg-blue-50 hover:text-blue-600"
                                            title="Σημειώσεις & Διαχείριση"
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
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"
                                                />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center font-medium text-slate-400">
                                        Δεν υπάρχουν προγραμματισμένα ραντεβού για σήμερα.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div
                id="commentModal"
                class="fixed inset-0 z-50 flex hidden items-center justify-center bg-slate-900/50 p-4 backdrop-blur-sm"
            >
                <div class="w-full max-w-lg transform overflow-hidden rounded-2xl bg-white shadow-xl transition-all">
                    <div class="flex items-center justify-between border-b border-slate-100 bg-slate-50 p-4">
                        <h3 class="font-bold text-slate-800">
                            Σημειώσεις:
                            <span id="modalPlate" class="text-red-600"></span>
                        </h3>
                        <button onclick="closeCommentModal()" class="text-slate-400 hover:text-slate-600">
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
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </button>
                    </div>

                    <form id="commentForm" method="POST" class="p-6">
                        @csrf
                        <div class="mb-4">
                            <label class="mb-2 block text-sm font-medium text-slate-700">Νέα Σημείωση</label>
                            <textarea
                                name="body"
                                rows="4"
                                class="w-full rounded-l border-slate-200 text-sm focus:border-red-500 focus:ring-red-500"
                                placeholder=" Γράψτε κάτι για αυτό το ραντεβού..."
                                required
                            ></textarea>
                        </div>

                        <div class="mt-6 flex justify-end gap-3">
                            <button
                                type="button"
                                onclick="closeCommentModal()"
                                class="rounded-xl px-4 py-2 text-sm font-bold text-slate-500 transition-all hover:bg-slate-100"
                            >
                                Ακύρωση
                            </button>
                            <button
                                type="submit"
                                class="rounded-xl bg-red-600 px-6 py-2 text-sm font-bold text-white shadow-lg shadow-red-500/30 transition-all hover:bg-red-700"
                            >
                                Αποθήκευση
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

        // Ενημερώνουμε το Action του Form δυναμικά
        form.action = `/admin/appointments/${id}/comments`
        plateSpan.innerText = plate

        modal.classList.remove('hidden')
    }

    function closeCommentModal() {
        document.getElementById('commentModal').classList.add('hidden')
    }
</script>
