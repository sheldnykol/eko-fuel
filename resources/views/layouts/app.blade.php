@php
    use App\Support\Seo;

    $pageTitle = trim($__env->yieldContent('full_title'))
        ?: (trim($__env->yieldContent('title')) ? trim($__env->yieldContent('title')) . ' | ' . Seo::SITE_NAME : 'Πρατήρια EKO & Πλυντήριο Αυτοκινήτων στη Λάρισα | ' . Seo::SITE_NAME);
    $pageDescription = trim($__env->yieldContent('meta_description'))
        ?: 'Πρατήρια καυσίμων EKO στη Λάρισα και στην Πορταριά. Τιμές καυσίμων, πλυντήριο αυτοκινήτων με online ραντεβού, βιολογικός καθαρισμός, υγραέριο και παραγγελία πετρελαίου.';
    $ogImage = trim($__env->yieldContent('og_image')) ?: asset('images/opt/og-image.jpg');
    $canonical = trim($__env->yieldContent('canonical')) ?: url()->current();
@endphp
<!DOCTYPE html>
<html lang="el">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>{{ $pageTitle }}</title>
        <meta name="description" content="{{ $pageDescription }}" />
        <meta name="robots" content="@yield('robots', 'index, follow, max-image-preview:large')" />
        <link rel="canonical" href="{{ $canonical }}" />
        <meta name="theme-color" content="#e21838" />
        <meta name="format-detection" content="telephone=yes" />
        <meta name="geo.region" content="GR-42" />
        <meta name="geo.placename" content="Λάρισα" />

        <meta property="og:type" content="@yield('og_type', 'website')" />
        <meta property="og:site_name" content="{{ Seo::SITE_NAME }}" />
        <meta property="og:locale" content="el_GR" />
        <meta property="og:title" content="{{ $pageTitle }}" />
        <meta property="og:description" content="{{ $pageDescription }}" />
        <meta property="og:url" content="{{ $canonical }}" />
        <meta property="og:image" content="{{ $ogImage }}" />
        <meta property="og:image:width" content="1200" />
        <meta property="og:image:height" content="630" />
        <meta name="twitter:card" content="summary_large_image" />

        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/opt/eko-logo-32.png') }}" />
        <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('images/opt/eko-logo-192.png') }}" />
        <link rel="apple-touch-icon" href="{{ asset('images/opt/apple-touch-icon.png') }}" />

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;500;600;700;800;900&display=swap"
            rel="stylesheet"
        />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script type="application/ld+json">{!! Seo::graph(Seo::organization(), Seo::website()) !!}</script>
        @stack('schema')
        @stack('head')
    </head>
    <body class="flex min-h-screen flex-col bg-white text-slate-700 antialiased">
        <a href="#main" class="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-2 focus:z-[60] focus:rounded focus:bg-white focus:px-3 focus:py-2 focus:text-sm">
            Μετάβαση στο περιεχόμενο
        </a>

        @include('partials.nav')

        <main id="main" class="grow">
            @yield('content')
        </main>

        @include('partials.footer')

        @include('partials.cookie_consent')
    </body>
</html>
