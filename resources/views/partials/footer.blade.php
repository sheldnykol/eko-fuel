<footer class="border-t border-slate-800 bg-[#141414] text-slate-400">
    <div class="mx-auto max-w-6xl px-4 py-12 md:px-6">
        <div class="grid grid-cols-1 gap-10 md:grid-cols-12">
            <div class="md:col-span-4">
                <div class="flex items-center gap-2.5">
                    <img src="{{ asset('images/opt/eko-logo-96.png') }}" alt="EKO" width="40" height="36" class="h-9 w-auto" loading="lazy" />
                    <span class="text-lg font-black tracking-tight text-white uppercase italic">ΕΚΟ ΔΡΑΜΗ</span>
                </div>
                <p class="mt-4 max-w-xs text-sm leading-relaxed">
                    Πρατήρια καυσίμων EKO στη Λάρισα και στην Πορταριά. Ποιοτικά καύσιμα, πλυντήριο αυτοκινήτων,
                    υγραέριο και διανομή πετρελαίου από το 1986.
                </p>
                <a href="tel:2410283954" class="mt-4 inline-block text-sm font-semibold text-white hover:text-[#e21838]">2410 283954</a>
            </div>

            <div class="md:col-span-5">
                <h2 class="mb-4 text-xs font-bold tracking-widest text-slate-500 uppercase">Τα πρατήριά μας</h2>
                <ul class="grid grid-cols-1 gap-4 text-sm sm:grid-cols-2">
                    @foreach (config('stations') as $id => $station)
                        <li>
                            <a href="{{ route('station.show', $id) }}" class="font-semibold text-white hover:text-[#e21838]">{{ $station['title'] }}</a>
                            <p class="mt-0.5 text-[13px]">{{ $station['street'] }}, {{ $station['city'] }}</p>
                            <p class="text-[13px]">
                                <a href="tel:{{ $station['phone'] }}" class="hover:text-white">{{ $station['phone'] }}</a>
                                · {{ $station['opens'] }}-{{ $station['closes'] }}
                            </p>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="md:col-span-3">
                <h2 class="mb-4 text-xs font-bold tracking-widest text-slate-500 uppercase">Σύνδεσμοι</h2>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('pages.booking') }}" class="hover:text-white">Ραντεβού πλυντηρίου</a></li>
                    <li><a href="{{ url('/services') }}" class="hover:text-white">Υπηρεσίες & τιμές</a></li>
                    <li><a href="{{ route('fuel-orders.create') }}" class="hover:text-white">Παραγγελία πετρελαίου</a></li>
                    <li><a href="{{ route('lpg-orders.create') }}" class="hover:text-white">Παραγγελία υγραερίου</a></li>
                    <li><a href="{{ route('station.products', 1) }}" class="hover:text-white">Προϊόντα</a></li>
                    <li><a href="{{ route('cancellation.page') }}" class="hover:text-white">Ακύρωση ραντεβού</a></li>
                    <li><a href="{{ url('/terms') }}" class="hover:text-white">Όροι χρήσης</a></li>
                    <li><a href="{{ url('/privacy') }}" class="hover:text-white">Πολιτική απορρήτου</a></li>
                </ul>
            </div>
        </div>

        <div class="mt-10 flex flex-col gap-2 border-t border-slate-800 pt-6 text-xs sm:flex-row sm:items-center sm:justify-between">
            <p>&copy; {{ date('Y') }} ΕΚΟ ΑΦΟΙ ΔΡΑΜΗ. Με την επιφύλαξη παντός δικαιώματος.</p>
            <a href="{{ route('login') }}" class="hover:text-white" rel="nofollow">Σύνδεση διαχείρισης</a>
        </div>
    </div>
</footer>
