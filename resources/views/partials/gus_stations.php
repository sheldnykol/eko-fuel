<section class="bg-white py-8 md:py-12">
    <img src="{{ asset('images/eko1.png') }}" alt="Πρατήριο 1" class="w-full h-48 object-cover">
    <div class="container mx-auto px-4">
        <h2 class="text-center text-2xl md:text-3xl font-bold mb-8 tracking-tight">Τα Πρατήριά μας</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
            <!-- Card 1: Πρατήριο 1 -->
            <a href="{{ route('station.show', 1) }}" class="block bg-gray-50 rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <img src="{{ asset('images/eko1.png') }}" alt="Πρατήριο 1" class="w-full h-48 object-cover">
                <div class="p-6 text-center">
                    <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-2">Πρατήριο Λάρισα - Βόλου 12</h3>
                    <p class="text-gray-600 text-sm md:text-base">Δες τις τιμές και υπηρεσίες</p>
                </div>
            </a>

            <!-- Card 2: Πρατήριο 2 -->
            <a href="{{ route('station.show', 2) }}" class="block bg-gray-50 rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <img src="{{ asset('images/eko2.jpg') }}" alt="Πρατήριο 2" class="w-full h-48 md:h-64 object-cover">
                <div class="p-6 text-center">
                    <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-2">Πρατήριο Λάρισα - Κέντρο</h3>
        <p class="text-gray-600 text-sm md:text-base">Δες τις τιμές και υπηρεσίες</p>
                </div>
            </a>
        </div>
    </div>
</section>