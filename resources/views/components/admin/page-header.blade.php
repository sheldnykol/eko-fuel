@props(['title', 'subtitle' => null])

<div class="mb-5 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
    <div class="min-w-0">
        <h1 class="text-lg font-bold tracking-tight text-slate-900 sm:text-xl">{{ $title }}</h1>
        @if ($subtitle)
            <p class="mt-0.5 text-[13px] text-slate-500">{{ $subtitle }}</p>
        @endif
    </div>
    @if (trim($slot))
        <div class="flex flex-wrap items-center gap-2">{{ $slot }}</div>
    @endif
</div>
