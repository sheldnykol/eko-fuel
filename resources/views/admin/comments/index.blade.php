@extends('admin.admin')

@section('admin_content')
    <div class="mx-auto max-w-5xl">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-black text-slate-900">Activity Log & Σημειώσεις</h2>
                <p class="mt-1 text-sm text-slate-500">
                    Παρακολουθήστε τη δραστηριότητα και τις νέες παραγγελίες σε πραγματικό χρόνο.
                </p>
            </div>
            <div
                class="flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-bold text-slate-600 shadow-sm"
            >
                <span class="flex h-2 w-2 animate-pulse rounded-full bg-emerald-500"></span>
                Σύνολο: {{ $comments->total() }} συμβάντα
            </div>
        </div>

        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            {{-- Το "Feed" Container --}}
            <div class="flex h-[700px] flex-col overflow-y-auto bg-slate-50/50 p-6">
                @php
                    $lastDate = null;
                @endphp

                @forelse ($comments as $comment)
                    {{-- 1. Λογική Διαχωρισμού Ημερών (Date Separator) --}}
                    @php
                        $currentDate = $comment->created_at->format('Y-m-d');
                        $isSystemEvent = is_null($comment->user_id); // Αν δεν έχει user_id, είναι του συστήματος!
                        $isMine = $comment->user_id === auth()->id();
                    @endphp

                    @if ($lastDate !== $currentDate)
                        <div class="my-6 flex justify-center">
                            <span
                                class="rounded-full border border-slate-200 bg-white px-4 py-1 text-[10px] font-black tracking-widest text-slate-400 uppercase shadow-sm"
                            >
                                @if ($comment->created_at->isToday())
                                    Σήμερα
                                @elseif ($comment->created_at->isYesterday())
                                    Χθες
                                @else
                                    {{ $comment->created_at->translatedFormat('d F Y') }}
                                @endif
                            </span>
                        </div>
                        @php
                            $lastDate = $currentDate;
                        @endphp
                    @endif

                    {{-- 2. Εμφάνιση Συμβάντος --}}
                    @if ($isSystemEvent)
                        {{-- SYSTEM ALERT (Π.χ. Νέα Παραγγελία Καυσίμου) --}}
                        <div class="mb-4 flex w-full justify-center">
                            <div
                                class="flex w-full max-w-2xl items-start gap-4 rounded-2xl border border-amber-200 bg-amber-50 p-4 shadow-sm"
                            >
                                <div class="rounded-full bg-amber-100 p-2 text-amber-600">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="2"
                                        stroke="currentColor"
                                        class="h-5 w-5"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M15.75 5.25v13.5m-7.5-13.5v13.5M3 5.25h18M3 18.75h18M6.75 5.25v13.5m10.5-13.5v13.5"
                                        />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-black tracking-wider text-amber-800 uppercase">
                                            Ειδοποιηση Συστηματος
                                        </span>
                                        <span class="text-xs font-bold text-amber-500">
                                            {{ $comment->created_at->format('H:i') }}
                                        </span>
                                    </div>
                                    <p class="mt-1 text-sm font-medium text-amber-900">
                                        {!! nl2br(e($comment->body)) !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- ΚΑΝΟΝΙΚΟ ΣΧΟΛΙΟ (Από Admin) --}}
                        <div class="{{ $isMine ? 'items-end' : 'items-start' }} mb-4 flex flex-col">
                            <div
                                class="{{ $isMine ? 'rounded-tr-none bg-slate-800 text-white' : 'rounded-tl-none border border-slate-200 bg-white text-slate-800' }} max-w-[75%] rounded-2xl px-5 py-4 shadow-sm transition-all hover:shadow-md"
                            >
                                <div
                                    class="{{ $isMine ? 'border-slate-700' : 'border-slate-100' }} mb-2 flex items-center justify-between border-b pb-2"
                                >
                                    <span class="text-[11px] font-black tracking-wider uppercase opacity-80">
                                        {{ $comment->user->name ?? 'Unknown' }}
                                    </span>
                                    @if ($comment->appointment)
                                        <div class="ml-3 flex flex-wrap items-center gap-1.5">
                                            <span
                                                class="rounded bg-black/10 px-2 py-0.5 text-[10px] font-bold"
                                                title="Πινακίδα"
                                            >
                                                🚗 {{ $comment->appointment->license_plate }}
                                            </span>
                                            <span
                                                class="rounded bg-black/10 px-2 py-0.5 text-[10px] font-bold"
                                                title="Πελάτης"
                                            >
                                                👤 {{ $comment->appointment->customer_name }}
                                            </span>
                                            <a
                                                href="tel:{{ $comment->appointment->customer_phone }}"
                                                class="rounded bg-black/10 px-2 py-0.5 text-[10px] font-bold transition-colors hover:bg-black/20"
                                                title="Κλήση"
                                            >
                                                📞 {{ $comment->appointment->customer_phone }}
                                            </a>
                                        </div>
                                    @endif
                                </div>

                                <p class="text-sm leading-relaxed">{{ $comment->body }}</p>

                                <div class="mt-2 text-right text-[10px] font-bold opacity-50">
                                    {{ $comment->created_at->format('H:i') }}
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="flex h-full flex-col items-center justify-center text-slate-400">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="mb-2 h-12 w-12 opacity-20"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z"
                            />
                        </svg>
                        <p class="font-medium">Δεν υπάρχουν καταγραφές στο Log.</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="border-t border-slate-100 bg-white p-4">
                {{ $comments->links() }}
            </div>
        </div>
    </div>
@endsection
