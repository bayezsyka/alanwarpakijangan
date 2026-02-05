@extends('layouts.public')

@section('title', 'Informasi Pendaftaran - Pondok Pesantren Al-Anwar Pakijangan')

@section('content')
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-[#FDFDFC]">
        <div class="max-w-5xl mx-auto">
            <!-- Header Section -->
            <div class="text-center mb-16">
                <span class="text-[#008362] font-bold tracking-widest uppercase text-sm block mb-2">Penerimaan Santri
                    Baru</span>
                <h1 class="text-4xl md:text-5xl font-extrabold text-[#1b1b18] mb-4">Informasi Pendaftaran</h1>
                <p class="text-xl font-semibold text-[#008362]">Pondok Pesantren Al Anwar Pakijangan</p>
                <p class="text-gray-500 mt-2 font-medium">Tahun Ajaran 2026/2027 M (1447/1448 H)</p>
            </div>

            <!-- Program Unggulan Section -->
            <div class="bg-[#1b1b18] text-white p-8 rounded-2xl shadow-xl mb-12 relative overflow-hidden group">
                <div
                    class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-bl-full -mr-8 -mt-8 transition-transform group-hover:scale-110">
                </div>
                <div class="flex items-center mb-8 relative z-10">
                    <div
                        class="w-10 h-10 bg-white/10 text-white rounded-lg flex items-center justify-center mr-4 backdrop-blur-sm">
                        <i class="fas fa-star text-lg text-yellow-400"></i>
                    </div>
                    <h2 class="text-2xl font-bold">Program Unggulan</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 relative z-10">
                    <div
                        class="flex items-center p-3 rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 transition-colors">
                        <i class="fas fa-book-reader text-[#008362] mr-3"></i>
                        <span class="font-medium">Kitab</span>
                    </div>
                    <div
                        class="flex items-center p-3 rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 transition-colors">
                        <i class="fas fa-quran text-[#008362] mr-3"></i>
                        <span class="font-medium">Tahfidz</span>
                    </div>
                    <div
                        class="flex items-center p-3 rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 transition-colors">
                        <i class="fas fa-robot text-[#008362] mr-3"></i>
                        <span class="font-medium">Robotik</span>
                    </div>
                    <div
                        class="flex items-center p-3 rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 transition-colors">
                        <i class="fas fa-microscope text-[#008362] mr-3"></i>
                        <span class="font-medium">Sains Club</span>
                    </div>
                    <div
                        class="flex items-center p-3 rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 transition-colors">
                        <i class="fas fa-language text-[#008362] mr-3"></i>
                        <span class="font-medium">English Club</span>
                    </div>
                    <div
                        class="flex items-center p-3 rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 transition-colors">
                        <i class="fas fa-mosque text-[#008362] mr-3"></i>
                        <span class="font-medium">Arab Club</span>
                    </div>
                    <div
                        class="flex items-center p-3 rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 transition-colors">
                        <i class="fas fa-star text-[#008362] mr-3"></i>
                        <span class="font-medium">Hafalan Surat Pilihan</span>
                    </div>
                    <div
                        class="flex items-center p-3 rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 transition-colors">
                        <i class="fas fa-pen-nib text-[#008362] mr-3"></i>
                        <span class="font-medium">Jurnalistik</span>
                    </div>
                </div>
            </div>

            <!-- Important Policy Note -->
            <div class="mb-12 p-6 bg-blue-50 border-l-8 border-blue-500 rounded-r-2xl shadow-sm">
                <div class="flex items-start">
                    <div class="flex-shrink-0 mt-1">
                        <i class="fas fa-info-circle text-blue-600 text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-bold text-blue-900 mb-1">Informasi Penting (Wajib):</h3>
                        <p class="text-blue-800 leading-relaxed">
                            Calon siswa <span class="font-bold underline">SMP Al-Anwar wajib mondok</span> di Pondok
                            Pesantren Al-Anwar, dan santri Al-Anwar yang mengikuti sekolah formal <span
                                class="font-bold underline">wajib bersekolah di SMP Al-Anwar</span>.
                        </p>
                    </div>
                </div>
            </div>

            <!-- 1. Persyaratan Section -->
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 mb-12">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 bg-green-100 text-[#008362] rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-file-contract text-lg"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">1. Persyaratan Administrasi</h2>
                </div>
                <p class="text-gray-600 mb-6">Calon santri wajib melengkapi berkas pendaftaran sebagai berikut :</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <span class="text-[#008362] mr-3 mt-1"><i class="fas fa-check-circle"></i></span>
                            <span class="text-gray-700">Fotokopi Kartu Keluarga (4 Lembar)</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-[#008362] mr-3 mt-1"><i class="fas fa-check-circle"></i></span>
                            <span class="text-gray-700">Fotokopi Akte Kelahiran (4 Lembar)</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-[#008362] mr-3 mt-1"><i class="fas fa-check-circle"></i></span>
                            <span class="text-gray-700">Fotokopi Ijazah Formal/SKL (4 Lembar)</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-[#008362] mr-3 mt-1"><i class="fas fa-check-circle"></i></span>
                            <span class="text-gray-700">Fotokopi Ijazah Madin (4 Lembar)</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-[#008362] mr-3 mt-1"><i class="fas fa-check-circle"></i></span>
                            <span class="text-gray-700">Fotokopi SKHU/SKNR (4 Lembar)</span>
                        </li>
                    </ul>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <span class="text-[#008362] mr-3 mt-1"><i class="fas fa-check-circle"></i></span>
                            <span class="text-gray-700">Fotokopi NISN (4 Lembar)</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-[#008362] mr-3 mt-1"><i class="fas fa-check-circle"></i></span>
                            <span class="text-gray-700">Fotokopi KIP (4 Lembar) - <span class="italic text-sm">jika
                                    ada</span></span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-[#008362] mr-3 mt-1"><i class="fas fa-check-circle"></i></span>
                            <span class="text-gray-700">Fotokopi KTP Orang Tua (4 Lembar)</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-[#008362] mr-3 mt-1"><i class="fas fa-check-circle"></i></span>
                            <span class="text-gray-700">Pas Foto 3x2 (2 Lembar)</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-[#008362] mr-3 mt-1"><i class="fas fa-check-circle"></i></span>
                            <span class="text-gray-700">Pas Foto 3x4 (4 Lembar)</span>
                        </li>
                    </ul>
                </div>
                <div class="mt-8 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg">
                    <p class="text-red-700 text-sm">
                        <span class="font-bold">Catatan Foto:</span> Foto terbaru harus menggunakan <span
                            class="font-bold underline">background merah</span> dan mengenakan <span
                            class="font-bold underline">seragam putih</span>.
                    </p>
                </div>
            </div>

            <!-- 2. Pilihan Paket Section -->
            <div class="mb-12">
                <div class="flex items-center mb-8">
                    <div class="w-10 h-10 bg-green-100 text-[#008362] rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-layer-group text-lg"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">2. Pilihan Paket & Rincian Biaya</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Paket A -->
                    <div
                        class="bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 flex flex-col h-full border-t-8 border-t-[#008362]">
                        <div class="p-8 pb-0">
                            <h3 class="text-2xl font-black text-gray-900 mb-2">PAKET A</h3>
                            <p class="text-[#008362] font-bold text-lg mb-6 leading-tight">Mondok + SMP</p>
                            <div class="bg-gray-50 p-4 rounded-xl mb-6">
                                <span class="text-sm text-gray-500 block uppercase tracking-wider font-bold">Total Biaya
                                    Awal</span>
                                <span class="text-3xl font-black text-[#008362]">Rp 4.235.000</span>
                            </div>
                        </div>
                        <div class="p-8 pt-0 flex-grow">
                            <h4 class="font-bold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-list-ul mr-2 text-xs"></i> Rincian Biaya Awal:
                            </h4>
                            <ul class="space-y-3 text-sm text-gray-600 border-b border-gray-100 pb-6 mb-6">
                                <li class="flex justify-between"><span>Pendaftaran</span> <span
                                        class="font-semibold text-gray-900">Rp 150.000</span></li>
                                <li class="flex justify-between"><span>Uang Gedung</span> <span
                                        class="font-semibold text-gray-900">Rp 2.000.000</span></li>
                                <li class="flex justify-between"><span>Seragam & Perlengkapan Pesantren</span> <span
                                        class="font-semibold text-gray-900">Rp 410.000</span></li>
                                <li class="flex justify-between"><span>Seragam & Perlengkapan SMP</span> <span
                                        class="font-semibold text-gray-900">Rp 600.000</span></li>
                                <li class="flex justify-between"><span>Biaya Makan & Syahriyah</span> <span
                                        class="font-semibold text-gray-900">Rp 650.000</span></li>
                                <li class="flex justify-between"><span>Infaq Kegiatan</span> <span
                                        class="font-semibold text-gray-900">Rp 100.000</span></li>
                                <li class="flex justify-between"><span>Loker</span> <span
                                        class="font-semibold text-gray-900">Rp 325.000</span></li>
                            </ul>
                            <h4 class="font-bold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-sync-alt mr-2 text-xs"></i> Biaya Lanjutan (Rutin/Berkala):
                            </h4>
                            <ul class="space-y-3 text-sm text-gray-600">
                                <li class="flex justify-between"><span>Biaya Bulanan (SPP)</span> <span
                                        class="font-semibold text-gray-900">Rp 650.000</span></li>
                                <li class="flex justify-between"><span>Daftar Ulang Pesantren (Tahunan)</span> <span
                                        class="font-semibold text-gray-900">Rp 300.000</span></li>
                                <li class="flex justify-between"><span>Biaya Semesteran</span> <span
                                        class="font-semibold text-gray-900">Rp 500.000</span></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Paket B -->
                    <div
                        class="bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 flex flex-col h-full border-t-8 border-t-gray-800">
                        <div class="p-8 pb-0">
                            <h3 class="text-2xl font-black text-gray-900 mb-2">PAKET B</h3>
                            <p class="text-gray-500 font-bold text-lg mb-6 leading-tight">Mondok Saja</p>
                            <div class="bg-gray-50 p-4 rounded-xl mb-6">
                                <span class="text-sm text-gray-500 block uppercase tracking-wider font-bold">Total Biaya
                                    Awal</span>
                                <span class="text-3xl font-black text-gray-800">Rp 2.485.000</span>
                            </div>
                        </div>
                        <div class="p-8 pt-0 flex-grow">
                            <h4 class="font-bold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-list-ul mr-2 text-xs"></i> Rincian Biaya Awal:
                            </h4>
                            <ul class="space-y-3 text-sm text-gray-600 border-b border-gray-100 pb-6 mb-6">
                                <li class="flex justify-between"><span>Pendaftaran</span> <span
                                        class="font-semibold text-gray-900">Rp 150.000</span></li>
                                <li class="flex justify-between"><span>Uang Gedung</span> <span
                                        class="font-semibold text-gray-900">Rp 1.000.000</span></li>
                                <li class="flex justify-between"><span>Seragam & Perlengkapan Pesantren</span> <span
                                        class="font-semibold text-gray-900">Rp 410.000</span></li>
                                <li class="flex justify-between"><span>Biaya Makan & Syahriyah</span> <span
                                        class="font-semibold text-gray-900">Rp 500.000</span></li>
                                <li class="flex justify-between"><span>Infaq Kegiatan</span> <span
                                        class="font-semibold text-gray-900">Rp 100.000</span></li>
                                <li class="flex justify-between"><span>Loker</span> <span
                                        class="font-semibold text-gray-900">Rp 325.000</span></li>
                            </ul>
                            <h4 class="font-bold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-sync-alt mr-2 text-xs"></i> Biaya Lanjutan (Rutin/Berkala):
                            </h4>
                            <ul class="space-y-3 text-sm text-gray-600">
                                <li class="flex justify-between"><span>Biaya Bulanan (SPP)</span> <span
                                        class="font-semibold text-gray-900">Rp 500.000</span></li>
                                <li class="flex justify-between"><span>Daftar Ulang Pesantren (Tahunan)</span> <span
                                        class="font-semibold text-gray-900">Rp 300.000</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. Ketentuan Section -->
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 mb-12">
                <div class="flex items-center mb-8">
                    <div class="w-10 h-10 bg-green-100 text-[#008362] rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-info-circle text-lg"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">3. Ketentuan Pembayaran & Fasilitas</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6">
                    <div class="flex items-start">
                        <div
                            class="w-8 h-8 rounded-full bg-green-50 text-[#008362] flex items-center justify-center mr-4 flex-shrink-0 font-bold text-sm">
                            1</div>
                        <p class="text-gray-700 leading-relaxed"><span class="font-bold">Waktu Pembayaran
                                Pendaftaran:</span> Biaya pendaftaran dibayarkan <span
                                class="font-bold text-red-600 underline">sebelum</span> siswa mengisi formulir pendaftaran.
                        </p>
                    </div>
                    <div class="flex items-start">
                        <div
                            class="w-8 h-8 rounded-full bg-green-50 text-[#008362] flex items-center justify-center mr-4 flex-shrink-0 font-bold text-sm">
                            2</div>
                        <p class="text-gray-700 leading-relaxed"><span class="font-bold">Pembayaran Daftar Ulang:</span>
                            Biaya uang gedung, seragam, dan perlengkapan dibayar tunai (kontan) saat melakukan daftar ulang.
                        </p>
                    </div>
                    <div class="flex items-start">
                        <div
                            class="w-8 h-8 rounded-full bg-green-50 text-[#008362] flex items-center justify-center mr-4 flex-shrink-0 font-bold text-sm">
                            3</div>
                        <p class="text-gray-700 leading-relaxed"><span class="font-bold">Cakupan Seragam Pesantren:</span>
                            Biaya ini mencakup Jas Almamater dan Seragam Putih.</p>
                    </div>
                    <div class="flex items-start">
                        <div
                            class="w-8 h-8 rounded-full bg-green-50 text-[#008362] flex items-center justify-center mr-4 flex-shrink-0 font-bold text-sm">
                            4</div>
                        <p class="text-gray-700 leading-relaxed"><span class="font-bold">Cakupan Seragam SMP (Khusus Paket
                                A):</span> Biaya ini mencakup LKS untuk 2 Semester dan Seragam Olahraga.</p>
                    </div>
                    <div class="flex items-start">
                        <div
                            class="w-8 h-8 rounded-full bg-green-50 text-[#008362] flex items-center justify-center mr-4 flex-shrink-0 font-bold text-sm">
                            5</div>
                        <p class="text-gray-700 leading-relaxed"><span class="font-bold">Jatuh Tempo SPP:</span> Biaya
                            bulanan/SPP wajib dibayarkan setiap bulan maksimal tanggal 10.</p>
                    </div>
                    <div class="flex items-start">
                        <div
                            class="w-8 h-8 rounded-full bg-green-50 text-[#008362] flex items-center justify-center mr-4 flex-shrink-0 font-bold text-sm">
                            6</div>
                        <p class="text-gray-700 leading-relaxed"><span class="font-bold">Biaya Tahunan:</span> Biaya
                            daftar ulang pesantren dibayarkan saat pemberangkatan bulan Syawal.</p>
                    </div>
                    <div class="flex items-start">
                        <div
                            class="w-8 h-8 rounded-full bg-green-50 text-[#008362] flex items-center justify-center mr-4 flex-shrink-0 font-bold text-sm">
                            7</div>
                        <p class="text-gray-700 leading-relaxed"><span class="font-bold">Biaya Semesteran (Khusus Paket
                                A):</span> Sudah termasuk paket untuk 2 semester.</p>
                    </div>
                    <div class="flex items-start">
                        <div
                            class="w-8 h-8 rounded-full bg-red-50 text-red-600 flex items-center justify-center mr-4 flex-shrink-0 font-bold text-sm">
                            8</div>
                        <p class="text-gray-700 leading-relaxed"><span class="font-bold">Kebijakan Pengunduran
                                Diri:</span> Apabila santri mengundurkan diri, maka biaya yang telah masuk <span
                                class="font-bold text-red-600 underline">tidak dapat dikembalikan</span>.</p>
                    </div>
                </div>
            </div>

            <!-- 4. Komitmen Section -->
            <div class="bg-[#1b1b18] text-white p-10 rounded-3xl shadow-xl relative overflow-hidden mb-12">
                <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-white opacity-5 rounded-full"></div>
                <div class="flex items-center mb-8 relative z-10">
                    <div
                        class="w-10 h-10 bg-white/10 text-white rounded-lg flex items-center justify-center mr-4 backdrop-blur-sm">
                        <i class="fas fa-handshake text-lg"></i>
                    </div>
                    <h2 class="text-2xl font-bold">4. Komitmen Santri & Wali Santri</h2>
                </div>
                <p class="text-gray-400 mb-8 relative z-10">Dengan mendaftar di Pondok Pesantren Al Anwar Pakijangan,
                    santri dan wali santri menyatakan bersedia untuk :</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-4 relative z-10">
                    <div class="flex items-start">
                        <i class="fas fa-check text-[#008362] mt-1 mr-3"></i>
                        <span class="text-gray-300">Dididik dan dibina sesuai Visi dan Misi Pondok Pesantren.</span>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-check text-[#008362] mt-1 mr-3"></i>
                        <span class="text-gray-300">Mematuhi segala peraturan dan tata tertib yang berlaku.</span>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-check text-[#008362] mt-1 mr-3"></i>
                        <span class="text-gray-300">Menyelesaikan target pembelajaran yang ditentukan pesantren dan
                            sekolah.</span>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-check text-[#008362] mt-1 mr-3"></i>
                        <span class="text-gray-300">Melunasi semua biaya daftar ulang dan administrasi lainnya sesuai
                            ketentuan.</span>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-check text-[#008362] mt-1 mr-3"></i>
                        <span class="text-gray-300">Menerima konsekuensi/sanksi atas pelanggaran tata tertib, termasuk jika
                            harus dikembalikan kepada orang tua.</span>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-check text-[#008362] mt-1 mr-3"></i>
                        <span class="text-gray-300">Tidak menuntut pengembalian uang pendaftaran jika mengundurkan
                            diri.</span>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="text-center bg-green-50 p-10 rounded-3xl border border-green-100">
                <h3 class="text-2xl font-black text-gray-900 mb-4">Mulai Langkah Pertama Anda Sekarang</h3>
                <p class="text-gray-600 mb-8 max-w-xl mx-auto">Silakan kunjungi Sekretariat Pendaftaran di Pondok Pesantren
                    Al-Anwar Pakijangan untuk proses pendaftaran langsung.</p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="https://wa.me/6289629671089" target="_blank"
                        class="flex items-center justify-center px-8 py-4 bg-[#008362] text-white font-bold rounded-full hover:bg-[#006b50] transition-all transform hover:scale-105 shadow-lg group w-full sm:w-auto">
                        <i class="fab fa-whatsapp mr-3 text-2xl"></i>
                        Hubungi Panitia Pendaftaran
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
