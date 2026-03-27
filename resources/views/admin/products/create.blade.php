@extends('admin.admin')

@section('admin_content')
    <div class="mx-auto mt-10 max-w-2xl rounded-[2rem] border border-slate-100 bg-white p-8 shadow-xl">
        <h2 class="mb-6 text-2xl font-black text-slate-900">Προσθήκη Νέου Προϊόντος</h2>

        <form
            action="{{ route('admin.products.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-5"
        >
            @csrf

            <div>
                <label class="mb-2 block text-sm font-bold text-slate-700">Πρατήριο</label>
                <select name="station_id" class="w-full rounded-xl border-slate-200 focus:ring-red-500">
                    @foreach ($stations as $id => $s)
                        <option value="{{ $id }}">{{ $s['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="mb-2 block text-sm font-bold text-slate-700">Όνομα Προϊόντος</label>
                    <input type="text" name="name" class="w-full rounded-xl border-slate-200" required />
                </div>
                <div>
                    <label class="mb-2 block text-sm font-bold text-slate-700">Τιμή (€)</label>
                    <input type="number" step="0.01" name="price" class="w-full rounded-xl border-slate-200" required />
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="mb-2 block text-sm font-bold text-slate-700">Τύπος</label>
                    <select name="product_type" class="w-full rounded-xl border-slate-200">
                        <option value="retail">Προϊόν (Retail)</option>
                        <option value="service">Υπηρεσία (Service)</option>
                    </select>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-bold text-slate-700">Κατηγορία</label>
                    <input
                        type="text"
                        name="category"
                        placeholder="π.χ. Λιπαντικά"
                        class="w-full rounded-xl border-slate-200"
                    />
                </div>
            </div>

            <div>
                <label class="mb-2 block text-sm font-bold text-slate-700">Εικόνα Προϊόντος</label>
                <input
                    type="file"
                    name="image"
                    class="w-full text-sm text-slate-500 file:mr-4 file:rounded-full file:border-0 file:bg-red-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-red-700 hover:file:bg-red-100"
                />
            </div>

            <div class="pt-4">
                <button
                    type="submit"
                    class="w-full rounded-xl bg-slate-900 py-4 font-black text-white transition-all hover:bg-black"
                >
                    ΑΠΟΘΗΚΕΥΣΗ ΠΡΟΪΟΝΤΟΣ
                </button>
            </div>
        </form>
    </div>
@endsection
