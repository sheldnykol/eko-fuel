@extends('admin.admin')

@section('admin_title', 'Παραγγελίες Καυσίμων')

@php
    $tabs = [
        'fuel' => ['Πετρέλαιο κίνησης', 'fuel'],
        'lpg' => ['Υγραέριο (LPG)', 'flame'],
        'heating' => ['Πετρέλαιο θέρμανσης', 'home'],
    ];
    $typeLabels = [
        'diesel_economy' => 'Diesel Economy',
        'diesel_avio' => 'Diesel Avio',
        'heating' => 'Θέρμανση',
        'propane' => 'Προπάνιο',
    ];
    $prefix = ['fuel' => 'fuel_', 'lpg' => 'lpg_', 'heating' => 'heatOil_'][$type];

    $rows = $orders->map(function ($order) use ($prefix, $type, $typeLabels) {
        $kind = match ($type) {
            'fuel' => $order->fuel_type,
            'lpg' => $order->lpg_type,
            default => null,
        };

        return [
            'name' => $order->{$prefix . 'name'},
            'phone' => $order->{$prefix . 'phone'},
            'afm' => $order->{$prefix . 'afm'},
            'address' => trim($order->{$prefix . 'address'} . ' ' . $order->{$prefix . 'number_address'}),
            'city' => $order->{$prefix . 'city'},
            'qty' => $order->{$prefix . 'quantity'},
            'kind' => $kind ? ($typeLabels[$kind] ?? str_replace('_', ' ', $kind)) : 'Θέρμανσης',
            'created' => $order->created_at,
        ];
    });
@endphp

@section('admin_content')
    <x-admin.page-header title="Παραγγελίες Καυσίμων" subtitle="Αιτήματα πελατών από τη φόρμα του site, ανά κατηγορία." />

    <div class="no-scrollbar -mx-1 mb-4 flex gap-1 overflow-x-auto px-1" role="tablist">
        @foreach ($tabs as $key => [$label, $icon])
            @php
                $active = $type === $key;
            @endphp
            <a
                href="{{ route('admin.fuel-orders', ['type' => $key]) }}"
                role="tab"
                aria-selected="{{ $active ? 'true' : 'false' }}"
                class="{{ $active ? 'bg-slate-900 text-white' : 'bg-white text-slate-600 ring-1 ring-slate-200 ring-inset hover:bg-slate-50' }} inline-flex shrink-0 items-center gap-1.5 rounded-lg px-3 py-1.5 text-[13px] font-medium whitespace-nowrap"
            >
                <x-admin.icon :name="$icon" class="h-4 w-4" />
                {{ $label }}
                <span class="{{ $active ? 'bg-white/20' : 'bg-slate-100' }} rounded px-1.5 text-[11px] tabular-nums">{{ $counts[$key] }}</span>
            </a>
        @endforeach
    </div>

    @if ($rows->isEmpty())
        <div class="rounded-xl border border-dashed border-slate-300 bg-white px-4 py-12 text-center text-[13px] text-slate-500">
            Δεν υπάρχουν παραγγελίες σε αυτή την κατηγορία.
        </div>
    @else
        <div class="space-y-2.5 md:hidden">
            @foreach ($rows as $row)
                <article class="rounded-xl border border-slate-200 bg-white p-3.5">
                    <div class="flex items-start justify-between gap-3">
                        <div class="min-w-0">
                            <h3 class="truncate text-[13px] font-semibold text-slate-900">{{ $row['name'] }}</h3>
                            <p class="text-[12px] text-slate-500">ΑΦΜ {{ $row['afm'] }}</p>
                        </div>
                        <div class="shrink-0 text-right">
                            <p class="text-sm font-semibold text-red-600 tabular-nums">{{ number_format($row['qty'], 0, ',', '.') }} lt</p>
                            <p class="text-[11px] text-slate-500">{{ $row['kind'] }}</p>
                        </div>
                    </div>
                    <p class="mt-2 flex items-start gap-1.5 text-[12px] text-slate-600">
                        <x-admin.icon name="map-pin" class="mt-px h-3.5 w-3.5 shrink-0 text-slate-400" />
                        {{ $row['address'] }}, {{ $row['city'] }}
                    </p>
                    <div class="mt-2.5 flex items-center justify-between border-t border-slate-100 pt-2.5">
                        <span class="text-[11px] text-slate-400 tabular-nums">{{ $row['created']->format('d/m/Y H:i') }}</span>
                        <a href="tel:{{ $row['phone'] }}" class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 px-2.5 py-1 text-[12px] font-medium text-slate-700 hover:bg-slate-50">
                            <x-admin.icon name="phone" class="h-3.5 w-3.5" />
                            {{ $row['phone'] }}
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="hidden overflow-hidden rounded-xl border border-slate-200 bg-white md:block">
            <table class="w-full text-left text-[13px]">
                <thead class="border-b border-slate-200 bg-slate-50 text-[11px] font-medium tracking-wide text-slate-500 uppercase">
                    <tr>
                        <th class="px-4 py-2.5">Πελάτης</th>
                        <th class="px-4 py-2.5">Τηλέφωνο</th>
                        <th class="px-4 py-2.5">Διεύθυνση</th>
                        <th class="px-4 py-2.5 text-right">Ποσότητα</th>
                        <th class="px-4 py-2.5 text-right">Ημερομηνία</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($rows as $row)
                        <tr class="hover:bg-slate-50">
                            <td class="px-4 py-2.5">
                                <p class="font-medium text-slate-900">{{ $row['name'] }}</p>
                                <p class="text-[12px] text-slate-500">ΑΦΜ {{ $row['afm'] }}</p>
                            </td>
                            <td class="px-4 py-2.5 whitespace-nowrap">
                                <a href="tel:{{ $row['phone'] }}" class="text-slate-700 hover:text-red-600">{{ $row['phone'] }}</a>
                            </td>
                            <td class="px-4 py-2.5 text-slate-600">{{ $row['address'] }}, {{ $row['city'] }}</td>
                            <td class="px-4 py-2.5 text-right whitespace-nowrap">
                                <p class="font-semibold text-red-600 tabular-nums">{{ number_format($row['qty'], 0, ',', '.') }} lt</p>
                                <p class="text-[11px] text-slate-500">{{ $row['kind'] }}</p>
                            </td>
                            <td class="px-4 py-2.5 text-right text-[12px] whitespace-nowrap text-slate-500 tabular-nums">{{ $row['created']->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
