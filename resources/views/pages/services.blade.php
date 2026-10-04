@extends('layouts.app')

@section('title', 'Πλυντήριο Αυτοκινήτων Λάρισα: Υπηρεσίες & Τιμές')
@section('meta_description', 'Τιμές πλυντηρίου αυτοκινήτων στη Λάρισα: πλύσιμο μέσα-έξω από 15€, εξωτερικό, βιολογικός καθαρισμός, Fast Track, self-service πλυντήριο και υγραέριο κίνησης.')

@php
    use App\Http\Controllers\CancellationController;
    use App\Support\BookingRules;
    use App\Support\Seo;

    $stations = Seo::stations();
    $prices = BookingRules::PRICES;
    $washDays = BookingRules::WASH_DAYS;
    $faq = [
        'Πόσο κοστίζει το πλύσιμο αυτοκινήτου στο πλυντήριο ΕΚΟ στη Λάρισα;' =>
            'Για επιβατικό αυτοκίνητο το πλύσιμο μέσα-έξω κοστίζει περίπου ' . BookingRules::PRICES['ΙΧ']['ΜΕΣΑ-ΕΞΩ'] . '€, μόνο έξω περίπου ' . BookingRules::PRICES['ΙΧ']['ΕΞΩ'] . '€ και μόνο μέσα περίπου ' . BookingRules::PRICES['ΙΧ']['ΜΕΣΑ'] . '€. Ο βιολογικός καθαρισμός κοστίζει περίπου ' . BookingRules::PRICES['ΙΧ']['ΒΙΟΛΟΓΙΚΟΣ'] . '€. Οι τιμές είναι ενδεικτικές.',
        'Πώς κλείνω ραντεβού για πλύσιμο αυτοκινήτου;' =>
            'Κλείνετε ραντεβού online από τη σελίδα κράτησης, χωρίς εγγραφή. Επιλέγετε ημέρα, ώρα και πακέτο και λαμβάνετε επιβεβαίωση με SMS και email.',
        'Ποιες ημέρες γίνεται ο βιολογικός καθαρισμός;' =>
            'Ο βιολογικός καθαρισμός γίνεται Τρίτη έως Πέμπτη και διαρκεί από 3-4 ώρες έως μία ημέρα, ανάλογα με το όχημα.',
        'Μπορώ να ακυρώσω το ραντεβού μου;' =>
            'Ναι, online έως ' . CancellationController::DEADLINE_HOURS . ' ώρες πριν, από τον σύνδεσμο στο email επιβεβαίωσης ή από τη σελίδα ακύρωσης με το κινητό και την πινακίδα σας.',
        'Τι ώρες λειτουργούν τα πρατήρια ΕΚΟ Δράμη;' =>
            collect($stations)->map(fn ($s) => $s['title'] . ': ' . $s['opens'] . '-' . $s['closes'])->implode(', ') . '.',
        'Πού υπάρχει υγραέριο κίνησης (LPG) στη Λάρισα;' =>
            'Υγραέριο κίνησης (Autogas) θα βρείτε στο πρατήριο ΕΚΟ Λ. Καραμανλή 102, στο 1ο χλμ της Π.Ε.Ο. Λάρισας-Αθηνών.',
        'Κάνετε διανομή πετρελαίου και υγραερίου;' =>
            'Ναι. Μπορείτε να παραγγείλετε online πετρέλαιο κίνησης και υγραέριο θέρμανσης ή προπανίου και θα επικοινωνήσουμε μαζί σας για προσφορά.',
    ];
@endphp

@push('schema')
    <script type="application/ld+json">{!! Seo::graph(Seo::faq($faq), Seo::breadcrumbs([['Αρχική', url('/')], ['Υπηρεσίες', url('/services')]])) !!}</script>
@endpush

