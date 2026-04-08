@extends('layouts.app')

@section('content')
    <section class="min-h-screen bg-slate-50 py-12">
        <div class="container mx-auto max-w-6xl px-4">
            {{-- Κεντρικός Τίτλος --}}
            <div class="mb-16 text-center">
                <h2 class="mb-4 text-4xl font-black tracking-tight text-slate-900 uppercase">Υπηρεσίες & Προϊόντα</h2>
                <p class="mx-auto max-w-2xl text-lg text-slate-500">
                    Φροντίζουμε το όχημά σας με την ποιότητα και την αξιοπιστία της EKO.
                </p>
            </div>

            {{-- 1. ΚΛΑΣΙΚΟ ΠΛΥΝΤΗΡΙΟ --}}
            <div class="mb-16">
                <div class="mb-8 flex items-center space-x-4">
                    <div class="h-10 w-2 rounded-full bg-[#e21838]"></div>
                    <h3 class="text-3xl font-black tracking-tighter text-slate-800 uppercase">Πλυντήριο Αυτοκινήτων</h3>
                </div>

                <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                    {{-- Κάρτα: Πλύσιμο Μέσα - Έξω --}}
                    <div
                        class="group rounded-[2.5rem] border border-slate-100 bg-white p-8 shadow-sm transition-all hover:shadow-xl"
                    >
                        <div class="mb-6 flex items-start justify-between">
                            <div
                                class="rounded-2xl bg-red-50 p-4 text-[#e21838] transition-colors group-hover:bg-[#e21838] group-hover:text-white"
                            >
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z"
                                    ></path>
                                </svg>
                            </div>
                            <div class="flex flex-col items-end gap-2">
                                <span
                                    class="flex items-center rounded-full bg-slate-100 px-4 py-2 text-xs font-bold text-slate-600"
                                >
                                    <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                        ></path>
                                    </svg>
                                    20'- 45' Λεπτά
                                </span>
                                <span class="rounded-xl bg-slate-900 px-4 py-1.5 text-lg font-black text-white">
                                    από 15€
                                </span>
                            </div>
                        </div>

                        <div class="mb-1 flex items-center gap-1.5">
                            <span class="h-1.5 w-1.5 rounded-full bg-[#e21838]"></span>
                            <p class="text-[10px] font-bold text-[#e21838] uppercase">Δευτέρα εώς Σάββατο</p>
                        </div>

                        <h4 class="mb-3 text-2xl font-black text-slate-900">
                            Πλύσιμο Μέσα - Έξω (+2€ Έξτρα για fast track)
                        </h4>
                        <p class="mb-6 leading-relaxed text-slate-500">
                            Ολοκληρωμένος καθαρισμός με ενεργό αφρό, στέγνωμα στο χέρι και περιποίηση εσωτερικού με
                            ειδικά γαλακτώματα.
                        </p>

                        <div class="flex gap-4 border-t border-slate-50 pt-4">
                            <div class="text-sm">
                                <span class="text-slate-400">Μέσα:</span>
                                <span class="font-bold text-slate-700">από 8€</span>
                            </div>
                            <div class="text-sm">
                                <span class="text-slate-400">Έξω:</span>
                                <span class="font-bold text-slate-700">από 7€</span>
                            </div>
                        </div>
                    </div>

                    {{-- Κάρτα: Βιολογικός Καθαρισμός --}}
                    <div
                        class="group rounded-[2.5rem] border border-slate-100 bg-white p-8 shadow-sm transition-all hover:shadow-xl"
                    >
                        <div class="mb-6 flex items-start justify-between">
                            <div
                                class="rounded-2xl bg-blue-50 p-4 text-blue-600 transition-colors group-hover:bg-blue-600 group-hover:text-white"
                            >
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.642.321a6 6 0 01-3.86.517l-2.388-.477a2 2 0 00-1.022.547l-1.168 1.168a2 2 0 001.61 3.412h13.419a2 2 0 001.61-3.412l-1.168-1.168z"
                                    ></path>
                                </svg>
                            </div>
                            <div class="flex flex-col items-end gap-2">
                                <span
                                    class="flex items-center rounded-full bg-slate-100 px-4 py-2 text-xs font-bold text-slate-600"
                                >
                                    <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                        ></path>
                                    </svg>
                                    3-4 Ώρες - 1 Ημέρα
                                </span>
                                <span class="rounded-xl bg-slate-900 px-4 py-1.5 text-lg font-black text-white">
                                    από 50€
                                </span>
                            </div>
                        </div>

                        <div class="mb-1 flex items-center gap-1.5">
                            <span class="h-1.5 w-1.5 rounded-full bg-[#e21838]"></span>
                            <p class="text-[10px] font-bold text-[#e21838] uppercase">Τρίτη - Τετάρτη - Πέμπτη</p>
                        </div>

                        <h4 class="mb-3 text-2xl font-black text-slate-900">Βιολογικός Καθαρισμός</h4>
                        <p class="mb-8 leading-relaxed text-slate-500">
                            Βαθύς καθαρισμός με μηχανήματα extraction σε καθίσματα, μοκέτες και ουρανό. Απομάκρυνση
                            οσμών και μικροβίων.
                        </p>
                    </div>
                </div>

                <a
                    href="/booking"
                    class="mt-7 inline-flex w-full items-center justify-center rounded-2xl bg-slate-900 py-4 font-bold text-white transition-all hover:bg-[#e21838]"
                >
                    Κλείσε Ραντεβού
                </a>
            </div>

            {{-- 2. ΕΙΔΙΚΕΣ ΥΠΗΡΕΣΙΕΣ ΠΡΑΤΗΡΙΩΝ (Αυτόματος & Self Service) --}}
            <div class="mb-16">
                <div class="mb-8 flex items-center space-x-4">
                    <div class="h-10 w-2 rounded-full bg-blue-600"></div>
                    <h3 class="text-3xl font-black tracking-tighter text-slate-800 uppercase">
                        Αποκλειστικές Υπηρεσίες
                    </h3>
                </div>

                <div class="grid grid-cols-1 gap-8">
                    {{-- ΓΕΩΡΓΙΑΔΟΥ: Αυτόματος Πωλητής --}}
                    <div
                        class="group relative overflow-hidden rounded-3xl bg-white p-1 shadow-lg ring-1 ring-slate-200 transition-all hover:shadow-2xl"
                    >
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-blue-600 to-indigo-800 opacity-95 transition-opacity group-hover:opacity-100"
                        ></div>
                        <div
                            class="absolute -top-16 -right-16 h-60 w-60 rounded-full bg-white/10 blur-3xl transition-transform group-hover:scale-110"
                        ></div>

                        <div
                            class="relative flex h-full flex-col overflow-hidden rounded-[1.3rem] p-8 text-white md:flex-row md:items-start md:gap-8"
                        >
                            <div class="mb-6 flex shrink-0 items-center justify-center md:mb-0">
                                <div
                                    class="relative flex h-24 w-24 items-center justify-center rounded-2xl bg-white/15 text-white ring-1 ring-white/20 backdrop-blur-sm"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="h-12 w-12"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"
                                        />
                                    </svg>
                                </div>
                            </div>

                            <div class="flex-1 text-center md:text-left">
                                <div class="mb-4">
                                    <span
                                        class="mb-3 inline-flex items-center gap-1.5 rounded-full bg-white/20 px-3 py-1 text-xs font-bold tracking-wider text-white uppercase backdrop-blur-md"
                                    >
                                        📍 Πρατήριο Γεωργιάδου
                                    </span>
                                    <h3
                                        class="text-2xl font-black tracking-tight text-white uppercase italic md:text-3xl"
                                    >
                                        Οδηγίες Αυτόματου Πωλητή
                                    </h3>
                                    <p class="mt-1 text-sm text-blue-100">Ακολουθήστε τα βήματα για γρήγορη πληρωμή</p>
                                </div>

                                <div
                                    class="grid grid-cols-1 gap-x-6 gap-y-3 border-t border-white/10 pt-4 text-left md:grid-cols-2"
                                >
                                    <div class="flex gap-2.5 text-sm text-blue-50">
                                        <span class="font-bold text-white opacity-60">01.</span>
                                        Επιλογή «Κάρτα» στο μενού.
                                    </div>
                                    <div class="flex gap-2.5 text-sm text-blue-50">
                                        <span class="font-bold text-white opacity-60">02.</span>
                                        Αρ. κυκλοφορίας & «Συνέχεια».
                                    </div>
                                    <div class="flex gap-2.5 text-sm text-blue-50">
                                        <span class="font-bold text-white opacity-60">03.</span>
                                        Απόδειξη: πατήστε «Συνέχεια».
                                    </div>
                                    <div class="flex gap-2.5 text-sm text-blue-50">
                                        <span class="font-bold text-white opacity-60">04.</span>
                                        Καύσιμο & Αντλία (7-10).
                                    </div>
                                    <div class="flex gap-2.5 text-sm text-blue-50">
                                        <span class="font-bold text-white opacity-60">05.</span>
                                        Επιλέξτε το ποσό.
                                    </div>
                                    <div class="flex gap-2.5 text-sm text-blue-50">
                                        <span class="font-bold text-white opacity-60">06.</span>
                                        Κάρτα στο POS & PIN.
                                    </div>
                                    <div class="flex gap-2.5 text-sm text-blue-50">
                                        <span class="font-bold text-white opacity-60">07.</span>
                                        Ανεφοδιασμός (Πιέστε λαβή).
                                    </div>
                                    <div class="flex gap-2.5 text-sm text-blue-50">
                                        <span class="font-bold text-white opacity-60">08.</span>
                                        Επιστροφή & Αυτόματη Απόδειξη.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ΚΑΡΑΜΑΝΛΗ: Self Service Πλυντήριο --}}
                    <div
                        class="group relative overflow-hidden rounded-3xl bg-white p-1 shadow-lg ring-1 ring-slate-200 transition-all hover:shadow-2xl"
                    >
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-slate-800 to-slate-900 opacity-95 transition-opacity group-hover:opacity-100"
                        ></div>
                        <div
                            class="absolute -bottom-16 -left-16 h-64 w-64 rounded-full bg-blue-500/10 blur-3xl transition-transform group-hover:scale-125"
                        ></div>

                        <div
                            class="relative flex h-full flex-col overflow-hidden rounded-[1.3rem] p-8 text-white md:flex-row md:items-start md:gap-8"
                        >
                            <div class="mb-6 flex shrink-0 items-center justify-center md:mb-0">
                                <div
                                    class="relative flex h-24 w-24 items-center justify-center rounded-2xl bg-white/10 text-blue-400 ring-1 ring-white/20 backdrop-blur-sm"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="h-12 w-12"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75m0 3v.75m0 3v.75m0 3v.75m0 3v.75m3-15h13.5M5.25 15h13.5m-13.5-3h13.5m-13.5-3h13.5m-13.5-3h13.5M2.25 15.75c1.192.35 2.441.528 3.75.528 1.309 0 2.558-.178 3.75-.528M13.5 15.75c1.192.35 2.441.528 3.75.528 1.309 0 2.558-.178 3.75-.528"
                                        />
                                    </svg>
                                </div>
                            </div>

                            <div class="flex-1">
                                <div class="mb-6 text-center md:text-left">
                                    <span
                                        class="mb-3 inline-flex items-center gap-1.5 rounded-full bg-[#e21838] px-3 py-1 text-xs font-bold tracking-wider text-white uppercase shadow-sm"
                                    >
                                        📍 Πρατήριο Καραμανλή
                                    </span>
                                    <h3
                                        class="text-2xl font-black tracking-tight text-white uppercase italic md:text-3xl"
                                    >
                                        Self Service Πλυντήριο
                                    </h3>
                                    <p class="mt-1 text-sm text-slate-400">
                                        Ακολουθήστε τις οδηγίες για τέλειο αποτέλεσμα καθαρισμού.
                                    </p>
                                </div>

                                <div class="grid grid-cols-1 gap-y-5 border-t border-white/10 pt-6 text-left">
                                    <div class="flex gap-4 text-sm leading-relaxed text-blue-50">
                                        <span
                                            class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-blue-500/20 text-[10px] font-bold text-blue-400 ring-1 ring-blue-500/30"
                                        >
                                            01
                                        </span>
                                        <p>
                                            <strong class="mb-1 block text-xs tracking-wider text-white uppercase">
                                                Καθαρισμός με υψηλή πίεση
                                            </strong>
                                            Πρόπλυση και κύρια πλύση με ζεστό αποσκληρυμένο νερό και καθαριστικό για την
                                            αφαίρεση ρύπου και εντόμων!
                                        </p>
                                    </div>
                                    <div class="flex gap-4 text-sm leading-relaxed text-blue-50">
                                        <span
                                            class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-blue-500/20 text-[10px] font-bold text-blue-400 ring-1 ring-blue-500/30"
                                        >
                                            02
                                        </span>
                                        <p>
                                            <strong class="mb-1 block text-xs tracking-wider text-white uppercase">
                                                Καθαρισμός με βούρτσες
                                            </strong>
                                            Χρησιμοποίησε την μαλακή βούρτσα πλύσης και ενεργό αφρό για την αφαίρεση
                                            επίμονου ρύπου. Ξεπλύνετε την βούρτσα με νερό πριν τη χρήση.
                                        </p>
                                    </div>
                                    <div class="flex gap-4 text-sm leading-relaxed text-blue-50">
                                        <span
                                            class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-blue-500/20 text-[10px] font-bold text-blue-400 ring-1 ring-blue-500/30"
                                        >
                                            03
                                        </span>
                                        <p>
                                            <strong class="mb-1 block text-xs tracking-wider text-white uppercase">
                                                Ξέπλυμα με καθαρό νερό
                                            </strong>
                                            Ψεκασμός υψηλής πίεσης με κρύο καθαρό νερό ξεπλένει τον αφρό κι τον ρύπο από
                                            την επιφάνεια του αμαξώματος.
                                        </p>
                                    </div>
                                    <div class="flex gap-4 text-sm leading-relaxed text-blue-50">
                                        <span
                                            class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-blue-500/20 text-[10px] font-bold text-blue-400 ring-1 ring-blue-500/30"
                                        >
                                            04
                                        </span>
                                        <p>
                                            <strong class="mb-1 block text-xs tracking-wider text-white uppercase">
                                                Περιποίηση χρώματος με ζεστό κερί
                                            </strong>
                                            Προστασία μεγάλης διάρκειας με ειδικό καρναούβικο κερί.
                                        </p>
                                    </div>
                                    <div class="flex gap-4 text-sm leading-relaxed text-blue-50">
                                        <span
                                            class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-blue-500/20 text-[10px] font-bold text-blue-400 ring-1 ring-blue-500/30"
                                        >
                                            05
                                        </span>
                                        <p>
                                            <strong class="mb-1 block text-xs tracking-wider text-white uppercase">
                                                Στέγνωμα και γυάλισμα
                                            </strong>
                                            Τελικό ξέπλυμα με κρύο απιονισμένο νερό και γυαλιστικό, για στιλπνότητα και
                                            λάμψη στο χρώμα.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 3. ΠΡΟΪΟΝΤΑ --}}
            <div>
                <div class="mb-8 flex items-center space-x-4">
                    <div class="h-10 w-2 rounded-full bg-slate-800"></div>
                    <h3 class="text-3xl font-black tracking-tighter text-slate-800 uppercase">Κορυφαία Προϊόντα</h3>
                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                    <div
                        class="rounded-[2rem] border border-slate-100 bg-white p-6 text-center shadow-sm transition-shadow hover:shadow-lg"
                    >
                        <div class="mb-4 flex h-48 items-center justify-center rounded-3xl bg-slate-50">
                            <span class="text-xs font-bold tracking-widest text-slate-300 uppercase">
                                Image Placeholder
                            </span>
                        </div>
                        <h5 class="mb-1 font-black text-slate-900">Λιπαντικά EKO Megatron</h5>
                        <p class="mb-4 text-sm text-balance text-slate-500">
                            Μέγιστη προστασία κινητήρα κάτω από οποιεσδήποτε συνθήκες.
                        </p>
                        <a href="#" class="text-sm font-bold text-[#e21838] hover:underline">Δείτε τα Προϊόντα →</a>
                    </div>

                    <div
                        class="rounded-[2rem] border border-slate-100 bg-white p-6 text-center shadow-sm transition-shadow hover:shadow-lg"
                    >
                        <div class="mb-4 flex h-48 items-center justify-center rounded-3xl bg-slate-50">
                            <span class="text-xs font-bold tracking-widest text-slate-300 uppercase">
                                Image Placeholder
                            </span>
                        </div>
                        <h5 class="mb-1 font-black text-slate-900">Αξεσουάρ Αυτοκινήτου</h5>
                        <p class="mb-4 text-sm text-balance text-slate-500">
                            Υαλοκαθαριστήρες, αρωματικά και είδη έκτακτης ανάγκης.
                        </p>
                        <a href="#" class="text-sm font-bold text-[#e21838] hover:underline">Περισσότερα →</a>
                    </div>

                    <div
                        class="rounded-[2rem] border border-slate-100 bg-white p-6 text-center shadow-sm transition-shadow hover:shadow-lg"
                    >
                        <div class="mb-4 flex h-48 items-center justify-center rounded-3xl bg-slate-50">
                            <span class="text-xs font-bold tracking-widest text-slate-300 uppercase">
                                Image Placeholder
                            </span>
                        </div>
                        <h5 class="mb-1 font-black text-slate-900">Χημικά & Καθαριστικά</h5>
                        <p class="mb-4 text-sm text-balance text-slate-500">
                            Εξειδικευμένα προϊόντα για τη λάμψη του οχήματός σας.
                        </p>
                        <a href="#" class="text-sm font-bold text-[#e21838] hover:underline">Αγορά τώρα →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
