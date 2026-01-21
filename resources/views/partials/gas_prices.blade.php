<section class="relative overflow-hidden bg-slate-50 py-12 md:py-20">
    <div
        class="absolute top-0 -left-20 h-96 w-96 rounded-full bg-blue-100 opacity-30 mix-blend-multiply blur-3xl filter"
    ></div>
    <div
        class="absolute -right-20 bottom-0 h-96 w-96 rounded-full bg-indigo-100 opacity-30 mix-blend-multiply blur-3xl filter"
    ></div>

    <div class="relative container mx-auto px-4">
        <div class="mb-10 flex flex-col items-center justify-center gap-4 text-center md:mb-14">
            <div
                class="inline-flex h-20 w-20 items-center justify-center rounded-full bg-white shadow-md ring-1 ring-slate-100"
            >
                <img class="h-12 w-12 object-contain" src="{{ asset('images/fuel_icon_rm.png') }}" alt="fuel_icon" />
            </div>
            <div>
                <h2 class="text-3xl font-black tracking-tight text-slate-800 md:text-4xl lg:text-5xl">
                    Τιμές Καυσίμων
                </h2>
                <p class="mt-2 text-sm font-medium text-slate-500">Ενημερωθείτε για τις τρέχουσες τιμές μας</p>
            </div>
        </div>

        <div class="scrollbar-hide -mx-4 overflow-x-auto px-4 pt-4 pb-8 md:overflow-visible">
            <div
                class="flex snap-x snap-mandatory gap-6 pb-4 md:grid md:grid-cols-2 md:gap-8 lg:grid-cols-3 xl:grid-cols-6"
            >
                <div
                    class="group relative flex w-64 shrink-0 snap-center flex-col items-center overflow-hidden rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl md:w-auto"
                >
                    <div class="absolute top-0 h-1.5 w-full bg-gradient-to-r from-gray-900 to-black"></div>

                    <div class="mb-4 flex h-24 w-full items-center justify-center">
                        <img
                            src="{{ asset('images/racing.jpg') }}"
                            alt="100"
                            loading="lazy"
                            class="h-full w-full object-contain transition-transform duration-500 group-hover:scale-110"
                        />
                    </div>

                    <h4 class="mb-1 text-sm font-bold tracking-wider text-slate-400 uppercase">Αμολυβδη 100</h4>

                    <div class="flex items-baseline gap-1">
                        <span class="text-3xl font-black text-slate-800 md:text-4xl">
                            {{ $prices['amolyvdhi_100'] ?? '-' }}
                        </span>
                        <span class="text-xs font-semibold text-slate-400">€/L</span>
                    </div>
                </div>

                <div
                    class="group relative flex w-64 shrink-0 snap-center flex-col items-center overflow-hidden rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl md:w-auto"
                >
                    <div class="absolute top-0 h-1.5 w-full bg-gradient-to-r from-red-500 to-red-600"></div>
                    <div class="mb-4 flex h-24 w-full items-center justify-center">
                        <img
                            src="{{ asset('images/95eko.jpg') }}"
                            alt="95"
                            loading="lazy"
                            class="h-full w-full object-contain transition-transform duration-500 group-hover:scale-110"
                        />
                    </div>
                    <h4 class="mb-1 text-sm font-bold tracking-wider text-slate-400 uppercase">Αμολυβδη 95</h4>
                    <div class="flex items-baseline gap-1">
                        <span class="text-3xl font-black text-slate-800 md:text-4xl">
                            {{ $prices['amolyvdhi_95'] ?? '-' }}
                        </span>
                        <span class="text-xs font-semibold text-slate-400">€/L</span>
                    </div>
                </div>

                <div
                    class="group relative flex w-64 shrink-0 snap-center flex-col items-center overflow-hidden rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl md:w-auto"
                >
                    <div class="absolute top-0 h-1.5 w-full bg-gradient-to-r from-blue-600 to-blue-700"></div>
                    <div class="mb-4 flex h-24 w-full items-center justify-center">
                        <img
                            src="{{ asset('images/ekonomy.jpg') }}"
                            alt="Economy"
                            loading="lazy"
                            class="h-full w-full object-contain transition-transform duration-500 group-hover:scale-110"
                        />
                    </div>
                    <h4 class="mb-1 text-sm font-bold tracking-wider text-slate-400 uppercase">Diesel Economy</h4>
                    <div class="flex items-baseline gap-1">
                        <span class="text-3xl font-black text-slate-800 md:text-4xl">
                            {{ $prices['diesel_economy'] ?? '-' }}
                        </span>
                        <span class="text-xs font-semibold text-slate-400">€/L</span>
                    </div>
                </div>

                <div
                    class="group relative flex w-64 shrink-0 snap-center flex-col items-center overflow-hidden rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl md:w-auto"
                >
                    <div class="absolute top-0 h-1.5 w-full bg-gradient-to-r from-slate-600 to-slate-700"></div>
                    <div class="mb-4 flex h-24 w-full items-center justify-center">
                        <img
                            src="{{ asset('images/diesel-avio.jpg') }}"
                            alt="Avio"
                            loading="lazy"
                            class="h-full w-full object-contain transition-transform duration-500 group-hover:scale-110"
                        />
                    </div>
                    <h4 class="mb-1 text-sm font-bold tracking-wider text-slate-400 uppercase">Diesel Avio</h4>
                    <div class="flex items-baseline gap-1">
                        <span class="text-3xl font-black text-slate-800 md:text-4xl">
                            {{ $prices['diesel_avio'] ?? '-' }}
                        </span>
                        <span class="text-xs font-semibold text-slate-400">€/L</span>
                    </div>
                </div>

                <div
                    class="group relative flex w-64 shrink-0 snap-center flex-col items-center overflow-hidden rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl md:w-auto"
                >
                    <div class="absolute top-0 h-1.5 w-full bg-gradient-to-r from-emerald-500 to-emerald-600"></div>
                    <div class="mb-4 flex h-24 w-full items-center justify-center">
                        <img
                            src="{{ asset('images/auto-gas.jpg') }}"
                            alt="Auto Gas"
                            loading="lazy"
                            class="h-full w-full object-contain transition-transform duration-500 group-hover:scale-110"
                        />
                    </div>
                    <h4 class="mb-1 text-sm font-bold tracking-wider text-slate-400 uppercase">Auto Gas</h4>
                    <div class="flex items-baseline gap-1">
                        <span class="text-3xl font-black text-slate-800 md:text-4xl">
                            {{ $prices['auto_gas'] ?? '-' }}
                        </span>
                        <span class="text-xs font-semibold text-slate-400">€/L</span>
                    </div>
                </div>

                <div
                    class="group relative flex w-64 shrink-0 snap-center flex-col items-center overflow-hidden rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl md:w-auto"
                >
                    <div class="absolute top-0 h-1.5 w-full bg-gradient-to-r from-orange-400 to-orange-500"></div>
                    <div class="mb-4 flex h-24 w-full items-center justify-center">
                        <img
                            src="{{ asset('images/thermanshs.png') }}"
                            alt="Θέρμανσης"
                            loading="lazy"
                            class="h-full w-full object-contain transition-transform duration-500 group-hover:scale-110"
                        />
                    </div>
                    <h4 class="mb-1 text-sm font-bold tracking-wider text-slate-400 uppercase">Θερμανσης</h4>
                    <div class="flex items-baseline gap-1">
                        <span class="text-3xl font-black text-slate-800 md:text-4xl">
                            {{ $prices['petrelaio'] ?? '-' }}
                        </span>
                        <span class="text-xs font-semibold text-slate-400">€/L</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
