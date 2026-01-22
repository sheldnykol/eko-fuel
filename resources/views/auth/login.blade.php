@extends('layouts.app')

@section('content')
    <div class="flex min-h-screen items-center justify-center bg-slate-100">
        <div class="w-full max-w-md rounded-[2rem] border border-slate-200 bg-white p-8 shadow-xl">
            <h2 class="mb-6 text-center text-3xl font-black text-slate-900">Admin Login</h2>

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="mb-1 block text-sm font-bold text-slate-700">Email</label>
                    <input
                        type="email"
                        name="email"
                        required
                        class="w-full rounded-xl border-slate-200 bg-slate-50 p-3"
                    />
                </div>
                <div>
                    <label class="mb-1 block text-sm font-bold text-slate-700">Password</label>
                    <input
                        type="password"
                        name="password"
                        required
                        class="w-full rounded-xl border-slate-200 bg-slate-50 p-3"
                    />
                </div>
                <button
                    type="submit"
                    class="w-full rounded-xl bg-slate-900 py-4 font-bold text-white transition-all hover:bg-slate-800"
                >
                    Εισοδος
                </button>

                @if ($errors->any())
                    <p class="mt-2 text-center text-sm font-bold text-red-500">{{ $errors->first() }}</p>
                @endif
            </form>
        </div>
    </div>
@endsection
