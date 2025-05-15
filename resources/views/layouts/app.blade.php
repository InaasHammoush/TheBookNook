<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <link rel="icon" type="image/png" href="{{ asset('logo.png') }}?v=2">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">

            <!-- Page Heading -->
            @include('layouts.navigation')

            <header class="flex items-center px-6 py-2 bg-white shadow">
                <!-- Header: Title -->
                <img src="{{ asset('images/LogoAndTitle.png') }}"
                     alt="The Book Nook Logo"
                     style="height: 140px; width: auto; margin-top: -10px; margin-bottom: -90px; margin-left: +30px">

                <!-- Searchbar -->
                <div class="flex-1 mx-6 flex justify-center">
                    <x-search />
                </div>

                <!-- New Thread Button -->
                @auth
                    <a href="{{ route('threads.create') }}"
                       class="ml-auto bg-emerald-500 hover:bg-emerald-600 text-white font-semibold px-5 py-2 rounded-full shadow transition-all duration-200">
                        + New Thread
                    </a>
                @endauth
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    @stack('scripts')
    </body>
</html>
