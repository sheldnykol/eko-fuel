<!DOCTYPE html>
<html lang="el" class="scroll-smooth">
    <head>
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/eko-logo.png') }}" />
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <title>@yield('title', 'EKO Fuel')</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
            rel="stylesheet"
        />
    </head>
    <body class="flex min-h-screen flex-col bg-gray-50 antialiased">
        @include('partials.nav')
        <main class="grow">
            @yield('content')
        </main>
        @include('partials.footer')
    </body>
</html>
