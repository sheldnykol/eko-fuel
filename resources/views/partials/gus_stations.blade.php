<section id="gus_stations" class="bg-slate-50 py-16 md:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-16 flex flex-col items-center justify-center text-center">
            <div class="shadow-grey-200 mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-black shadow-lg">
                <img
                    class="h-10 w-10 object-contain brightness-0 invert"
                    src="{{ asset('images/gas-icon.png') }}"
                    alt="fuel_icon"
                />
            </div>
            <h2 class="text-3xl font-black tracking-tight text-slate-900 md:text-5xl">Τα Πρατήριά μας</h2>
            <p class="mt-4 text-lg text-slate-500">Επιλέξτε το πλησιέστερο σημείο εξυπηρέτησης στη Θεσσαλία</p>
        </div>

        <div class="grid grid-cols-1 gap-10 md:grid-cols-2 lg:gap-16">
            {{-- Πρατήριο 1 --}}
            <a
                href="{{ route('station.show', 1) }}"
                class="group relative flex flex-col overflow-hidden rounded-[2rem] bg-white shadow-sm ring-1 ring-slate-200 transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl"
            >
                <div class="relative h-64 overflow-hidden md:h-80">
                    <img
                        src="{{ asset('images\bolou.png') }}"
                        alt="ΕΚΟ ΒΟΛΟΥ 12"
                        class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110"
                    />
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent"
                    ></div>
                    <div class="absolute top-6 right-6">
                        <span
                            class="status-badge rounded-full bg-emerald-100 px-3 py-1 text-[10px] font-bold text-emerald-600 uppercase"
                        >
                            Ανοιχτά τώρα
                        </span>
                    </div>
                </div>
                <div class="flex flex-1 flex-col p-8">
                    <div class="mb-3 flex items-center gap-2 text-xs font-bold tracking-widest text-red-600 uppercase">
                        <span>Πρατήριο 01</span>
                        <span class="h-px w-8 bg-red-200"></span>
                    </div>
                    <h3
                        class="mb-4 text-2xl leading-tight font-black text-slate-900 transition-colors group-hover:text-red-600 md:text-3xl"
                    >
                        ΒΟΛΟΥ 12, ΛΑΡΙΣΑ
                    </h3>
                    <p class="mb-8 leading-relaxed text-slate-500">
                        Στο κεντρικότερο σημείο της οδού Βόλου, προσφέρουμε κορυφαία καύσιμα και ολοκληρωμένες υπηρεσίες
                        πλυντηρίου.
                    </p>
                    <div class="mt-auto flex items-center justify-between border-t border-slate-100 pt-6">
                        <span class="text-sm font-bold text-slate-900">Δες Τιμές & Υπηρεσίες</span>
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-50 text-red-600 transition-all group-hover:rotate-45 group-hover:bg-red-600 group-hover:text-white"
                        >
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2.5"
                                class="h-5 w-5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"
                                />
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            {{-- Πρατήριο 2 --}}
            <a
                href="{{ route('station.show', 2) }}"
                class="group relative flex flex-col overflow-hidden rounded-[2rem] bg-white shadow-sm ring-1 ring-slate-200 transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl"
            >
                <div class="relative h-64 overflow-hidden md:h-80">
                    <img
                        src="{{ asset('images\ethniki.png') }}"
                        alt="ΕΚΟ Λ. ΚΑΡΑΜΑΝΛΗ"
                        class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110"
                    />
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent"
                    ></div>
                    <div class="absolute top-6 right-6">
                        <span
                            class="status-badge rounded-full bg-emerald-100 px-3 py-1 text-[10px] font-bold text-emerald-600 uppercase"
                        >
                            Ανοιχτά τώρα
                        </span>
                    </div>
                </div>
                <div class="flex flex-1 flex-col p-8">
                    <div class="mb-3 flex items-center gap-2 text-xs font-bold tracking-widest text-red-600 uppercase">
                        <span>Πρατήριο 02</span>
                        <span class="h-px w-8 bg-red-200"></span>
                    </div>
                    <h3
                        class="mb-4 text-2xl leading-tight font-black text-slate-900 transition-colors group-hover:text-red-600 md:text-3xl"
                    >
                        Λ. ΚΑΡΑΜΑΝΛΗ 102, ΛΑΡΙΣΑ
                    </h3>
                    <p class="mb-8 leading-relaxed text-slate-500">
                        Εύκολη πρόσβαση στην έξοδο της πόλης (Π.Ε.Ο. Λάρισας-Αθηνών), ιδανικό για ανεφοδιασμό πριν το
                        ταξίδι.
                    </p>
                    <div class="mt-auto flex items-center justify-between border-t border-slate-100 pt-6">
                        <span class="text-sm font-bold text-slate-900">Δες Τιμές & Υπηρεσίες</span>
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-50 text-red-600 transition-all group-hover:rotate-45 group-hover:bg-red-600 group-hover:text-white"
                        >
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2.5"
                                class="h-5 w-5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"
                                />
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            {{-- Πρατήριο 3 --}}
            <a
                href="{{ route('station.show', 3) }}"
                class="group relative flex flex-col overflow-hidden rounded-[2rem] bg-white shadow-sm ring-1 ring-slate-200 transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl"
            >
                <div class="relative h-64 overflow-hidden md:h-80">
                    <img
                        src="{{ asset('images\gevrgiadou.png') }}"
                        alt="ΕΚΟ ΓΕΩΡΓΙΑΔΟΥ"
                        class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110"
                    />
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent"
                    ></div>
                    <div class="absolute top-6 right-6">
                        <span
                            class="status-badge rounded-full bg-emerald-100 px-3 py-1 text-[10px] font-bold text-emerald-600 uppercase"
                        >
                            Ανοιχτά τώρα
                        </span>
                    </div>
                </div>
                <div class="flex flex-1 flex-col p-8">
                    <div class="mb-3 flex items-center gap-2 text-xs font-bold tracking-widest text-red-600 uppercase">
                        <span>Πρατήριο 03</span>
                        <span class="h-px w-8 bg-red-200"></span>
                    </div>
                    <h3
                        class="mb-4 text-2xl leading-tight font-black text-slate-900 transition-colors group-hover:text-red-600 md:text-3xl"
                    >
                        ΓΕΩΡΓΙΑΔΟΥ 28, ΛΑΡΙΣΑ
                    </h3>
                    <p class="mb-8 leading-relaxed text-slate-500">
                        Πλήρως εξοπλισμένο πρατήριο στο κέντρο της Λάρισας με υπηρεσίες πλυσίματος και λιπαντικών.
                    </p>
                    <div class="mt-auto flex items-center justify-between border-t border-slate-100 pt-6">
                        <span class="text-sm font-bold text-slate-900">Δες Τιμές & Υπηρεσίες</span>
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-50 text-red-600 transition-all group-hover:rotate-45 group-hover:bg-red-600 group-hover:text-white"
                        >
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2.5"
                                class="h-5 w-5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"
                                />
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            {{-- Πρατήριο 4 --}}
            <a
                href="{{ route('station.show', 4) }}"
                class="group relative flex flex-col overflow-hidden rounded-[2rem] bg-white shadow-sm ring-1 ring-slate-200 transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl"
            >
                <div class="relative h-64 overflow-hidden md:h-80">
                    <img
                        src="{{ asset('images/IMG_1947.JPG') }}"
                        alt="ΕΚΟ ΠΟΡΤΑΡΙΑ"
                        class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110"
                    />
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent"
                    ></div>
                    <div class="absolute top-6 right-6">
                        <span
                            class="status-badge rounded-full bg-emerald-100 px-3 py-1 text-[10px] font-bold text-emerald-600 uppercase"
                        >
                            Ανοιχτά τώρα
                        </span>
                    </div>
                </div>
                <div class="flex flex-1 flex-col p-8">
                    <div class="mb-3 flex items-center gap-2 text-xs font-bold tracking-widest text-red-600 uppercase">
                        <span>Πρατήριο 04</span>
                        <span class="h-px w-8 bg-red-200"></span>
                    </div>
                    <h3
                        class="mb-4 text-2xl leading-tight font-black text-slate-900 transition-colors group-hover:text-red-600 md:text-3xl"
                    >
                        11ο ΧΛΜ, ΕΟ ΒΟΛΟΥ ΠΟΡΤΑΡΙΑΣ
                    </h3>
                    <p class="mb-8 leading-relaxed text-slate-500">
                        Εξυπηρετούμε τη διαδρομή προς Πήλιο με ποιοτικά καύσιμα και είδη καταστήματος για τις εξορμήσεις
                        σας.
                    </p>
                    <div class="mt-auto flex items-center justify-between border-t border-slate-100 pt-6">
                        <span class="text-sm font-bold text-slate-900">Δες Τιμές & Υπηρεσίες</span>
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-50 text-red-600 transition-all group-hover:rotate-45 group-hover:bg-red-600 group-hover:text-white"
                        >
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2.5"
                                class="h-5 w-5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"
                                />
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkStatus = () => {
            const now = new Date()
            const hour = now.getHours()
            const isOpen = hour >= 6 && hour < 23
            const badges = document.querySelectorAll('.status-badge')

            badges.forEach(badge => {
                if (isOpen) {
                    badge.innerText = 'Ανοιχτά τώρα'
                    badge.classList.remove('bg-red-100', 'text-red-600')
                    badge.classList.add('bg-emerald-100', 'text-emerald-600')
                } else {
                    badge.innerText = 'Κλειστά'
                    badge.classList.remove('bg-emerald-100', 'text-emerald-600')
                    badge.classList.add('bg-red-100', 'text-red-600')
                }
            })
        }
        checkStatus()
        setInterval(checkStatus, 60000)
    })
</script>
