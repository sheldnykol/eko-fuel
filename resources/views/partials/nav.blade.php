<header class="sticky top-0 z-50 w-full border-b border-gray-100 bg-white/90 backdrop-blur-md transition-all">
    <div class="container mx-auto px-4 md:px-6">
        <div class="flex h-20 items-center justify-between">
            <a href="/" class="group flex items-center gap-2">
                <img
                    src="{{ asset('images/eko-logo.png') }}"
                    alt="EKO Logo"
                    class="h-12 w-auto object-contain transition-transform duration-300 group-hover:scale-105"
                />
                <span class="hidden text-2xl font-black tracking-tighter text-[#e21838] md:block">EKO</span>
            </a>

            <nav class="hidden items-center gap-8 md:flex">
                <a href="#" class="text-sm font-semibold text-slate-600 transition-colors hover:text-[#e21838]">
                    Αρχική
                </a>
                <a href="#" class="text-sm font-semibold text-slate-600 transition-colors hover:text-[#e21838]">
                    Καύσιμα
                </a>
                <a href="#" class="text-sm font-semibold text-slate-600 transition-colors hover:text-[#e21838]">
                    Υπηρεσίες
                </a>
                <a href="#" class="text-sm font-semibold text-slate-600 transition-colors hover:text-[#e21838]">
                    Επικοινωνία
                </a>
            </nav>

            <div class="hidden items-center gap-4 md:flex">
                <a href="tel:210xxxxxxx" class="hidden text-sm font-bold text-slate-500 hover:text-slate-800 lg:block">
                    <span class="mr-1">📞</span>
                    2410283954
                </a>

                <a
                    href="#"
                    class="rounded-full bg-[#e21838] px-6 py-2.5 text-sm font-bold text-white shadow-md shadow-red-500/20 transition-all hover:-translate-y-0.5 hover:bg-[#c4142f] hover:shadow-lg"
                >
                    Σύνδεση
                </a>
            </div>

            <div class="flex items-center md:hidden">
                <input type="checkbox" id="menu-toggle" class="peer hidden" />

                <label
                    for="menu-toggle"
                    class="cursor-pointer rounded-md p-2 text-slate-600 transition hover:bg-slate-100 hover:text-[#e21838]"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-8 w-8"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </label>
                {{-- inset-inline: 0 gia emfanizei to div apo ta 0px aristera ths selidas | origin-top : gia na kanei emfanish apo panw pros ta katw otan patas to hum --}}
                <div
                    class="absolute inset-x-0 top-20 -z-10 origin-top scale-y-0 bg-white px-6 py-8 shadow-xl transition-transform duration-300 ease-in-out peer-checked:scale-y-100"
                >
                    <div class="flex flex-col space-y-4 text-center">
                        <a href="#" class="text-lg font-medium text-slate-800 hover:text-[#e21838]">Αρχική</a>
                        <a href="#" class="text-lg font-medium text-slate-800 hover:text-[#e21838]">Καύσιμα</a>
                        <a href="#" class="text-lg font-medium text-slate-800 hover:text-[#e21838]">Υπηρεσίες</a>
                        <a href="#" class="text-lg font-medium text-slate-800 hover:text-[#e21838]">Επικοινωνία</a>
                        <hr class="border-slate-100" />
                        <a
                            href="#"
                            class="flex w-full items-center justify-center gap-2 rounded-xl bg-slate-100 py-3 text-lg font-bold text-[#e21838]"
                        >
                            <span>👤</span>
                            Σύνδεση
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
