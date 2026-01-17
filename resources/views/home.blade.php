<!-- resources/views/home.blade.php -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'EKO Fuel') }}</title>

    <!-- Vite assets - ΑΠΑΡΑΙΤΗΤΟ για να φορτώνονται CSS/JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Προαιρετικά: Google Fonts για Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="antialiased">

    <!-- Το header/nav σου -->
    @include('nav')
    @include('hero')


</body>
</html>