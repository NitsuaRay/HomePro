<header class="fixed top-0 left-0 right-0 z-50 bg-white text-gray-600 body-font border-b">
    <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
        <a href="#home" class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
            <img src="{{ asset('backend/assets/images/logo.png') }}" alt="" class="w-8 h-8">
            <h2 class="ml-3 text-xl text-primary font-bold">Home<span class="text-secondary">Pro</span></h2>
        </a>

        <nav class="md:mr-auto md:ml-4 md:py-1 md:pl-4 md:border-l md:border-gray-400 flex flex-wrap items-center text-lg justify-center">
            <a href="#home" class="mr-5 hover:text-primary hover:font-medium">Home</a>
            <a href="#services" class="mr-5 hover:text-primary  hover:font-medium">Services</a>
            <a href="#contact" class="mr-5 hover:text-primary hover:font-medium">Contact</a>
        </nav>
        @if(Route::has('login'))
        @auth
        <button class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0" style="margin-right: 1rem;">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </button>
        @else
        <button class="inline-flex items-center bg-primary border-0 py-1 px-3 focus:outline-none hover:bg-primary-half rounded text-white hover:text-base mt-4 md:mt-0" style="margin-right: 1rem;">
            <a href="{{ route('login') }}">Login</a>
        </button>
        @if(Route::has('register'))
        <button class="inline-flex items-center bg-secondary border-0 py-1 px-3 focus:outline-none hover:bg-secondary-half rounded text-white hover:text-base mt-4 md:mt-0" style="margin-right: 1rem;">
            <a href="{{ route('register') }}">Register</a>
        </button>
        @endif
        @endauth
        @endif
    </div>
</header>