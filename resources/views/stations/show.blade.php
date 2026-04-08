@extends('layouts.app')

@section('title', $station['name'])

@section('content')
    <section class="group relative h-125 w-full overflow-hidden bg-slate-900">
        <img
            src="{{ asset('images/' . $station['image']) }}"
            alt="{{ $station['name'] }}"
            class="absolute inset-0 h-full w-full object-cover transition-transform duration-1000 ease-in-out group-hover:scale-105 opacity-90"
        />

        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent"></div>

        <div class="relative z-10 mx-auto flex h-full max-w-7xl items-end px-6 pb-12 md:px-12 md:pb-20">
            <div class="max-w-2xl animate-fade-in-up">
                <div class="mb-4 inline-flex items-center rounded-full bg-red-600/90 px-3 py-1 text-xs font-bold uppercase tracking-wider text-white backdrop-blur-sm">
                    EKO Station
                </div>
                <h1 class="mb-4 text-4xl font-black tracking-tight text-white md:text-6xl drop-shadow-sm">
                    {{ $station['name'] }}
                </h1>

                <div class="flex items-center gap-2 text-lg font-medium text-slate-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-red-500">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                    </svg>
                    <span>{{ $station['address'] }}</span>
                </div>
            </div>
        </div>
    </section>

    <div class="relative z-20 -mt-10">
        @include('partials.gas_prices', ['prices' => $station['prices']])
    </div>

    <section class="bg-slate-50 pb-16 md:pb-24">
        <div class="container mx-auto px-4">
            
            <div class="mb-12 flex flex-col items-center justify-center text-center">
                <div class="mb-4 inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-white text-red-600 shadow-md ring-1 ring-slate-100 rotate-3">
                     <img
                        class="h-10 w-10 object-contain"
                        src="{{ asset('images/info2.png') }}"
                        alt="services_icon"
                    />
                </div>
                <h2 class="text-3xl font-black text-slate-800 md:text-4xl lg:text-5xl">Υπηρεσίες Πρατηρίου</h2>
                <p class="mt-3 max-w-2xl text-slate-500">
                    Προσφέρουμε ολοκληρωμένη φροντίδα για το όχημά σας με υπηρεσίες υψηλής ποιότητας.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3 xl:gap-10">
                @foreach ($station['services'] as $service)
                    @if ($service === 'Πλυντήριο Αυτοκινήτων')
                        <div class="group relative overflow-hidden rounded-3xl bg-white p-1 shadow-lg ring-1 ring-slate-200 transition-all hover:shadow-2xl md:col-span-2 lg:col-span-2">
                            <div class="absolute inset-0  opacity-10 group-hover:opacity-20 transition-opacity"></div>
                            
                            <div class="relative flex flex-col h-full overflow-hidden rounded-[1.3rem] bg-white p-8 md:flex-row md:items-center md:gap-8">
                                <div class="mb-6 flex shrink-0 items-center justify-center md:mb-0">
                                    <div class="relative flex h-24 w-24 items-center justify-center rounded-2xl bg-slate-50">
                                        <img 
                                            src="{{ asset('images/car.png') }}" 
                                            alt="Πλυντήριο" 
                                            class="h-16 w-16 object-contain drop-shadow-sm"
                                        />
                                    </div>
                                </div>
                                
                                <div class="flex-1 text-center md:text-left">
                                    <h3 class="mb-2 text-2xl font-black text-slate-900 md:text-3xl">Πλυντήριο Αυτοκινήτων</h3>
                                    <p class="mb-6 text-slate-600">
                                        Επαγγελματικός καθαρισμός με τα καλύτερα προϊόντα της αγοράς. Κλείσε ώρα άμεσα χωρίς εγγραφή – διαθέσιμα slots κάθε μέρα!
                                    </p>
                                    
                                    <a href="{{ route('pages.booking') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#e21838] px-8 py-3.5 text-sm font-bold text-white shadow-lg shadow-red-500/30 transition-all hover:bg-[#c4142f] hover:shadow-red-500/50 hover:-translate-y-0.5">
                                        <span>Κλείσε Ραντεβού Τώρα</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                            <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- <div class="group flex flex-col items-start justify-between rounded-3xl bg-white p-8 shadow-sm ring-1 ring-slate-200 transition-all hover:-translate-y-1 hover:shadow-lg">
                            <div>
                                <div class="mb-6 inline-flex h-14 w-14 items-center justify-center rounded-xl bg-slate-50 text-slate-600 ring-1 ring-slate-100 group-hover:bg-slate-900 group-hover:text-white transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-7 w-7">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z" />
                                    </svg>
                                </div>
                                <h3 class="mb-2 text-xl font-bold text-slate-800 ">{{ $service }}</h3>
                                <p class="text-sm leading-relaxed text-slate-500">
                                    Υψηλής ποιότητας εξυπηρέτηση από το εξειδικευμένο προσωπικό μας.
                                </p>
                            </div>
                        </div> --}}
                        <div class="container mx-auto px-4 pb-20">
                            <div class="relative overflow-hidden rounded-[3rem] bg-slate-900 p-12 text-center text-white shadow-2xl">
                                <div class="absolute inset-0 opacity-20" style="background-image: url('{{ asset('images/pattern.png') }}');"></div>
                                <div class="relative z-10">
                                    <h2 class="mb-4 text-3xl font-black md:text-4xl uppercase italic tracking-tighter">Χρειάζεστε κάτι για το αυτοκίνητο;</h2>
                                    <p class="mb-8 text-slate-400">Δείτε τη διαθεσιμότητα σε λιπαντικά, αξεσουάρ και προϊόντα περιποίησης στο κατάστημά μας.</p>
                                    <a href="{{ route('station.products', ['id' => request()->route('id')]) }}" 
                                    class="inline-flex items-center justify-center gap-3 rounded-2xl bg-white px-10 py-4 text-lg font-black text-slate-900 transition-all hover:bg-red-600 hover:text-white hover:scale-105 shadow-xl shadow-white/5">
                                        <span>🛒 ΕΠΙΣΚΕΨΗ ΣΤΟ ΚΑΤΑΣΤΗΜΑ</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
