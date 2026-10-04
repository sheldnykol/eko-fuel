@extends('layouts.app')

@section('title', 'Παραγγελία Πετρελαίου Θέρμανσης στη Λάρισα')
@section('meta_description', 'Παραγγελία πετρελαίου θέρμανσης με παράδοση στο σπίτι σας στη Λάρισα από την ΕΚΟ Δράμη.')
@section('robots', 'noindex, follow')

@section('content')
    <x-order-card
        heading="Παραγγελία πετρελαίου θέρμανσης"
        intro="Συμπληρώστε τα στοιχεία σας και θα σας καλέσουμε με προσφορά."
        :fields="['heatOil_name', 'heatOil_quantity', 'heatOil_afm', 'heatOil_city', 'heatOil_address', 'heatOil_number_address', 'heatOil_phone']"
    >
        <form action="{{ route('heating-oil-orders.store') }}" method="POST" class="space-y-4" data-order-form>
            @csrf
            <x-field name="heatOil_name" label="Ονοματεπώνυμο / Επωνυμία" autocomplete="name" required />

            <div class="grid grid-cols-2 gap-3">
                <x-field name="heatOil_quantity" label="Λίτρα" type="number" min="50" step="50" placeholder="π.χ. 1000" required />
                <x-field name="heatOil_afm" label="ΑΦΜ" inputmode="numeric" maxlength="9" placeholder="9 ψηφία" required />
            </div>

            <x-field name="heatOil_phone" label="Τηλέφωνο" type="tel" inputmode="numeric" maxlength="10" placeholder="69XXXXXXXX" autocomplete="tel" required />

            <div class="grid grid-cols-[minmax(0,1fr)_88px] gap-3">
                <x-field name="heatOil_address" label="Διεύθυνση" autocomplete="address-line1" required />
                <x-field name="heatOil_number_address" label="Αριθμός" />
            </div>

            <x-field name="heatOil_city" label="Πόλη / περιοχή" autocomplete="address-level2" placeholder="π.χ. Λάρισα" required />

            <button type="submit" class="h-11 w-full rounded-lg bg-[#e21838] text-sm font-bold text-white hover:bg-[#c4142f] disabled:opacity-70">
                Αποστολή παραγγελίας
            </button>
        </form>
    </x-order-card>
@endsection
