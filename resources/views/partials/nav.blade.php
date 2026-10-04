@php
    $links = [
        ['url' => url('/'), 'label' => 'Αρχική', 'active' => request()->is('/')],
        ['url' => route('stations.show'), 'label' => 'Πρατήρια', 'active' => request()->is('contact') || request()->is('station/*') && ! request()->is('station/*/products')],
        ['url' => url('/services'), 'label' => 'Υπηρεσίες', 'active' => request()->is('services')],
        ['url' => route('station.products', 1), 'label' => 'Προϊόντα', 'active' => request()->is('station/*/products')],
        ['url' => url('/infoGeneration'), 'label' => 'Η εταιρεία', 'active' => request()->is('infoGeneration')],
    ];
@endphp

<header class="sticky top-0 z-50 w-full border-b border-slate-200 bg-white">
    <div class="mx-auto flex h-16 max-w-6xl items-center justify-between gap-4 px-4 md:px-6">
        <a href="{{ url('/') }}" class="flex shrink-0 items-center gap-2.5" aria-label="ΕΚΟ Δράμη - Αρχική">
            <img src="{{ asset('images/opt/eko-logo-96.png') }}" alt="EKO" width="40" height="36" class="h-9 w-auto" />
            <span class="text-lg leading-none font-black tracking-tight text-[#e21838] uppercase italic">ΕΚΟ ΔΡΑΜΗ</span>
        </a>

        <nav class="hidden items-center gap-6 lg:flex" aria-label="Κύριο μενού">
            @foreach ($links as $link)
                <a
                    href="{{ $link['url'] }}"
                    class="{{ $link['active'] ? 'text-[#e21838]' : 'text-slate-600 hover:text-slate-900' }} text-sm font-semibold"
                    @if ($link['active']) aria-current="page" @endif
                >
                    {{ $link['label'] }}
                </a>
            @endforeach
        </nav>

        <div class="hidden items-center gap-4 lg:flex">
            @auth
                <a href="{{ route('admin.dashboard') }}" class="text-sm font-semibold text-slate-600 hover:text-slate-900">Διαχείριση</a>
            @else
                <a href="tel:2410283954" class="text-sm font-semibold text-slate-600 hover:text-slate-900">2410 283954</a>
            @endauth
            <a href="{{ route('pages.booking') }}" class="rounded-lg bg-[#e21838] px-4 py-2 text-sm font-bold text-white hover:bg-[#c4142f]">
                Ραντεβού πλυντηρίου
            </a>
        </div>

        <button
            type="button"
            id="mobileMenuButton"
            class="-mr-2 rounded-md p-2 text-slate-700 hover:bg-slate-100 lg:hidden"
            aria-controls="mobileMenu"
            aria-expanded="false"
            aria-label="Μενού"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <div id="mobileMenu" class="hidden border-t border-slate-200 bg-white lg:hidden">
        <nav class="mx-auto max-w-6xl space-y-1 px-4 py-3" aria-label="Μενού κινητού">
            @foreach ($links as $link)
                <a
                    href="{{ $link['url'] }}"
                    class="{{ $link['active'] ? 'bg-red-50 text-[#e21838]' : 'text-slate-700 hover:bg-slate-50' }} block rounded-md px-3 py-2 text-[15px] font-semibold"
                >
                    {{ $link['label'] }}
                </a>
            @endforeach
            @auth
                <a href="{{ route('admin.dashboard') }}" class="block rounded-md px-3 py-2 text-[15px] font-semibold text-slate-700 hover:bg-slate-50">Διαχείριση</a>
            @endauth
            <div class="grid grid-cols-2 gap-2 pt-2">
                <a href="tel:2410283954" class="rounded-lg border border-slate-200 px-3 py-2.5 text-center text-sm font-bold text-slate-700">Κλήση</a>
                <a href="{{ route('pages.booking') }}" class="rounded-lg bg-[#e21838] px-3 py-2.5 text-center text-sm font-bold text-white">Ραντεβού</a>
            </div>
        </nav>
    </div>
</header>

<script>
    document.getElementById('mobileMenuButton').addEventListener('click', function () {
        const menu = document.getElementById('mobileMenu')
        const open = menu.classList.toggle('hidden') === false
        this.setAttribute('aria-expanded', open)
    })
</script>
