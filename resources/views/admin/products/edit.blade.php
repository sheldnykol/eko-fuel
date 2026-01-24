@extends('admin.admin')

@section('admin_content')
    <div class="mx-auto mt-10 max-w-2xl rounded-[2rem] border border-slate-100 bg-white p-8 shadow-xl">
        <h2 class="mb-6 text-2xl font-black text-slate-900">Επεξεργασία: {{ $product->name }}</h2>

        <form
            action="{{ route('admin.products.update', $product->id) }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-5"
        >
            @csrf
            @method('PUT')

            <div>
                <label class="mb-2 block text-sm font-bold text-slate-700">Πρατήριο</label>
                <select name="station_id" class="w-full rounded-xl border-slate-200">
                    @foreach ($stations as $sid => $s)
                        <option value="{{ $sid }}" {{ $product->station_id == $sid ? 'selected' : '' }}>
                            {{ $s['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="mb-2 block text-sm font-bold text-slate-700">Όνομα</label>
                    <input
                        type="text"
                        name="name"
                        value="{{ $product->name }}"
                        class="w-full rounded-xl border-slate-200"
                        required
                    />
                </div>
                <div>
                    <label class="mb-2 block text-sm font-bold text-slate-700">Τιμή (€)</label>
                    <input
                        type="number"
                        step="0.01"
                        name="price"
                        value="{{ $product->price }}"
                        class="w-full rounded-xl border-slate-200"
                        required
                    />
                </div>
            </div>

            <div>
                <label class="mb-2 block text-sm font-bold text-slate-700">Τρέχουσα Εικόνα</label>
                @if ($product->image)
                    <img
                        src="{{ asset('storage/' . $product->image) }}"
                        class="mb-2 h-20 w-20 rounded-lg object-cover"
                    />
                @endif

                <input type="file" name="image" class="w-full text-sm text-slate-500" />
            </div>

            <button
                type="submit"
                class="w-full rounded-xl bg-slate-900 py-4 font-black text-white transition-all hover:bg-black"
            >
                ΕΝΗΜΕΡΩΣΗ ΠΡΟΪΟΝΤΟΣ
            </button>
        </form>
    </div>
@endsection