@if(str_contains(mb_strtoupper($station['name'], 'UTF-8'), 'ΓΕΩΡΓΙΑΔΟΥ'))
    <div class="group relative overflow-hidden rounded-3xl bg-white p-1 shadow-lg ring-1 ring-slate-200 transition-all hover:shadow-2xl md:col-span-2 lg:col-span-2">
        
        {{-- Μπλε Gradient Φόντο (όπως πριν) --}}
        <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-indigo-800 opacity-90 transition-opacity group-hover:opacity-100"></div>
        
        {{-- Διακοσμητικό εφέ στο φόντο --}}
        <div class="absolute -right-16 -top-16 h-60 w-60 rounded-full bg-white/10 blur-3xl transition-transform group-hover:scale-110"></div>

        <div class="relative flex flex-col h-full overflow-hidden rounded-[1.3rem] p-8 text-white md:flex-row md:items-start md:gap-8">
            {{-- Εικονίδιο Αριστερά (με λευκό/μπλε στυλ) --}}
            <div class="mb-6 flex shrink-0 items-center justify-center md:mb-0">
                <div class="relative flex h-24 w-24 items-center justify-center rounded-2xl bg-white/15 backdrop-blur-sm text-white ring-1 ring-white/20">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-12 w-12">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                    </svg>
                </div>
            </div>
            
            {{-- Περιεχόμενο Δεξιά --}}
            <div class="flex-1 text-center md:text-left">
                <div class="mb-4">
                    <h3 class="text-2xl font-black text-white md:text-3xl uppercase italic tracking-tight">Οδηγίες Αυτόματου Πωλητή</h3>
                    <p class="text-blue-100 text-sm">Ακολουθήστε τα βήματα για γρήγορη πληρωμή </p>
                </div>
                
                {{-- Λίστα Οδηγιών (2 στήλες) --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-3 text-left border-t border-white/10 pt-4">
                    <div class="flex gap-2.5 text-sm text-blue-50">
                        <span class="font-bold text-white opacity-60">01.</span> Επιλογή «Κάρτα» στο μενού.
                    </div>
                    <div class="flex gap-2.5 text-sm text-blue-50">
                        <span class="font-bold text-white opacity-60">02.</span> Αρ. κυκλοφορίας & «Συνέχεια».
                    </div>
                    <div class="flex gap-2.5 text-sm text-blue-50">
                        <span class="font-bold text-white opacity-60">03.</span> Απόδειξη: πατήστε «Συνέχεια».
                    </div>
                    <div class="flex gap-2.5 text-sm text-blue-50">
                        <span class="font-bold text-white opacity-60">04.</span> Καύσιμο & Αντλία (7-10).
                    </div>
                    <div class="flex gap-2.5 text-sm text-blue-50">
                        <span class="font-bold text-white opacity-60">05.</span> Επιλέξτε το ποσό.
                    </div>
                    <div class="flex gap-2.5 text-sm text-blue-50">
                        <span class="font-bold text-white opacity-60">06.</span> Κάρτα στο POS & PIN.
                    </div>
                    <div class="flex gap-2.5 text-sm text-blue-50">
                        <span class="font-bold text-white opacity-60">07.</span> Ανεφοδιασμός (Πιέστε λαβή).
                    </div>
                    <div class="flex gap-2.5 text-sm text-blue-50">
                        <span class="font-bold text-white opacity-60">08.</span> Επιστροφή & Αυτόματη Απόδειξη.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif


{{-- SELF SERVICE ΠΛΥΝΤΗΡΙΟ ΓΙΑ ΚΑΡΑΜΑΝΛΗ - ΣΚΟΥΡΟ PREMIUM ΣΤΥΛ --}}
@if(str_contains(mb_strtoupper($station['name'], 'UTF-8'), 'ΚΑΡΑΜΑΝΛΗ'))
    <div class="group relative overflow-hidden rounded-3xl bg-white p-1 shadow-lg ring-1 ring-slate-200 transition-all hover:shadow-2xl md:col-span-2 lg:col-span-2">
        
        {{-- Σκούρο Gradient Φόντο --}}
        <div class="absolute inset-0 bg-gradient-to-br from-slate-800 to-slate-900 opacity-95 transition-opacity group-hover:opacity-100"></div>
        
        {{-- Διακοσμητική λάμψη --}}
        <div class="absolute -left-16 -bottom-16 h-64 w-64 rounded-full bg-blue-500/10 blur-3xl transition-transform group-hover:scale-125"></div>

        <div class="relative flex flex-col h-full overflow-hidden rounded-[1.3rem] p-8 text-white md:flex-row md:items-start md:gap-8">
            
            {{-- Εικονίδιο Αριστερά --}}
            <div class="mb-6 flex shrink-0 items-center justify-center md:mb-0">
                <div class="relative flex h-24 w-24 items-center justify-center rounded-2xl bg-white/10 backdrop-blur-sm text-blue-400 ring-1 ring-white/20">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-12 w-12">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75m0 3v.75m0 3v.75m0 3v.75m0 3v.75m3-15h13.5M5.25 15h13.5m-13.5-3h13.5m-13.5-3h13.5m-13.5-3h13.5M2.25 15.75c1.192.35 2.441.528 3.75.528 1.309 0 2.558-.178 3.75-.528M13.5 15.75c1.192.35 2.441.528 3.75.528 1.309 0 2.558-.178 3.75-.528" />
                    </svg>
                </div>
            </div>
            
            {{-- Περιεχόμενο Δεξιά --}}
            <div class="flex-1">
                <div class="mb-6 text-center md:text-left">
                    <h3 class="text-2xl font-black text-white md:text-3xl uppercase italic tracking-tight">Self Service Πλυντήριο</h3>
                    <p class="text-slate-400 text-sm mt-1">Ακολουθήστε τις οδηγίες για τέλειο αποτέλεσμα καθαρισμού.</p>
                </div>

                {{-- Λίστα Οδηγιών - Μία κάτω από την άλλη (grid-cols-1) --}}
                <div class="grid grid-cols-1 gap-y-5 text-left border-t border-white/10 pt-6">
                    
                    <div class="flex gap-4 text-sm text-blue-50 leading-relaxed">
                        <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-blue-500/20 text-[10px] font-bold text-blue-400 ring-1 ring-blue-500/30">01</span>
                        <p><strong class="text-white block mb-1 uppercase text-xs tracking-wider">Καθαρισμός με υψηλή πίεση</strong> Πρόπλυση και κύρια πλύση με ζεστό αποσκληρυμένο νερό και καθαριστικό για την αφαίρεση ρύπου και εντόμων!</p>
                    </div>

                    <div class="flex gap-4 text-sm text-blue-50 leading-relaxed">
                        <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-blue-500/20 text-[10px] font-bold text-blue-400 ring-1 ring-blue-500/30">02</span>
                        <p><strong class="text-white block mb-1 uppercase text-xs tracking-wider">Καθαρισμός με βούρτσες</strong> Χρησιμοποίησε την μαλακή βούρτσα πλύσης και ενεργό αφρό για την αφαίρεση επίμονου ρύπου. Ξεπλύνετε την βούρτσα με νερό πριν από την χρήση αυτής.</p>
                    </div>

                    <div class="flex gap-4 text-sm text-blue-50 leading-relaxed">
                        <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-blue-500/20 text-[10px] font-bold text-blue-400 ring-1 ring-blue-500/30">03</span>
                        <p><strong class="text-white block mb-1 uppercase text-xs tracking-wider">Ξέπλυμα με καθαρό νερό</strong> Ψεκασμός υψηλής πίεσης με κρύο καθαρό νερό ξεπλένει τον αφρό κι τον ρύπο από την επιφάνεια του αμαξώματος.</p>
                    </div>

                    <div class="flex gap-4 text-sm text-blue-50 leading-relaxed">
                        <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-blue-500/20 text-[10px] font-bold text-blue-400 ring-1 ring-blue-500/30">04</span>
                        <p><strong class="text-white block mb-1 uppercase text-xs tracking-wider">Περιποίηση χρώματος με ζεστό κερί</strong> Προστασία μεγάλης διάρκειας με ειδικό καρναούβικο κερί.</p>
                    </div>

                    <div class="flex gap-4 text-sm text-blue-50 leading-relaxed">
                        <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-blue-500/20 text-[10px] font-bold text-blue-400 ring-1 ring-blue-500/30">05</span>
                        <p><strong class="text-white block mb-1 uppercase text-xs tracking-wider">Στέγνωμα και γυάλισμα</strong> Τελικό ξέπλυμα με κρύο απιονισμένο νερό και γυαλιστικό, για στιλπνότητα και λάμψη στο χρώμα μετά το στέγνωμα.</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endif

                </div>
            </div>
        </div>
    </section>
@endsection