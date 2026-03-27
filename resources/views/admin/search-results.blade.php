@extends('admin.admin')

@section('admin_content')
    <div class="container mx-auto max-w-6xl px-4 py-8">
        <h1 class="mb-2 text-3xl font-black text-slate-900">Αποτελέσματα Αναζήτησης</h1>
        <p class="mb-8 font-medium text-slate-600 italic">Αναζήτηση για: "{{ $query }}"</p>

        <div class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-xl">
            <table class="w-full text-left">
                <thead class="border-b border-slate-100 bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase">Ημερομηνία/Ώρα</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase">Πελάτης</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-slate-400 uppercase">Πινακίδα</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-slate-400 uppercase">Κατάσταση</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($appointments as $app)
                        <tr class="transition-colors hover:bg-slate-50">
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-900">
                                    {{ date('d/m/Y', strtotime($app->appointment_date)) }}
                                </div>
                                <div class="text-sm text-slate-500">
                                    {{ date('H:i', strtotime($app->appointment_time)) }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-900">{{ $app->customer_name }}</div>
                                <div class="text-sm text-slate-500">{{ $app->customer_phone }}</div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="rounded-lg bg-slate-900 px-3 py-1 font-mono font-bold text-white">
                                    {{ $app->license_plate }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{-- Εδώ μπορείς να βάλεις τα badges που έχουμε και στο dashboard --}}
                                @if ($app->status == 2)
                                    <span class="text-xs font-bold text-emerald-600 uppercase">✅ Ολοκληρώθηκε</span>
                                @else
                                    <span class="text-xs font-bold text-amber-600 uppercase">⏳ Εκκρεμεί</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center font-medium text-slate-400">
                                Δεν βρέθηκαν αποτελέσματα για την αναζήτησή σας.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
