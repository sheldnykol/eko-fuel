@props(['status'])

@php
    $map = [
        1 => ['Εκκρεμεί', 'bg-amber-50 text-amber-700 ring-amber-200', 'bg-amber-500'],
        2 => ['Ολοκληρώθηκε', 'bg-emerald-50 text-emerald-700 ring-emerald-200', 'bg-emerald-500'],
        3 => ['Ακυρώθηκε', 'bg-slate-100 text-slate-500 ring-slate-200', 'bg-slate-400'],
    ];
    [$label, $classes, $dot] = $map[(int) $status] ?? $map[1];
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center gap-1.5 rounded-full px-2 py-0.5 text-[11px] font-semibold ring-1 ring-inset $classes"]) }}>
    <span class="h-1.5 w-1.5 rounded-full {{ $dot }}"></span>
    {{ $label }}
</span>
