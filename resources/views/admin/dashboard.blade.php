@extends('admin.admin')

@section('admin_title', 'Ραντεβού')

@php
    use App\Support\BookingRules;
    use Carbon\Carbon;

    $selected = Carbon::parse($selectedDate)->locale('el');
    $today = now()->toDateString();
    $active = $appointments->where('status', '!=', BookingRules::STATUS_CANCELLED)->values();
    $cancelled = $appointments->where('status', BookingRules::STATUS_CANCELLED)->values();
    $kpis = [
        ['Σύνολο', $stats['total'], 'text-slate-900'],
        ['Αναμονή', $stats['pending'], 'text-amber-600'],
        ['Έγιναν', $stats['completed'], 'text-emerald-600'],
        ['Ακυρώσεις', $stats['canceled'], 'text-slate-500'],
    ];
@endphp

@section('admin_content')
    <x-admin.page-header
        title="Ραντεβού"
        :subtitle="ucfirst($selected->translatedFormat('l j F Y')) . ($selectedDate === $today ? ' · Σήμερα' : '')"
    >
        @if ($selectedDate !== $today)
            <a href="{{ route('admin.dashboard') }}" class="rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-[13px] font-medium text-slate-700 hover:bg-slate-50">Σήμερα</a>
        @endif
        <form action="{{ route('admin.dashboard') }}" method="GET">
            <label class="sr-only" for="admin_date_input">Μετάβαση σε ημερομηνία</label>
            <input
                type="date"
                name="date"
                id="admin_date_input"
                value="{{ $selectedDate }}"
                onchange="this.form.submit()"
                class="rounded-lg border border-slate-200 bg-white px-2.5 py-1.5 text-[13px] text-slate-700 focus:border-red-500 focus:ring-1 focus:ring-red-500 focus:outline-none"
            />
        </form>
        <a
            href="{{ route('admin.exportPDF', ['date' => $selectedDate]) }}"
            class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-[13px] font-medium text-slate-700 hover:bg-slate-50"
            title="PDF με τα ολοκληρωμένα ραντεβού της ημέρας"
        >
            <x-admin.icon name="download" class="h-4 w-4" />
            PDF
        </a>
    </x-admin.page-header>

    <div class="grid grid-cols-1 gap-5 lg:grid-cols-[280px_minmax(0,1fr)]">
        <aside class="space-y-4">
            <section class="rounded-xl border border-slate-200 bg-white p-3.5" aria-label="Ημερολόγιο">
                <div class="mb-2 flex items-center justify-between">
                    <h2 class="text-sm font-semibold text-slate-900">{{ ucfirst($calendarDate->copy()->locale('el')->translatedFormat('F Y')) }}</h2>
                    <div class="flex items-center">
                        <a href="{{ route('admin.dashboard', ['date' => $selectedDate, 'month' => $prevMonth->month, 'year' => $prevMonth->year]) }}" class="rounded-md p-1.5 text-slate-500 hover:bg-slate-100" aria-label="Προηγούμενος μήνας">
                            <x-admin.icon name="chevron-left" class="h-4 w-4" />
                        </a>
                        <a href="{{ route('admin.dashboard', ['date' => $selectedDate, 'month' => $nextMonth->month, 'year' => $nextMonth->year]) }}" class="rounded-md p-1.5 text-slate-500 hover:bg-slate-100" aria-label="Επόμενος μήνας">
                            <x-admin.icon name="chevron-right" class="h-4 w-4" />
                        </a>
                    </div>
                </div>

                @php
                    $dayKeys = array_keys($calendarDays);
                    $focusIndex = array_search($selectedDate, $dayKeys, true);
                    if ($focusIndex === false) {
                        $focusIndex = array_search($today, $dayKeys, true);
                    }
                    $focusWeek = $focusIndex === false ? 0 : intdiv($emptyDaysAtStart + $focusIndex, 7);
                @endphp
                <div class="cal-collapsed grid grid-cols-7 gap-0.5 text-center" id="calendarGrid">
                    @foreach (['Δε', 'Τρ', 'Τε', 'Πε', 'Πα', 'Σα', 'Κυ'] as $dayName)
                        <div class="pb-1 text-[11px] font-medium text-slate-400">{{ $dayName }}</div>
                    @endforeach

                    @for ($i = 0; $i < $emptyDaysAtStart; $i++)
                        <div class="{{ $focusWeek === 0 ? '' : 'cal-other-week' }}"></div>
                    @endfor

                    @foreach ($calendarDays as $date => $count)
                        @php
                            $isSelected = $date === $selectedDate;
                            $isToday = $date === $today;
                            $otherWeek = intdiv($emptyDaysAtStart + $loop->index, 7) !== $focusWeek;
                        @endphp
                        <a
                            href="{{ route('admin.dashboard', ['date' => $date]) }}"
                            class="{{ $otherWeek ? 'cal-other-week' : '' }} {{ $isSelected ? 'bg-slate-900 text-white' : ($isToday ? 'font-semibold text-red-600 hover:bg-slate-100' : ($date < $today ? 'text-slate-400 hover:bg-slate-100' : 'text-slate-700 hover:bg-slate-100')) }} flex h-10 flex-col items-center justify-center rounded-md text-[13px] tabular-nums"
                            title="{{ $count ? $count . ' ραντεβού' : 'Χωρίς ραντεβού' }}"
                            @if ($isSelected) aria-current="date" @endif
                        >
                            <span>{{ (int) substr($date, 8, 2) }}</span>
                            <span class="{{ $count ? ($isSelected ? 'bg-white' : 'bg-red-500') : 'bg-transparent' }} mt-0.5 h-1 w-1 rounded-full"></span>
                        </a>
                    @endforeach
                </div>

                <button type="button" id="calendarToggle" class="mt-1 w-full rounded-md py-1 text-[12px] font-medium text-slate-500 hover:bg-slate-50 lg:hidden" aria-expanded="false">
                    Όλος ο μήνας
                </button>
            </section>

            <p class="hidden px-1 text-[12px] text-slate-500 lg:block">
                {{ $upcomingCount }} ραντεβού σε αναμονή τις επόμενες 7 ημέρες.
            </p>
        </aside>

        <section class="min-w-0 space-y-4">
            <dl class="grid grid-cols-4 divide-x divide-slate-100 rounded-xl border border-slate-200 bg-white">
                @foreach ($kpis as [$label, $value, $tone])
                    <div class="px-2 py-2.5 text-center sm:px-4 sm:text-left">
                        <dt class="truncate text-[11px] text-slate-500 sm:text-xs">{{ $label }}</dt>
                        <dd class="{{ $tone }} text-lg leading-tight font-semibold tabular-nums">{{ $value }}</dd>
                    </div>
                @endforeach
            </dl>

            <div class="overflow-hidden rounded-xl border border-slate-200 bg-white">
                @forelse ($active as $app)
                    @include('admin.partials.appointment-row', ['app' => $app])
                @empty
                    <div class="px-4 py-12 text-center">
                        <p class="text-sm font-medium text-slate-700">Κανένα ραντεβού</p>
                        <p class="mt-0.5 text-[13px] text-slate-500">Δεν υπάρχουν κρατήσεις για αυτή την ημέρα.</p>
                    </div>
                @endforelse
            </div>

            @if ($cancelled->isNotEmpty())
                <details class="overflow-hidden rounded-xl border border-slate-200 bg-white">
                    <summary class="cursor-pointer list-none px-4 py-2.5 text-[13px] font-medium text-slate-600 hover:bg-slate-50">
                        Ακυρωμένα ({{ $cancelled->count() }})
                    </summary>
                    <div class="border-t border-slate-100">
                        @foreach ($cancelled as $app)
                            @include('admin.partials.appointment-row', ['app' => $app])
                        @endforeach
                    </div>
                </details>
            @endif
        </section>
    </div>

    <div id="commentModal" class="fixed inset-0 z-50 hidden items-end justify-center bg-slate-900/50 sm:items-center sm:p-4" role="dialog" aria-modal="true" aria-labelledby="commentTitle">
        <div class="w-full max-w-md rounded-t-2xl bg-white shadow-xl sm:rounded-2xl">
            <div class="flex items-center justify-between border-b border-slate-100 px-4 py-3">
                <div class="min-w-0">
                    <h3 id="commentTitle" class="text-sm font-semibold text-slate-900">Νέα σημείωση</h3>
                    <p id="modalSubtitle" class="truncate text-[12px] text-slate-500"></p>
                </div>
                <button type="button" onclick="closeCommentModal()" class="rounded-md p-1.5 text-slate-400 hover:bg-slate-100" aria-label="Κλείσιμο">
                    <x-admin.icon name="close" class="h-4 w-4" />
                </button>
            </div>
            <form id="commentForm" method="POST" class="p-4">
                @csrf
                <label for="commentBody" class="sr-only">Σημείωση</label>
                <textarea
                    name="body"
                    id="commentBody"
                    rows="3"
                    maxlength="1000"
                    required
                    placeholder="π.χ. καθυστέρησε 10 λεπτά"
                    class="w-full rounded-lg border border-slate-200 bg-white p-3 text-[13px] focus:border-red-500 focus:ring-1 focus:ring-red-500 focus:outline-none"
                ></textarea>
                <div class="mt-3 flex justify-end gap-2">
                    <button type="button" onclick="closeCommentModal()" class="rounded-lg px-3 py-2 text-[13px] font-medium text-slate-600 hover:bg-slate-100">Άκυρο</button>
                    <button type="submit" class="rounded-lg bg-slate-900 px-4 py-2 text-[13px] font-medium text-white hover:bg-slate-800">Αποθήκευση</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('calendarToggle')?.addEventListener('click', function () {
            const collapsed = document.getElementById('calendarGrid').classList.toggle('cal-collapsed')
            this.setAttribute('aria-expanded', !collapsed)
            this.textContent = collapsed ? 'Όλος ο μήνας' : 'Μόνο η εβδομάδα'
        })

        document.querySelectorAll('.status-select').forEach(select => {
            select.addEventListener('change', () => {
                if (select.value === '3' && !confirm('Ακύρωση του ραντεβού του ' + select.dataset.name + ';')) {
                    select.value = select.dataset.current
                    return
                }
                select.form.submit()
            })
        })

        function openCommentModal(btn) {
            const modal = document.getElementById('commentModal')
            document.getElementById('commentForm').action = btn.dataset.action
            document.getElementById('modalSubtitle').textContent = btn.dataset.subtitle
            modal.classList.remove('hidden')
            modal.classList.add('flex')
            setTimeout(() => document.getElementById('commentBody').focus(), 50)
        }

        function closeCommentModal() {
            const modal = document.getElementById('commentModal')
            modal.classList.add('hidden')
            modal.classList.remove('flex')
        }

        document.getElementById('commentModal').addEventListener('click', e => {
            if (e.target.id === 'commentModal') closeCommentModal()
        })
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closeCommentModal()
        })
    </script>
@endpush
