@extends('layouts.app')

@section('title', 'Παραγγελία Υγραερίου (LPG) Θέρμανσης & Προπανίου')
@section('meta_description', 'Παραγγείλτε online υγραέριο θέρμανσης για το σπίτι ή προπάνιο για επιχειρήσεις στη Λάρισα και στη Θεσσαλία. Ασφαλής διανομή και άμεση προσφορά.')

@php
    $select = 'h-10 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 focus:border-[#e21838] focus:ring-1 focus:ring-[#e21838] focus:outline-none';
@endphp

@section('content')
    <x-order-card
        heading="Παραγγελία υγραερίου"
        intro="Υγραέριο θέρμανσης για το σπίτι και προπάνιο για επιχειρήσεις, με ασφαλή διανομή στον χώρο σας."
        :fields="['lpg_name', 'lpg_type', 'lpg_quantity', 'lpg_afm', 'lpg_city', 'lpg_address', 'lpg_number_address', 'lpg_phone']"
    >
        <form action="{{ route('lpg-orders.store') }}" method="POST" class="space-y-4" data-order-form>
            @csrf
            <x-field name="lpg_name" label="Ονοματεπώνυμο / Επωνυμία" autocomplete="organization" required />

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label for="lpg_type" class="mb-1 block text-[13px] font-medium text-slate-700">Είδος</label>
                    <select name="lpg_type" id="lpg_type" class="{{ $select }}">
                        <option value="heating" @selected(old('lpg_type') === 'heating')>Θέρμανσης (σπίτι)</option>
                        <option value="propane" @selected(old('lpg_type') === 'propane')>Προπάνιο (επιχείρηση)</option>
                    </select>
                </div>
                <x-field name="lpg_quantity" label="Ποσότητα" hint="(λίτρα/κιλά)" type="number" min="50" step="1" placeholder="π.χ. 500" required />
            </div>

            <div class="grid grid-cols-2 gap-3">
                <x-field name="lpg_phone" label="Τηλέφωνο" type="tel" inputmode="numeric" maxlength="10" minlength="10" pattern="\d{10}" placeholder="69XXXXXXXX" autocomplete="tel" required />
                <x-field name="lpg_afm" label="ΑΦΜ" inputmode="numeric" maxlength="9" minlength="9" pattern="\d{9}" placeholder="9 ψηφία" required />
            </div>

            <div class="grid grid-cols-[minmax(0,1fr)_88px] gap-3">
                <x-field name="lpg_address" label="Διεύθυνση" autocomplete="address-line1" required />
                <x-field name="lpg_number_address" label="Αριθμός" />
            </div>

            <x-field name="lpg_city" label="Πόλη / περιοχή" autocomplete="address-level2" placeholder="π.χ. Λάρισα" required />

            <button type="submit" class="h-11 w-full rounded-lg bg-[#e21838] text-sm font-bold text-white hover:bg-[#c4142f] disabled:opacity-70">
                Αποστολή παραγγελίας
            </button>
        </form>

        <x-slot:aside>
            <div class="rounded-xl border border-slate-200 bg-white p-5">
                <h2 class="text-sm font-bold text-slate-900">Αντιπρόσωπος Θεσσαλίας</h2>
                <p class="mt-1 text-slate-600">Αποκλειστικός αντιπρόσωπος υγραερίου: Τύμπας Λάμπρος</p>
                <a href="tel:6944638312" class="mt-2 inline-block font-semibold text-[#e21838] hover:underline">6944 638312</a>
            </div>
        </x-slot:aside>
    </x-order-card>
@endsection
