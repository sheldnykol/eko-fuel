@extends('layouts.app')

@section('title', 'Σύνδεση Διαχείρισης')
@section('robots', 'noindex, nofollow')

@section('content')
    <section class="flex min-h-[60vh] items-center justify-center bg-slate-50 px-4 py-12">
        <div class="w-full max-w-sm rounded-xl border border-slate-200 bg-white p-6">
            <h1 class="text-lg font-bold text-slate-900">Σύνδεση διαχείρισης</h1>
            <p class="mt-0.5 mb-5 text-sm text-slate-500">Μόνο για το προσωπικό της ΕΚΟ Δράμη.</p>

            @if ($errors->any())
                <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-[13px] text-red-700" role="alert">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf
                <x-field name="email" label="Email" type="email" autocomplete="username" required />
                <div>
                    <label for="password" class="mb-1 block text-[13px] font-medium text-slate-700">Κωδικός</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        autocomplete="current-password"
                        required
                        class="h-10 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm focus:border-[#e21838] focus:ring-1 focus:ring-[#e21838] focus:outline-none"
                    />
                </div>
                <button type="submit" class="h-10 w-full rounded-lg bg-slate-900 text-sm font-bold text-white hover:bg-slate-800">Είσοδος</button>
            </form>
        </div>
    </section>
@endsection
