<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Artikel - Pesantren Al-Anwar</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
</head>
@include('layouts.nav')
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] min-h-screen flex flex-col">
    <main class="flex-grow">
        <section class="py-8 sm:py-12 px-4 sm:px-6 lg:px-8 bg-gray-50 pt-24 pb-16">
            <div class="container mx-auto max-w-7xl">
                
                @livewire('search-artikel-tamu')

            </div>
        </section>
    </main>
    @include('layouts.footer')
    @livewireScripts
</body>
</html>