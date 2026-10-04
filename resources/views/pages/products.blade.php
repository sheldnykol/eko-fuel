@extends('layouts.app')

@section('title', 'Λιπαντικά & Αξεσουάρ Αυτοκινήτου - ' . $station['title'] . ' ' . $station['city'])
@section('meta_description', 'Λιπαντικά, χημικά, αντιψυκτικά και αξεσουάρ αυτοκινήτου στο κατάστημα του πρατηρίου ' . $station['title'] . ', ' . $station['street'] . ', ' . $station['city'] . '.')

@php
    use App\Support\Seo;

    $categoryMap = [
        'lubricants' => 'Λιπαντικά',
        'chemicals' => 'Χημικά',
        'accessories' => 'Αξεσουάρ',
        'maintenance' => 'Συντήρηση',
        'misc' => 'Λοιπά',
    ];
    $usedCategories = $products->pluck('category')->unique();
@endphp

@push('schema')
    <script type="application/ld+json">{!! Seo::graph(Seo::breadcrumbs([['Αρχική', url('/')], [$station['title'], route('station.show', $id)], ['Προϊόντα', route('station.products', $id)]])) !!}</script>
@endpush

@section('content')
    <section class="bg-slate-50 py-10 md:py-14">
        <div class="mx-auto max-w-6xl px-4 md:px-6">
            <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
                <div>
                    <nav class="mb-2 text-[13px] text-slate-500" aria-label="Breadcrumb">
                        <a href="{{ url('/') }}" class="hover:text-slate-900">Αρχική</a>
                        <span class="mx-1">/</span>
                        <a href="{{ route('station.show', $id) }}" class="hover:text-slate-900">{{ $station['title'] }}</a>
                        <span class="mx-1">/</span>
                        <span class="text-slate-700">Προϊόντα</span>
                    </nav>
                    <h1 class="text-2xl font-black tracking-tight text-slate-900 md:text-3xl">Προϊόντα καταστήματος</h1>
                    <p class="mt-1 text-sm text-slate-600">{{ $station['title'] }}, {{ $station['street'] }}, {{ $station['city'] }}</p>
                </div>

                <div class="w-full md:w-64">
                    <label for="stationSelect" class="mb-1 block text-[13px] font-medium text-slate-700">Πρατήριο</label>
                    <select
                        id="stationSelect"
                        onchange="window.location.href = this.value"
                        class="h-10 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm focus:border-[#e21838] focus:ring-1 focus:ring-[#e21838] focus:outline-none"
                    >
                        @foreach ($allStations as $stationId => $item)
                            <option value="{{ route('station.products', $stationId) }}" @selected($id === (int) $stationId)>{{ $item['title'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            @if ($products->isNotEmpty() && $usedCategories->count() > 1)
                <div class="mt-6 flex flex-wrap gap-2" role="tablist">
                    <button type="button" data-category="all" class="category-btn rounded-lg border border-slate-900 bg-slate-900 px-3 py-1.5 text-[13px] font-semibold text-white">Όλα</button>
                    @foreach ($categoryMap as $key => $name)
                        @continue(! $usedCategories->contains($key))
                        <button type="button" data-category="{{ $key }}" class="category-btn rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-[13px] font-semibold text-slate-700">{{ $name }}</button>
                    @endforeach
                </div>
            @endif

            <div class="mt-6 grid grid-cols-2 gap-3 md:grid-cols-3 lg:grid-cols-4" id="productsGrid">
                @forelse ($products as $product)
                    <article class="product-card flex flex-col rounded-xl border border-slate-200 bg-white p-4" data-category="{{ $product->category }}">
                        <div class="flex aspect-square items-center justify-center rounded-lg bg-slate-50">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" loading="lazy" class="h-full w-full object-contain p-3" />
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8l-9-5-9 5 9 5 9-5zM3 8v8l9 5 9-5V8M12 13v8" /></svg>
                            @endif
                        </div>
                        <p class="mt-3 text-[11px] font-semibold tracking-wide text-slate-500 uppercase">
                            {{ $categoryMap[$product->category] ?? 'Γενικά' }}{{ $product->product_type === 'service' ? ' · Υπηρεσία' : '' }}
                        </p>
                        <h2 class="mt-0.5 text-sm font-bold text-slate-900">{{ $product->name }}</h2>
                        @if (! is_null($product->price) && $product->price > 0)
                            <p class="mt-auto pt-2 text-base font-black text-slate-900">{{ number_format($product->price, 2, ',', '.') }}€</p>
                        @endif
                    </article>
                @empty
                    <p class="col-span-full rounded-xl border border-dashed border-slate-300 bg-white px-4 py-12 text-center text-sm text-slate-600">
                        Δεν υπάρχουν καταχωρημένα προϊόντα για αυτό το πρατήριο. Ρωτήστε μας στο
                        <a href="tel:{{ $station['phone'] }}" class="font-semibold text-slate-900">{{ $station['phone'] }}</a>.
                    </p>
                @endforelse
            </div>
        </div>
    </section>

    <script>
        document.querySelectorAll('.category-btn').forEach(button => {
            button.addEventListener('click', () => {
                const category = button.dataset.category
                document.querySelectorAll('.product-card').forEach(card => {
                    card.classList.toggle('hidden', category !== 'all' && card.dataset.category !== category)
                })
                document.querySelectorAll('.category-btn').forEach(b => {
                    const active = b === button
                    b.classList.toggle('bg-slate-900', active)
                    b.classList.toggle('text-white', active)
                    b.classList.toggle('border-slate-900', active)
                    b.classList.toggle('bg-white', !active)
                    b.classList.toggle('text-slate-700', !active)
                    b.classList.toggle('border-slate-300', !active)
                })
            })
        })
    </script>
@endsection