@section('content')
    <section class="border-b border-slate-200 bg-white">
        <div class="mx-auto max-w-6xl px-4 py-10 md:px-6 md:py-14">
            <h1 class="text-2xl font-black tracking-tight text-slate-900 md:text-4xl">Πλυντήριο αυτοκινήτων & υπηρεσίες στη Λάρισα</h1>
            <p class="mt-2 max-w-2xl text-sm text-slate-600 md:text-base">
                Πλύσιμο αυτοκινήτου με ραντεβού, βιολογικός καθαρισμός, self-service πλυντήριο, υγραέριο κίνησης και
                διανομή καυσίμων από τα πρατήρια ΕΚΟ Δράμη.
            </p>
            <a href="{{ route('pages.booking') }}" class="mt-5 inline-block rounded-lg bg-[#e21838] px-4 py-2.5 text-sm font-bold text-white hover:bg-[#c4142f]">Κλείστε ραντεβού</a>
        </div>
    </section>

    <section class="bg-slate-50 py-10 md:py-14">
        <div class="mx-auto grid max-w-6xl grid-cols-1 gap-6 px-4 md:px-6 lg:grid-cols-3">
            <div class="lg:col-span-2">
                <h2 class="text-xl font-bold text-slate-900">Τιμές πλυντηρίου</h2>
                <p class="mt-1 text-sm text-slate-600">ΕΚΟ Βόλου 12, Λάρισα · ενδεικτικές τιμές ανά τύπο οχήματος.</p>

                <div class="mt-4 overflow-hidden rounded-xl border border-slate-200 bg-white">
                    <table class="w-full text-left text-[13px] sm:text-sm">
                        <thead class="border-b border-slate-200 bg-slate-50 text-[13px] text-slate-500">
                            <tr>
                                <th scope="col" class="px-3 py-2.5 font-medium sm:px-4">Πακέτο</th>
                                @foreach (BookingRules::VEHICLE_TYPES as $vehicle)
                                    <th scope="col" class="px-2 py-2.5 text-right font-medium sm:px-4">{{ $vehicle }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach (BookingRules::WASH_LABELS as $wash => $label)
                                <tr>
                                    <th scope="row" class="px-3 py-2.5 font-medium text-slate-800 sm:px-4">
                                        {{ $label }}
                                        @if (isset($washDays[$wash]))
                                            <span class="block text-xs font-normal text-slate-500">{{ BookingRules::daysLabel($washDays[$wash]) }}</span>
                                        @endif
                                    </th>
                                    @foreach (BookingRules::VEHICLE_TYPES as $vehicle)
                                        <td class="px-2 py-2.5 text-right tabular-nums sm:px-4">
                                            @isset($prices[$vehicle][$wash])
                                                ~{{ $prices[$vehicle][$wash] }}€
                                            @else
                                                <span class="text-slate-300">-</span>
                                            @endisset
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <p class="mt-2 text-xs text-slate-500">Οι τιμές μπορεί να διαφέρουν ανάλογα με την κατάσταση του οχήματος.</p>
            </div>

            <div class="rounded-xl border border-slate-200 bg-white p-5">
                <h2 class="text-base font-bold text-slate-900">Επιπλέον υπηρεσίες</h2>
                <ul class="mt-3 space-y-1.5 text-sm text-slate-700">
                    <li class="flex justify-between gap-2"><span>Fast Track (χωρίς αναμονή)</span><span class="text-slate-500">+2€</span></li>
                    @foreach (BookingRules::EXTRAS as $name => $extra)
                        <li class="flex justify-between gap-2">
                            <span>{{ $name }}</span>
                            <span class="text-slate-500">
                                @if ($extra['free'])
                                    δωρεάν
                                @elseif ($extra['days'])
                                    {{ BookingRules::daysShortLabel($extra['days']) }}
                                @endif
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    <section class="bg-white py-10 md:py-14">
        <div class="mx-auto max-w-6xl px-4 md:px-6">
            <h2 class="text-xl font-bold text-slate-900">Υπηρεσίες ανά πρατήριο</h2>
            <div class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
                <a href="{{ route('station.show', 1) }}" class="rounded-xl border border-slate-200 p-5 hover:border-slate-300">
                    <h3 class="font-bold text-slate-900">Πλυντήριο με ραντεβού</h3>
                    <p class="mt-1 text-sm text-slate-600">Πλύσιμο μέσα-έξω, βιολογικός καθαρισμός και Fast Track.</p>
                    <p class="mt-3 text-[13px] font-semibold text-[#e21838]">ΕΚΟ Βόλου 12</p>
                </a>
                <a href="{{ route('station.show', 2) }}" class="rounded-xl border border-slate-200 p-5 hover:border-slate-300">
                    <h3 class="font-bold text-slate-900">Self service πλυντήριο & LPG</h3>
                    <p class="mt-1 text-sm text-slate-600">Πλύσιμο αυτοεξυπηρέτησης και υγραέριο κίνησης (Autogas).</p>
                    <p class="mt-3 text-[13px] font-semibold text-[#e21838]">ΕΚΟ Λ. Καραμανλή 102</p>
                </a>
                <a href="{{ route('station.show', 3) }}" class="rounded-xl border border-slate-200 p-5 hover:border-slate-300">
                    <h3 class="font-bold text-slate-900">Φορτιστής 22kW & αυτόματος πωλητής</h3>
                    <p class="mt-1 text-sm text-slate-600">Φόρτιση ηλεκτρικών οχημάτων και ανεφοδιασμός με κάρτα.</p>
                    <p class="mt-3 text-[13px] font-semibold text-[#e21838]">ΕΚΟ Γεωργιάδου 28</p>
                </a>
                <a href="{{ route('station.show', 4) }}" class="rounded-xl border border-slate-200 p-5 hover:border-slate-300">
                    <h3 class="font-bold text-slate-900">Στη διαδρομή για Πήλιο</h3>
                    <p class="mt-1 text-sm text-slate-600">Καύσιμα και είδη καταστήματος στην Ε.Ο. Βόλου-Πορταριάς.</p>
                    <p class="mt-3 text-[13px] font-semibold text-[#e21838]">ΕΚΟ Πορταριά</p>
                </a>
            </div>

            <div class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-2">
                <a href="{{ route('fuel-orders.create') }}" class="rounded-xl border border-slate-200 p-5 hover:border-slate-300">
                    <h3 class="font-bold text-slate-900">Παραγγελία πετρελαίου κίνησης</h3>
                    <p class="mt-1 text-sm text-slate-600">Diesel Economy και Diesel Avio με παράδοση στον χώρο σας.</p>
                </a>
                <a href="{{ route('lpg-orders.create') }}" class="rounded-xl border border-slate-200 p-5 hover:border-slate-300">
                    <h3 class="font-bold text-slate-900">Παραγγελία υγραερίου</h3>
                    <p class="mt-1 text-sm text-slate-600">Υγραέριο θέρμανσης για το σπίτι και προπάνιο για επιχειρήσεις.</p>
                </a>
            </div>
        </div>
    </section>

    <section class="border-t border-slate-200 bg-slate-50 py-10 md:py-14">
        <div class="mx-auto max-w-3xl px-4 md:px-6">
            <h2 class="text-xl font-bold text-slate-900">Συχνές ερωτήσεις</h2>
            <div class="mt-4 divide-y divide-slate-200 rounded-xl border border-slate-200 bg-white">
                @foreach ($faq as $question => $answer)
                    <details class="group px-5 py-4">
                        <summary class="flex cursor-pointer list-none items-start justify-between gap-4 text-sm font-semibold text-slate-900">
                            {{ $question }}
                            <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-4 w-4 shrink-0 text-slate-400 transition-transform group-open:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" /></svg>
                        </summary>
                        <p class="mt-2 text-sm text-slate-600">{{ $answer }}</p>
                    </details>
                @endforeach
            </div>
        </div>
    </section>
@endsection
