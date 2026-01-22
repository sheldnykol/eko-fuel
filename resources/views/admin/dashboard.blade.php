@extends('layouts.app')

@section('content')
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
                                    PIN
                                </th>
                                <th class="px-6 py-4 text-xs font-bold tracking-widest text-slate-400 uppercase">
                                    Κατάσταση
                                </th>
                                <th
                                    class="px-6 py-4 text-center text-xs font-bold tracking-widest text-slate-400 uppercase"
                                >
                                    Ενέργειες
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
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
                                            class="rounded border border-red-100 bg-red-50 px-2 py-1 font-mono font-black text-red-600 uppercase"
                                        >
                                            {{ $app->booking_pin }}
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
        </div>
    </div>
@endsection
