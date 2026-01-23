@extends('admin.admin')

@section('admin_content')
    <div class="container mx-auto max-w-6xl">
        <div class="mb-8">
            <h1 class="text-3xl font-black text-slate-900">📊 Στατιστικά & Αναφορές</h1>
            <p class="font-medium text-slate-600">Συνολική εικόνα πλυντηρίου για το έτος {{ date('Y') }}</p>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            <div class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm lg:col-span-2">
                <h3 class="mb-6 text-xl font-bold text-slate-800">Κίνηση Ραντεβού ανά Μήνα</h3>
                <div class="h-[300px]">
                    <canvas id="appointmentsChart"></canvas>
                </div>
            </div>

            <div class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
                <h3 class="mb-6 text-xl font-bold text-slate-800">Top Πελάτες</h3>
                <div class="space-y-6">
                    @forelse ($topCustomers as $customer)
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-bold text-slate-900">{{ $customer->customer_name }}</p>
                                <p class="text-xs text-slate-500">{{ $customer->customer_phone }}</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-black text-red-600">{{ $customer->total }}</span>
                                <span class="text-xs text-slate-400">επισκ.</span>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-slate-400 italic">Δεν υπάρχουν δεδομένα ακόμα.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('appointmentsChart').getContext('2d')
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($labels) !!},
                    datasets: [
                        {
                            label: 'Αριθμός Ραντεβού',
                            data: {!! json_encode($data) !!},
                            borderColor: '#e21838',
                            backgroundColor: 'rgba(226, 24, 56, 0.1)',
                            borderWidth: 4,
                            pointBackgroundColor: '#fff',
                            pointBorderColor: '#e21838',
                            pointRadius: 6,
                            tension: 0.4,
                            fill: true,
                        },
                    ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { stepSize: 1 },
                        },
                    },
                },
            })
        })
    </script>
@endsection
