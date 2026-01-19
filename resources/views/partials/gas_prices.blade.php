<section class="bg-white py-8 md:py-12">
    <div class="container mx-auto px-4">
        <div class="mb-6 flex items-center justify-center gap-3">
            <img
                class="h-14 w-14 object-contain md:h-20 md:w-20"
                src="{{ asset('images/fuel_icon_rm.png') }}"
                alt="fuel_icon"
            />
            <h2 class="text-center text-2xl font-extrabold md:text-3xl lg:text-4xl">Τιμές Καυσίμων</h2>
            <img
                src="{{ asset('images/station1.png') }}"
                alt="Πρατήριο 2"
                class="h-48 w-full object-cover transition-transform duration-500 group-hover:scale-105 md:h-64 lg:h-80"
            />
        </div>

        <!-- Horizontal scroll for mobile /  grid in desktop -->
        <div class="scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100 -mx-4 overflow-x-auto px-4 pb-4">
            <div class="flex min-w-max gap-4 md:grid md:min-w-full md:grid-cols-3 md:gap-6 lg:grid-cols-6 lg:gap-8">
                <!-- fuel 1 -->
                <div class="w-40 shrink-0 rounded-lg border border-indigo-100 bg-white text-center shadow-md md:w-auto">
                    <h4 class="bg-black py-1.5 text-xs font-extrabold text-white md:text-sm">Αμόλυβδη 100</h4>
                    <img
                        src="{{ asset('images/racing.jpg') }}"
                        alt="100"
                        loading="lazy"
                        class="h-20 w-full object-contain md:h-28 lg:h-32"
                    />
                    <p class="py-2 text-lg font-extrabold text-black md:text-2xl lg:text-4xl">1,78</p>
                </div>

                <!-- fuel 2 -->
                <div class="w-40 shrink-0 rounded-lg border border-indigo-100 bg-white text-center shadow-md md:w-auto">
                    <h4 class="bg-[#e21838] py-1.5 text-xs font-extrabold text-white md:text-sm">Αμόλυβδη 95</h4>
                    <img
                        src="{{ asset('images/95eko.jpg') }}"
                        alt="95"
                        loading="lazy"
                        class="h-20 w-full object-contain md:h-28 lg:h-32"
                    />
                    <p class="py-2 text-lg font-extrabold text-black md:text-2xl lg:text-4xl">1,78</p>
                </div>

                <!-- fuel 3 -->
                <div class="w-40 shrink-0 rounded-lg border border-indigo-100 bg-white text-center shadow-md md:w-auto">
                    <h4 class="bg-blue-700 py-1.5 text-xs font-extrabold text-white md:text-sm">Diesel Economy</h4>
                    <img
                        src="{{ asset('images/ekonomy.jpg') }}"
                        alt="Economy"
                        loading="lazy"
                        class="h-20 w-full object-contain md:h-28 lg:h-32"
                    />
                    <p class="py-2 text-lg font-extrabold text-black md:text-2xl lg:text-4xl">1,78</p>
                </div>

                <!-- fuel 4 -->
                <div class="w-40 shrink-0 rounded-lg border border-indigo-100 bg-white text-center shadow-md md:w-auto">
                    <h4 class="bg-gray-600 py-1.5 text-xs font-extrabold text-white md:text-sm">Diesel Avio</h4>
                    <img
                        src="{{ asset('images/diesel-avio.jpg') }}"
                        alt="Avio"
                        loading="lazy"
                        class="h-20 w-full object-contain md:h-28 lg:h-32"
                    />
                    <p class="py-2 text-lg font-extrabold text-black md:text-2xl lg:text-4xl">1,78</p>
                </div>

                <!-- fuel 5 -->
                <div class="w-40 shrink-0 rounded-lg border border-indigo-100 bg-white text-center shadow-md md:w-auto">
                    <h4 class="bg-[#e21838] py-1.5 text-xs font-extrabold text-white md:text-sm">Auto Gas</h4>
                    <img
                        src="{{ asset('images/auto-gas.jpg') }}"
                        alt="Auto Gas"
                        loading="lazy"
                        class="h-20 w-full object-contain md:h-28 lg:h-32"
                    />
                    <p class="py-2 text-lg font-extrabold text-black md:text-2xl lg:text-4xl">1,78</p>
                </div>

                <!- fuel 6 -->
                <div class="w-40 shrink-0 rounded-lg border border-indigo-100 bg-white text-center shadow-md md:w-auto">
                    <h4 class="bg-gray-300 py-1.5 text-xs font-extrabold text-white md:text-sm">Πετρέλαιο Θέρμανσης</h4>
                    <img
                        src="{{ asset('images/thermanshs.png') }}"
                        alt="Θέρμανσης"
                        loading="lazy"
                        class="h-20 w-full object-contain md:h-28 lg:h-32"
                    />
                    <p class="py-2 text-lg font-extrabold text-black md:text-2xl lg:text-4xl">1,78</p>
                </div>
            </div>
        </div>
    </div>
</section>
