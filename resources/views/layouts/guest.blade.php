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
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-r from-[#F8F7FF] to-[#B8B8FF] ">
            <div>
                <a href="/">
                    <h1 class="text-gray-700 text-2xl flex items-center justify-center mb-3">Bug Tracker</h1>
                </a>
                <h3 class="text-gray-500 text-lg flex items-center justify-center mb-4">
                    @if( Route::currentRouteName() == 'login' )
                        Login
                    @elseif( Route::currentRouteName() == 'register' ) 
                        Sign Up
                    @elseif( Str::of(Route::currentRouteName())->startsWith('password.') )
                        Password Reset
                    @elseif( Str::of(Route::currentRouteName())->startsWith('verification.') )
                    @endif
                </h3>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
