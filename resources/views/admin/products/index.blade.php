@extends('admin.admin')

@section('admin_content')
    <div class="container mx-auto px-4 py-8">
        <div class="mb-8 flex flex-col items-center justify-between gap-4 md:flex-row">
            <div>
                <h1 class="text-3xl font-black text-slate-900">📦 Διαχείριση Προϊόντων</h1>
                <p class="text-slate-500">Προσθήκη και επεξεργασία προϊόντων ανά πρατήριο</p>
            </div>

            <div class="flex gap-3">
                <form action="{{ route('admin.products.index') }}" method="GET" class="flex items-center">
                    <select
                        name="station_id"
                        onchange="this.form.submit()"
                        class="rounded-xl border-slate-200 text-sm font-bold"
                    >
                        <option value="">Όλα τα Πρατήρια</option>
                        @foreach ($stations as $id => $station)
                            <option value="{{ $id }}" {{ request('station_id') == $id ? 'selected' : '' }}>
                                {{ $station['name'] }}
                            </option>
                        @endforeach
                    </select>
                </form>

                <a
                    href="{{ route('admin.products.create') }}"
                    class="rounded-xl bg-red-600 px-6 py-2 font-bold text-white transition-all hover:bg-red-700"
                >
                    + Νέο Προϊόν
                </a>
            </div>
        </div>

        <div class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-xl">
            <table class="w-full text-left">
                <thead class="border-b border-slate-100 bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase">Προϊόν</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase">Πρατήριο</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-slate-400 uppercase">Τύπος</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-slate-400 uppercase">Τιμή</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-slate-400 uppercase">Ενέργειες</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($products as $product)
                        <tr class="transition-colors hover:bg-slate-50">
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-900">{{ $product->name }}</div>
                                <div class="text-xs text-slate-400">{{ $product->category }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">
                                {{ $stations[$product->station_id]['name'] ?? 'Άγνωστο' }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="{{ $product->product_type == 'service' ? 'bg-blue-100 text-blue-700' : 'bg-orange-100 text-orange-700' }} rounded-full px-3 py-1 text-[10px] font-black uppercase"
                                >
                                    {{ $product->product_type }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center font-black text-slate-900">
                                {{ number_format($product->price, 2) }}€
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a
                                        href="{{ route('admin.products.edit', $product->id) }}"
                                        class="rounded-lg bg-slate-100 p-2 transition-colors hover:bg-slate-200"
                                    >
                                        ✏️
                                    </a>
                                    <form
                                        action="{{ route('admin.products.destroy', $product->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Διαγραφή;')"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="rounded-lg bg-red-50 p-2 text-red-600 transition-colors hover:bg-red-100"
                                        >
                                            🗑️
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
