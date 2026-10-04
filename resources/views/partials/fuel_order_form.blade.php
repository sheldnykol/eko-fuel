@extends('layouts.app')

@section('title', 'Παραγγελία Πετρελαίου Κίνησης στη Λάρισα')
@section('meta_description', 'Παραγγείλτε online πετρέλαιο κίνησης Diesel Economy ή Diesel Avio με παράδοση στον χώρο σας στη Λάρισα. Άμεση προσφορά από την ΕΚΟ Δράμη, έως 3 άτοκες δόσεις.')

@php
    use App\Support\Seo;

    $select = 'h-10 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 focus:border-[#e21838] focus:ring-1 focus:ring-[#e21838] focus:outline-none';
@endphp

@section('content')
    <x-order-card
        heading="Παραγγελία πετρελαίου κίνησης"
        intro="Συμπληρώστε τα στοιχεία σας και θα σας καλέσουμε με προσφορά."
        :fields="['fuel_name', 'fuel_type', 'fuel_quantity', 'fuel_phone', 'fuel_afm', 'fuel_address', 'fuel_number_address', 'fuel_city']"
    >
        <form action="{{ route('fuel-orders.store') }}" method="POST" class="space-y-4" data-order-form>
            @csrf
            <x-field name="fuel_name" label="Ονοματεπώνυμο / Επωνυμία" autocomplete="organization" required />

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label for="fuel_type" class="mb-1 block text-[13px] font-medium text-slate-700">Καύσιμο</label>
                    <select name="fuel_type" id="fuel_type" class="{{ $select }}">
                        <option value="diesel_economy" @selected(old('fuel_type') === 'diesel_economy')>Diesel Economy</option>
                        <option value="diesel_avio" @selected(old('fuel_type') === 'diesel_avio')>Diesel Avio</option>
                    </select>
                </div>
                <x-field name="fuel_quantity" label="Λίτρα" type="number" min="50" step="50" placeholder="τουλάχιστον 50" required />
            </div>

            <div class="grid grid-cols-2 gap-3">
                <x-field name="fuel_phone" label="Τηλέφωνο" type="tel" inputmode="numeric" maxlength="10" placeholder="69XXXXXXXX" autocomplete="tel" required />
                <x-field name="fuel_afm" label="ΑΦΜ" inputmode="numeric" maxlength="9" placeholder="9 ψηφία" required />
            </div>

            <div class="grid grid-cols-[minmax(0,1fr)_88px] gap-3">
                <x-field name="fuel_address" label="Διεύθυνση" autocomplete="address-line1" required />
                <x-field name="fuel_number_address" label="Αριθμός" />
            </div>

            <x-field name="fuel_city" label="Πόλη / περιοχή" autocomplete="address-level2" placeholder="π.χ. Λάρισα" required />

            <button type="submit" class="h-11 w-full rounded-lg bg-[#e21838] text-sm font-bold text-white hover:bg-[#c4142f] disabled:opacity-70">
                Αποστολή παραγγελίας
            </button>
        </form>

        <x-slot:aside>
            <div class="rounded-xl border border-slate-200 bg-white p-5">
                <h2 class="text-sm font-bold text-slate-900">Τρόποι πληρωμής</h2>
                <p class="mt-1 text-slate-600">Δεχόμαστε όλες τις κάρτες, με έως 3 άτοκες δόσεις.</p>
                <ul class="mt-3 grid grid-cols-3 gap-2">
                    @foreach ([['image0.jpeg', 'Κάρτα Αγρότη'], ['image1.jpeg', 'Go For More'], ['image2.jpeg', 'Eurobank Επιστροφή']] as [$image, $label])
                        <li class="rounded-lg border border-slate-200 p-2 text-center">
                            <img src="{{ Seo::image($image) }}" alt="{{ $label }}" loading="lazy" class="mx-auto h-8 w-auto object-contain" />
                            <span class="mt-1 block text-[11px] text-slate-600">{{ $label }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </x-slot:aside>
    </x-order-card>
@endsection
