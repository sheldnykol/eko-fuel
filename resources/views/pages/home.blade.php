@extends('layouts.app')

{{-- SEO Title: Πλούσιο σε λέξεις-κλειδιά --}}
@section('title', 'EKO Fuel | Πλυντήριο Αυτοκινήτων & Καύσιμα στην ΛΑΡΙΣΑ')

{{-- Meta Description: Ένα κείμενο που προτρέπει σε δράση --}}
@section('meta_description', 'Βρείτε το πλησιέστερο πρατήριο EKO, δείτε τιμές καυσίμων και κλείστε online ραντεβού για πλύσιμο αυτοκινήτου ή βιολογικό καθαρισμό σε δευτερόλεπτα.')

{{-- Meta Location: Βοηθάει στο Local SEO (αντικατάστησε με την πόλη σου) --}}
@section('meta_location', 'Λάρισα, Θεσσαλία')

@section('content')
    @include('partials.hero')

    <h1 class="sr-only">EKO Fuel - Κορυφαίο Πλυντήριο Αυτοκινήτων και Πρατήρια Καυσίμων</h1>

    @include('partials.gus_stations')
    @include('partials.map')
@endsection
