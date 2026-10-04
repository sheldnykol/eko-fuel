@extends('admin.admin')

@section('admin_title', 'Προϊόντα')

@php
    $categoryMap = [
        'lubricants' => 'Λιπαντικά',
        'chemicals' => 'Χημικά',
        'accessories' => 'Αξεσουάρ',
        'maintenance' => 'Συντήρηση',
        'misc' => 'Λοιπά',
    ];
    $avgPrice = $products->whereNotNull('price')->where('price', '>', 0)->avg('price');
@endphp

@section('admin_content')
    <x-admin.page-header title="Προϊόντα" subtitle="Προϊόντα και υπηρεσίες που εμφανίζονται στη σελίδα κάθε πρατηρίου.">
        <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-1.5 rounded-lg bg-red-600 px-3 py-1.5 text-[13px] font-medium text-white hover:bg-red-700">
            <x-admin.icon name="plus" class="h-4 w-4" />
            Νέο προϊόν
        </a>
    </x-admin.page-header>

    <div class="mb-4 grid grid-cols-3 gap-3">
        @foreach ([['Σύνολο', $products->count(), 'box'], ['Μέση τιμή', $avgPrice ? number_format($avgPrice, 2, ',', '.') . '€' : '-', 'euro'], ['Πρατήρια', count($stations), 'store']] as [$label, $value, $icon])
            <div class="flex items-center gap-3 rounded-xl border border-slate-200 bg-white p-3">
                <span class="hidden rounded-lg bg-slate-100 p-2 text-slate-600 sm:block"><x-admin.icon :name="$icon" class="h-4 w-4" /></span>
                <div class="min-w-0">
                    <p class="truncate text-[11px] font-medium text-slate-500 sm:text-xs">{{ $label }}</p>
                    <p class="truncate text-base font-semibold text-slate-900 tabular-nums">{{ $value }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mb-4 flex flex-col gap-2.5 sm:flex-row sm:items-center">
        <label class="relative block sm:w-72">
            <span class="sr-only">Αναζήτηση προϊόντος</span>
            <x-admin.icon name="search" class="pointer-events-none absolute top-1/2 left-3 h-4 w-4 -translate-y-1/2 text-slate-400" />
            <input
                type="search"
                id="adminSearch"
                placeholder="Αναζήτηση προϊόντος"
                class="w-full rounded-lg border border-slate-200 bg-white py-2 pr-3 pl-9 text-[13px] focus:border-red-500 focus:ring-1 focus:ring-red-500 focus:outline-none"
            />
        </label>
        <div class="no-scrollbar -mx-1 flex gap-1 overflow-x-auto px-1">
            <button type="button" data-cat="all" class="cat-btn shrink-0 rounded-lg px-2.5 py-1.5 text-[12px] font-medium">Όλα</button>
            @foreach ($categoryMap as $key => $name)
                <button type="button" data-cat="{{ $key }}" class="cat-btn shrink-0 rounded-lg px-2.5 py-1.5 text-[12px] font-medium whitespace-nowrap">{{ $name }}</button>
            @endforeach
        </div>
    </div>

    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white">
        <ul class="divide-y divide-slate-100" id="productList">
            @forelse ($products as $product)
                <li class="product-row flex items-center gap-3 px-3.5 py-2.5 sm:px-4" data-name="{{ $product->name }}" data-category="{{ $product->category }}">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="" class="h-10 w-10 shrink-0 rounded-lg object-cover ring-1 ring-slate-200" loading="lazy" />
                    @else
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-slate-100 text-slate-400"><x-admin.icon name="image" class="h-4 w-4" /></span>
                    @endif

                    <div class="min-w-0 flex-1">
                        <p class="truncate text-[13px] font-medium text-slate-900">{{ $product->name }}</p>
                        <p class="flex flex-wrap items-center gap-x-2 text-[12px] text-slate-500">
                            <span>{{ $categoryMap[$product->category] ?? $product->category }}</span>
                            <span class="hidden sm:inline">· {{ $stations[$product->station_id]['name'] ?? 'Άγνωστο πρατήριο' }}</span>
                        </p>
                    </div>

                    <span class="{{ $product->product_type == 'service' ? 'bg-blue-50 text-blue-700' : 'bg-orange-50 text-orange-700' }} hidden rounded-full px-2 py-0.5 text-[11px] font-medium sm:inline">
                        {{ $product->product_type == 'service' ? 'Υπηρεσία' : 'Προϊόν' }}
                    </span>

                    <span class="w-16 text-right text-[13px] font-semibold text-slate-900 tabular-nums">
                        {{ ! is_null($product->price) && $product->price > 0 ? number_format($product->price, 2, ',', '.') . '€' : '-' }}
                    </span>

                    <div class="flex shrink-0 gap-1">
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="rounded-md p-1.5 text-slate-500 hover:bg-slate-100 hover:text-slate-900" title="Επεξεργασία" aria-label="Επεξεργασία {{ $product->name }}">
                            <x-admin.icon name="pencil" class="h-4 w-4" />
                        </a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Διαγραφή του «{{ $product->name }}»;')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded-md p-1.5 text-slate-500 hover:bg-red-50 hover:text-red-600" title="Διαγραφή" aria-label="Διαγραφή {{ $product->name }}">
                                <x-admin.icon name="trash" class="h-4 w-4" />
                            </button>
                        </form>
                    </div>
                </li>
            @empty
                <li class="px-4 py-12 text-center text-[13px] text-slate-500">Δεν υπάρχουν προϊόντα ακόμα.</li>
            @endforelse
        </ul>
        <p id="noProducts" class="hidden px-4 py-10 text-center text-[13px] text-slate-500">Δεν βρέθηκαν προϊόντα.</p>
    </div>
@endsection

@push('scripts')
    <script>
        ;(function () {
            const rows = [...document.querySelectorAll('.product-row')]
            const search = document.getElementById('adminSearch')
            const buttons = [...document.querySelectorAll('.cat-btn')]
            const empty = document.getElementById('noProducts')
            let category = 'all'
            const normalize = t => (t || '').toLowerCase().normalize('NFD').replace(/[̀-ͯ]/g, '')

            function apply() {
                const q = normalize(search.value)
                let visible = 0
                rows.forEach(row => {
                    const show = normalize(row.dataset.name).includes(q) && (category === 'all' || row.dataset.category === category)
                    row.classList.toggle('hidden', !show)
                    if (show) visible++
                })
                buttons.forEach(b => {
                    const active = b.dataset.cat === category
                    b.classList.toggle('bg-slate-900', active)
                    b.classList.toggle('text-white', active)
                    b.classList.toggle('bg-white', !active)
                    b.classList.toggle('text-slate-600', !active)
                    b.classList.toggle('ring-1', !active)
                    b.classList.toggle('ring-slate-200', !active)
                })
                empty.classList.toggle('hidden', visible > 0 || !rows.length)
            }

            search.addEventListener('input', apply)
            buttons.forEach(b => b.addEventListener('click', () => { category = b.dataset.cat; apply() }))
            apply()
        })()
    </script>
@endpush
