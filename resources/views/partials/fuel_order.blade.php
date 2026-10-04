<section class="bg-white py-20 md:py-24">
    <div class="mx-auto max-w-6xl px-6">
        <div class="mb-14 max-w-xl">
            <span class="text-xs font-bold tracking-widest text-[#e21838] uppercase">Παραγγελία Καυσίμων</span>
            <h2 class="mt-3 text-3xl font-black tracking-tight text-slate-900 md:text-4xl">
                Διανομή καυσίμων στον χώρο σας
            </h2>
            <p class="mt-4 text-lg text-slate-500">
                Παραγγείλτε online και λάβετε άμεση προσφορά, χωρίς να φύγετε από το σπίτι ή την επιχείρησή σας.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <a
                href="{{ route('fuel-orders.create') }}"
                class="flex flex-col rounded-2xl border border-slate-200 p-8 transition-colors hover:border-[#e21838]"
            >
                <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-xl bg-red-50 text-[#e21838]">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-7 w-7"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.75"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"
                        />
                    </svg>
                </div>
                <span
                    class="mb-2 w-fit rounded-full bg-red-50 px-2.5 py-0.5 text-[10px] font-bold tracking-widest text-[#e21838] uppercase"
                >
                    Diesel
                </span>
                <h3 class="mb-2 text-xl font-bold text-slate-900">Πετρέλαιο Κίνησης</h3>
                <p class="mb-6 text-sm leading-relaxed text-slate-500">
                    Παράγγειλε τώρα και πάρε προσφορά με άμεση παράδοση στον χώρο σας.
                </p>
                <span class="mt-auto text-sm font-bold text-[#e21838]">Παράγγειλε τώρα →</span>
            </a>

            <a
                href="{{ route('lpg-orders.create') }}"
                class="flex flex-col rounded-2xl border border-slate-200 p-8 transition-colors hover:border-blue-500"
            >
                <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-7 w-7"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.75"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.99 7.99 0 0120 13a7.98 7.98 0 01-2.343 5.657z"
                        />
                    </svg>
                </div>
                <span
                    class="mb-2 w-fit rounded-full bg-blue-50 px-2.5 py-0.5 text-[10px] font-bold tracking-widest text-blue-600 uppercase"
                >
                    LPG
                </span>
                <h3 class="mb-2 text-xl font-bold text-slate-900">Υγραέριο (LPG)</h3>
                <p class="text-sm leading-relaxed text-slate-500">
                    Υγραέριο θέρμανσης για το σπίτι και προπανίου για επιχειρήσεις.
                </p>
                <p class="mt-3 text-xs font-semibold text-slate-400">
                    Αποκλειστικός αντιπρόσωπος Θεσσαλίας — Τύμπας Λάμπρος, 6944 638312
                </p>
                <span class="mt-auto pt-4 text-sm font-bold text-blue-600">Παράγγειλε τώρα →</span>
            </a>

            <div class="flex flex-col rounded-2xl border border-dashed border-slate-200 bg-slate-50 p-8">
                <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-xl bg-slate-200 text-slate-400">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-7 w-7"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.75"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                        />
                    </svg>
                </div>
                <span
                    class="mb-2 w-fit rounded-full bg-slate-200 px-2.5 py-0.5 text-[10px] font-bold tracking-widest text-slate-500 uppercase"
                >
                    Σύντομα
                </span>
                <h3 class="mb-2 text-xl font-bold text-slate-500">Πετρέλαιο Θέρμανσης</h3>
                <p class="text-sm leading-relaxed text-slate-400">Η online παραγγελία θα είναι διαθέσιμη σύντομα.</p>
            </div>
        </div>
    </div>
</section>
