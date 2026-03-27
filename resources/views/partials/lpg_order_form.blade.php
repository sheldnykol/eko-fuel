@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-slate-50 py-12 px-4">
        <div class="max-w-xl mx-auto">
            
            <div class="bg-white shadow-2xl rounded-3xl overflow-hidden border border-blue-100">
                
                <div class="bg-blue-600 p-8 text-center relative">
                    <h1 class="text-3xl font-bold text-white uppercase tracking-wider">Παραγγελία Υγραερίου</h1>
                    <p class="text-blue-100 mt-2 text-sm">Άμεση παράδοση στον χώρο σας</p>
                </div>

                @if(session('success'))
                    <div class="m-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 font-medium italic">
                        {{ session('success') }}
                    </div>
                @endif
                
                <form action="{{ route('lpg-orders.store') }}" method="POST" class="p-8 space-y-5">
                    @csrf
                    
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Ονοματεπώνυμο / Επωνυμία</label>
                            <input type="text" name="customer_lpg_name" oninput="this.value = this.value.toUpperCase()" value="{{ old('customer_lpg_name') }}" 
                                class="w-full border-slate-200 rounded-xl shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3" 
                                placeholder="π.χ. ΙΩΑΝΝΗΣ ΠΑΠΑΔΟΠΟΥΛΟΣ" required>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Είδος Υγραερίου</label>
                            <select name="lpg_type" class="w-full border-slate-200 rounded-xl shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 bg-slate-50 font-medium text-slate-700">
                                <option value="heating">Υγραέριο Θέρμανσης (για το σπίτι)</option>
                                <option value="propane">Υγραέριο Προπανίου (για επιχειρήσεις)</option>
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Ποσότητα (Λίτρα/Κιλά)</label>
                                <input type="number" name="lpg_quantity" step="100" min="0" value="{{ old('lpg_quantity') }}" 
                                    class="w-full border-slate-200 rounded-xl shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3" 
                                    placeholder="π.χ. 500" required>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">ΑΦΜ</label>
                                <input type="tel" name="customer_lpg_afm" value="{{ old('customer_lpg_afm') }}" 
                                    class="w-full border-slate-200 rounded-xl shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3" 
                                    placeholder="9 ψηφία" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Πόλη / Περιοχή</label>
                                <input type="text" name="customer_lpg_city" oninput="this.value = this.value.toUpperCase()" value="{{ old('customer_lpg_city') }}" 
                                    class="w-full border-slate-200 rounded-xl shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3" 
                                    placeholder="π.χ. Λάρισα" required>
                            </div>
                            <div class="flex gap-2">
                                <div class="grow">
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Διεύθυνση</label>
                                    <input type="text" name="customer_lpg_address" oninput="this.value = this.value.toUpperCase()" value="{{ old('customer_lpg_address') }}" 
                                        class="w-full border-slate-200 rounded-xl shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3" required>
                                </div>
                                <div class="w-20">
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Αρ.</label>
                                    <input type="text" name="customer_lpg_number_of_address" value="{{ old('customer_lpg_number_of_address') }}" 
                                        class="w-full border-slate-200 rounded-xl shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3" required>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Τηλέφωνο Επικοινωνίας</label>
                            <input type="tel" name="customer_lpg_phone" value="{{ old('customer_lpg_phone') }}" 
                                class="w-full border-slate-200 rounded-xl shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3" 
                                placeholder="69XXXXXXXX" required>
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg transform transition hover:-translate-y-1 active:scale-95 uppercase tracking-wide">
                                Επιβεβαιωση Παραγγελιας Υγραεριου
                            </button>
                        </div>
                    </form>
                </div>

                <div class="text-center mt-6">
                    <a href="/" class="text-slate-400 hover:text-blue-600 text-sm font-medium transition flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Επιστροφή στην Αρχική
                </a>
            </div>
        </div>
    </div>
@endsection