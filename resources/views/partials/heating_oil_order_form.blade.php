@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-slate-50 py-12 px-4">
        <div class="max-w-xl mx-auto">
            
            <div class="bg-white shadow-2xl rounded-3xl overflow-hidden border border-orange-100">
                
                <div class="bg-orange-600 p-8 text-center relative">
                    <h1 class="text-3xl font-bold text-white uppercase tracking-wider">ΠΑΡΑΓΓΕΛΙΑ ΠΕΤΡΕΛΑΙΟΥ ΘΕΡΜΑΝΣΗΣ</h1>
                    <p class="text-orange-100 mt-2 text-sm">Άμεση παράδοση για τη ζεστασιά του σπιτιού σας</p>
                </div>

                @if(session('success'))
                    <div class="m-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 font-medium italic">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('heating-oil-orders.store') }}" method="POST" class="p-8 space-y-5">
                    @csrf
                    

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Ονοματεπώνυμο / Επωνυμία</label>
                        <input type="text" name="heatOil_name" oninput="this.value = this.value.toUpperCase()" value="{{ old('heatOil_name') }}" 
                            class="w-full border-slate-200 rounded-xl shadow-sm focus:border-orange-500 focus:ring-orange-500 p-3" 
                            placeholder="π.χ. ΔΗΜΗΤΡΙΟΣ ΠΑΠΑΔΟΠΟΥΛΟΣ" required>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Ποσότητα (Λίτρα)</label>
                            <input type="number" name="heatOil_quantity" step="50" min="0" value="{{ old('heatOil_quantity') }}" 
                                class="w-full border-slate-200 rounded-xl shadow-sm focus:border-orange-500 focus:ring-orange-500 p-3" 
                                placeholder="π.χ. 1000" required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">ΑΦΜ</label>
                            <input type="tel" name="heatOil_afm" value="{{ old('heatOil_afm') }}" 
                                class="w-full border-slate-200 rounded-xl shadow-sm focus:border-orange-500 focus:ring-orange-500 p-3" 
                                placeholder="9 ψηφία" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Πόλη / Περιοχή</label>
                            <input type="text" name="heatOil_city" oninput="this.value = this.value.toUpperCase()" value="{{ old('heatOil_city') }}" 
                                class="w-full border-slate-200 rounded-xl shadow-sm focus:border-orange-500 focus:ring-orange-500 p-3" 
                                placeholder="π.χ. Λάρισα" required>
                        </div>
                        <div class="flex gap-2">
                            <div class="grow">
                                <label class="block text-sm font-bold text-slate-700 mb-2">Διεύθυνση</label>
                                <input type="text" name="heatOil_address" oninput="this.value = this.value.toUpperCase()" value="{{ old('heatOil_address') }}" 
                                    class="w-full border-slate-200 rounded-xl shadow-sm focus:border-orange-500 focus:ring-orange-500 p-3" required>
                            </div>
                            <div class="w-20">
                                <label class="block text-sm font-bold text-slate-700 mb-2">Αρ.</label>
                                <input type="text" name="heatOil_number_address" value="{{ old('heatOil_number_address') }}" 
                                    class="w-full border-slate-200 rounded-xl shadow-sm focus:border-orange-500 focus:ring-orange-500 p-3" required>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Τηλέφωνο Επικοινωνίας</label>
                        <input type="tel" name="heatOil_phone" value="{{ old('heatOil_phone') }}" 
                            class="w-full border-slate-200 rounded-xl shadow-sm focus:border-orange-500 focus:ring-orange-500 p-3" 
                            placeholder="69XXXXXXXX" required>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-4 rounded-xl shadow-lg transform transition hover:-translate-y-1 active:scale-95 uppercase tracking-widest">
                            ΕΠΙΒΕΒΑΙΩΣΗ ΠΑΡΑΓΓΕΛΙΑΣ
                        </button>
                    </div>
                </form>
            </div>

            <div class="text-center mt-6">
                <a href="/" class="text-slate-400 hover:text-orange-600 text-sm font-medium transition flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Επιστροφή στην Αρχική
                </a>
            </div>
        </div>
    </div>
@endsection