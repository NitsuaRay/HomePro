<nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <div class="shrink-0 flex items-center">
                    <a href="">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>
                <!-- Navigation Links (Hidden on Small Screens) -->
                <div class="hidden space-x-6 sm:-my-px sm:ml-6 sm:flex items-center sm:text-lg text-md">
                    <a href="#services" class=" hover:text-blue-900 hover:font-medium">Services Offered</a>
                    <a href="#contact" class=" hover:text-blue-900 hover:font-medium">Contact</a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @if (Route::has('login'))
                @auth
                <a href="{{ url('/dashboard') }}" class="font-semibold text-white bg-blue-900 hover:bg-blue-700 focus:outline focus:outline-2 rounded py-1 px-4 focus:rounded-sm focus:outline-blue-300">Home</a>
                @else
                <a href="{{ route('login') }}" class="font-semibold text-white bg-blue-900 hover:bg-blue-700 focus:outline focus:outline-2 rounded py-1 px-4 focus:rounded-sm focus:outline-blue-300">Log in</a>

                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="rounded py-1 px-4 bg-amber-700 ml-4 font-semibold text-white hover:bg-amber-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-amber-900">Register</a>
                @endif
                @endauth

                @endif
            </div>
            <!-- Hamburger (Visible on Small Screens) -->
            <div class="sm:hidden flex items-center">
                <button id="menu-toggle" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Hidden by Default) -->
    <div id="mobile-menu" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if (Route::has('login'))
            @auth
            <a href="{{ url('/dashboard') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium border-transparent text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white hover:border-gray-700 dark:hover:border-white">Home</a>
            @else
            <a href="{{ route('login') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium border-transparent text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white hover:border-gray-700 dark:hover:border-white">Log in</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium border-transparent text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white hover:border-gray-700 dark:hover:border-white">Register</a>
            @endif
            @endauth
            @endif
        </div>
    </div>
</nav>

<script>
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    menuToggle.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>