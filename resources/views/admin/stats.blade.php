@extends('admin.admin')

@section('admin_title', 'Στατιστικά')

@section('admin_content')
    <x-admin.page-header title="Στατιστικά" :subtitle="'Πλυντήριο · έτος ' . $selectedYear">
        <form action="{{ route('admin.stats') }}" method="GET">
            <label for="year" class="sr-only">Έτος</label>
            <select
                name="year"
                id="year"
                onchange="this.form.submit()"
                class="rounded-lg border border-slate-200 bg-white px-2.5 py-1.5 text-[13px] font-medium text-slate-700 focus:border-red-500 focus:ring-1 focus:ring-red-500 focus:outline-none"
            >
                @foreach ($availableYears as $year)
                    <option value="{{ $year }}" @selected($selectedYear == $year)>{{ $year }}</option>
                @endforeach
            </select>
        </form>
    </x-admin.page-header>

    @php
        $cards = [
            ['label' => 'Ολοκληρωμένα', 'value' => $totals['completed'], 'icon' => 'check-circle', 'tone' => 'bg-emerald-50 text-emerald-600'],
            ['label' => 'Μοναδικοί πελάτες', 'value' => $totals['customers'], 'icon' => 'users', 'tone' => 'bg-blue-50 text-blue-600'],
            ['label' => 'Καλύτερος μήνας', 'value' => $totals['best_month'], 'icon' => 'trending', 'tone' => 'bg-red-50 text-red-600'],
            ['label' => 'Ποσοστό ακυρώσεων', 'value' => $totals['cancel_rate'] . '%', 'icon' => 'x-circle', 'tone' => 'bg-slate-100 text-slate-500'],
        ];
    @endphp

    <div class="mb-5 grid grid-cols-2 gap-3 xl:grid-cols-4">
        @foreach ($cards as $card)
            <div class="flex items-center gap-3 rounded-xl border border-slate-200 bg-white p-3 sm:p-4">
                <span class="{{ $card['tone'] }} hidden rounded-lg p-2 sm:block"><x-admin.icon :name="$card['icon']" class="h-4 w-4" /></span>
                <div class="min-w-0">
                    <p class="truncate text-[11px] font-medium text-slate-500 sm:text-xs">{{ $card['label'] }}</p>
                    <p class="truncate text-base leading-tight font-semibold text-slate-900 tabular-nums sm:text-lg">{{ $card['value'] }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 gap-5 lg:grid-cols-3">
        <section class="rounded-xl border border-slate-200 bg-white p-4 lg:col-span-2">
            <div class="mb-3 flex flex-wrap items-center justify-between gap-2">
                <h2 class="text-sm font-semibold text-slate-900">Ραντεβού ανά μήνα</h2>
                <div class="flex items-center gap-3 text-[11px] text-slate-500">
                    <span class="flex items-center gap-1.5"><span class="h-2 w-2 rounded-sm bg-red-600"></span> Ολοκληρωμένα</span>
                    <span class="flex items-center gap-1.5"><span class="h-2 w-2 rounded-sm bg-slate-300"></span> Ακυρωμένα</span>
                </div>
            </div>
            <div class="h-64 sm:h-72">
                <canvas id="appointmentsChart" aria-label="Ραντεβού ανά μήνα" role="img"></canvas>
            </div>
        </section>

        <section class="rounded-xl border border-slate-200 bg-white">
            <h2 class="border-b border-slate-100 px-4 py-3 text-sm font-semibold text-slate-900">Top πελάτες</h2>
            <ol class="divide-y divide-slate-100">
                @forelse ($topCustomers as $customer)
                    <li class="flex items-center gap-3 px-4 py-2.5">
                        <span class="w-4 text-[12px] font-semibold text-slate-400 tabular-nums">{{ $loop->iteration }}</span>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-[13px] font-medium text-slate-900">{{ $customer->customer_name }}</p>
                            <a href="tel:{{ $customer->customer_phone }}" class="text-[12px] text-slate-500 hover:text-slate-900">{{ $customer->customer_phone }}</a>
                        </div>
                        <span class="rounded-full bg-slate-100 px-2 py-0.5 text-[12px] font-semibold text-slate-700 tabular-nums">{{ $customer->total }}</span>
                    </li>
                @empty
                    <li class="px-4 py-8 text-center text-[13px] text-slate-400">Δεν υπάρχουν δεδομένα για το {{ $selectedYear }}.</li>
                @endforelse
            </ol>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
    <script>
        ;(function () {
            const el = document.getElementById('appointmentsChart')
            if (!window.Chart || !el) return
            Chart.defaults.font.family = 'Inter, system-ui, sans-serif'
            Chart.defaults.font.size = 11
            Chart.defaults.color = '#64748b'
            new Chart(el, {
                type: 'bar',
                data: {
                    labels: @json($labels),
                    datasets: [
                        { label: 'Ολοκληρωμένα', data: @json($data), backgroundColor: '#dc2626', borderRadius: 4, maxBarThickness: 22 },
                        { label: 'Ακυρωμένα', data: @json($cancelledData), backgroundColor: '#cbd5e1', borderRadius: 4, maxBarThickness: 22 },
                    ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: { mode: 'index', intersect: false },
                    plugins: { legend: { display: false } },
                    scales: {
                        x: { grid: { display: false }, ticks: { maxRotation: 0, autoSkip: true, autoSkipPadding: 6 } },
                        y: { beginAtZero: true, ticks: { precision: 0 }, grid: { color: '#f1f5f9' }, border: { display: false } },
                    },
                },
            })
        })()
    </script>
@endpush
