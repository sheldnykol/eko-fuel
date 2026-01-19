<section class="relative min-h-screen overflow-hidden">
    <!-- Background Image -->
    <img
        src="{{ asset('images/hero1.jpg') }}"
        alt="Hero Background"
        class="absolute inset-0 h-full w-full object-cover"
        loading="lazy"
    />

    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-black/50"></div>

    <div
        class="absolute inset-0 flex items-center justify-center px-6 text-center lg:justify-end lg:px-20 lg:text-right"
    >
        <div class="max-w-full text-white lg:max-w-2xl">
            <!-- Τίτλος -->
            <h1 class="mb-8 text-4xl leading-tight font-bold drop-shadow-2xl md:text-5xl lg:mb-12 lg:text-6xl">
                Καλώς ήρθατε
                <br class="hidden lg:inline" />
                στην ΕΚΟ!
            </h1>

            <!-- Κουμπιά -->
                        <div class="flex flex-col justify-center gap-4 sm:flex-row sm:gap-6 lg:justify-end">
                <button
                    type="button"
                    class="min-w-[200px] rounded-md bg-[#3b548e] px-10 py-4 text-lg font-bold text-white shadow-lg transition-colors duration-300 hover:bg-[#2f4474]"
                >
                    ΔΕΣ ΤΙΜΕΣ
                </button>

                <button
                    type="button"
                    class="min-w-[200px] rounded-md bg-[#e21838] px-10 py-4 text-lg font-bold text-white shadow-lg transition-colors duration-300 hover:bg-[#c4142f]"
                >
                    ΠΡΑΤΗΡΙΑ
                </button>
            </div>
        </div>
    </div>
</section>
