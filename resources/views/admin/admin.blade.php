<!DOCTYPE html>
<html lang="el">
    <head>
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/eko-logo.png') }}" />
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
                        <img src="{{ asset('images/eko-logo.png') }}" class="mb-8 h-10 object-contain" />
                    </a>

                    <nav class="space-y-2">
                        <div class="mb-6 px-2">
                            <form action="{{ route('admin.search') }}" method="GET">
                                <div class="relative">
                                    <input
                                        type="text"
                                        name="query"
                                        placeholder="Αναζήτηση..."
                                        class="w-full rounded-xl border-none bg-slate-800 py-2.5 pr-4 pl-10 text-sm text-white placeholder-slate-500 transition-all focus:ring-2 focus:ring-red-500"
                                    />
                                    <span class="absolute top-3 left-3 text-slate-500">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="2"
                                            stroke="currentColor"
                                            class="h-4 w-4"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607Z"
                                            />
                                        </svg>
                                    </span>
                                </div>
                            </form>
                        </div>

                        <a
                            href="{{ route('admin.dashboard') }}"
                            class="{{ request()->routeIs('admin.dashboard') ? 'bg-red-600 text-white shadow-lg shadow-red-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-bold transition-all"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                class="h-5 w-5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"
                                />
                            </svg>
                            Ραντεβού
                        </a>
                        <a
                            href="{{ route('admin.comments.index') }}"
                            class="{{ request()->routeIs('admin.comments.*') ? 'bg-red-600 text-white shadow-lg shadow-red-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-bold transition-all"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                class="h-5 w-5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M7.5 8.25h9m-9 3h9m-9 3h3m-6.75 4.125l-.375 3.75 3.75-.375 1.5-1.5H21a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0021 4.5H3.375A2.25 2.25 0 001.125 6.75v10.5a2.25 2.25 0 002.25 2.25h1.5l1.5 1.5z"
                                />
                            </svg>
                            Σημειώσεις (Chat)
                        </a>

                        <a
                            href="{{ route('admin.stats') }}"
                            class="{{ request()->routeIs('admin.stats') ? 'bg-red-600 text-white shadow-lg shadow-red-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-bold transition-all"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                class="h-5 w-5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0h-10.5"
                                />
                            </svg>
                            Στατιστικά
                        </a>

                        <a
                            href="{{ route('admin.schedules.index') }}"
                            class="{{ request()->routeIs('admin.schedules.*') ? 'bg-red-600 text-white shadow-lg shadow-red-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-bold transition-all"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                class="h-5 w-5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"
                                />
                            </svg>
                            Ώρες Πλυντηρίου
                        </a>

                        <a
                            href="{{ route('admin.products.index') }}"
                            class="{{ request()->routeIs('admin.products.*') ? 'bg-red-600 text-white shadow-lg shadow-red-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-bold transition-all"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                class="h-5 w-5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9"
                                />
                            </svg>
                            Προϊόντα
                        </a>

                        <hr class="my-6 border-slate-800" />

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button
                                type="submit"
                                class="group flex w-full items-center gap-3 rounded-xl px-4 py-3 text-sm font-bold text-slate-400 transition-all hover:bg-red-500/10 hover:text-red-500"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                    stroke="currentColor"
                                    class="h-5 w-5 transition-transform group-hover:translate-x-1"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75"
                                    />
                                </svg>
                                Αποσύνδεση
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
