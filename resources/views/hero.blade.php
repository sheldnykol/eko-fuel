<!-- resources/views/components/hero.blade.php -->

<section class="relative overflow-hidden min-h-screen">
    <!-- Background Image -->
    <img 
        src="{{ asset('images/hero1.jpg') }}" 
        alt="Hero Background" 
        class="absolute inset-0 w-full h-full object-cover"
        loading="lazy"
    >

    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-black/50"></div>

    <!-- Περιεχόμενο (overlay πάνω στην εικόνα) -->
    <div class="absolute inset-0 flex items-center justify-center lg:justify-end text-center lg:text-right px-6 lg:px-20">
        <div class="text-white max-w-full lg:max-w-2xl">
            <!-- Τίτλος -->
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-8 lg:mb-12 drop-shadow-2xl">
                Καλώς ήρθατε<br class="hidden lg:inline"> στήν ΕΚΟ!
            </h1>

            <!-- Κουμπιά -->
            <div class="flex flex-col sm:flex-row gap-4 sm:gap-6 justify-center lg:justify-end">
                <button 
                    type="button" 
                    class="px-10 py-4 bg-[#3b548e] text-white font-bold text-lg rounded-md shadow-lg hover:bg-[#2f4474] transition-colors duration-300 min-w-[200px]"
                >
                    ΔΕΣ ΤΙΜΕΣ
                </button>

                <button 
                    type="button" 
                    class="px-10 py-4 bg-[#e21838] text-white font-bold text-lg rounded-md shadow-lg hover:bg-[#c4142f] transition-colors duration-300 min-w-[200px]"
                >
                    ΠΡΑΤΗΡΙΑ
                </button>
            </div>
        </div>
    </div>
</section>