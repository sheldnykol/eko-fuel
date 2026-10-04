@extends('layouts.app')

@section('full_title', 'Πρατήρια EKO & Πλυντήριο Αυτοκινήτων στη Λάρισα | ΕΚΟ Δράμη')
@section('meta_description', 'Πρατήρια καυσίμων EKO στη Λάρισα και στην Πορταριά: τιμές καυσίμων, πλυντήριο αυτοκινήτων με online ραντεβού, υγραέριο κίνησης και διανομή πετρελαίου.')

@php
    use App\Support\Seo;

    $schemas = array_map(fn ($id) => Seo::stationSchema($id), array_keys(Seo::stations()));
@endphp

@push('schema')
    <script type="application/ld+json">{!! Seo::graph(...$schemas) !!}</script>
@endpush

@section('content')
    @include('partials.hero')
    @include('partials.gus_stations')
    @include('partials.fuel_order')
    @include('partials.map')
@endsection
