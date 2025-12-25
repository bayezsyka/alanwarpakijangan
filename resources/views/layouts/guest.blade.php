{{-- <!DOCTYPE html>
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
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html> --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Login | Admin Al-Anwar</title>
        <link rel="icon" href="{{ asset('images/logo.webp') }}" type="image/webp">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div
            class="min-h-screen flex items-center justify-center bg-no-repeat bg-cover bg-center relative"
            style="background-image: linear-gradient(rgba(0, 131, 98, 0.4), rgba(0, 131, 98, 0.4)), url('{{ asset('images/landingpage/bgppdb.png') }}');"
        >
            <div class="w-full max-w-5xl flex flex-col md:flex-row items-center justify-center p-10">
                <!-- Logo & Text -->
                <div class="text-white md:w-1/2 w-full flex flex-col items-center justify-center text-center px-6 mb-10 md:mb-0">
                    <a href="/">
                        <img src="{{ asset('images/logo.webp') }}" alt="Logo" class="h-32 mb-4">
                    </a>
                    <h1 class="text-2xl md:text-3xl font-bold leading-tight">
                        Pondok Pesantren <br> Al-Anwar Pakijangan
                    </h1>
                </div>

                <!-- Form -->
                <div class="bg-white p-8 md:w-1/2 w-full shadow-lg rounded-lg">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
