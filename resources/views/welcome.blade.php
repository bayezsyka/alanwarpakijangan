@extends('layouts.public')

@section('title', 'Pondok Pesantren Al-Anwar Pakijangan | Brebes')
@section('meta_description', 'Pondok Pesantren Al-Anwar Pakijangan di Bulakamba, Brebes mengembangkan pendidikan salaf modern, Madrasah Diniyah, SMP, dan pembinaan karakter santri.')
@section('meta_keywords', 'Pondok Pesantren Al-Anwar Pakijangan, Ponpes Al-Anwar Pakijangan, PP Al-Anwar Pakijangan, Al-Anwar Pakijangan, pesantren Pakijangan, pesantren Bulakamba, pesantren Brebes, pesantren salaf modern Brebes, SMP Al Anwar Pakijangan, Madrasah Diniyah Al-Anwar Pakijangan, KH Anwar Mukhtar, KH Muhammad Miftah')
@section('og_title', 'Pondok Pesantren Al-Anwar Pakijangan')
@section('og_description', 'Pesantren salaf modern di Pakijangan, Bulakamba, Brebes yang memadukan pendidikan agama, ilmu pengetahuan, dan pembinaan karakter santri.')
@section('canonical_url', \App\Support\SeoUrl::baseUrl() . '/')

@push('schema')
<script type="application/ld+json">
{!! json_encode(\App\Support\SeoUrl::websiteSchema(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endpush

@section('content')
    @include('welcome.hero')
    @include('welcome.rutinan')
    @include('welcome.artikel')
    @include('welcome.profil')
    @include('welcome.galeri')
    @include('welcome.announcement-modal')
@endsection