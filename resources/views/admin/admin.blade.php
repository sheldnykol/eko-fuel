<!DOCTYPE html>
<html lang="el">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
        <meta name="robots" content="noindex, nofollow" />
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/eko-logo.png') }}" />
        <title>@yield('admin_title', 'Admin') · EKO Admin</title>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
            rel="stylesheet"
        />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .admin-shell {
                font-family: 'Inter', ui-sans-serif, system-ui, sans-serif;
            }
            .no-scrollbar {
                scrollbar-width: none;
            }
            .no-scrollbar::-webkit-scrollbar {
                display: none;
            }
            @media (max-width: 1023px) {
                .cal-collapsed .cal-other-week {
                    display: none;
                }
            }
        </style>
    </head>
    <body class="admin-shell bg-slate-50 text-[13px] text-slate-700 antialiased sm:text-sm">
        @php
            $restricted = ! auth()->user()->isAdmin();
            $navItems = [
                ['route' => 'admin.dashboard', 'match' => 'admin.dashboard', 'label' => 'Ραντεβού', 'icon' => 'calendar', 'all' => true],
                ['route' => 'admin.comments.index', 'match' => 'admin.comments.*', 'label' => 'Σημειώσεις', 'icon' => 'chat', 'all' => true],
                ['route' => 'admin.schedules.index', 'match' => 'admin.schedules.*', 'label' => 'Ωράριο Πλυντηρίου', 'icon' => 'clock', 'all' => false],
                ['route' => 'admin.fuel-orders', 'match' => 'admin.fuel-orders*', 'label' => 'Παραγγελίες Καυσίμων', 'icon' => 'fuel', 'all' => false],
                ['route' => 'admin.stats', 'match' => 'admin.stats', 'label' => 'Στατιστικά', 'icon' => 'chart', 'all' => false],
                ['route' => 'admin.products.index', 'match' => 'admin.products.*', 'label' => 'Προϊόντα', 'icon' => 'box', 'all' => false],
            ];
            $navItems = array_filter($navItems, fn ($item) => $item['all'] || ! $restricted);
            $currentItem = collect($navItems)->first(fn ($item) => request()->routeIs($item['match']));
        @endphp

        <div class="flex min-h-screen">
            <div id="navOverlay" class="fixed inset-0 z-40 hidden bg-slate-900/50 lg:hidden" onclick="toggleNav(false)"></div>

            <aside
                id="sidebar"
                class="fixed inset-y-0 left-0 z-50 flex w-64 -translate-x-full flex-col bg-slate-900 text-slate-300 transition-transform duration-200 lg:sticky lg:top-0 lg:h-screen lg:w-60 lg:translate-x-0"
            >
                <div class="flex h-14 items-center justify-between px-4">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5">
                        <img src="{{ asset('images/eko-logo.png') }}" class="h-7 w-7 rounded object-contain" alt="EKO" />
                        <span class="text-sm font-semibold text-white">EKO Admin</span>
                    </a>
                    <button type="button" class="rounded-md p-1.5 text-slate-400 hover:bg-slate-800 lg:hidden" onclick="toggleNav(false)" aria-label="Κλείσιμο μενού">
                        <x-admin.icon name="close" />
                    </button>
                </div>

                <form action="{{ route('admin.search') }}" method="GET" class="px-3 pb-3">
                    <label class="relative block">
                        <span class="sr-only">Αναζήτηση</span>
                        <x-admin.icon name="search" class="pointer-events-none absolute top-1/2 left-2.5 h-4 w-4 -translate-y-1/2 text-slate-500" />
                        <input
                            type="search"
                            name="query"
                            value="{{ request('query') }}"
                            placeholder="Πινακίδα, όνομα, τηλέφωνο"
                            class="w-full rounded-lg border-0 bg-slate-800 py-2 pr-3 pl-8 text-[13px] text-white placeholder-slate-500 focus:ring-2 focus:ring-red-500 focus:outline-none"
                        />
                    </label>
                </form>

                <nav class="flex-1 space-y-0.5 overflow-y-auto px-3">
                    <p class="px-2.5 pt-2 pb-1.5 text-[11px] font-semibold tracking-wider text-slate-500 uppercase">Μενού</p>
                    @foreach ($navItems as $item)
                        @php
                            $active = request()->routeIs($item['match']);
                        @endphp
                        <a
                            href="{{ route($item['route']) }}"
                            class="{{ $active ? 'bg-slate-800 text-white' : 'text-slate-400 hover:bg-slate-800/60 hover:text-white' }} relative flex items-center gap-2.5 rounded-lg px-2.5 py-2 text-[13px] font-medium transition-colors"
                            @if ($active) aria-current="page" @endif
                        >
                            @if ($active)
                                <span class="absolute top-1.5 bottom-1.5 left-0 w-0.5 rounded-full bg-red-500"></span>
                            @endif
                            <x-admin.icon :name="$item['icon']" class="h-[18px] w-[18px] shrink-0" />
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </nav>

                <div class="border-t border-slate-800 p-3">
                    <div class="mb-2 flex items-center gap-2.5 px-2.5">
                        <span class="flex h-7 w-7 items-center justify-center rounded-full bg-slate-700 text-xs font-semibold text-white">
                            {{ mb_strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}
                        </span>
                        <div class="min-w-0">
                            <p class="truncate text-[13px] font-medium text-white">{{ auth()->user()->name }}</p>
                            <p class="truncate text-[11px] text-slate-500">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="flex w-full items-center gap-2.5 rounded-lg px-2.5 py-2 text-[13px] font-medium text-slate-400 transition-colors hover:bg-red-500/10 hover:text-red-400">
                            <x-admin.icon name="logout" class="h-[18px] w-[18px]" />
                            Αποσύνδεση
                        </button>
                    </form>
                </div>
            </aside>

            <div class="flex min-w-0 flex-1 flex-col">
                <header class="sticky top-0 z-30 flex h-14 items-center gap-3 border-b border-slate-200 bg-white/95 px-4 backdrop-blur lg:hidden">
                    <button type="button" class="-ml-1.5 rounded-md p-1.5 text-slate-600 hover:bg-slate-100" onclick="toggleNav(true)" aria-label="Άνοιγμα μενού">
                        <x-admin.icon name="menu" />
                    </button>
                    <span class="truncate text-sm font-semibold text-slate-900">{{ $currentItem['label'] ?? 'EKO Admin' }}</span>
                    <img src="{{ asset('images/eko-logo.png') }}" class="ml-auto h-6 w-6 object-contain" alt="" />
                </header>

                <main class="mx-auto w-full max-w-7xl flex-1 px-4 py-5 sm:px-6 lg:px-8 lg:py-7">
                    @if (session('success'))
                        <div class="mb-4 flex items-start gap-2 rounded-lg border border-emerald-200 bg-emerald-50 px-3.5 py-2.5 text-[13px] font-medium text-emerald-800" role="status">
                            <x-admin.icon name="check-circle" class="mt-px h-4 w-4 shrink-0" />
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-4 flex items-start gap-2 rounded-lg border border-red-200 bg-red-50 px-3.5 py-2.5 text-[13px] font-medium text-red-800" role="alert">
                            <x-admin.icon name="alert" class="mt-px h-4 w-4 shrink-0" />
                            <div>
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @yield('admin_content')
                </main>
            </div>
        </div>

        <script>
            function toggleNav(open) {
                document.getElementById('sidebar').classList.toggle('-translate-x-full', !open)
                document.getElementById('navOverlay').classList.toggle('hidden', !open)
                document.body.style.overflow = open ? 'hidden' : ''
            }
            document.addEventListener('keydown', e => {
                if (e.key === 'Escape') toggleNav(false)
            })
        </script>
        @stack('scripts')
    </body>
</html>
