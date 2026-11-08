<!DOCTYPE html>
<html lang="id">
<head>
    @php($seo = $page['props']['seo'] ?? null)
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $seo['judul'] ?? 'Pondok Pesantren Al-Anwar Pakijangan' }}</title>
    <meta name="description" content="{{ $seo['deskripsi'] ?? 'Pondok Pesantren Al-Anwar Pakijangan di Bulakamba, Brebes mengembangkan pendidikan salaf modern, Madrasah Diniyah, SMP, dan pembinaan karakter santri.' }}">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    @if($seo)
        <link rel="canonical" href="{{ $seo['canonical'] }}">
        <meta property="og:locale" content="id_ID">
        <meta property="og:type" content="{{ $seo['jenis'] ?? 'website' }}">
        <meta property="og:site_name" content="Pondok Pesantren Al-Anwar Pakijangan">
        <meta property="og:title" content="{{ $seo['judul'] }}">
        <meta property="og:description" content="{{ $seo['deskripsi'] }}">
        <meta property="og:url" content="{{ $seo['canonical'] }}">
        <meta property="og:image" content="{{ $seo['gambar'] }}">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $seo['judul'] }}">
        <meta name="twitter:description" content="{{ $seo['deskripsi'] }}">
        <meta name="twitter:image" content="{{ $seo['gambar'] }}">
        @foreach($seo['schema'] ?? [] as $skema)
            <script type="application/ld+json">{!! json_encode($skema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
        @endforeach
    @endif
    <link rel="icon" type="image/png" href="{{ asset('images/logo.webp') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.webp') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|newsreader:500,600,700" rel="stylesheet">
    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/public-app.jsx'])
    @inertiaHead
</head>
<body>
    <!--
    THESIS: Beranda institusi yang bekerja sebagai arsip hidup pesantren, bukan landing page promosi berkartu seragam.
    OWN-WORLD: Hijau hutan, gading hangat, tinta gelap, aksen kuningan, garis arsip, dan tipografi editorial.
    STORY: Pengunjung mengenali Al-Anwar, melihat agenda nyata, membaca terbitan, lalu menuju pendaftaran atau kontak.
    FIRST VIEWPORT: Nama dan posisi pesantren memimpin di bidang hijau, foto pesantren menjadi bukti utama, tindakan berada dekat identitas.
    FORM: Arsip editorial pesantren, kandidat ketujuh, seed 74d097c3.
    FINISH: unreviewed and undocumented is unfinished; this build ends with the finish review, the verdict, and DESIGN.md
    -->
    @inertia
</body>
</html>
