@extends('layouts.app')

@section('title', 'Η Εταιρεία: 40 Χρόνια Πρατήρια EKO στη Λάρισα')
@section('meta_description', 'Η ιστορία της ΕΚΟ Δράμη: από το πρώτο πρατήριο στη Βόλου το 1986 έως σήμερα, τρεις γενιές, τέσσερα πρατήρια EKO στη Λάρισα και στην Πορταριά, ιδιόκτητος στόλος μεταφοράς καυσίμων.')

@php
    $timeline = [
        ['1986', 'Το ξεκίνημα', 'Τα τρία αδέρφια λειτουργούν το πρώτο πρατήριο στην οδό Βόλου, με έμφαση από την πρώτη μέρα στα ποιοτικά καύσιμα και στην εξυπηρέτηση.'],
        ['2000', 'Η δεύτερη γενιά', 'Η δεύτερη γενιά αναλαμβάνει ενεργά την επιχείρηση και λειτουργεί το δεύτερο πρατήριο στην οδό Γεωργιάδου 28 στη Λάρισα.'],
        ['2012', 'Υγραέριο και self-service', 'Δημιουργείται ο πρώτος σύγχρονος σταθμός υγραερίου κίνησης (LPG) στη Λ. Καραμανλή 102, μαζί με πλυντήριο αυτοεξυπηρέτησης.'],
        ['2023', 'Ιδιόκτητος στόλος', 'Η επιχείρηση αποκτά δικό της στόλο μεταφοράς καυσίμων, με πλήρη έλεγχο της ποιότητας και της ασφάλειας σε κάθε παράδοση.'],
        ['2026', 'Η τρίτη γενιά', 'Η τρίτη γενιά μπαίνει στην επιχείρηση και λειτουργεί το νέο πρατήριο στην Πορταριά, συνεχίζοντας την οικογενειακή παράδοση.'],
    ];
@endphp

@section('content')
    <section class="border-b border-slate-200 bg-white">
        <div class="mx-auto max-w-3xl px-4 py-10 md:px-6 md:py-14">
            <p class="text-[13px] font-semibold tracking-wide text-[#e21838] uppercase">Η εταιρεία</p>
            <h1 class="mt-1 text-2xl font-black tracking-tight text-slate-900 md:text-4xl">ΕΚΟ Δράμη, από το 1986 στη Λάρισα</h1>
            <p class="mt-3 text-sm leading-relaxed text-slate-600 md:text-base">
                Μια οικογενειακή επιχείρηση τριών γενεών που προσφέρει ποιοτικά καύσιμα EKO και σύγχρονες υπηρεσίες
                για κάθε οδηγό, σε τέσσερα πρατήρια στη Λάρισα και στην Πορταριά.
            </p>
        </div>
    </section>

    <section class="bg-slate-50 py-10 md:py-14">
        <div class="mx-auto max-w-3xl px-4 md:px-6">
            <h2 class="text-xl font-bold text-slate-900">Η διαδρομή μας</h2>
            <ol class="mt-6 space-y-6 border-l border-slate-300 pl-6">
                @foreach ($timeline as [$year, $title, $text])
                    <li class="relative">
                        <span class="absolute top-1.5 -left-[29px] h-2.5 w-2.5 rounded-full bg-[#e21838]"></span>
                        <p class="text-[13px] font-bold text-[#e21838]">{{ $year }}</p>
                        <h3 class="font-bold text-slate-900">{{ $title }}</h3>
                        <p class="mt-1 text-sm leading-relaxed text-slate-600">{{ $text }}</p>
                    </li>
                @endforeach
            </ol>

            <div class="mt-10 grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="rounded-xl border border-slate-200 bg-white p-5">
                    <h2 class="font-bold text-slate-900">Η αποστολή μας</h2>
                    <p class="mt-1 text-sm text-slate-600">
                        Εγγυημένα καύσιμα EKO και άψογη εξυπηρέτηση, χτίζοντας σχέσεις εμπιστοσύνης με κάθε πελάτη.
                    </p>
                </div>
                <div class="rounded-xl border border-slate-200 bg-white p-5">
                    <h2 class="font-bold text-slate-900">Σύγχρονες υπηρεσίες</h2>
                    <p class="mt-1 text-sm text-slate-600">
                        Από τον αυστηρό έλεγχο των καυσίμων μέχρι τα self-service πλυντήρια, επενδύουμε συνεχώς στο μέλλον.
                    </p>
                </div>
            </div>

            <blockquote class="mt-8 border-l-4 border-[#e21838] bg-white p-5 text-sm text-slate-700 italic">
                Σχεδόν 40 χρόνια κοινής πορείας, 3 γενιές, η ίδια δέσμευση για ποιότητα και εξυπηρέτηση δίπλα στον οδηγό.
            </blockquote>

            <div class="mt-8 flex flex-wrap gap-2">
                <a href="{{ route('stations.show') }}" class="rounded-lg bg-slate-900 px-4 py-2.5 text-sm font-bold text-white hover:bg-slate-800">Τα πρατήριά μας</a>
                <a href="{{ route('pages.booking') }}" class="rounded-lg border border-slate-300 px-4 py-2.5 text-sm font-bold text-slate-800 hover:bg-white">Ραντεβού πλυντηρίου</a>
            </div>
        </div>
    </section>
@endsection
