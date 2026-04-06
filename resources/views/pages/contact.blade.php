@extends('layouts.app')

@section('content')
    <section class="min-h-screen bg-slate-50 py-12">
        <div class="container mx-auto max-w-6xl px-4">
            <div class="mb-16 text-center">
                <h2 class="mb-3 text-4xl font-black tracking-tight text-slate-900">Τα Πρατήριά μας</h2>
                <p class="mx-auto max-w-xl text-lg text-slate-500">
                    4 σημεία εξυπηρέτησης EKO Fuel στην περιοχή σας, έτοιμα να σας εξυπηρετήσουν.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                @foreach ($allStations as $id => $station)
                    <div
                        class="group relative overflow-hidden rounded-[2.5rem] border border-slate-200 bg-white p-2 shadow-sm transition-all duration-500 hover:-translate-y-1 hover:border-red-200 hover:shadow-xl"
                    >
                        <div class="p-6">
                            <div class="mb-6 flex items-start justify-between">
                                <div>
                                    <span
                                        class="mb-1 block text-[10px] font-bold tracking-widest text-red-600 uppercase"
                                    >
                                        EKO Station
                                    </span>
                                    <h3 class="text-2xl font-black text-slate-800">{{ $station['name'] }}</h3>
                                </div>
                                <span
                                    id="status-badge-{{ $id }}"
                                    data-open="{{ $station['name'] == 'ΓΕΩΡΓΙΑΔΟΥ 28' ? 22 : ($station['name'] == 'ΕΟ ΒΟΛΟΥ ΠΟΡΤΑΡΙΑΣ (χ.θ 11+300 αριστερα)' ? 21 : 23) }}"
                                    class="status-badge rounded-full px-4 py-1 text-[11px] font-bold tracking-wider uppercase"
                                >
                                    Έλεγχος...
                                </span>
                            </div>

                            <div class="space-y-4">
                                <div
                                    class="flex items-center space-x-4 rounded-2xl bg-slate-50 p-4 transition-colors group-hover:bg-red-50/50"
                                >
                                    <div
                                        class="rounded-xl bg-white p-2 text-slate-400 shadow-sm group-hover:text-red-500"
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
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                            />
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                            />
                                        </svg>
                                    </div>
                                    <p class="text-sm font-bold text-slate-700">{{ $station['address'] }}</p>
                                </div>

                                <div
                                    class="flex items-center justify-between rounded-2xl bg-slate-50 p-4 transition-colors group-hover:bg-red-50/50"
                                >
                                    <div class="flex items-center space-x-4">
                                        <div
                                            class="rounded-xl bg-white p-2 text-slate-400 shadow-sm group-hover:text-red-500"
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
                                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                                                />
                                            </svg>
                                        </div>
                                        <span class="text-sm font-bold text-slate-700">{{ $station['phone'] }}</span>
                                    </div>
                                    <a
                                        href="tel:{{ $station['phone'] }}"
                                        class="rounded-lg bg-red-600 px-3 py-1.5 text-xs font-bold text-white shadow-sm hover:bg-red-700"
                                    >
                                        Κλήση
                                    </a>
                                </div>

                                <div class="mt-4 border-t border-slate-100 pt-4">
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="font-medium text-slate-500">Ωράριο Λειτουργίας:</span>
                                        <span class="font-black text-slate-900">
                                            @if ($station['name'] == 'ΓΕΩΡΓΙΑΔΟΥ 28')
                                                06:00 - 22:00
                                            @elseif ($station['name'] == 'ΕΟ ΒΟΛΟΥ ΠΟΡΤΑΡΙΑΣ (χ.θ 11+300 αριστερα)')
                                                06:00 - 21:00
                                            @else
                                                06:00 - 23:00
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8 flex gap-3">
                                @if (isset($station['map_url']))
                                    <a
                                        href="{{ $station['map_url'] }}"
                                        target="_blank"
                                        class="flex-1 rounded-2xl bg-slate-900 py-4 text-center text-sm font-bold text-white transition-all hover:bg-red-600"
                                    >
                                        Οδηγίες Χάρτη
                                    </a>
                                @endif

                                <a
                                    href="{{ route('station.show', $id) }}"
                                    class="flex-1 rounded-2xl border border-slate-200 py-4 text-center text-sm font-bold text-slate-800 transition-all hover:bg-slate-50"
                                >
                                    Λεπτομέρειες
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkStatus = () => {
                const now = new Date()
                const hour = now.getHours()

                document.querySelectorAll('.status-badge').forEach(badge => {
                    const closeHour = parseInt(badge.getAttribute('data-open'))
                    const isOpen = hour >= 6 && hour < closeHour

                    if (isOpen) {
                        badge.innerText = 'Ανοιχτά τώρα'
                        badge.className =
                            'status-badge rounded-full bg-emerald-100 px-4 py-1 text-[11px] font-bold uppercase tracking-wider text-emerald-600'
                    } else {
                        badge.innerText = 'Κλειστά'
                        badge.className =
                            'status-badge rounded-full bg-red-100 px-4 py-1 text-[11px] font-bold uppercase tracking-wider text-red-600'
                    }
                })
            }
            checkStatus()
            setInterval(checkStatus, 60000)
        })
    </script>
@endsection
