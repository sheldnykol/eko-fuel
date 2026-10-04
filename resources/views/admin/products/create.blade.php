@extends('admin.admin')

@section('admin_title', 'Νέο προϊόν')

@section('admin_content')
    <div class="mx-auto max-w-2xl">
        <a href="{{ route('admin.products.index') }}" class="mb-3 inline-flex items-center gap-1 text-[13px] font-medium text-slate-500 hover:text-slate-900">
            <x-admin.icon name="arrow-left" class="h-4 w-4" />
            Προϊόντα
        </a>
        <x-admin.page-header title="Νέο προϊόν" subtitle="Προσθήκη προϊόντος ή υπηρεσίας σε πρατήριο." />

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="rounded-xl border border-slate-200 bg-white">
            @csrf
            <div class="p-4 sm:p-5">
                @include('admin.products._form', ['product' => null])
            </div>
            <div class="flex justify-end gap-2 border-t border-slate-100 bg-slate-50/70 px-4 py-3 sm:px-5">
                <a href="{{ route('admin.products.index') }}" class="rounded-lg px-3 py-2 text-[13px] font-medium text-slate-600 hover:bg-slate-100">Άκυρο</a>
                <button type="submit" class="rounded-lg bg-red-600 px-4 py-2 text-[13px] font-medium text-white hover:bg-red-700">Αποθήκευση</button>
            </div>
        </form>
    </div>
@endsection
