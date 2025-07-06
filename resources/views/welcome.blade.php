<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pondok Pesantren Al-Anwar Pakijangan</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
@include('layouts.nav')

{{-- Styles --}}
<body class="">

    @include('welcome.hero')
    @include('welcome.artikel')
    @include('welcome.profil')

    
    {{-- @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif --}}

    @include('layouts.footer')

</body>
</html>
