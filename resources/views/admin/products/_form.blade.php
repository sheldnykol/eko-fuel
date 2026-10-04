@php
    $product = $product ?? null;
    $inputClass = 'w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-[13px] text-slate-900 focus:border-red-500 focus:ring-1 focus:ring-red-500 focus:outline-none';
    $labelClass = 'mb-1 block text-[12px] font-medium text-slate-700';
    $categories = ['lubricants' => 'Λιπαντικά', 'chemicals' => 'Χημικά', 'accessories' => 'Αξεσουάρ', 'maintenance' => 'Συντήρηση', 'misc' => 'Λοιπά προϊόντα'];
@endphp

<div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
    <div class="sm:col-span-2">
        <label for="name" class="{{ $labelClass }}">Όνομα προϊόντος / υπηρεσίας</label>
        <input type="text" id="name" name="name" value="{{ old('name', $product?->name) }}" placeholder="π.χ. Λιπαντικό Ultra 10W-40" required class="{{ $inputClass }}" />
        @error('name') <p class="mt-1 text-[12px] text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="station_id" class="{{ $labelClass }}">Πρατήριο</label>
        <select id="station_id" name="station_id" required class="{{ $inputClass }}">
            <option value="">Επιλέξτε πρατήριο...</option>
            @foreach ($stations as $id => $station)
                <option value="{{ $id }}" @selected(old('station_id', $product?->station_id) == $id)>{{ $station['name'] ?? 'Πρατήριο ' . $id }}</option>
            @endforeach
        </select>
        @error('station_id') <p class="mt-1 text-[12px] text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <span class="{{ $labelClass }}">Τύπος</span>
        <div class="grid grid-cols-2 gap-1 rounded-lg bg-slate-100 p-0.5">
            @foreach (['retail' => 'Προϊόν', 'service' => 'Υπηρεσία'] as $value => $label)
                <label class="cursor-pointer">
                    <input type="radio" name="product_type" value="{{ $value }}" class="peer sr-only" @checked(old('product_type', $product?->product_type ?? 'retail') === $value) />
                    <span class="block rounded-md py-1.5 text-center text-[13px] font-medium text-slate-600 peer-checked:bg-white peer-checked:text-slate-900 peer-checked:shadow-sm peer-focus-visible:ring-2 peer-focus-visible:ring-red-300">{{ $label }}</span>
                </label>
            @endforeach
        </div>
        @error('product_type') <p class="mt-1 text-[12px] text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="category" class="{{ $labelClass }}">Κατηγορία</label>
        <select id="category" name="category" required class="{{ $inputClass }}">
            @foreach ($categories as $value => $label)
                <option value="{{ $value }}" @selected(old('category', $product?->category) === $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('category') <p class="mt-1 text-[12px] text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="price" class="{{ $labelClass }}">Τιμή <span class="font-normal text-slate-400">(προαιρετικό)</span></label>
        <div class="relative">
            <input type="number" id="price" step="0.01" min="0" name="price" value="{{ old('price', $product?->price) }}" placeholder="0.00" inputmode="decimal" class="{{ $inputClass }} pr-8" />
            <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-[13px] text-slate-400">€</span>
        </div>
        @error('price') <p class="mt-1 text-[12px] text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="sm:col-span-2">
        <label for="image" class="{{ $labelClass }}">Εικόνα <span class="font-normal text-slate-400">(προαιρετικό, JPG/PNG έως 2MB)</span></label>
        <div class="flex items-center gap-3">
            @if ($product?->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="Τρέχουσα εικόνα" class="h-12 w-12 shrink-0 rounded-lg object-cover ring-1 ring-slate-200" />
            @endif
            <input
                type="file"
                id="image"
                name="image"
                accept="image/jpeg,image/png"
                class="w-full text-[13px] text-slate-500 file:mr-3 file:rounded-lg file:border-0 file:bg-slate-100 file:px-3 file:py-2 file:text-[12px] file:font-medium file:text-slate-700 hover:file:bg-slate-200"
            />
        </div>
        @error('image') <p class="mt-1 text-[12px] text-red-600">{{ $message }}</p> @enderror
    </div>
</div>
