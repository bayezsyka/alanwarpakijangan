@extends('layouts.public')

@section('title', 'Informasi Pendaftaran - Pondok Pesantren Al-Anwar Pakijangan')

@section('content')
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-[#FDFDFC]">
        <div class="max-w-4xl mx-auto">
            <!-- Header Section -->
            <div class="text-center mb-16">
                <span class="text-[#008362] font-bold tracking-widest uppercase text-sm block mb-2">Penerimaan Santri
                    Baru</span>
                <h1 class="text-4xl md:text-5xl font-extrabold text-[#1b1b18] mb-6">Informasi Pendaftaran</h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                    Pendaftaran santri baru Pondok Pesantren Al-Anwar Pakijangan dilakukan secara langsung (offline) di
                    sekretariat pendaftaran kami.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <!-- Persyaratan Section -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center mb-6 text-[#008362]">
                        <i class="fas fa-file-alt text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Persyaratan Dokumen</h2>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-start">
                            <span class="text-[#008362] mr-3 mt-1"><i class="fas fa-check-circle"></i></span>
                            <span>Fotokopi Kartu Keluarga (KK) - 2 Lembar</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-[#008362] mr-3 mt-1"><i class="fas fa-check-circle"></i></span>
                            <span>Fotokopi Akta Kelahiran - 2 Lembar</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-[#008362] mr-3 mt-1"><i class="fas fa-check-circle"></i></span>
                            <span>Fotokopi Ijazah Terakhir (Jika ada) - 2 Lembar</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-[#008362] mr-3 mt-1"><i class="fas fa-check-circle"></i></span>
                            <span>Pas Foto Background Merah (3x4 & 4x6) - masing-masing 4 Lembar</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-[#008362] mr-3 mt-1"><i class="fas fa-check-circle"></i></span>
                            <span>Mengisi formulir pendaftaran di tempat</span>
                        </li>
                    </ul>
                </div>

                <!-- Lokasi & Waktu Section -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center mb-6 text-blue-600">
                        <i class="fas fa-map-marker-alt text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Tempat & Waktu</h2>
                    <div class="space-y-4 text-gray-600">
                        <div>
                            <h4 class="font-semibold text-gray-900">Lokasi Sekretariat:</h4>
                            <p>Kantor Pusat Pondok Pesantren Al-Anwar, Pakijangan, Pasuruan.</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Jam Operasional:</h4>
                            <p>Setiap Hari: 08.00 - 16.00 WIB</p>
                            <p class="text-sm italic font-medium mt-1 text-red-500">* Istirahat pada waktu shalat</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alur Pendaftaran Section -->
            <div class="bg-[#1b1b18] text-white p-10 rounded-3xl mb-12 shadow-xl relative overflow-hidden">
                <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white opacity-5 rounded-full"></div>
                <h2 class="text-3xl font-bold mb-8 text-center">Alur Pendaftaran Offline</h2>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 relative z-10">
                    <div class="text-center">
                        <div class="text-4xl font-black opacity-20 mb-2">01</div>
                        <h3 class="font-bold text-lg mb-2">Datang Ke Lokasi</h3>
                        <p class="text-sm text-gray-400">Kunjungi sekretariat pendaftaran dengan membawa dokumen
                            persyaratan.</p>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-black opacity-20 mb-2">02</div>
                        <h3 class="font-bold text-lg mb-2">Isi Formulir</h3>
                        <p class="text-sm text-gray-400">Petugas pendaftaran akan memberikan dan memandu pengisian formulir
                            fisik.</p>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-black opacity-20 mb-2">03</div>
                        <h3 class="font-bold text-lg mb-2">Verifikasi & Tes</h3>
                        <p class="text-sm text-gray-400">Penyerahan berkas, verifikasi data, dan mengikuti sesi
                            wawancara/tes awal.</p>
                    </div>
                </div>
            </div>

            <!-- Contact Section -->
            <div class="text-center bg-green-50 p-8 rounded-2xl border border-green-100">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Butuh Bantuan atau Informasi Lebih Lanjut?</h3>
                <p class="text-gray-600 mb-6">Hubungi layanan bantuan pendaftaran kami melalui WhatsApp untuk respon lebih
                    cepat.</p>
                <a href="https://wa.me/6281234567890" target="_blank"
                    class="inline-flex items-center justify-center px-8 py-4 bg-[#008362] text-white font-bold rounded-full hover:bg-[#006b50] transition-all transform hover:scale-105 shadow-lg group">
                    <i class="fab fa-whatsapp mr-3 text-2xl"></i>
                    Hubungi Panitia Pendaftaran
                    <i class="fas fa-arrow-right ml-3 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>
    </section>
@endsection
