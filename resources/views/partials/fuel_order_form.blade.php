@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-slate-50 py-12 px-4">
        <div class="max-w-xl mx-auto">
            
            <div class="bg-white shadow-2xl rounded-3xl overflow-hidden border border-red-100">
                
                <div class="bg-red-600 p-8 text-center relative">
                    <h1 class="text-3xl font-bold text-white uppercase tracking-wider">ΠΑΡΑΓΓΕΛΙΑ ΠΕΤΡΕΛΑΙΟΥ ΚΙΝΗΣΗΣ</h1>
                    <p class="text-red-100 mt-2 text-sm">Κορυφαία ποιότητα καυσίμων στον χώρο σας</p>
                </div>

                @if(session('success'))
                    <div class="m-6 p-6 bg-green-50 border-2 border-green-200 rounded-2xl shadow-sm flex items-start space-x-4 animate-fade-in-down">
                        <div class="flex-shrink-0 p-2 bg-green-500 rounded-full text-white">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-green-800 uppercase tracking-tight">Επιτυχής Καταχώρηση</h3>
                            <p class="text-green-700 mt-1 leading-relaxed italic">
                                {{ session('success') }}
                            </p>
                            <div class="mt-3 p-3 bg-white/60 rounded-lg border border-green-100">
                                <p class="text-sm text-green-800 font-bold">
                                    <span class="inline-block mr-1">ℹ️</span> 
                                    Για την προσφορά, θα επικοινωνήσουμε μαζί σας τηλεφωνικά τα επόμενα 24ωρα.
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('fuel-orders.store') }}" method="POST" class="p-8 space-y-5">
                    @csrf
                    
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Ονοματεπώνυμο / Επωνυμία</label>
                        <input type="text" name="customer_fuel_name" oninput="this.value = this.value.toUpperCase()" value="{{ old('customer_fuel_name') }}" 
                            class="w-full border-slate-200 rounded-xl shadow-sm focus:border-red-500 focus:ring-red-500 p-3" 
                            placeholder="π.χ. ΚΩΝΣΤΑΝΤΙΝΟΣ ΠΑΠΑΔΟΠΟΥΛΟΣ" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Τύπος Καυσίμου</label>
                        <select name="fuel_type" class="w-full border-slate-200 rounded-xl shadow-sm focus:border-red-500 focus:ring-red-500 p-3 bg-slate-50 font-medium text-slate-700">
                            <option value="diesel_economy">Diesel Κίνησης (Economy)</option>
                            <option value="diesel_avio">Diesel Avio (Premium)</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Ποσότητα (Λίτρα)</label>
                            <input type="number" name="fuel_quantity" step="100" min="0" value="{{ old('fuel_quantity') }}" 
                                class="w-full border-slate-200 rounded-xl shadow-sm focus:border-red-500 focus:ring-red-500 p-3" 
                                placeholder="π.χ. 500" required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">ΑΦΜ</label>
                            <input type="tel" name="customer_fuel_afm" value="{{ old('customer_fuel_afm') }}" 
                                class="w-full border-slate-200 rounded-xl shadow-sm focus:border-red-500 focus:ring-red-500 p-3" 
                                placeholder="9 ψηφία" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Πόλη / Περιοχή</label>
                            <input type="text" name="customer_fuel_city" oninput="this.value = this.value.toUpperCase()" value="{{ old('customer_fuel_city') }}" 
                                class="w-full border-slate-200 rounded-xl shadow-sm focus:border-red-500 focus:ring-red-500 p-3" 
                                placeholder="π.χ. Λάρισα" required>
                        </div>
                        <div class="flex gap-2">
                            <div class="grow">
                                <label class="block text-sm font-bold text-slate-700 mb-2">Διεύθυνση</label>
                                <input type="text" name="customer_fuel_address" oninput="this.value = this.value.toUpperCase()" value="{{ old('customer_fuel_address') }}" 
                                    class="w-full border-slate-200 rounded-xl shadow-sm focus:border-red-500 focus:ring-red-500 p-3" required>
                            </div>
                            <div class="w-20">
                                <label class="block text-sm font-bold text-slate-700 mb-2">Αρ.</label>
                                <input type="text" name="customer_fuel_number_of_address" value="{{ old('customer_fuel_number_of_address') }}" 
                                    class="w-full border-slate-200 rounded-xl shadow-sm focus:border-red-500 focus:ring-red-500 p-3" required>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Τηλέφωνο Επικοινωνίας</label>
                        <input type="tel" name="customer_fuel_phone" value="{{ old('customer_fuel_phone') }}" 
                            class="w-full border-slate-200 rounded-xl shadow-sm focus:border-red-500 focus:ring-red-500 p-3" 
                            placeholder="69XXXXXXXX" required>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-4 rounded-xl shadow-lg transform transition hover:-translate-y-1 active:scale-95 uppercase tracking-widest">
                            ΕΠΙΒΕΒΑΙΩΣΗ ΠΑΡΑΓΓΕΛΙΑΣ
                        </button>
                    </div>
                </form>
            </div>

            <div class="text-center mt-6">
                <a href="/" class="text-slate-400 hover:text-red-600 text-sm font-medium transition flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Επιστροφή στην Αρχική
                </a>
            </div>
        </div>
    </div>
@endsection