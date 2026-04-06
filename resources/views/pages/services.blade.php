@extends('layouts.app')

@section('content')
    <section class="min-h-screen bg-slate-50 py-12">
        <div class="container mx-auto max-w-6xl px-4">
            <div class="mb-16 text-center">
                <h2 class="mb-4 text-4xl font-black tracking-tight text-slate-900 uppercase">Υπηρεσίες & Προϊόντα</h2>
                <p class="mx-auto max-w-2xl text-lg text-slate-500">
                    Φροντίζουμε το όχημά σας με την ποιότητα και την αξιοπιστία της EKO.
                </p>
            </div>

            <div class="mb-13">
                <div class="mb-8 flex items-center space-x-4">
                    <div class="h-10 w-2 rounded-full bg-[#e21838]"></div>
                    <h3 class="text-3xl font-black tracking-tighter text-slate-800 uppercase">Πλυντήριο Αυτοκινήτων</h3>
                </div>

                <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
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
                                    15€
                                </span>
                            </div>
                        </div>

                        <div class="mb-1 flex items-center gap-1.5">
                            <span class="h-1.5 w-1.5 rounded-full bg-[#e21838]"></span>
                            <p class="text-[10px] font-bold text-[#e21838] uppercase">Δευτέρα εώς Παρασκευή</p>
                        </div>

                        <h4 class="mb-3 text-2xl font-black text-slate-900">Πλύσιμο Μέσα - Έξω</h4>
                        <p class="mb-6 leading-relaxed text-slate-500">
                            Ολοκληρωμένος καθαρισμός με ενεργό αφρό, στέγνωμα στο χέρι και περιποίηση εσωτερικού με
                            ειδικά γαλακτώματα.
                        </p>

                        <div class="flex gap-4 border-t border-slate-50 pt-4">
                            <div class="text-sm">
                                <span class="text-slate-400">Μέσα:</span>
                                <span class="font-bold text-slate-700">8€</span>
                            </div>
                            <div class="text-sm">
                                <span class="text-slate-400">Έξω:</span>
                                <span class="font-bold text-slate-700">7€</span>
                            </div>
                        </div>
                    </div>

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

            <div>
                <div class="mb-8 flex items-center space-x-4">
                    <div class="h-10 w-2 rounded-full bg-slate-800"></div>
                    <h3 class="text-3xl font-black tracking-tighter text-slate-800 uppercase">Κορυφαία Προϊόντα</h3>
                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                    <div class="rounded-[2rem] border border-slate-100 bg-white p-6 text-center shadow-sm">
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

                    <div class="rounded-[2rem] border border-slate-100 bg-white p-6 text-center shadow-sm">
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

                    <div class="rounded-[2rem] border border-slate-100 bg-white p-6 text-center shadow-sm">
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
