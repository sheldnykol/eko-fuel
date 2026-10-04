@extends('layouts.app')

@php
    use App\Support\Seo;

    $isGeorgiadou = (int) $id === 3;
    $isKaramanli = (int) $id === 2;
@endphp

@section('title', $station['seo_title'] ?? $station['title'] . ' - Πρατήριο Καυσίμων ' . $station['city'])
@section('meta_description', $station['description'] . ' Ωράριο ' . $station['opens'] . '-' . $station['closes'] . ', τηλ. ' . $station['phone'] . '.')
@section('og_image', Seo::image($station['image']))

@push('schema')
    <script type="application/ld+json">{!! Seo::graph(Seo::stationSchema($id), Seo::breadcrumbs([['Αρχική', url('/')], ['Πρατήρια', route('stations.show')], [$station['title'], route('station.show', $id)]])) !!}</script>
@endpush

@section('content')
    <section class="border-b border-slate-200 bg-white">
        <div class="mx-auto grid max-w-6xl grid-cols-1 items-center gap-8 px-4 py-8 md:grid-cols-2 md:px-6 md:py-12">
            <div>
                <nav class="mb-3 text-[13px] text-slate-500" aria-label="Breadcrumb">
                    <a href="{{ url('/') }}" class="hover:text-slate-900">Αρχική</a>
                    <span class="mx-1">/</span>
                    <a href="{{ route('stations.show') }}" class="hover:text-slate-900">Πρατήρια</a>
                    <span class="mx-1">/</span>
                    <span class="text-slate-700">{{ $station['title'] }}</span>
                </nav>
                <h1 class="text-2xl font-black tracking-tight text-slate-900 md:text-4xl">
                    {{ $station['title'] }}
                    <span class="mt-1 block text-base font-semibold text-slate-500 md:text-lg">Πρατήριο καυσίμων EKO, {{ $station['city'] }}</span>
                </h1>

                <dl class="mt-6 space-y-2 text-sm">
                    <div class="flex gap-3">
                        <dt class="w-20 shrink-0 text-slate-500">Διεύθυνση</dt>
                        <dd class="font-medium text-slate-800">{{ $station['street'] }}, {{ $station['city'] }}</dd>
                    </div>
                    <div class="flex gap-3">
                        <dt class="w-20 shrink-0 text-slate-500">Ωράριο</dt>
                        <dd class="font-medium text-slate-800">Καθημερινά {{ $station['opens'] }} - {{ $station['closes'] }}</dd>
                    </div>
                    <div class="flex gap-3">
                        <dt class="w-20 shrink-0 text-slate-500">Τηλέφωνο</dt>
                        <dd><a href="tel:{{ $station['phone'] }}" class="font-medium text-slate-800 hover:text-[#e21838]">{{ $station['phone'] }}</a></dd>
                    </div>
                </dl>

                <div class="mt-6 flex flex-wrap gap-2">
                    @if ($station['has_wash'])
                        <a href="{{ route('pages.booking') }}" class="rounded-lg bg-[#e21838] px-4 py-2.5 text-sm font-bold text-white hover:bg-[#c4142f]">Ραντεβού πλυντηρίου</a>
                    @endif
                    <a href="{{ Seo::mapsUrl($station) }}" target="_blank" rel="noopener" class="rounded-lg border border-slate-300 px-4 py-2.5 text-sm font-bold text-slate-800 hover:bg-slate-50">Οδηγίες χάρτη</a>
                    <a href="tel:{{ $station['phone'] }}" class="rounded-lg border border-slate-300 px-4 py-2.5 text-sm font-bold text-slate-800 hover:bg-slate-50">Κλήση</a>
                </div>
            </div>

            <img
                src="{{ Seo::image($station['image']) }}"
                alt="{{ $station['title'] }} - πρατήριο EKO στην {{ $station['city'] }}"
                width="1200"
                height="800"
                class="aspect-[3/2] w-full rounded-xl border border-slate-200 object-cover"
                fetchpriority="high"
            />
        </div>
    </section>

    @include('partials.gas_prices', ['prices' => $station['prices']])

    <section class="bg-white py-10 md:py-14">
        <div class="mx-auto max-w-6xl px-4 md:px-6">
            <h2 class="text-xl font-bold text-slate-900 md:text-2xl">Υπηρεσίες πρατηρίου</h2>
            <p class="mt-1 max-w-2xl text-sm text-slate-600">{{ $station['description'] }}</p>

            <div class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-2">
                @if ($station['has_wash'])
                    <div class="rounded-xl border border-slate-200 p-5">
                        <h3 class="font-bold text-slate-900">Πλυντήριο αυτοκινήτων</h3>
                        <p class="mt-1 text-sm text-slate-600">
                            Πλύσιμο μέσα-έξω, εξωτερικό πλύσιμο, βιολογικός καθαρισμός και Fast Track χωρίς αναμονή. Κλείστε ώρα
                            online χωρίς εγγραφή.
                        </p>
                        <a href="{{ route('pages.booking') }}" class="mt-3 inline-block text-sm font-bold text-[#e21838] hover:underline">Κλείστε ραντεβού</a>
                    </div>
                @endif

                @if ($isKaramanli)
                    <div class="rounded-xl border border-slate-200 p-5">
                        <h3 class="font-bold text-slate-900">Υγραέριο κίνησης (Autogas LPG)</h3>
                        <p class="mt-1 text-sm text-slate-600">Σταθμός ανεφοδιασμού υγραερίου κίνησης στην έξοδο της Λάρισας προς Αθήνα.</p>
                    </div>
                    <div class="rounded-xl border border-slate-200 p-5 md:col-span-2">
                        <h3 class="font-bold text-slate-900">Self service πλυντήριο: οδηγίες</h3>
                        <ol class="mt-3 grid grid-cols-1 gap-3 text-sm text-slate-600 md:grid-cols-2">
                            <li><strong class="text-slate-800">1. Υψηλή πίεση.</strong> Πρόπλυση και κύρια πλύση με ζεστό αποσκληρυμένο νερό και καθαριστικό.</li>
                            <li><strong class="text-slate-800">2. Βούρτσα.</strong> Μαλακή βούρτσα με ενεργό αφρό. Ξεπλύνετε τη βούρτσα με νερό πριν τη χρήση.</li>
                            <li><strong class="text-slate-800">3. Ξέβγαλμα.</strong> Κρύο καθαρό νερό υψηλής πίεσης απομακρύνει αφρό και ρύπους.</li>
                            <li><strong class="text-slate-800">4. Ζεστό κερί.</strong> Προστασία χρώματος μεγάλης διάρκειας με κερί καρναούβης.</li>
                            <li><strong class="text-slate-800">5. Στέγνωμα.</strong> Απιονισμένο νερό και γυαλιστικό για λάμψη χωρίς σημάδια.</li>
                        </ol>
                    </div>
                @endif

                @if ($isGeorgiadou)
                    <div class="rounded-xl border border-slate-200 p-5">
                        <h3 class="font-bold text-slate-900">Φορτιστής ηλεκτρικών οχημάτων 22kW</h3>
                        <p class="mt-1 text-sm text-slate-600">Σταθμός φόρτισης ηλεκτρικών αυτοκινήτων. Δευτέρα έως Σάββατο, 06:00 - 22:00.</p>
                    </div>
                    <div class="rounded-xl border border-slate-200 p-5">
                        <h3 class="font-bold text-slate-900">Αυτόματος πωλητής καυσίμων</h3>
                        <ol class="mt-2 space-y-1 text-sm text-slate-600">
                            <li>1. Επιλέξτε «Κάρτα» στο μενού.</li>
                            <li>2. Αριθμός κυκλοφορίας και «Συνέχεια».</li>
                            <li>3. Απόδειξη: πατήστε «Συνέχεια».</li>
                            <li>4. Επιλέξτε καύσιμο και αντλία (7-10).</li>
                            <li>5. Επιλέξτε το ποσό.</li>
                            <li>6. Κάρτα στο POS και PIN.</li>
                            <li>7. Ανεφοδιασμός (πιέστε τη λαβή).</li>
                            <li>8. Επιστροφή της λαβής, η απόδειξη βγαίνει αυτόματα.</li>
                        </ol>
                    </div>
                @endif

                @unless ($isGeorgiadou)
                    <div class="rounded-xl border border-slate-200 p-5">
                        <h3 class="font-bold text-slate-900">Κατάστημα</h3>
                        <p class="mt-1 text-sm text-slate-600">Λιπαντικά, αντιψυκτικά, χημικά και αξεσουάρ αυτοκινήτου.</p>
                        <a href="{{ route('station.products', $id) }}" class="mt-3 inline-block text-sm font-bold text-[#e21838] hover:underline">Δείτε τα προϊόντα</a>
                    </div>
                @endunless
            </div>
        </div>
    </section>

    <section class="border-t border-slate-200 bg-slate-50 py-10">
        <div class="mx-auto max-w-6xl px-4 md:px-6">
            <h2 class="text-lg font-bold text-slate-900">Άλλα πρατήρια ΕΚΟ Δράμη</h2>
            <ul class="mt-4 grid grid-cols-1 gap-3 sm:grid-cols-3">
                @foreach (config('stations') as $otherId => $other)
                    @continue((int) $otherId === (int) $id)
                    <li>
                        <a href="{{ route('station.show', $otherId) }}" class="block rounded-lg border border-slate-200 bg-white p-4 hover:border-slate-300">
                            <span class="block text-sm font-bold text-slate-900">{{ $other['title'] }}</span>
                            <span class="text-[13px] text-slate-500">{{ $other['street'] }}, {{ $other['city'] }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endsection
