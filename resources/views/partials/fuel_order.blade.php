<section class="bg-slate-50 py-18 md:py-24">
    <div class="mb-16 flex flex-col items-center justify-center text-center">
        {{-- Εικονίδιο Βυτιοφόρου --}}
        <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-black shadow-lg shadow-slate-200">
            <svg
                class="h-10 w-10 text-white"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <path d="M10 18h4" />
                <path d="M14 14V9a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v5" />
                <path d="M2 14v4h2" />
                <path d="M8 18h6" />
                <path d="M18 18h1" />
                <path d="M22 18v-4l-1-4h-3v8" />
                <circle cx="6" cy="18" r="2" />
                <circle cx="16" cy="18" r="2" />
            </svg>
        </div>

        {{-- Τίτλος και Περιγραφή --}}
        <h2 class="text-3xl font-black tracking-tight text-slate-900 md:text-5xl">Διανομές Καυσίμων</h2>
        <p class="mt-4 max-w-2xl text-lg text-slate-500">Άμεση και αξιόπιστη τροφοδοσία καυσίμων στον χώρο σας.</p>
    </div>
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 justify-items-center gap-8 md:grid-cols-3">
            <a
                href="{{ route('fuel-orders.create') }}"
                class="group relative block w-full max-w-sm rounded-3xl border border-slate-200 bg-white p-10 text-center shadow-sm transition-all duration-300 hover:border-red-500 hover:shadow-2xl"
            >
                <div
                    class="mb-6 inline-flex h-20 w-20 items-center justify-center rounded-2xl bg-red-50 text-red-600 transition-colors duration-300 group-hover:bg-red-600 group-hover:text-white"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-10 w-10"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"
                        />
                    </svg>
                </div>
                <h3 class="mb-2 text-2xl font-bold text-slate-800">Πετρέλαιο Κίνησης</h3>
                <p class="mb-2 text-2xl font-bold text-slate-800">Παράγγειλε Τώρα και Πάρε Προσφορά</p>
                <p class="text-slate-500">Άμεση παράδοση στον χώρο σας</p>
                <span
                    class="absolute top-4 right-4 rounded-full bg-red-100 px-3 py-1 text-[10px] font-bold tracking-widest text-red-600 uppercase"
                >
                    DIESEL
                </span>
            </a>

            <a
                href="{{ route('lpg-orders.create') }}"
                class="group relative block w-full max-w-sm rounded-3xl border border-slate-200 bg-white p-10 text-center shadow-sm transition-all duration-300 hover:border-blue-500 hover:shadow-2xl"
            >
                <div
                    class="mb-6 inline-flex h-20 w-20 items-center justify-center rounded-2xl bg-blue-50 text-blue-600 transition-colors duration-300 group-hover:bg-blue-600 group-hover:text-white"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-10 w-10"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.99 7.99 0 0120 13a7.98 7.98 0 01-2.343 5.657z"
                        />
                    </svg>
                </div>
                <h3 class="mb-2 text-2xl font-bold text-slate-800">Υγραέριο (LPG)</h3>
                <span class="mb-2 text-base font-bold text-slate-800">
                    ΑΠΟΚΛΕΙΣΤΙΚΟΣ ΑΝΤΙΠΡΟΣΩΠΟΣ ΘΕΣΣΑΛΙΑΣ ΤΥΜΠΑΣ ΓΙΩΡΓΟΣ(6944638312)
                </span>
                <p class="text-slate-500">
                    Υγραέριο για Θέρμανσης για το σπίτι
                    <br />
                    Υγραεριο προπανίου για επιχειρήσεις
                </p>
                <span
                    class="absolute top-4 right-4 rounded-full bg-blue-100 px-3 py-1 text-[10px] font-bold tracking-widest text-blue-600 uppercase"
                >
                    LPG
                </span>
            </a>

            <a
                href="{{ route('heating-oil-orders.create') }}"
                class="group relative block w-full max-w-sm rounded-3xl border border-slate-200 bg-white p-10 text-center shadow-sm transition-all duration-300 hover:border-orange-500 hover:shadow-2xl"
            >
                <div
                    class="mb-6 inline-flex h-20 w-20 items-center justify-center rounded-2xl bg-orange-50 text-orange-600 transition-colors duration-300 group-hover:bg-orange-600 group-hover:text-white"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-10 w-10"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                        />
                    </svg>
                </div>
                <h3 class="mb-2 text-2xl font-bold text-slate-800">Πετρέλαιο Θέρμανσης</h3>
                <p class="text-slate-">Ζεστασιά σε κάθε σπίτι</p>
                <span
                    class="absolute top-4 right-4 rounded-full bg-orange-100 px-3 py-1 text-[10px] font-bold tracking-widest text-orange-600 uppercase"
                >
                    HEAT
                </span>
            </a>
        </div>
    </div>
</section>
