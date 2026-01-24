<!DOCTYPE html>
<html lang="el">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Admin Panel - EKO</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-slate-100 antialiased">
        <div class="flex min-h-screen">
            <aside class="sticky top-0 hidden h-screen w-64 flex-shrink-0 flex-col bg-slate-900 text-white md:flex">
                <div class="flex-1 p-6">
                    <a href="/">
                        <img src="{{ asset('images/eko-logo.png') }}" class="mb-8 h-10" />
                    </a>
                    <nav class="space-y-4">
                        <div class="mb-6 px-4">
                            <form action="{{ route('admin.search') }}" method="GET">
                                <div class="relative">
                                    <input
                                        type="text"
                                        name="query"
                                        placeholder="Αναζήτηση"
                                        class="w-full rounded-xl border-none bg-slate-800 py-2 pr-4 pl-10 text-sm text-white focus:ring-2 focus:ring-red-500"
                                    />
                                    <span class="absolute top-2.5 left-3 opacity-50">🔍</span>
                                </div>
                            </form>
                        </div>
                        <a
                            href="{{ route('admin.dashboard') }}"
                            class="{{ request()->routeIs('admin.dashboard') ? 'bg-red-600' : '' }} block rounded-lg px-4 py-2 hover:bg-slate-800"
                        >
                            📅 Ραντεβού
                        </a>
                        <a
                            href="{{ route('admin.stats') }}"
                            class="{{ request()->routeIs('admin.stats') ? 'bg-red-600' : '' }} block rounded-lg px-4 py-2 hover:bg-slate-800"
                        >
                            📊 Στατιστικά
                        </a>
                        <a
                            href="{{ route('admin.products.index') }}"
                            class="{{ request()->routeIs('admin.products.*') ? 'bg-red-600 text-white shadow-lg shadow-red-500/30' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} flex items-center gap-3 px-6 py-4 transition-all"
                        >
                            <span class="text-xl">📦</span>
                            <span class="text-sm font-bold tracking-wider uppercase">Προϊόντα</span>
                        </a>
                        <hr class="my-4 border-slate-700" />
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button
                                type="submit"
                                class="w-full rounded-lg px-4 py-2 text-left text-slate-400 hover:bg-slate-800 hover:text-white"
                            >
                                🚪 Αποσύνδεση
                            </button>
                        </form>
                    </nav>
                </div>
            </aside>

            <div class="flex min-w-0 flex-1 flex-col">
                <main class="flex-1 p-8">
                    @yield('admin_content')
                </main>
            </div>
        </div>
    </body>
</html>
