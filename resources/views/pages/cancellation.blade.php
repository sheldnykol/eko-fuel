@extends('layouts.app')

@section('title', 'Ακύρωση Ραντεβού Πλυντηρίου')
@section('meta_description', 'Ακυρώστε online το ραντεβού σας στο πλυντήριο αυτοκινήτων ΕΚΟ Δράμη στη Λάρισα.')
@section('robots', 'noindex, follow')

@php
    use App\Http\Controllers\CancellationController;
    use App\Support\BookingRules;
    use Carbon\Carbon;

    $field = 'h-10 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 focus:border-[#e21838] focus:ring-1 focus:ring-[#e21838] focus:outline-none';
    $list = $single ? collect([$single]) : ($appointments ?? collect());
@endphp

@section('content')
    <section class="bg-slate-50 py-8 sm:py-12">
        <div class="mx-auto max-w-lg px-4">
            <div class="rounded-xl border border-slate-200 bg-white p-5 sm:p-6">
                <h1 class="text-xl font-bold text-slate-900">Ακύρωση ραντεβού</h1>
                <p class="mt-0.5 mb-5 text-sm text-slate-500">
                    Η ακύρωση γίνεται online έως {{ CancellationController::DEADLINE_HOURS }} ώρες πριν το ραντεβού.
                </p>

                @if (session('success'))
                    <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 px-3 py-2 text-[13px] font-medium text-emerald-800" role="status">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-[13px] text-red-700" role="alert">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                @if (! $single)
                    <form action="{{ route('cancellation.page') }}" method="GET" class="space-y-3">
                        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                            <div>
                                <label for="customer_phone" class="mb-1 block text-[13px] font-medium text-slate-700">Κινητό κράτησης</label>
                                <input
                                    type="tel"
                                    name="customer_phone"
                                    id="customer_phone"
                                    value="{{ old('customer_phone', request('customer_phone')) }}"
                                    inputmode="numeric"
                                    maxlength="10"
                                    placeholder="69XXXXXXXX"
                                    required
                                    class="{{ $field }}"
                                />
                            </div>
                            <div>
                                <label for="license_plate" class="mb-1 block text-[13px] font-medium text-slate-700">Πινακίδα</label>
                                <input
                                    type="text"
                                    name="license_plate"
                                    id="license_plate"
                                    value="{{ old('license_plate', request('license_plate')) }}"
                                    maxlength="20"
                                    autocapitalize="characters"
                                    placeholder="ΡΙΑ1234"
                                    required
                                    class="{{ $field }} uppercase"
                                />
                            </div>
                        </div>
                        <button type="submit" class="h-10 w-full rounded-lg bg-slate-900 text-sm font-semibold text-white hover:bg-slate-800">
                            Εύρεση ραντεβού
                        </button>
                    </form>
                @endif

                @if ($list->isNotEmpty())
                    <ul class="{{ $single ? '' : 'mt-6 border-t border-slate-100 pt-4' }} space-y-3">
                        @foreach ($list as $appointment)
                            @php
                                $cancellable = (int) $appointment->status === 1 && CancellationController::isCancellable($appointment);
                            @endphp
                            <li class="rounded-lg border border-slate-200 p-4">
                                <p class="text-sm font-semibold text-slate-900">
                                    {{ ucfirst(Carbon::parse($appointment->appointment_date)->locale('el')->translatedFormat('l d/m/Y')) }}
                                    στις {{ substr($appointment->appointment_time, 0, 5) }}
                                </p>
                                <p class="mt-0.5 text-[13px] text-slate-600">
                                    {{ $appointment->license_plate }} · {{ BookingRules::WASH_LABELS[$appointment->wash_type] ?? $appointment->wash_type }}
                                </p>

                                @if ((int) $appointment->status !== 1)
                                    <p class="mt-3 text-[13px] text-slate-500">Το ραντεβού έχει ήδη ακυρωθεί ή ολοκληρωθεί.</p>
                                @elseif ($cancellable)
                                    <form
                                        action="{{ CancellationController::performUrl($appointment) }}"
                                        method="POST"
                                        class="mt-3"
                                        onsubmit="return confirm('Ακύρωση του ραντεβού στις {{ substr($appointment->appointment_time, 0, 5) }};')"
                                    >
                                        @csrf
                                        <button type="submit" class="h-9 rounded-lg border border-red-200 bg-red-50 px-4 text-[13px] font-semibold text-red-700 hover:bg-red-100">
                                            Ακύρωση ραντεβού
                                        </button>
                                    </form>
                                @else
                                    <p class="mt-3 text-[13px] text-slate-500">
                                        Υπολείπονται λιγότερες από {{ CancellationController::DEADLINE_HOURS }} ώρες. Για ακύρωση καλέστε στο
                                        <a href="tel:2410283954" class="font-semibold text-slate-800">2410 283954</a>.
                                    </p>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <p class="mt-4 text-center text-[13px] text-slate-500">
                <a href="{{ route('pages.booking') }}" class="font-semibold text-[#e21838] hover:underline">Νέο ραντεβού</a>
            </p>
        </div>
    </section>
@endsection
