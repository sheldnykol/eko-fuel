@extends('admin.admin')

@section('admin_content')
    <div class="mb-8">
        <h1 class="text-3xl font-black text-slate-900">Παραγγελίες Καυσίμων</h1>
        <p class="text-slate-500">Διαχείριση παραγγελιών πελατών ανά κατηγορία.</p>
    </div>

    <div class="mb-6 flex space-x-1 rounded-2xl bg-slate-200/50 p-1">
        <a
            href="{{ route('admin.fuel-orders', ['type' => 'fuel']) }}"
            class="{{ $type == 'fuel' ? 'bg-white text-red-600 shadow-sm' : 'text-slate-500 hover:bg-white/50 hover:text-slate-700' }} flex-1 rounded-xl py-2.5 text-center text-sm font-bold transition-all"
        >
            ⛽ Πετρέλαιο Κίνησης
        </a>
        <a
            href="{{ route('admin.fuel-orders', ['type' => 'lpg']) }}"
            class="{{ $type == 'lpg' ? 'bg-white text-red-600 shadow-sm' : 'text-slate-500 hover:bg-white/50 hover:text-slate-700' }} flex-1 rounded-xl py-2.5 text-center text-sm font-bold transition-all"
        >
            🔥 Υγραέριο (LPG)
        </a>
        <a
            href="{{ route('admin.fuel-orders', ['type' => 'heating']) }}"
            class="{{ $type == 'heating' ? 'bg-white text-red-600 shadow-sm' : 'text-slate-500 hover:bg-white/50 hover:text-slate-700' }} flex-1 rounded-xl py-2.5 text-center text-sm font-bold transition-all"
        >
            🏠 Πετρέλαιο Θέρμανσης
        </a>
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm">
        <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-50 text-slate-900">
                <tr>
                    <th class="px-6 py-4 font-bold">Πελάτης</th>
                    <th class="px-6 py-4 font-bold">Επικοινωνία / ΑΦΜ</th>
                    <th class="px-6 py-4 font-bold">Διεύθυνση</th>
                    <th class="px-6 py-4 font-bold">Λεπτομέρειες</th>
                    <th class="px-6 py-4 text-right font-bold">Ημερομηνία</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($orders as $order)
                    @php
                        if ($type == 'fuel') {
                            $name = $order->fuel_name;
                            $phone = $order->fuel_phone;
                            $afm = $order->fuel_afm;
                            $address = $order->fuel_address . ' ' . $order->fuel_number_address . ', ' . $order->fuel_city;
                            $qty = $order->fuel_quantity;
                            $fuelType = $order->fuel_type;
                        } elseif ($type == 'lpg') {
                            $name = $order->lpg_name;
                            $phone = $order->lpg_phone;
                            $afm = $order->lpg_afm;
                            $address = $order->lpg_address . ' ' . $order->lpg_number_address . ', ' . $order->lpg_city;
                            $qty = $order->lpg_quantity;
                            $fuelType = $order->lpg_type;
                        } else {
                            $name = $order->heatOil_name;
                            $phone = $order->heatOil_phone;
                            $afm = $order->heatOil_afm;
                            $address = $order->heatOil_address . ' ' . $order->heatOil_number_address . ', ' . $order->heatOil_city;
                            $qty = $order->heatOil_quantity;
                            $fuelType = 'Θέρμανσης'; // Το μοντέλο θέρμανσης δεν έχει πεδίο τύπου, είναι στάνταρ.
                        }
                    @endphp

                    <tr class="transition-colors hover:bg-slate-50">
                        <td class="px-6 py-4 font-bold text-slate-900">{{ $name }}</td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="font-medium">{{ $phone }}</span>
                                <span class="text-xs text-slate-400">ΑΦΜ: {{ $afm }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">{{ $address }}</td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="font-bold text-red-600">{{ $qty }} Λίτρα</span>
                                <span class="text-xs text-slate-500">
                                    {{ str_replace('_', ' ', strtoupper($fuelType)) }}
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right text-xs text-slate-400">
                            {{ $order->created_at->format('d/m/Y H:i') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                            Δεν βρέθηκαν παραγγελίες για αυτή την κατηγορία.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
