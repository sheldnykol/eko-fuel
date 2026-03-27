@extends('layouts.app')

@section('title', 'Προϊόντα - ' . $station['name'])

@section('content')
<div class="min-h-screen bg-slate-50 py-12">
    <div class="container mx-auto px-6">
        
        <div class="mb-10 flex flex-col items-center justify-between gap-6 rounded-[2.5rem] bg-white p-8 shadow-sm border border-slate-100 md:flex-row">
            <div>
                <nav class="mb-2 flex text-sm text-slate-400">
                    <a href="/" class="hover:text-red-600 font-bold">Αρχική</a>
                    <span class="mx-2">/</span>
                    <span class="text-slate-600 font-bold">{{ $station['name'] }}</span>
                </nav>
                <h1 class="text-3xl font-black text-slate-900 tracking-tighter uppercase italic">Κατάλογος Προϊόντων</h1>
            </div>

            <div class="w-full md:w-auto">
                <label class="mb-1 ml-1 block text-[10px] font-black uppercase tracking-widest text-slate-400">Επιλέξτε Πρατήριο</label>
                <select onchange="window.location.href='/station/' + this.value + '/products'" 
                        class="w-full min-w-[280px] rounded-2xl border-none bg-slate-100 py-4 font-bold text-slate-700 focus:ring-2 focus:ring-red-500 shadow-inner">
                    @foreach($allStations as $s_id => $s_data)
                        <option value="{{ $s_id }}" {{ $id == $s_id ? 'selected' : '' }}>
                            {{ $s_data['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
            @forelse($products as $product)
                <div class="group relative flex flex-col rounded-[2.5rem] bg-white p-5 shadow-sm transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl border border-slate-100">
                    
                    <div class="relative mb-5 h-52 overflow-hidden rounded-[1.8rem] bg-slate-50/50">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-full w-full object-contain p-6 transition-transform duration-500 group-hover:scale-110">
                        @else
                            <div class="flex h-full items-center justify-center text-5xl opacity-20">📦</div>
                        @endif
                        
                        <div class="absolute top-4 left-4">
                            <span class="rounded-xl bg-white/90 px-3 py-1.5 text-[10px] font-black uppercase tracking-tight text-slate-800 backdrop-blur shadow-sm">
                                {{ $product->category ?? 'General' }}
                            </span>
                        </div>
                    </div>

                    <div class="flex flex-1 flex-col px-1">
                        <span class="mb-1 text-[10px] font-black uppercase tracking-wider text-red-600">
                            {{ $product->product_type == 'service' ? '🛠️ Υπηρεσία' : '🛒 Προϊόν' }}
                        </span>
                        <h3 class="mb-4 text-xl font-black leading-tight text-slate-800">{{ $product->name }}</h3>
                        
                        <div class="mt-auto flex items-center justify-between pt-5 border-t border-slate-50">
                            <span class="text-2xl font-black text-slate-900 tracking-tighter">{{ number_format($product->price, 2) }}€</span>
                            <button class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-900 text-white transition-all hover:bg-red-600 hover:rotate-90 shadow-lg shadow-slate-200">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="h-5 w-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-24 text-center bg-white rounded-[3rem] border border-dashed border-slate-200">
                    <div class="mb-4 text-6xl grayscale opacity-50">🏪</div>
                    <h3 class="text-2xl font-black text-slate-800 uppercase italic">Δεν βρέθηκαν προϊόντα</h3>
                    <p class="text-slate-400 font-medium">Η λίστα αυτού του πρατηρίου είναι προς το παρόν άδεια.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection