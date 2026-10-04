@extends('layouts.app')

@section('title', 'Πρατήρια EKO στη Λάρισα: Διευθύνσεις, Ωράριο & Τηλέφωνα')
@section('meta_description', 'Τα 4 πρατήρια καυσίμων ΕΚΟ Δράμη: Βόλου 12, Λ. Καραμανλή 102 και Γεωργιάδου 28 στη Λάρισα και Ε.Ο. Βόλου-Πορταριάς. Διευθύνσεις, ωράριο λειτουργίας και τηλέφωνα επικοινωνίας.')

@php
    use App\Support\Seo;

    $schemas = array_map(fn ($id) => Seo::stationSchema($id), array_keys($allStations));
@endphp

@push('schema')
    <script type="application/ld+json">{!! Seo::graph(...$schemas) !!}</script>
@endpush

@section('content')
    <section class="bg-slate-50 py-10 md:py-14">
        <div class="mx-auto max-w-6xl px-4 md:px-6">
            <h1 class="text-2xl font-black tracking-tight text-slate-900 md:text-3xl">Τα πρατήριά μας</h1>
            <p class="mt-1 max-w-2xl text-sm text-slate-600">
                Τέσσερα πρατήρια καυσίμων EKO στη Λάρισα και στην Πορταριά. Επικοινωνήστε με το πρατήριο που σας εξυπηρετεί.
            </p>

            <div class="mt-8 grid grid-cols-1 gap-4 md:grid-cols-2">
                @foreach ($allStations as $id => $station)
                    <article class="flex flex-col rounded-xl border border-slate-200 bg-white p-5">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <h2 class="text-lg font-bold text-slate-900">{{ $station['title'] }}</h2>
                                <p class="text-sm text-slate-600">{{ $station['street'] }}, {{ $station['city'] }}</p>
                            </div>
                            <span
                                class="status-badge shrink-0 rounded-full bg-slate-100 px-2.5 py-0.5 text-[11px] font-semibold text-slate-600"
                                data-opens="{{ $station['opens'] }}"
                                data-closes="{{ $station['closes'] }}"
                            ></span>
                        </div>

                        <dl class="mt-4 space-y-1.5 text-sm">
                            <div class="flex gap-3">
                                <dt class="w-20 shrink-0 text-slate-500">Ωράριο</dt>
                                <dd class="font-medium text-slate-800">Καθημερινά {{ $station['opens'] }} - {{ $station['closes'] }}</dd>
                            </div>
                            <div class="flex gap-3">
                                <dt class="w-20 shrink-0 text-slate-500">Τηλέφωνο</dt>
                                <dd><a href="tel:{{ $station['phone'] }}" class="font-medium text-slate-800 hover:text-[#e21838]">{{ $station['phone'] }}</a></dd>
                            </div>
                        </dl>

                        <div class="mt-5 flex flex-wrap gap-2 border-t border-slate-100 pt-4">
                            <a href="{{ route('station.show', $id) }}" class="rounded-lg bg-slate-900 px-3.5 py-2 text-[13px] font-bold text-white hover:bg-slate-800">Τιμές & υπηρεσίες</a>
                            <a href="{{ Seo::mapsUrl($station) }}" target="_blank" rel="noopener" class="rounded-lg border border-slate-300 px-3.5 py-2 text-[13px] font-bold text-slate-800 hover:bg-slate-50">Οδηγίες χάρτη</a>
                            <a href="tel:{{ $station['phone'] }}" class="rounded-lg border border-slate-300 px-3.5 py-2 text-[13px] font-bold text-slate-800 hover:bg-slate-50">Κλήση</a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <script>
        ;(function () {
            const now = new Intl.DateTimeFormat('en-GB', { timeZone: 'Europe/Athens', hour: '2-digit', minute: '2-digit', hourCycle: 'h23' }).format(new Date())
            document.querySelectorAll('.status-badge').forEach(badge => {
                const open = now >= badge.dataset.opens && now < badge.dataset.closes
                badge.textContent = open ? 'Ανοιχτό τώρα' : 'Κλειστό'
                badge.classList.toggle('bg-emerald-50', open)
                badge.classList.toggle('text-emerald-700', open)
                badge.classList.toggle('bg-slate-100', !open)
                badge.classList.toggle('text-slate-600', !open)
            })
        })()
    </script>
@endsection
