@extends('admin.admin')

@section('admin_content')
    <div class="mx-auto max-w-5xl">
        <div class="mb-8 flex items-center justify-between">
            <h2 class="text-2xl font-bold text-slate-800">Κεντρικό Log Σημειώσεων</h2>
            <div class="rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm text-slate-500">
                Σύνολο: {{ $comments->total() }} σημειώσεις
            </div>
        </div>

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            {{-- Το "Chat" Container --}}
            <div class="flex h-[600px] flex-col space-y-4 overflow-y-auto bg-slate-50 p-6">
                @foreach ($comments as $comment)
                    {{-- Έλεγχος αν το σχόλιο είναι του συνδεδεμένου Admin για να το βάλουμε δεξιά --}}
                    @php
                        $isMine = $comment->user_id === auth()->id();
                    @endphp

                    <div class="{{ $isMine ? 'items-end' : 'items-start' }} flex flex-col">
                        {{-- Το "Συννεφάκι" --}}
                        <div
                            class="{{ $isMine ? 'rounded-tr-none bg-red-600 text-white' : 'rounded-tl-none border border-slate-200 bg-white text-slate-800' }} max-w-[70%] rounded-2xl px-4 py-3 shadow-sm"
                        >
                            {{-- Header Σχολίου: Admin Name & Πινακίδα --}}
                            <div
                                class="{{ $isMine ? 'border-red-500' : 'border-slate-100' }} mb-1 flex items-center gap-2 border-b pb-1"
                            >
                                <span class="text-[10px] font-black tracking-tighter uppercase">
                                    {{ $comment->user ? $comment->user->name : 'System' }}
                                </span>
                                <span class="text-[10px] font-medium italic opacity-80">
                                    — {{ $comment->appointment->license_plate }}
                                </span>
                            </div>

                            {{-- Το κείμενο --}}
                            <p class="mt-1 text-sm leading-relaxed">
                                {{ $comment->body }}
                            </p>

                            {{-- Η ώρα --}}
                            <div class="mt-2 text-right text-[9px] font-bold uppercase opacity-60">
                                {{ $comment->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="border-t border-slate-100 bg-white p-4">
                {{ $comments->links() }}
            </div>
        </div>
    </div>
@endsection
