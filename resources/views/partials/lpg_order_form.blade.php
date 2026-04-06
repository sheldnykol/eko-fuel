@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-slate-50 px-4 py-12">
        <div class="mx-auto max-w-xl">
            <div class="overflow-hidden rounded-3xl border border-blue-100 bg-white shadow-2xl">
                <div class="relative bg-blue-600 p-8 text-center">
                    <h1 class="text-3xl font-bold tracking-wider text-white uppercase">Παραγγελία Υγραερίου</h1>
                    <p class="mt-2 text-sm text-blue-100">Άμεση παράδοση στον χώρο σας</p>
                </div>

                {{-- Μήνυμα Επιτυχίας --}}
                @if (session('success'))
                    <div
                        class="m-6 flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 text-emerald-500"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>
                        <span class="font-bold">{{ session('success') }}</span>
                    </div>
                @endif

                {{-- Μηνύματα Σφάλματος (Validation Errors) --}}
                @if ($errors->any())
                    <div class="m-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                        <ul class="list-disc space-y-1 pl-5">
                            @foreach ($errors->all() as $error)
                                <li class="font-medium">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('lpg-orders.store') }}" method="POST" class="space-y-5 p-8">
                    @csrf

                    <div>
                        <label class="mb-2 block text-sm font-bold text-slate-700">Ονοματεπώνυμο / Επωνυμία</label>
                        <input
                            type="text"
                            name="lpg_name"
                            value="{{ old('lpg_name') }}"
                            class="w-full rounded-xl border-slate-200 p-3 uppercase shadow-sm placeholder:normal-case focus:border-blue-500 focus:ring-blue-500"
                            placeholder="π.χ. ΙΩΑΝΝΗΣ ΠΑΠΑΔΟΠΟΥΛΟΣ"
                            required
                            oninput="this.value = this.value.toUpperCase()"
                        />
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-bold text-slate-700">Είδος Υγραερίου</label>
                        <select
                            name="lpg_type"
                            class="w-full rounded-xl border-slate-200 bg-slate-50 p-3 font-medium text-slate-700 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        >
                            <option value="heating" {{ old('lpg_type') == 'heating' ? 'selected' : '' }}>
                                Υγραέριο Θέρμανσης (για το σπίτι)
                            </option>
                            <option value="propane" {{ old('lpg_type') == 'propane' ? 'selected' : '' }}>
                                Υγραέριο Προπανίου (για επιχειρήσεις)
                            </option>
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700">Ποσότητα (Λίτρα/Κιλά)</label>
                            <input
                                type="number"
                                name="lpg_quantity"
                                step="100"
                                min="100"
                                value="{{ old('lpg_quantity') }}"
                                class="w-full rounded-xl border-slate-200 p-3 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                placeholder="π.χ. 500"
                                required
                            />
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700">ΑΦΜ (9 Ψηφία)</label>
                            <input
                                type="text"
                                name="lpg_afm"
                                value="{{ old('lpg_afm') }}"
                                class="w-full rounded-xl border-slate-200 p-3 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                placeholder="π.χ. 123456789"
                                required
                                maxlength="9"
                                minlength="9"
                                pattern="\d{9}"
                                title="Παρακαλώ εισάγετε ακριβώς 9 ψηφία"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 9)"
                            />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700">Πόλη / Περιοχή</label>
                            <input
                                type="text"
                                name="lpg_city"
                                value="{{ old('lpg_city') }}"
                                class="w-full rounded-xl border-slate-200 p-3 uppercase shadow-sm placeholder:normal-case focus:border-blue-500 focus:ring-blue-500"
                                placeholder="π.χ. ΛΑΡΙΣΑ"
                                required
                                oninput="this.value = this.value.toUpperCase()"
                            />
                        </div>
                        <div class="flex gap-2">
                            <div class="grow">
                                <label class="mb-2 block text-sm font-bold text-slate-700">Διεύθυνση</label>
                                <input
                                    type="text"
                                    name="lpg_address"
                                    value="{{ old('lpg_address') }}"
                                    class="w-full rounded-xl border-slate-200 p-3 uppercase shadow-sm placeholder:normal-case focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="π.χ. ΟΔΟΣ"
                                    required
                                    oninput="this.value = this.value.toUpperCase()"
                                />
                            </div>
                            <div class="w-20">
                                <label class="mb-2 block text-sm font-bold text-slate-700">Αρ.</label>
                                <input
                                    type="text"
                                    name="lpg_number_address"
                                    value="{{ old('lpg_number_address') }}"
                                    class="w-full rounded-xl border-slate-200 p-3 uppercase shadow-sm placeholder:normal-case focus:border-blue-500 focus:ring-blue-500"
                                    required
                                    oninput="this.value = this.value.toUpperCase()"
                                />
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-bold text-slate-700">Τηλέφωνο (10 Ψηφία)</label>
                        <input
                            type="text"
                            name="lpg_phone"
                            value="{{ old('lpg_phone') }}"
                            class="w-full rounded-xl border-slate-200 p-3 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="69XXXXXXXX ή 2410XXXXXX"
                            required
                            maxlength="10"
                            minlength="10"
                            pattern="\d{10}"
                            title="Παρακαλώ εισάγετε ακριβώς 10 ψηφία"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10)"
                        />
                    </div>

                    <div class="pt-4">
                        <button
                            type="submit"
                            class="w-full transform rounded-xl bg-blue-600 py-4 font-bold tracking-wide text-white uppercase shadow-lg transition hover:-translate-y-1 hover:bg-blue-700 active:scale-95"
                        >
                            Επιβεβαιωση Παραγγελιας Υγραεριου
                        </button>
                    </div>
                </form>
            </div>

            <div class="mt-6 text-center">
                <a
                    href="/"
                    class="flex items-center justify-center gap-2 text-sm font-medium text-slate-400 transition hover:text-blue-600"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"
                        />
                    </svg>
                    Επιστροφή στην Αρχική
                </a>
            </div>
        </div>
    </div>
@endsection
