@php
    use App\Support\Seo;

    $fuels = [
        'amolyvdhi_95' => ['Αμόλυβδη 95', '95eko.jpg'],
        'amolyvdhi_100' => ['Αμόλυβδη 100', 'racing.jpg'],
        'amolyvdhi_98' => ['Αμόλυβδη 98', 'premium98.jpg'],
        'diesel_economy' => ['Diesel Economy', 'ekonomy.jpg'],
        'diesel_avio' => ['Diesel Avio', 'diesel-avio.jpg'],
        'auto_gas' => ['Autogas (LPG)', 'auto-gas.jpg'],
        'petrelaio' => ['Πετρέλαιο θέρμανσης', 'thermanshs.png'],
    ];
    $available = collect($fuels)->filter(fn ($fuel, $key) => isset($prices[$key]) && $prices[$key] !== '-');
@endphp

<section class="bg-slate-50 py-10 md:py-14">
    <div class="mx-auto max-w-6xl px-4 md:px-6">
        <h2 class="text-xl font-bold text-slate-900 md:text-2xl">Τιμές καυσίμων</h2>
        <p class="mt-1 text-sm text-slate-600">Τρέχουσες τιμές ανά λίτρο.</p>

        @if ($available->isEmpty())
            <p class="mt-6 rounded-xl border border-slate-200 bg-white p-5 text-sm text-slate-600">
                Οι τιμές δεν είναι διαθέσιμες αυτή τη στιγμή. Καλέστε μας για ενημέρωση.
            </p>
        @else
            <ul class="mt-6 grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-6">
                @foreach ($available as $key => [$label, $image])
                    <li class="rounded-xl border border-slate-200 bg-white p-4 text-center">
                        <img src="{{ Seo::image($image) }}" alt="{{ $label }} EKO" width="470" height="143" loading="lazy" class="mx-auto h-10 w-auto object-contain" />
                        <p class="mt-3 text-[13px] font-medium text-slate-500">{{ $label }}</p>
                        <p class="text-xl font-black text-slate-900 tabular-nums">
                            {{ $prices[$key] }}<span class="ml-0.5 text-xs font-semibold text-slate-400">€/lt</span>
                        </p>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</section>
