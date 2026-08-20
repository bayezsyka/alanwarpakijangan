@extends('layouts.public')

@section('title', 'Artikel | Pondok Pesantren Al-Anwar Pakijangan')
@section('meta_description', 'Artikel Pondok Pesantren Al-Anwar Pakijangan tentang pendidikan pesantren, santri, keislaman, karakter, ilmu pengetahuan, dan kegiatan Al-Anwar.')
@section('meta_keywords', 'artikel pesantren, pendidikan santri, artikel Islam Brebes, pemikiran santri, kegiatan Al-Anwar, teknologi pesantren, Pondok Pesantren Al-Anwar Pakijangan')
@section('og_title', 'Artikel Al-Anwar Pakijangan')
@section('og_description', 'Baca artikel, pemikiran, pendidikan, kegiatan santri, dan informasi terbaru Pondok Pesantren Al-Anwar Pakijangan.')
@section('canonical_url', \App\Support\SeoUrl::url('artikel'))

@push('schema')
@php
    $breadcrumbs = \App\Support\SeoUrl::breadcrumbSchema([
        ['name' => 'Beranda', 'url' => \App\Support\SeoUrl::baseUrl() . '/'],
        ['name' => 'Artikel', 'url' => \App\Support\SeoUrl::url('artikel')],
    ]);
@endphp
<script type="application/ld+json">
{!! json_encode($breadcrumbs, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endpush

@section('content')
<section class="section bg-surface-alt !pt-20 lg:!pt-24">
    @livewire('search-artikel-tamu')
</section>
@endsection
