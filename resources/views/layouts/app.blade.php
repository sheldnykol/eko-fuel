<!DOCTYPE html>
<html lang="el" class="scroll-smooth">
    <head>
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/eko-logo.png') }}" />
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <title>@yield('title') | EKO Fuel - Πλυντήριο Αυτοκινήτων & Καύσιμα</title>

        <meta
            name="description"
            content="@yield('meta_description', 'Κλείστε online ραντεβού για πλύσιμο αυτοκινήτου στην EKO. Κορυφαίες υπηρεσίες καθαρισμού, βιολογικός καθαρισμός και ποιοτικά καύσιμα στην περιοχή σας.')"
        />
        <meta
            name="keywords"
            content="πλυντήριο αυτοκινήτων, ραντεβού πλυντήριο, βιολογικός καθαρισμός, EKO fuel, βενζινάδικο, @yield('meta_location', 'Ελλάδα')"
        />
        <meta name="author" content="Your Name/Agency" />

        <meta property="og:type" content="website" />
        <meta property="og:title" content="@yield('title') | EKO Fuel" />
        <meta
            property="og:description"
            content="Κλείστε το ραντεβού σας για πλύσιμο αυτοκινήτου online εύκολα και γρήγορα."
        />
        <meta property="og:image" content="{{ asset('images/eko-preview.jpg') }}" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
            rel="stylesheet"
        />

        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    </head>
    <body class="flex min-h-screen flex-col bg-gray-50 antialiased">
        @include('partials.nav')

        <main class="grow">
            @yield('content')
        </main>

        @include('partials.footer')
    </body>
</html>
