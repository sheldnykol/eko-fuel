<section class="relative min-h-[90vh] w-full overflow-hidden bg-slate-900">
    <div class="absolute inset-0 overflow-hidden">
        <img
            src="{{ asset('images/hero1.jpg') }}"
            alt="Hero Background"
            class="h-full w-full object-cover transition-transform duration-[10000ms] ease-out group-hover:scale-110 motion-safe:animate-[zoom_20s_infinite_alternate]"
            loading="eager"
        />
    </div>

    <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/40 to-transparent"></div>

    <div class="relative z-10 mx-auto flex h-full min-h-[90vh] max-w-7xl items-center px-6 md:px-12">
        <div class="max-w-3xl">
            <div
                class="animate-fade-in mb-6 inline-flex items-center gap-2 rounded-full bg-red-600/20 px-4 py-1.5 text-sm font-bold tracking-wide text-red-500 ring-1 ring-red-500/30 backdrop-blur-md"
            >
                <span class="relative flex h-2 w-2">
                    <span
                        class="absolute inline-flex h-full w-full animate-ping rounded-full bg-red-400 opacity-75"
                    ></span>
                    <span class="relative inline-flex h-2 w-2 rounded-full bg-red-500"></span>
                </span>
                EKO -AΦΟΙ Κ ΔΡΑΜΗ ΟΕ
            </div>

            <h1 class="mb-6 text-5xl leading-[1.1] font-black text-white md:text-7xl lg:text-8xl">
                Καλώς ήρθατε
                <br />
                <span class="bg-gradient-to-r from-red-500 to-red-700 bg-clip-text text-transparent">στην ΕΚΟ!</span>
            </h1>

            <p class="mb-10 max-w-xl text-lg leading-relaxed text-slate-300 md:text-xl">
                Ποιότητα καυσίμων, κορυφαία εξυπηρέτηση και καινοτόμες υπηρεσίες για κάθε σας διαδρομή.
            </p>

            <div class="flex flex-col items-center gap-4 sm:flex-row sm:gap-6">
                <a
                    href="#"
                    class="group relative flex w-full min-w-[200px] items-center justify-center overflow-hidden rounded-xl bg-[#e21838] px-8 py-5 text-lg font-black text-white transition-all hover:bg-[#c4142f] hover:shadow-[0_0_30px_-5px_rgba(226,24,56,0.5)] sm:w-auto"
                >
                    <span class="relative z-10">ΒΡΕΣ ΠΡΑΤΗΡΙΟ</span>
                    <div
                        class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-white/20 to-transparent transition-transform duration-500 group-hover:translate-x-full"
                    ></div>
                </a>
            </div>

            <div class="mt-12 flex items-center gap-8 border-t border-white/10 pt-8">
                <div>
                    <span class="block text-2xl font-bold text-white">24/7</span>
                    <span class="text-sm text-slate-400 italic">Εξυπηρέτηση</span>
                </div>
                <div class="h-8 w-px bg-white/10"></div>
                <div>
                    <span class="block text-2xl font-bold text-white">100%</span>
                    <span class="text-sm text-slate-400 italic">Εγγύηση Ποιότητας</span>
                </div>
            </div>
        </div>
    </div>

    <div class="absolute bottom-0 left-0 h-32 w-full bg-gradient-to-t from-slate-50 to-transparent"></div>
</section>

<style>
    @keyframes zoom {
        from {
            transform: scale(1);
        }
        to {
            transform: scale(1.1);
        }
    }
</style>
