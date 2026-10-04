<section class="relative h-screen min-h-[600px] w-full overflow-hidden bg-[#050505]">
    <div class="pointer-events-none absolute inset-0 z-0 overflow-hidden">
        <div class="absolute -top-[20%] -left-[10%] h-[70vh] w-[50vw] rounded-full bg-[#e21838]/10 blur-[120px]"></div>
        <div class="absolute top-[60%] -right-[10%] h-[60vh] w-[40vw] rounded-full bg-blue-900/15 blur-[120px]"></div>
    </div>

    <div id="slider-container" class="relative z-10 h-full w-full">
        <div class="cinematic-slide active absolute inset-0 h-full w-full" data-slide="0">
            <div class="absolute inset-0 z-0 flex justify-end">
                <div class="relative w-full lg:w-3/5">
                    <div
                        class="absolute inset-0 z-10 bg-gradient-to-r from-[#050505] via-[#050505]/80 to-transparent"
                    ></div>
                    <div
                        class="absolute inset-0 z-10 bg-gradient-to-t from-[#050505] via-transparent to-transparent"
                    ></div>
                    <img
                        src="{{ asset('images/opt/bolou.webp') }}"
                        class="slide-img h-full w-full object-cover opacity-60 mix-blend-luminosity"
                        alt="Πρατήριο EKO Βόλου 12 στη Λάρισα"
                        fetchpriority="high"
                    />
                </div>
            </div>
            <div class="relative z-20 mx-auto flex h-full max-w-7xl items-center px-16 lg:px-24">
                <div class="slide-content max-w-2xl">
                    <div class="mb-4 inline-flex items-center gap-3">
                        <span class="h-px w-8 bg-[#e21838]"></span>
                        <span class="text-sm font-bold tracking-[0.2em] text-[#e21838] uppercase">EKO ΛΑΡΙΣΑ</span>
                    </div>
                    <h1 class="mb-6 text-5xl leading-[1.05] font-black tracking-tight text-white lg:text-8xl">
                        Καλώς ήρθατε στην
                        <br />
                        <span class="text-[#e21838]/70">ΕΚΟ ΔΡΑΜΗ.</span>
                        <span class="sr-only">Πρατήρια καυσίμων EKO και πλυντήριο αυτοκινήτων στη Λάρισα</span>
                    </h1>
                    <p class="mb-10 max-w-md text-lg leading-relaxed text-zinc-400">
                        Ποιότητα καυσίμων επόμενης γενιάς, κορυφαία εξυπηρέτηση και καινοτόμες υπηρεσίες σχεδιασμένες
                        για κάθε σας διαδρομή.
                    </p>
                    <a
                        href="#gas_stations"
                        class="group relative inline-flex h-14 items-center justify-center overflow-hidden rounded-full bg-white px-8 font-bold tracking-wider text-black transition-all hover:scale-105"
                    >
                        <div
                            class="absolute inset-0 flex h-full w-full [transform:skew(-1deg)_translateX(-100%)] justify-center group-hover:[transform:skew(-1deg)_translateX(100%)] group-hover:duration-1000"
                        >
                            <div class="relative h-full w-8 bg-white/20"></div>
                        </div>
                        <span class="relative">ΒΡΕΣ ΠΡΑΤΗΡΙΟ</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="cinematic-slide absolute inset-0 h-full w-full" data-slide="1">
            <div class="absolute inset-0 z-0 flex justify-end">
                <div class="relative w-full lg:w-3/5">
                    <div
                        class="absolute inset-0 z-10 bg-gradient-to-r from-[#050505] via-[#050505]/80 to-transparent"
                    ></div>
                    <div
                        class="absolute inset-0 z-10 bg-gradient-to-t from-[#050505] via-transparent to-transparent"
                    ></div>
                    <img
                        src="{{ asset('images/opt/wash_logo.webp') }}"
                        class="slide-img h-full w-full object-cover opacity-60 mix-blend-luminosity"
                        alt="Πλυντήριο αυτοκινήτων EKO στη Λάρισα"
                        decoding="async"
                    />
                </div>
            </div>
            <div class="relative z-20 mx-auto flex h-full max-w-7xl items-center px-16 lg:px-24">
                <div class="slide-content max-w-2xl">
                    <div class="mb-4 inline-flex items-center gap-3">
                        <span class="h-px w-8 bg-blue-500"></span>
                        <span class="text-sm font-bold tracking-[0.2em] text-blue-500 uppercase">EKO WASH</span>
                    </div>
                    <h2 class="mb-6 text-6xl leading-[1.05] font-black tracking-tight text-white lg:text-8xl">
                        Κλείστε Ραντεβού
                        <br />
                        <span class="text-blue-500/70">για Πλύσιμο.</span>
                    </h2>
                    <p class="mb-10 max-w-md text-lg leading-relaxed text-zinc-400">
                        Επαγγελματικός καθαρισμός του οχήματός σας μέσα και έξω. Χρησιμοποιούμε κορυφαία προϊόντα
                        περιποίησης για ένα αστραφτερό αποτέλεσμα.
                    </p>
                    <a
                        href="/booking"
                        class="group relative inline-flex h-14 items-center justify-center overflow-hidden rounded-full bg-blue-600 px-8 font-bold tracking-wider text-white transition-all hover:scale-105 hover:bg-blue-500"
                    >
                        <span class="relative">ΚΛΕΙΣΕ ΡΑΝΤΕΒΟΥ</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="cinematic-slide absolute inset-0 h-full w-full" data-slide="2">
            <div class="absolute inset-0 z-0 flex justify-end">
                <div class="relative w-full lg:w-3/5">
                    <div
                        class="absolute inset-0 z-10 bg-gradient-to-r from-[#050505] via-[#050505]/80 to-transparent"
                    ></div>
                    <div
                        class="absolute inset-0 z-10 bg-gradient-to-t from-[#050505] via-transparent to-transparent"
                    ></div>
                    <img
                        src="{{ asset('images/opt/pitstop.webp') }}"
                        class="slide-img h-full w-full object-contain p-10 opacity-30 mix-blend-screen"
                        alt="Λιπαντικά και αξεσουάρ αυτοκινήτου EKO"
                        decoding="async"
                    />
                </div>
            </div>
            <div class="relative z-20 mx-auto flex h-full max-w-7xl items-center px-16 lg:px-24">
                <div class="slide-content max-w-2xl">
                    <div class="mb-4 inline-flex items-center gap-3">
                        <span class="h-px w-8 bg-zinc-500"></span>
                        <span class="text-sm font-bold tracking-[0.2em] text-zinc-400 uppercase">EKO SHOP</span>
                    </div>
                    <h2 class="mb-6 text-6xl leading-[1.05] font-black tracking-tight text-white lg:text-8xl">
                        Λιπαντικά &
                        <br />
                        <span class="text-zinc-500">Αξεσουάρ.</span>
                    </h2>
                    <p class="mb-10 max-w-md text-lg leading-relaxed text-zinc-400">
                        Μεγάλη διαθεσιμότητα σε επώνυμα λιπαντικά, ειδικά χημικά, αντιψυκτικά και ό,τι απαιτεί η σωστή
                        συντήρηση του κινητήρα σας.
                    </p>
                    <a
                        href="/station/1/products"
                        class="group relative inline-flex h-14 items-center justify-center overflow-hidden rounded-full border border-white/20 bg-white/5 px-8 font-bold tracking-wider text-white backdrop-blur-md transition-all hover:bg-white/10"
                    >
                        <span class="relative">ΔΕΙΤΕ ΤΑ ΠΡΟΪΟΝΤΑ</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <button
        id="prev-slide"
        class="absolute top-1/2 left-2 z-40 -translate-y-1/2 p-4 text-white/20 transition-colors hover:text-white lg:left-6"
        aria-label="Προηγούμενο"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="2"
            stroke="currentColor"
            class="h-8 w-8"
        >
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
        </svg>
    </button>
    <button
        id="next-slide"
        class="absolute top-1/2 right-12 z-40 -translate-y-1/2 p-4 text-white/20 transition-colors hover:text-white lg:right-24"
        aria-label="Επόμενο"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="2"
            stroke="currentColor"
            class="h-8 w-8"
        >
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
        </svg>
    </button>

    <div class="absolute top-1/2 right-4 z-30 flex -translate-y-1/2 flex-col items-center gap-6 lg:right-10">
        <div class="text-xs font-bold tracking-widest text-zinc-500">01</div>
        <div class="relative flex h-24 w-[2px] flex-col justify-between bg-white/10">
            <div
                id="progress-line"
                class="absolute top-0 left-0 w-full bg-[#e21838] transition-all duration-700 ease-out"
                style="height: 33.33%"
            ></div>

            <button class="nav-trigger h-1/3 w-4 -translate-x-1/2 cursor-pointer" data-target="0" aria-label="Διαφάνεια 1"></button>
            <button class="nav-trigger h-1/3 w-4 -translate-x-1/2 cursor-pointer" data-target="1" aria-label="Διαφάνεια 2"></button>
            <button class="nav-trigger h-1/3 w-4 -translate-x-1/2 cursor-pointer" data-target="2" aria-label="Διαφάνεια 3"></button>
        </div>
        <div class="text-xs font-bold tracking-widest text-zinc-500">03</div>
    </div>
