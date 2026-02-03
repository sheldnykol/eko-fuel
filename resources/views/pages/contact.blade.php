@extends('layouts.app')

@section('content')
    <section class="min-h-screen bg-slate-50 py-12">
        <div class="container mx-auto max-w-5xl px-4">
            <div class="mb-16 text-center">
                <h2 class="mb-3 text-4xl font-black tracking-tight text-slate-900">Eπικοινωνία</h2>
                <p class="mx-auto max-w-xl text-lg text-slate-500">
                    Βρείτε το πλησιέστερο σημείο εξυπηρέτησης σας σε λιγότερο από 1 λεπτό.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-12 lg:grid-cols-2">
                @foreach ($allStations as $id => $station)
                    <div class="group relative flex flex-col space-y-4">
                        <div
                            class="flex items-center space-x-4 rounded-[2rem] border border-slate-100 bg-white p-6 shadow-sm transition-all duration-300 group-hover:border-red-100 group-hover:shadow-md"
                        >
                            <div
                                class="rounded-2xl bg-red-50 p-4 text-red-600 transition-colors group-hover:bg-red-600 group-hover:text-white"
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
                                        stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                                    />
                                </svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold tracking-[0.1em] text-slate-400 uppercase">
                                    Γραμμή Επικοινωνίας
                                </p>
                                <a
                                    href="tel:{{ $station['phone'] }}"
                                    class="text-xl font-black text-slate-800 transition-colors hover:text-red-600"
                                >
                                    {{ $station['phone'] }}
                                </a>
                            </div>
                        </div>

                        <div
                            class="flex items-center space-x-4 rounded-[2rem] border border-slate-100 bg-white p-6 shadow-sm transition-all duration-300 group-hover:border-red-100 group-hover:shadow-md"
                        >
                            <div class="rounded-2xl bg-slate-50 p-4 text-slate-400">
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
                            <div class="flex-1">
                                <p class="text-[10px] font-bold tracking-[0.1em] text-slate-400 uppercase">Τοποθεσία</p>
                                <p class="text-lg leading-tight font-bold text-slate-800">{{ $station['address'] }}</p>
                            </div>
                            @if (isset($station['map_url']))
                                <a
                                    href="{{ $station['map_url'] }}"
                                    target="_blank"
                                    class="rounded-xl bg-slate-900 px-4 py-2 text-xs font-bold text-white transition-colors hover:bg-red-600"
                                >
                                    Χάρτης
                                </a>
                            @endif
                        </div>

                        <div
                            class="rounded-[2rem] border border-slate-100 bg-white p-8 shadow-sm transition-all duration-300 group-hover:shadow-md"
                        >
                            <div class="mb-4 flex items-center justify-between">
                                <h3 class="text-lg font-black text-slate-900">Ωράριο</h3>
                                <span
                                    id="status-badge-{{ $id }}"
                                    class="rounded-full bg-emerald-100 px-3 py-1 text-[10px] font-bold text-emerald-600 uppercase"
                                >
                                    Ανοιχτά τώρα
                                </span>
                            </div>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between border-b border-slate-50 pb-2">
                                    <span class="text-sm font-medium text-slate-500">Δευτέρα - Κυριακή</span>
                                    <span class="font-bold text-slate-900">06:00 - 23:00</span>
                                </div>
                                <p class="text-[11px] text-slate-400 italic">
                                    * Το ωράριο ενδέχεται να διαφοροποιείται τις αργίες.
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @include('partials.map')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkStatus = () => {
                const now = new Date()
                const hour = now.getHours()

                // Ορισμός ωραρίου: 06:00 έως 23:00 (δηλαδή μέχρι τις 22:59)
                const isOpen = hour >= 6 && hour < 23

                // Βρίσκουμε όλα τα badges στη σελίδα
                const badges = document.querySelectorAll('.status-badge')

                badges.forEach(badge => {
                    if (isOpen) {
                        badge.innerText = 'Ανοιχτά τώρα'
                        badge.classList.remove('bg-red-100', 'text-red-600')
                        badge.classList.add('bg-emerald-100', 'text-emerald-600')
                    } else {
                        badge.innerText = 'Κλειστά'
                        badge.classList.remove('bg-emerald-100', 'text-emerald-600')
                        badge.classList.add('bg-red-100', 'text-red-600')
                    }
                })
            }

            // Εκτέλεση ελέγχου αμέσως
            checkStatus()

            // Προαιρετικό: Έλεγχος κάθε 1 λεπτό μήπως αλλάξει η ώρα ενώ ο χρήστης είναι στη σελίδα
            setInterval(checkStatus, 60000)
        })
    </script>
@endsection
