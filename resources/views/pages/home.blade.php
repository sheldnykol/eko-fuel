@extends('layouts.app')

@section('title', 'EKO Fuel - Αρχική')

@section('content')
    @include('partials.hero')

    <!-- Placeholder για τις επόμενες ενότητες -->
    <section class="bg-white py-12">
        <div class="container mx-auto px-4">
            <h2 class="mb-8 text-center text-2xl font-bold md:text-3xl">Τιμές Καυσίμων</h2>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-3 lg:grid-cols-5 ">
                <!-- Card 1: Τιμές -->
  
                    <div class="rounded-lg border-2 border-indigo-100 text-center self-center shadow-md/30">
                        <h4 class=" text-l rounded-s font-semibold bg-amber-300">Αμόλυβδη 95</h4>
                        <h1 class="font-semibold md:text-4xl text-black pt-2 pb-2">1.78 €</h1>
                    </div>

                <div class="rounded-xl bg-gray-100 p-6 text-center">
                    <h4 class="mb-2 text-xl font-semibold">Αμόλυβδη 98/100</h4>
                    <p class="text-gray-600">Δες τις τρέχουσες τιμές σε όλα τα πρατήρια</p>
                </div>
                <div class="rounded-xl bg-gray-100 p-6 text-center">
                    <h4 class="mb-2 text-xl font-semibold">Diesel Κίνησης</h4>
                    <p class="text-gray-600">Δες τις τρέχουσες τιμές σε όλα τα πρατήρια</p>
                </div>
                <div class="rounded-xl bg-gray-100 p-6 text-center">
                    <h3 class="mb-2 text-xl font-semibold">Υγραέριο Κίνησης</h4>
                    <p class="text-gray-600">Δες τις τρέχουσες τιμές σε όλα τα πρατήρια</p>
                </div>
                <div class="rounded-xl bg-gray-100 p-6 text-center">
                    <h4 class="mb-2 text-xl font-semibold">Dieasel Θέρμανσης</h4>
                    <p class="text-gray-600">Δες τα 3 πρατήρια μας στον χάρτη</p>
                </div>
                <div class="rounded-xl bg-gray-100 p-6 text-center">
                    <h3 class="mb-2 text-xl font-semibold">Dieasel Θέρμανσης</h4>
                    <p class="text-gray-600">Δες τα 3 πρατήρια μας στον χάρτη</p>
                </div>
                <div class="rounded-xl bg-gray-100 p-6 text-center">
                    <h4 class="mb-2 text-xl font-semibold">Super</h4>
                    <p class="text-gray-600">Δες τα 3 πρατήρια μας στον χάρτη</p>
                </div>
            </div>
        </div>
    </section>
    @include('partials.map')
@endsection
