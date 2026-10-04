@extends('admin.admin')

@section('admin_title', 'Αναζήτηση')

@section('admin_content')
    <x-admin.page-header
        title="Αναζήτηση"
        :subtitle="$query !== '' ? $appointments->count() . ' αποτελέσματα για «' . $query . '»' : 'Αναζήτηση με πινακίδα, όνομα ή τηλέφωνο'"
    />

    <form action="{{ route('admin.search') }}" method="GET" class="mb-4">
        <label class="relative block max-w-md">
            <span class="sr-only">Αναζήτηση</span>
            <x-admin.icon name="search" class="pointer-events-none absolute top-1/2 left-3 h-4 w-4 -translate-y-1/2 text-slate-400" />
            <input
                type="search"
                name="query"
                value="{{ $query }}"
                autofocus
                placeholder="Πινακίδα, όνομα ή τηλέφωνο"
                class="w-full rounded-lg border border-slate-200 bg-white py-2 pr-3 pl-9 text-[13px] focus:border-red-500 focus:ring-1 focus:ring-red-500 focus:outline-none"
            />
        </label>
    </form>

    @if ($appointments->isEmpty())
        <div class="rounded-xl border border-dashed border-slate-300 bg-white px-4 py-12 text-center text-[13px] text-slate-500">
            {{ $query !== '' ? 'Δεν βρέθηκαν ραντεβού.' : 'Γράψτε κάτι για αναζήτηση.' }}
        </div>
    @else
        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white">
            <ul class="divide-y divide-slate-100 md:hidden">
                @foreach ($appointments as $app)
                    <li>
                        <a href="{{ route('admin.dashboard', ['date' => $app->appointment_date]) }}" class="flex items-center gap-3 px-3.5 py-3 hover:bg-slate-50">
                            <div class="w-14 shrink-0 text-center">
                                <p class="text-[13px] font-semibold text-slate-900 tabular-nums">{{ date('d/m', strtotime($app->appointment_date)) }}</p>
                                <p class="text-[11px] text-slate-500 tabular-nums">{{ substr($app->appointment_time, 0, 5) }}</p>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="truncate text-[13px] font-medium text-slate-900">{{ $app->customer_name }}</p>
                                <p class="mt-0.5 flex items-center gap-1.5 text-[12px] text-slate-500">
                                    <span class="rounded bg-slate-900 px-1.5 py-px font-mono text-[10px] text-white">{{ $app->license_plate }}</span>
                                    {{ $app->customer_phone }}
                                </p>
                            </div>
                            <x-admin.status-badge :status="$app->status" />
                        </a>
                    </li>
                @endforeach
            </ul>

            <table class="hidden w-full text-left text-[13px] md:table">
                <thead class="border-b border-slate-200 bg-slate-50 text-[11px] font-medium tracking-wide text-slate-500 uppercase">
                    <tr>
                        <th class="px-4 py-2.5">Ημερομηνία</th>
                        <th class="px-4 py-2.5">Πελάτης</th>
                        <th class="px-4 py-2.5">Πινακίδα</th>
                        <th class="px-4 py-2.5">Πακέτο</th>
                        <th class="px-4 py-2.5">Κατάσταση</th>
                        <th class="px-4 py-2.5"><span class="sr-only">Άνοιγμα</span></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($appointments as $app)
                        <tr class="hover:bg-slate-50">
                            <td class="px-4 py-2.5 whitespace-nowrap tabular-nums">
                                <span class="font-medium text-slate-900">{{ date('d/m/Y', strtotime($app->appointment_date)) }}</span>
                                <span class="ml-1 text-slate-500">{{ substr($app->appointment_time, 0, 5) }}</span>
                            </td>
                            <td class="px-4 py-2.5">
                                <p class="font-medium text-slate-900">{{ $app->customer_name }}</p>
                                <p class="text-[12px] text-slate-500">{{ $app->customer_phone }}</p>
                            </td>
                            <td class="px-4 py-2.5">
                                <span class="rounded bg-slate-900 px-1.5 py-0.5 font-mono text-[11px] text-white">{{ $app->license_plate }}</span>
                            </td>
                            <td class="px-4 py-2.5 text-slate-600">{{ $app->wash_type }}</td>
                            <td class="px-4 py-2.5"><x-admin.status-badge :status="$app->status" /></td>
                            <td class="px-4 py-2.5 text-right">
                                <a href="{{ route('admin.dashboard', ['date' => $app->appointment_date]) }}" class="inline-flex items-center gap-1 text-[12px] font-medium text-red-600 hover:text-red-700">
                                    Άνοιγμα <x-admin.icon name="chevron-right" class="h-3.5 w-3.5" />
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
