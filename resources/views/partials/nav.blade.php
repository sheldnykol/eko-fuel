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
            @guest
                <nav class="hidden items-center gap-8 md:flex">
                    <a href="/" class="text-sm font-semibold text-slate-600 transition-colors hover:text-[#e21838]">
                        Αρχική
                    </a>
                    <a
                        href="/services"
                        class="text-sm font-semibold text-slate-600 transition-colors hover:text-[#e21838]"
                    >
                        Υπηρεσίες
                    </a>
                    <a
                        href="{{ route('stations.show') }}"
                        class="text-sm font-semibold text-slate-600 transition-colors hover:text-[#e21838]"
                    >
                        Επικοινωνία
                    </a>
                </nav>
            @endguest

            <div class="hidden items-center gap-4 md:flex">
                @guest
                    <a
                        href="tel:2410283954"
                        class="hidden items-center gap-1.5 text-sm font-bold text-slate-500 hover:text-slate-800 lg:flex"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="h-4 w-4"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.896-1.596-5.069-3.769-6.665-6.665l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"
                            />
                        </svg>
                        2410283954
                    </a>
                    <a
                        href="/login"
                        class="rounded-full bg-[#e21838] px-6 py-2.5 text-sm font-bold text-white shadow-md shadow-red-500/20 transition-all hover:-translate-y-0.5 hover:bg-[#c4142f] hover:shadow-lg"
                    >
                        Σύνδεση
                    </a>
                @endguest

                @auth
                    <span class="flex items-center gap-1 text-sm font-bold text-emerald-600">
                        <span class="h-2 w-2 animate-pulse rounded-full bg-emerald-500"></span>
                        ADMIN CONNECTED: {{ Auth::user()->name }}
                    </span>
                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="text-sm font-bold text-slate-600 hover:text-[#e21838]"
                    >
                        Dashboard
                    </a>

                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button
                            type="submit"
                            class="rounded-full bg-slate-800 px-6 py-2.5 text-sm font-bold text-white transition-all hover:bg-black"
                        >
                            Αποσύνδεση
                        </button>
                    </form>
                @endauth
            </div>
            {{-- mobile --}}
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
                        @guest
                            <a href="/" class="text-lg font-medium text-slate-800 hover:text-[#e21838]">Αρχική</a>
                            <a href="#" class="text-lg font-medium text-slate-800 hover:text-[#e21838]">Καύσιμα</a>
                            <a href="/services" class="text-lg font-medium text-slate-800 hover:text-[#e21838]">
                                Υπηρεσίες
                            </a>
                            <a
                                href="{{ route('stations.show') }}"
                                class="text-lg font-medium text-slate-800 hover:text-[#e21838]"
                            >
                                Επικοινωνία
                            </a>
                            <hr class="border-slate-100" />
                            <a
                                href="#"
                                class="flex w-full items-center justify-center gap-2 rounded-xl bg-slate-100 py-3 text-lg font-bold text-[#e21838]"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                    stroke="currentColor"
                                    class="h-5 w-5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"
                                    />
                                </svg>
                                Σύνδεση
                            </a>
                        @endguest

                        @auth
                            <div class="mb-2 font-bold text-emerald-600">Γεια σου, {{ Auth::user()->name }}</div>
                            <a href="{{ route('admin.dashboard') }}" class="text-lg font-medium text-slate-800">
                                Dashboard
                            </a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button
                                    type="submit"
                                    class="w-full rounded-xl bg-red-50 py-3 text-lg font-bold text-red-600"
                                >
                                    Αποσύνδεση
                                </button>
                            </form>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
