<header class="bg-[#e21838] py-3 px-4 shadow-sm">
    <div class="container mx-auto flex items-center justify-between">
       <!-- LOGO -->
        <div class="flex items-center justify-center flex-1">
            <img src="{{ asset('images/eko-logo.png') }}" 
                 alt="EKO Logo" 
                 class="h-20 w-auto mr-4">
            <h1 class="text-white font-semibold text-4xl drop-shadow-md" 
                >
                ΕΚΟ
            </h1>
        </div>

        <!-- Hamburger  -->
        <input type="checkbox" id="menu-toggle" class="hidden peer">
        <label for="menu-toggle" class="lg:hidden cursor-pointer z-50">
            <!-- Hamburger Icon -->
            <div class="space-y-2">
                <span class="block w-8 h-0.5 bg-white"></span>
                <span class="block w-8 h-0.5 bg-white"></span>
                <span class="block w-8 h-0.5 bg-white"></span>
            </div>
        </label>

        <!-- Links -->
        <nav class="hidden lg:flex items-center gap-8">
            <a href="#" class="text-white font-medium text-xl hover:text-gray-200 transition">
                Contact
            </a>
            <a href="#" class="text-white font-medium text-xl hover:text-gray-200 transition">
                Download
            </a>
        </nav>

        <!-- Mobile Menu  -->
        <div class="lg:hidden hidden peer-checked:block bg-[#e21838] shadow-lg z-40 relative mt-4">
            <div class="flex flex-col items-center gap-6 py-6">
                <a href="#" class="text-white font-medium text-xl hover:text-gray-200 transition">
                    Contact
                </a>
                <a href="#" class="text-white font-medium text-xl hover:text-gray-200 transition">
                    Download
                </a>
            </div>
        </div>
    </div>
</header>