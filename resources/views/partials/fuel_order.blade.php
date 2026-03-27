<section class="bg-slate-50 py-18 md:py-24">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 justify-items-center">

            <a href="{{ route('fuel-orders.create') }}" class="group relative block w-full max-w-sm p-10 bg-white border border-slate-200 rounded-3xl shadow-sm hover:shadow-2xl hover:border-red-500 transition-all duration-300 text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 mb-6 rounded-2xl bg-red-50 text-red-600 group-hover:bg-red-600 group-hover:text-white transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-slate-800 mb-2">Πετρέλαιο Κίνησης</h3>
                <p class="text-2xl font-bold text-slate-800 mb-2">Παράγγειλε Τώρα και Πάρε Προσφορά</p>
                <p class="text-slate-500">Άμεση παράδοση στον χώρο σας </p>
                <span class="absolute top-4 right-4 bg-red-100 text-red-600 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest">DIESEL</span>
            </a>

            <a href="{{ route('lpg-orders.create') }}" class="group relative block w-full max-w-sm p-10 bg-white border border-slate-200 rounded-3xl shadow-sm hover:shadow-2xl hover:border-blue-500 transition-all duration-300 text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 mb-6 rounded-2xl bg-blue-50 text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.99 7.99 0 0120 13a7.98 7.98 0 01-2.343 5.657z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-slate-800 mb-2">Υγραέριο (LPG)</h3>
                <span class= "text-base font-bold text-slate-800 mb-2">ΑΠΟΚΛΕΙΣΤΙΚΟΣ ΑΝΤΙΠΡΟΣΩΠΟΣ ΘΕΣΣΑΛΙΑΣ ΤΥΜΠΑΣ ΓΙΩΡΓΟΣ(6944638312)</span>
                <p class="text-slate-500">Υγραέριο για Θέρμανσης για το σπίτι <br> Υγραεριο προπανίου για επιχειρήσεις</p>
                <span class="absolute top-4 right-4 bg-blue-100 text-blue-600 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest">LPG</span>
            </a>

            <a href="{{ route('heating-οil-orders.create') }}" class="group relative block w-full max-w-sm p-10 bg-white border border-slate-200 rounded-3xl shadow-sm hover:shadow-2xl hover:border-orange-500 transition-all duration-300 text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 mb-6 rounded-2xl bg-orange-50 text-orange-600 group-hover:bg-orange-600 group-hover:text-white transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-slate-800 mb-2">Πετρέλαιο Θέρμανσης</h3>
                <p class="text-slate-">Ζεστασιά σε κάθε σπίτι</p>
                <span class="absolute top-4 right-4 bg-orange-100 text-orange-600 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest">HEAT</span>
            </a>

        </div>
    </div>
</section>

