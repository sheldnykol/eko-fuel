@php
    use App\Support\Seo;
@endphp

<section id="gas_stations" class="bg-slate-50 py-14 md:py-20">
    <div class="mx-auto max-w-6xl px-4 md:px-6">
        <div class="mb-8 max-w-2xl">
            <h2 class="text-2xl font-black tracking-tight text-slate-900 md:text-3xl">Πρατήρια EKO στη Λάρισα και στην Πορταριά</h2>
            <p class="mt-2 text-sm text-slate-600 md:text-base">
                Ποιοτικά καύσιμα EKO, πλυντήριο αυτοκινήτων, υγραέριο κίνησης και κατάστημα. Δείτε τιμές, ωράριο και
                υπηρεσίες κάθε πρατηρίου.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @foreach (Seo::stations() as $id => $station)
                <a href="{{ route('station.show', $id) }}" class="group flex flex-col overflow-hidden rounded-xl border border-slate-200 bg-white hover:border-slate-300">
                    <div class="relative">
                        <img
                            src="{{ Seo::image($station['image']) }}"
                            alt="{{ $station['title'] }}, {{ $station['city'] }}"
                            width="600"
                            height="400"
                            loading="lazy"
                            class="aspect-[3/2] w-full object-cover"
                        />
                        <span
                            class="status-badge absolute top-3 right-3 rounded-full bg-white/95 px-2.5 py-0.5 text-[11px] font-semibold text-slate-700"
                            data-opens="{{ $station['opens'] }}"
                            data-closes="{{ $station['closes'] }}"
                        ></span>
                    </div>
                    <div class="flex flex-1 flex-col p-4">
                        <h3 class="font-bold text-slate-900 group-hover:text-[#e21838]">{{ $station['title'] }}</h3>
                        <p class="text-[13px] text-slate-500">{{ $station['street'] }}, {{ $station['city'] }}</p>
                        <p class="mt-1 text-[13px] text-slate-500">{{ $station['opens'] }} - {{ $station['closes'] }}</p>
                        <span class="mt-3 text-[13px] font-bold text-[#e21838]">Τιμές & υπηρεσίες</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<script>
    ;(function () {
        const now = new Intl.DateTimeFormat('en-GB', { timeZone: 'Europe/Athens', hour: '2-digit', minute: '2-digit', hourCycle: 'h23' }).format(new Date())
        document.querySelectorAll('#gas_stations .status-badge').forEach(badge => {
            const open = now >= badge.dataset.opens && now < badge.dataset.closes
            badge.textContent = open ? 'Ανοιχτό τώρα' : 'Κλειστό'
            badge.classList.toggle('text-emerald-700', open)
        })
    })()
</script>
