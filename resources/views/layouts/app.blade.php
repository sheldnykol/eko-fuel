<!DOCTYPE html>
<html lang="el" class="scroll-smooth">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <title>@yield('title', 'EKO Fuel')</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
            rel="stylesheet"
        />
          <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    />
    </head>
    <body class="flex min-h-screen flex-col bg-gray-50 antialiased">
        @include('partials.nav')
        <main class="flex-grow">
            @yield('content')
        </main>
        <!-- Footer προαιρετικό για αρχή -->
    </body>
</html>
