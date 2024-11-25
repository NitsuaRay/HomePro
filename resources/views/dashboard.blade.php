<x-app-layout>
    @if (Auth::user()->isVerified == 'Verified')
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-white dark:text-white leading-tight ml-8">
                {{ __('Home') }}
            </h2>
            <div class="ml-4 sm:flex hidden">
                <span class="text-white"> | </span>
                <a href="#services" class="text-white ml-4 hover:text-amber-700">Our Services</a>
                <a href="#contact" class="text-white ml-4 hover:text-amber-700">Contact</a>
            </div>
        </x-slot>
        @if (Session::has('success'))
            <div id="toast-success"
                class="absolute top-10 right-0 flex items-center w-full max-w-md p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
                role="alert">
                <div
                    class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                    </svg>
                    <span class="sr-only">Check icon</span>
                </div>
                <div class="ms-3 text-sm font-normal">{{ session::get('success') }}</div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                    data-dismiss-target="#toast-success" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif
        @if (Session::has('error'))
            <div id="toast-error"
                class="absolute top-10 right-0 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
                role="alert">
                <div
                    class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-green-200">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                    </svg>
                    <span class="sr-only">Check icon</span>
                </div>
                <div class="ms-3 text-sm font-normal">{{ session::get('error') }}</div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                    data-dismiss-target="#toast-error" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif
        <section class="body-font flex-grow">
            <div class="container mx-auto flex md:px-24 md:py-12 px-4 py-4 md:flex-row flex-col items-center">
                <div
                    class="lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
                    <h1 class="sm:text-4xl text-5xl text-dark lg:text-6xl mb-4 font-bold">Welcome To</h1>
                    <h2 class="mb-7 text-4xl lg:text-5xl sm:text-2xl font-bold text-blue-900">Home<span
                            class="text-amber-700">Pro</span></h2>
                    <p class="mb-8 leading-relaxed text-base italic font-bold">"Discover reliable home service pros with
                        ease on our platform,<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Simplify your search
                        and
                        get your home needs sorted hassle-free!"</p>
                    <div class="flex justify-center">
                        <button
                            class="inline-flex text-white bg-blue-900 border-0 py-2 px-6 focus:outline-none hover:bg-amber-700 rounded text-sm md:text-lg"><a
                                href="{{ route('available.personnel') }}">Book Now</a></button>
                    </div>
                </div>
                <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6 hover:animate-pulse">
                    <img class="object-cover object-center rounded" alt="hero"
                        src="{{ asset('backend/assets/images/landing.png') }}">
                </div>
            </div>
        </section>

        @include('layouts.partials.services')
        @include('layouts.partials.contactUs')
        @include('layouts.partials.footer')
    @else
        <p class="px-4 py-2 bg-red-500 text-white text-center">Please update your profile image to verify your account.
            Click the Update Profile
            Image button at the top-right.</p>
    @endif
</x-app-layout>
