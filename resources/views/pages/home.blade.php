@extends('layouts.app')

@section('title', 'EKO Fuel - Αρχική')

@section('content')
    @include('partials.hero')
    @include('partials.gus_stations')
    @include('partials.map')
@endsection
