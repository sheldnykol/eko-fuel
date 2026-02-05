@extends('layouts.app')

@section('content')
    <section class="bg-slate-50 py-16">
        <div class="container mx-auto max-w-4xl px-4">
            <nav class="mb-8 flex text-sm font-bold tracking-widest text-slate-400 uppercase">
                <a href="/" class="hover:text-[#e21838]">Αρχική</a>
                <span class="mx-2">/</span>
                <span class="text-slate-900">Όροι Χρήσης</span>
            </nav>

            <div class="rounded-[2.5rem] border border-slate-100 bg-white p-8 shadow-xl md:p-16">
                <h1 class="mb-10 text-4xl font-black tracking-tighter text-slate-900 uppercase">
                    Όροι
                    <span class="text-[#e21838]">Χρήσης</span>
                    & Προϋποθέσεις
                </h1>

                <div class="prose prose-slate max-w-none space-y-8 leading-relaxed text-slate-600">
                    <section>
                        <div class="mb-4 flex items-center gap-3">
                            <div class="h-6 w-1 bg-[#e21838]"></div>
                            <h2 class="text-xl font-black text-slate-900 uppercase">1. Γενικά</h2>
                        </div>
                        <p>
                            Η παρούσα ιστοσελίδα παρέχει υπηρεσίες προγραμματισμού ραντεβού για το πλυντήριο αυτοκινήτων
                            της EKO. Με την πρόσβαση ή τη χρήση της ιστοσελίδας, αποδέχεστε ότι δεσμεύεστε από τους
                            παρόντες όρους.
                        </p>
                    </section>

                    <section>
                        <div class="mb-4 flex items-center gap-3">
                            <div class="h-6 w-1 bg-[#e21838]"></div>
                            <h2 class="text-xl font-black text-slate-900 uppercase">2. Πολιτική Ραντεβού</h2>
                        </div>
                        <ul class="list-disc space-y-2 pl-5">
                            <li>Ο χρήστης οφείλει να παρέχει αληθή στοιχεία (Όνομα, Τηλέφωνο, Πινακίδα).</li>
                            <li>
                                Κάθε κράτηση συνοδεύεται από έναν μοναδικό **κωδικό PIN** για την επιβεβαίωση της
                                ταυτότητας του πελάτη κατά την προσέλευση.
                            </li>
                            <li>
                                Σε περίπτωση καθυστέρησης άνω των 15 λεπτών, η επιχείρηση διατηρεί το δικαίωμα ακύρωσης
                                του ραντεβού.
                            </li>
                        </ul>
                    </section>

                    <section>
                        <div class="mb-4 flex items-center gap-3">
                            <div class="h-6 w-1 bg-[#e21838]"></div>
                            <h2 class="text-xl font-black text-slate-900 uppercase">3. Προσωπικά Δεδομένα</h2>
                        </div>
                        <p>
                            Η διαχείριση και προστασία των προσωπικών δεδομένων του επισκέπτη υπόκειται στους όρους της
                            παρούσας ενότητας και στις σχετικές διατάξεις του ελληνικού και ευρωπαϊκού δικαίου
                            (**GDPR**). Τα στοιχεία σας χρησιμοποιούνται αποκλειστικά για την εξυπηρέτηση του ραντεβού
                            σας.
                        </p>
                    </section>

                    <section>
                        <div class="mb-4 flex items-center gap-3">
                            <div class="h-6 w-1 bg-[#e21838]"></div>
                            <h2 class="text-xl font-black text-slate-900 uppercase">4. Περιορισμός Ευθύνης</h2>
                        </div>
                        <p>
                            Η EKO δεν φέρει ευθύνη για τυχόν τεχνικά προβλήματα που μπορεί να παρουσιαστούν κατά την
                            διάρκεια της κράτησης ή για λανθασμένη καταχώρηση στοιχείων από την πλευρά του χρήστη.
                        </p>
                    </section>

                    <hr class="border-slate-100" />

                    <div class="rounded-2xl bg-slate-50 p-6 text-sm italic">
                        Τελευταία ενημέρωση: {{ date('d/m/Y') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
