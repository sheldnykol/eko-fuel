@extends('layouts.app')

@section('content')
    <section class="bg-slate-50 py-16">
        <div class="container mx-auto max-w-4xl px-4">
            <nav class="mb-8 flex text-sm font-bold tracking-widest text-slate-400 uppercase">
                <a href="/" class="hover:text-[#e21838]">Αρχική</a>
                <span class="mx-2">/</span>
                <span class="text-slate-900">Πολιτική Απορρήτου</span>
            </nav>

            <div class="rounded-[2.5rem] border border-slate-100 bg-white p-8 shadow-xl md:p-16">
                <div class="mb-10 flex items-center gap-4">
                    <div class="rounded-2xl bg-blue-50 p-3 text-blue-600">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="h-8 w-8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"
                            />
                        </svg>
                    </div>
                    <h1 class="text-4xl font-black tracking-tighter text-slate-900 uppercase">
                        Πολιτική
                        <span class="text-blue-600">Απορρήτου</span>
                    </h1>
                </div>

                <div class="prose prose-slate max-w-none space-y-8 leading-relaxed text-slate-600">
                    <p class="text-lg">
                        Στην EKO, η προστασία των προσωπικών σας δεδομένων είναι προτεραιότητά μας. Η παρούσα πολιτική
                        εξηγεί τι δεδομένα συλλέγουμε και πώς τα διαχειριζόμαστε.
                    </p>

                    <section>
                        <h2 class="mb-4 flex items-center gap-2 text-xl font-black text-slate-900 uppercase">
                            <span class="text-blue-600">01.</span>
                            Τι δεδομένα συλλέγουμε
                        </h2>
                        <div
                            class="grid grid-cols-1 gap-4 rounded-2xl border border-slate-100 bg-slate-50 p-6 md:grid-cols-2"
                        >
                            <div class="flex items-start gap-3">
                                <span class="text-blue-600">✔</span>
                                <div>
                                    <p class="font-bold text-slate-900">Στοιχεία Επικοινωνίας</p>
                                    <p class="text-sm">Όνομα και αριθμό τηλεφώνου για την επιβεβαίωση του ραντεβού.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="text-blue-600">✔</span>
                                <div>
                                    <p class="font-bold text-slate-900">Στοιχεία Οχήματος</p>
                                    <p class="text-sm">
                                        Αριθμό πινακίδας για την ταυτοποίηση κατά την άφιξη στο πλυντήριο.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section>
                        <h2 class="mb-4 flex items-center gap-2 text-xl font-black text-slate-900 uppercase">
                            <span class="text-blue-600">02.</span>
                            Σκοπός Επεξεργασίας
                        </h2>
                        <p>Τα δεδομένα σας χρησιμοποιούνται **αποκλειστικά** για:</p>
                        <ul class="mt-2 list-disc space-y-2 pl-5">
                            <li>Την κράτηση της ώρας και της ημέρας του ραντεβού σας.</li>
                            <li>Την αποστολή κωδικού PIN για την ασφάλεια της κράτησης.</li>
                            <li>Την επικοινωνία μαζί σας σε περίπτωση αλλαγής του προγράμματος.</li>
                        </ul>
                    </section>

                    <section>
                        <h2 class="mb-4 flex items-center gap-2 text-xl font-black text-slate-900 uppercase">
                            <span class="text-blue-600">03.</span>
                            Διατήρηση Δεδομένων
                        </h2>
                        <p>
                            Δεν κρατάμε τα δεδομένα σας για πάντα. Οι πληροφορίες των ραντεβού διαγράφονται ή
                            αρχειοθετούνται μετά το πέρας της παροχής της υπηρεσίας, εκτός εάν απαιτείται από το νόμο η
                            τήρηση φορολογικών στοιχείων.
                        </p>
                    </section>

                    <section class="rounded-[2rem] border border-blue-100 bg-blue-50 p-8">
                        <h2 class="mb-4 text-xl font-black text-blue-900 uppercase">Τα δικαιώματά σας (GDPR)</h2>
                        <p class="mb-4 text-sm text-blue-800">Έχετε το δικαίωμα να ζητήσετε ανά πάσα στιγμή:</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="rounded-full bg-white px-3 py-1 text-xs font-bold text-blue-600 shadow-sm">
                                Πρόσβαση στα δεδομένα
                            </span>
                            <span class="rounded-full bg-white px-3 py-1 text-xs font-bold text-blue-600 shadow-sm">
                                Διόρθωση στοιχείων
                            </span>
                            <span class="rounded-full bg-white px-3 py-1 text-xs font-bold text-blue-600 shadow-sm">
                                Οριστική διαγραφή
                            </span>
                        </div>
                    </section>

                    <hr class="border-slate-100" />

                    <p class="text-xs text-slate-400">
                        Για οποιαδήποτε απορία σχετικά με τα δεδομένα σας, μπορείτε να επικοινωνήσετε μαζί μας στο
                        support
                        @eko-fuel.test.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
