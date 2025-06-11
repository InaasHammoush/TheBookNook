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

            <header class="fixed top-[56px] left-0 right-0 z-30 flex items-center px-6 py-2 bg-white shadow">
                <!-- Header: Title -->
                <img src="{{ asset('images/LogoForTitle.png') }}"
                     alt="The Book Nook Icon"
                     style="height: 50px; width: auto; margin-top: -10px; margin-bottom: -10px; margin-left: 30px; display: inline-block;">
                <img src="{{ asset('images/TextForTitle.png') }}"
                     alt="The Book Nook Text"
                     style="height: 50px; width: auto; margin-top: -10px; margin-bottom: -10px; display: inline-block;">

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

                @auth
                    <div x-data="{ open: false }" class="relative z-[9999]">
                        <!-- Trigger-Button -->
                        <button @click="open = !open"
                                class="fixed top-[12px] right-[200px] z-[9999] inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-white ">
                            {{ Auth::user()->name }}
                            <svg class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.178l3.71-3.946a.75.75 0 111.08 1.04l-4.25 4.52a.75.75 0 01-1.08 0l-4.25-4.52a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <!-- Dropdown-Panel -->
                        <div x-show="open"
                             @click.outside="open = false"
                             x-transition
                             class="fixed top-[55px] right-[200px] w-48 bg-white border rounded-md shadow-2xl z-[9999]">
                            <a href="{{ route('profile.edit') }}"
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth

            </header>

            <!-- Page Content -->
            <main class="pt-[100px]">
                {{ $slot }}
            </main>
        </div>
    @stack('scripts')
    </body>
</html>
