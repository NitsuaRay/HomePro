<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="shortcut icon" href="{{ asset('backend/assets/images/logo.png') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite('resources/css/app.css')
</head>

<body class="antialiased">

    @include('layouts.navigationLanding')

    <section class="body-font flex-grow">
        <div class="container mx-auto flex md:px-24 md:py-12 px-4 py-4 md:flex-row flex-col items-center">
            <div
                class="lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
                <h1 class="sm:text-4xl text-5xl text-dark lg:text-6xl mb-4 font-bold">Welcome To</h1>
                <h2 class="mb-7 text-4xl lg:text-5xl sm:text-2xl font-bold text-blue-900">Home<span
                        class="text-amber-700">Pro</span></h2>
                <p class="mb-8 leading-relaxed text-base italic font-bold">"Discover reliable home service pros with
                    ease on our platform,<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Simplify your search and
                    get your home needs sorted hassle-free!"</p>
                <div class="flex justify-center">
                    <button
                        class="inline-flex text-white bg-blue-900 border-0 py-2 px-6 focus:outline-none hover:bg-amber-700 rounded text-sm md:text-lg"><a
                            href="{{ route('available.personnel') }}">Book Now</a></button>
                </div>
            </div>
            <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6">
                <img class="object-cover object-center rounded" alt="hero"
                    src="{{ asset('backend/assets/images/landing.png') }}">
            </div>
        </div>
    </section>

    @include('layouts.partials.services')
    @include('layouts.partials.contactUs')
    @include('layouts.partials.footer')
</body>

</html>