</section>

<style>
    .cinematic-slide {
        opacity: 0;
        visibility: hidden;
        transition:
            opacity 1000ms ease-in-out,
            visibility 1000ms;
    }

    .cinematic-slide.active {
        opacity: 1;
        visibility: visible;
        z-index: 20;
    }

    .cinematic-slide .slide-content {
        transform: translateY(30px) scale(0.98);
        opacity: 0;
        transition: all 1000ms cubic-bezier(0.19, 1, 0.22, 1);
        transition-delay: 200ms;
    }

    .cinematic-slide .slide-img {
        transform: scale(0.9) translateX(10px);
        transition: transform 7000ms cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .cinematic-slide.active .slide-content {
        transform: translateY(0) scale(1);
        opacity: 1;
    }

    .cinematic-slide.active .slide-img {
        transform: scale(1) translateX(0);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const slides = document.querySelectorAll('.cinematic-slide')
        const triggers = document.querySelectorAll('.nav-trigger')
        const progressLine = document.getElementById('progress-line')
        const prevBtn = document.getElementById('prev-slide')
        const nextBtn = document.getElementById('next-slide')

        let current = 0
        let timer
        const totalSlides = slides.length

        const updateSlide = index => {
            if (index === current) return

            if (index >= totalSlides) index = 0
            if (index < 0) index = totalSlides - 1

            slides[current].classList.remove('active')

            current = index
            slides[current].classList.add('active')

            const heightPercentage = ((current + 1) / totalSlides) * 100
            progressLine.style.height = `${heightPercentage}%`
        }

        const resetTimer = () => {
            clearInterval(timer)
            timer = setInterval(() => updateSlide(current + 1), 6000)
        }

        prevBtn.addEventListener('click', () => {
            updateSlide(current - 1)
            resetTimer()
        })

        nextBtn.addEventListener('click', () => {
            updateSlide(current + 1)
            resetTimer()
        })

        triggers.forEach(trigger => {
            trigger.addEventListener('click', e => {
                updateSlide(parseInt(e.target.dataset.target))
                resetTimer()
            })
        })

        resetTimer()
    })
</script>
