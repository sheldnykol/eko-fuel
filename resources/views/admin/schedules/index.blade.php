@extends('admin.admin')

@section('admin_content')
    <div class="container mx-auto max-w-4xl p-6">
        <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-lg">
            <h2 class="mb-6 text-2xl font-black text-slate-800">Διαχείριση Ωραρίου Πλυντηρίου</h2>

            @if (session('success'))
                <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-100 p-4 text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.schedules.store') }}" method="POST">
                @csrf

                <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-2">
                    {{-- Επιλογή Πρατηρίου --}}
                    <div>
                        <label class="mb-2 block text-sm font-bold text-slate-700">Πρατήριο</label>
                        <select name="station_id" class="w-full rounded-xl border-slate-200 bg-slate-50 p-3">
                            @foreach ($stations as $station)
                                <option value="{{ $station->id }}">{{ $station->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Επιλογή Ημερομηνίας --}}
                    <div>
                        <label class="mb-2 block text-sm font-bold text-slate-700">
                            Ημερομηνία (Από {{ $minDate }})
                        </label>
                        <input
                            type="date"
                            name="date"
                            min="{{ $minDate }}"
                            required
                            class="w-full rounded-xl border-slate-200 bg-slate-50 p-3"
                        />
                        @error('date')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Επιλογή Ωρών με Checkboxes --}}
                <div class="mb-8">
                    <label class="mb-4 block text-sm font-bold text-slate-700">Επιλέξτε Διαθέσιμες Ώρες</label>
                    <div class="grid grid-cols-3 gap-3 sm:grid-cols-4 md:grid-cols-6">
                        @php
                            $times = ['08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30', '19:00', '19:30', '20:00'];
                        @endphp

                        @foreach ($times as $time)
                            <label
                                class="group relative flex cursor-pointer items-center justify-center rounded-xl border-2 border-slate-100 bg-slate-50 p-3 transition-all hover:border-red-200 has-[:checked]:border-red-500 has-[:checked]:bg-red-50"
                            >
                                <input type="checkbox" name="available_slots[]" value="{{ $time }}" class="hidden" />
                                <span class="text-sm font-bold text-slate-600 group-has-[:checked]:text-red-600">
                                    {{ $time }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <button
                    type="submit"
                    class="w-full rounded-2xl bg-slate-900 py-4 font-bold text-white shadow-lg transition-colors hover:bg-slate-800"
                >
                    ΑΠΟΘΗΚΕΥΣΗ ΠΡΟΓΡΑΜΜΑΤΟΣ
                </button>
            </form>
        </div>
    </div>
@endsection
