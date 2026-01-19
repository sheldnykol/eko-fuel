<!-- Ενότητα Πρατήρια – κάτω από το hero -->
                   <img 
                        src="{{ asset('images/station2.png') }}" >
<section class="bg-white py-10 md:py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-center text-2xl md:text-3xl lg:text-4xl font-bold mb-10 tracking-tight">Τα Πρατήριά μας</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-10">
            <!-- Card Πρατήριο 1 -->
            <a href="" 
               class="block bg-gray-50 rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 group">
                <div class="relative">
                    <img 
                        src="{{ asset('images/station2.png') }}" 
                        alt="Πρατήριο 1" 
                        class="w-full h-48 md:h-64 lg:h-80 object-cover transition-transform duration-500 group-hover:scale-105"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                </div>
                <div class="p-6 md:p-8 text-center">
                    <h3 class="text-xl md:text-2xl lg:text-3xl font-bold text-gray-900 mb-3">
                        Πρατήριο Λάρισα - Βόλου 12
                    </h3>
                    <p class="text-gray-600 text-base md:text-lg">
                        Δες τις τρέχουσες τιμές και υπηρεσίες
                    </p>
                    <span class="mt-6 inline-block px-8 py-3 bg-[#e21838] text-white font-bold rounded-lg text-lg group-hover:bg-[#c4142f] transition-colors">
                        Επίσκεψη →
                    </span>
                </div>
            </a>

            <!-- Card Πρατήριο 2 -->
            <a href="" 
               class="block bg-gray-50 rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 group">
                <div class="relative">
                    <img 
                        src="{{ asset('images/station1.png') }}" 
                        alt="Πρατήριο 2" 
                        class="w-full h-48 md:h-64 lg:h-80 object-cover transition-transform duration-500 group-hover:scale-105"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                </div>
                <div class="p-6 md:p-8 text-center">
                    <h3 class="text-xl md:text-2xl lg:text-3xl font-bold text-gray-900 mb-3">
                        Πρατήριο Λάρισα - Κέντρο
                    </h3>
                    <p class="text-gray-600 text-base md:text-lg">
                        Δες τις τρέχουσες τιμές και υπηρεσίες
                    </p>
                    <span class="mt-6 inline-block px-8 py-3 bg-[#3b548e] text-white font-bold rounded-lg text-lg group-hover:bg-[#2f4474] transition-colors">
                        Επίσκεψη →
                    </span>
                </div>
            </a>
        </div>
    </div>
</section>