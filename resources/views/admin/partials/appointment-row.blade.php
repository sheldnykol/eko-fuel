@php
    use App\Support\BookingRules;

    $status = (int) $app->status;
    $extras = collect(explode(',', (string) $app->extras))
        ->map(fn ($e) => trim($e))
        ->filter(fn ($e) => $e !== '' && $e !== 'Χωρίς Extras');
    $fast = $extras->contains(BookingRules::FAST_TRACK);
    $extras = $extras->reject(fn ($e) => $e === BookingRules::FAST_TRACK);
    $price = BookingRules::PRICES[$app->vehicle_type ?? 'ΙΧ'][$app->wash_type] ?? null;
    $notes = $app->getRelation('comments');
    $selectStyle = [
        1 => 'border-amber-300 bg-amber-50 text-amber-800',
        2 => 'border-emerald-300 bg-emerald-50 text-emerald-800',
        3 => 'border-slate-300 bg-slate-50 text-slate-600',
    ][$status] ?? 'border-slate-300';
@endphp

<article class="{{ $status === 3 ? 'opacity-60' : '' }} flex flex-wrap items-start gap-x-4 gap-y-2 border-b border-slate-100 px-4 py-3 last:border-b-0">
    <div class="w-12 shrink-0 pt-0.5">
        <p class="text-[15px] font-semibold text-slate-900 tabular-nums">{{ substr($app->appointment_time, 0, 5) }}</p>
        @if ($fast)
            <p class="text-[10px] font-bold tracking-wide text-red-600 uppercase">Fast</p>
        @endif
    </div>

    <div class="min-w-0 flex-1 basis-56 space-y-0.5">
        <p class="flex flex-wrap items-baseline gap-x-2">
            <span class="text-sm font-semibold text-slate-900">{{ $app->customer_name }}</span>
            <a href="tel:{{ $app->customer_phone }}" class="text-[13px] text-slate-500 tabular-nums hover:text-slate-900">{{ $app->customer_phone }}</a>
        </p>
        <p class="text-[13px] text-slate-600">
            <span class="font-mono font-medium text-slate-800">{{ $app->license_plate }}</span>
            · {{ $app->vehicle_type ?? 'ΙΧ' }}
            · {{ BookingRules::WASH_LABELS[$app->wash_type] ?? $app->wash_type }}@if ($price) <span class="text-slate-400">(~{{ $price }}€)</span>@endif
        </p>
        @if ($extras->isNotEmpty())
            <p class="text-[12px] text-slate-500">+ {{ $extras->implode(', ') }}</p>
        @endif
        @if ($app->comments)
            <p class="text-[12px] text-amber-700">Σχόλιο: {{ $app->comments }}</p>
        @endif
        @if ($notes->isNotEmpty())
            <details class="text-[12px]">
                <summary class="cursor-pointer text-slate-500 hover:text-slate-800">Σημειώσεις ({{ $notes->count() }})</summary>
                <ul class="mt-1 space-y-1 border-l-2 border-slate-200 pl-2">
                    @foreach ($notes as $note)
                        <li class="text-slate-700">
                            {{ $note->body }}
                            <span class="text-slate-400">· {{ $note->user->name ?? 'Σύστημα' }}, {{ $note->created_at->format('d/m H:i') }}</span>
                        </li>
                    @endforeach
                </ul>
            </details>
        @endif
    </div>

    <div class="flex w-full items-center gap-2 pl-16 sm:w-auto sm:pl-0">
        <form action="{{ route('admin.updateStatus', $app->id) }}" method="POST" class="flex-1 sm:flex-none">
            @csrf
            <label class="sr-only" for="status-{{ $app->id }}">Κατάσταση</label>
            <select
                name="status"
                id="status-{{ $app->id }}"
                data-current="{{ $status }}"
                data-name="{{ $app->customer_name }}"
                class="status-select {{ $selectStyle }} w-full rounded-lg border py-1.5 pr-8 pl-2.5 text-[13px] font-medium focus:ring-1 focus:ring-slate-400 focus:outline-none sm:w-40"
            >
                <option value="1" @selected($status === 1)>Σε αναμονή</option>
                <option value="2" @selected($status === 2)>Ολοκληρώθηκε</option>
                <option value="3" @selected($status === 3)>Ακυρώθηκε</option>
            </select>
        </form>
        <button
            type="button"
            onclick="openCommentModal(this)"
            data-action="{{ route('admin.comments.store', $app->id) }}"
            data-subtitle="{{ $app->license_plate }} · {{ $app->customer_name }}"
            class="rounded-lg border border-slate-200 p-1.5 text-slate-500 hover:bg-slate-50 hover:text-slate-900"
            title="Σημείωση"
            aria-label="Σημείωση για {{ $app->customer_name }}"
        >
            <x-admin.icon name="note" class="h-4 w-4" />
        </button>
    </div>
</article>
