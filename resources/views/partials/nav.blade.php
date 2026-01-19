<header class="bg-[#e21838] px-4 py-3 shadow-sm">
    <div class="container mx-auto flex items-center justify-between">
        <!-- LOGO -->
        <div class="flex flex-1 items-center justify-center">
            <img src="{{ asset('images/eko-logo.png') }}" alt="EKO Logo" class="mr-4 h-20 w-auto" />
            <h1 class="text-4xl font-semibold text-white drop-shadow-md">ΕΚΟ</h1>
        </div>

        <!-- Hamburger  -->
        <input type="checkbox" id="menu-toggle" class="peer hidden" />
        <label for="menu-toggle" class="z-50 cursor-pointer lg:hidden">
            <!-- Hamburger Icon -->
            <div class="space-y-2">
                <span class="block h-0.5 w-8 bg-white"></span>
                <span class="block h-0.5 w-8 bg-white"></span>
                <span class="block h-0.5 w-8 bg-white"></span>
            </div>
        </label>

        <!-- Links -->
        <nav class="hidden items-center gap-8 lg:flex">
            <a href="#" class="text-xl font-medium text-white transition hover:text-gray-200">Contact</a>
            <a href="#" class="text-xl font-medium text-white transition hover:text-gray-200">Download</a>
        </nav>

        <!-- Mobile Menu  -->
        <div class="relative z-40 mt-4 hidden bg-[#e21838] shadow-lg peer-checked:block lg:hidden">
            <div class="flex flex-col items-center gap-6 py-6">
                <a href="#" class="text-xl font-medium text-white transition hover:text-gray-200">Contact</a>
                <a href="#" class="text-xl font-medium text-white transition hover:text-gray-200">Download</a>
            </div>
        </div>
    </div>
</header>
