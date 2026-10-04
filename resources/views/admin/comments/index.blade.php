@extends('admin.admin')

@section('admin_title', 'Σημειώσεις')

@section('admin_content')
    <x-admin.page-header title="Σημειώσεις" subtitle="Σημειώσεις της ομάδας στα ραντεβού και ειδοποιήσεις συστήματος.">
        <span class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-2.5 py-1.5 text-[12px] font-medium text-slate-600">
            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
            {{ $comments->total() }} καταγραφές
        </span>
    </x-admin.page-header>

    <div class="mx-auto max-w-3xl">
        @php
            $lastDate = null;
        @endphp

        @forelse ($comments as $comment)
            @php
                $currentDate = $comment->created_at->format('Y-m-d');
                $isSystemEvent = is_null($comment->user_id);
                $isMine = $comment->user_id === auth()->id();
            @endphp

            @if ($lastDate !== $currentDate)
                <div class="sticky top-14 z-10 flex justify-center py-3 lg:top-0">
                    <span class="rounded-full border border-slate-200 bg-white px-3 py-0.5 text-[11px] font-medium text-slate-500 shadow-sm">
                        @if ($comment->created_at->isToday())
                            Σήμερα
                        @elseif ($comment->created_at->isYesterday())
                            Χθες
                        @else
                            {{ $comment->created_at->locale('el')->translatedFormat('l j F Y') }}
                        @endif
                    </span>
                </div>
                @php
                    $lastDate = $currentDate;
                @endphp
            @endif

            @if ($isSystemEvent)
                <div class="mb-2.5 flex gap-3 rounded-xl border border-amber-200 bg-amber-50 p-3">
                    <span class="h-fit rounded-lg bg-amber-100 p-1.5 text-amber-600"><x-admin.icon name="bell" class="h-4 w-4" /></span>
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center justify-between gap-2">
                            <span class="text-[11px] font-semibold tracking-wide text-amber-800 uppercase">Ειδοποίηση συστήματος</span>
                            <span class="text-[11px] text-amber-600 tabular-nums">{{ $comment->created_at->format('H:i') }}</span>
                        </div>
                        <p class="mt-0.5 text-[13px] text-amber-900">{!! nl2br(e($comment->body)) !!}</p>
                    </div>
                </div>
            @else
                <div class="{{ $isMine ? 'items-end' : 'items-start' }} mb-2.5 flex flex-col">
                    <div class="{{ $isMine ? 'rounded-tr-sm bg-slate-900 text-white' : 'rounded-tl-sm border border-slate-200 bg-white text-slate-800' }} w-full max-w-[92%] rounded-2xl px-3.5 py-2.5 sm:max-w-[80%]">
                        <div class="mb-1 flex items-center justify-between gap-3">
                            <span class="text-[12px] font-semibold {{ $isMine ? 'text-slate-300' : 'text-slate-500' }}">{{ $comment->user->name ?? 'Άγνωστος' }}</span>
                            <span class="text-[11px] tabular-nums {{ $isMine ? 'text-slate-400' : 'text-slate-400' }}">{{ $comment->created_at->format('H:i') }}</span>
                        </div>
                        <p class="text-[13px] leading-relaxed break-words">{{ $comment->body }}</p>

                        @if ($comment->appointment)
                            <a
                                href="{{ route('admin.dashboard', ['date' => \Carbon\Carbon::parse($comment->appointment->appointment_date)->toDateString()]) }}"
                                class="{{ $isMine ? 'border-slate-700 text-slate-300 hover:text-white' : 'border-slate-100 text-slate-500 hover:text-slate-900' }} mt-2 flex flex-wrap items-center gap-x-2 gap-y-1 border-t pt-2 text-[11px]"
                            >
                                <span class="{{ $isMine ? 'bg-white text-slate-900' : 'bg-slate-900 text-white' }} rounded px-1.5 py-px font-mono">{{ $comment->appointment->license_plate }}</span>
                                <span>{{ $comment->appointment->customer_name }}</span>
                                <span class="tabular-nums">· {{ date('d/m', strtotime($comment->appointment->appointment_date)) }} {{ substr($comment->appointment->appointment_time, 0, 5) }}</span>
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        @empty
            <div class="rounded-xl border border-dashed border-slate-300 bg-white px-4 py-14 text-center">
                <span class="mx-auto mb-3 flex w-fit rounded-full bg-slate-100 p-3 text-slate-400"><x-admin.icon name="chat" class="h-6 w-6" /></span>
                <p class="text-[13px] text-slate-500">Δεν υπάρχουν σημειώσεις ακόμα. Προσθέστε από το κουμπί «Σημείωση» σε κάθε ραντεβού.</p>
            </div>
        @endforelse

        @if ($comments->hasPages())
            <div class="mt-4">{{ $comments->links() }}</div>
        @endif
    </div>
@endsection
