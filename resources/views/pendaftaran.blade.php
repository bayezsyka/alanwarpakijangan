@extends('layouts.public')

@section('title', 'Informasi Pendaftaran - Pondok Pesantren Al-Anwar Pakijangan')

@section('content')
    <section class="section bg-surface-alt !pt-20 lg:!pt-24">
        <div class="container-editorial max-w-5xl">

            {{-- Header --}}
            <div class="text-center mb-16" data-aos="fade-up">
                <p class="eyebrow justify-center">Penerimaan Santri Baru</p>
                <h1 class="font-display font-semibold leading-[1.05] tracking-[-0.03em] text-dark text-[clamp(36px,5vw,58px)] mb-4">
                    Informasi Pendaftaran
                </h1>
                <p class="font-display text-xl text-primary italic">Pondok Pesantren Al Anwar Pakijangan</p>
                <p class="text-muted mt-2 text-sm">Tahun Ajaran 2026/2027 M (1447/1448 H)</p>
            </div>

            {{-- Program Unggulan - dark section --}}
            <div class="bg-dark text-white p-8 lg:p-10 rounded-lg shadow-soft mb-12 relative overflow-hidden" data-aos="fade-up">
                <div class="absolute top-0 right-0 w-40 h-40 border border-white/8 rounded-full -mr-12 -mt-12 pointer-events-none" aria-hidden="true"></div>
                <div class="flex items-center gap-3 mb-8 relative z-10">
                    <div class="w-11 h-11 rounded-full bg-white/10 border border-white/15 flex items-center justify-center">
                        <i class="fas fa-star text-accent"></i>
                    </div>
                    <h2 class="font-display text-2xl lg:text-3xl font-semibold">Program Unggulan</h2>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 relative z-10">
                    @php
                        $programs = [
                            ['book-reader', 'Kitab'],
                            ['quran', 'Tahfidz'],
                            ['robot', 'Robotik'],
                            ['microscope', 'Sains Club'],
                            ['language', 'English Club'],
                            ['mosque', 'Arab Club'],
                            ['star', 'Hafalan Surat Pilihan'],
                            ['pen-nib', 'Jurnalistik'],
                        ];
                    @endphp
                    @foreach ($programs as $prog)
                        <div class="flex items-center gap-2 p-3 rounded-md bg-white/5 border border-white/10 hover:bg-white/8 hover:-translate-y-0.5 transition-all">
                            <i class="fas fa-{{ $prog[0] }} text-accent"></i>
                            <span class="text-sm font-medium">{{ $prog[1] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Important Policy Note --}}
            <div class="mb-12 p-6 bg-accent-soft border-l-4 border-accent rounded-r-md shadow-card" data-aos="fade-up">
                <div class="flex items-start gap-3">
                    <i class="fas fa-info-circle text-accent text-xl mt-0.5"></i>
                    <div>
                        <h3 class="font-display text-lg font-semibold text-dark mb-1">Informasi Penting (Wajib)</h3>
                        <p class="text-dark/80 leading-relaxed text-[15px]">
                            Calon siswa <strong class="underline">SMP Al-Anwar wajib mondok</strong> di Pondok
                            Pesantren Al-Anwar, dan santri Al-Anwar yang mengikuti sekolah formal
                            <strong class="underline">wajib bersekolah di SMP Al-Anwar</strong>.
                        </p>
                    </div>
                </div>
            </div>

            {{-- 1. Persyaratan --}}
            <div class="card-editorial p-8 mb-12" data-aos="fade-up">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-11 h-11 rounded-full bg-primary-soft text-primary flex items-center justify-center">
                        <i class="fas fa-file-contract"></i>
                    </div>
                    <h2 class="font-display text-2xl lg:text-3xl font-semibold text-dark">1. Persyaratan Administrasi</h2>
                </div>
                <p class="text-muted mb-6">Calon santri wajib melengkapi berkas pendaftaran sebagai berikut:</p>
                <div class="grid md:grid-cols-2 gap-x-10 gap-y-3">
                    @php
                        $berkas = [
                            'Fotokopi Kartu Keluarga (4 Lembar)',
                            'Fotokopi Akte Kelahiran (4 Lembar)',
                            'Fotokopi Ijazah Formal/SKL (4 Lembar)',
                            'Fotokopi Ijazah Madin (4 Lembar)',
                            'Fotokopi SKHU/SKNR (4 Lembar)',
                            'Fotokopi NISN (4 Lembar)',
                            'Fotokopi KIP (4 Lembar) - jika ada',
                            'Fotokopi KTP Orang Tua (4 Lembar)',
                            'Pas Foto 3x2 (2 Lembar)',
                            'Pas Foto 3x4 (4 Lembar)',
                        ];
                    @endphp
                    @foreach ($berkas as $b)
                        <li class="flex items-start gap-3 list-none">
                            <span class="mt-1 inline-flex w-5 h-5 rounded-full bg-primary-soft text-primary items-center justify-center shrink-0">
                                <i class="fas fa-check text-[9px]"></i>
                            </span>
                            <span class="text-dark/80 text-[15px]">{{ $b }}</span>
                        </li>
                    @endforeach
                </div>
                <div class="mt-8 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-md">
                    <p class="text-red-800 text-sm">
                        <strong>Catatan Foto:</strong> Foto terbaru harus menggunakan <strong class="underline">background merah</strong> dan mengenakan <strong class="underline">seragam putih</strong>.
                    </p>
                </div>
            </div>

            {{-- 2. Pilihan Paket --}}
            <div class="mb-12" data-aos="fade-up">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-11 h-11 rounded-full bg-primary-soft text-primary flex items-center justify-center">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <h2 class="font-display text-2xl lg:text-3xl font-semibold text-dark">2. Pilihan Paket &amp; Rincian Biaya</h2>
                </div>

                <div class="grid md:grid-cols-2 gap-8">
                    {{-- Paket A --}}
                    <div class="bg-surface rounded-lg overflow-hidden shadow-card border border-black/8 flex flex-col h-full border-t-4 border-t-primary">
                        <div class="p-8 pb-0">
                            <h3 class="font-display text-2xl font-bold text-dark mb-1">PAKET A</h3>
                            <p class="text-primary font-bold text-lg mb-6">Mondok + SMP</p>
                            <div class="bg-surface-alt p-4 rounded-md mb-6">
                                <span class="text-[11px] font-bold uppercase tracking-[0.14em] text-muted block">Total Biaya Awal</span>
                                <span class="font-display text-3xl font-bold text-primary">Rp 4.235.000</span>
                            </div>
                        </div>
                        <div class="p-8 pt-0 flex-grow">
                            <h4 class="font-bold text-dark mb-4 text-sm flex items-center gap-2">
                                <i class="fas fa-list-ul text-xs text-accent"></i> Rincian Biaya Awal:
                            </h4>
                            <ul class="space-y-3 text-sm text-dark/70 border-b border-black/8 pb-6 mb-6">
                                <li class="flex justify-between"><span>Pendaftaran</span> <span class="font-semibold text-dark">Rp 150.000</span></li>
                                <li class="flex justify-between"><span>Uang Gedung</span> <span class="font-semibold text-dark">Rp 2.000.000</span></li>
                                <li class="flex justify-between"><span>Seragam &amp; Perlengkapan Pesantren</span> <span class="font-semibold text-dark">Rp 410.000</span></li>
                                <li class="flex justify-between"><span>Seragam &amp; Perlengkapan SMP</span> <span class="font-semibold text-dark">Rp 600.000</span></li>
                                <li class="flex justify-between"><span>Biaya Makan &amp; Syahriyah</span> <span class="font-semibold text-dark">Rp 650.000</span></li>
                                <li class="flex justify-between"><span>Infaq Kegiatan</span> <span class="font-semibold text-dark">Rp 100.000</span></li>
                                <li class="flex justify-between"><span>Loker</span> <span class="font-semibold text-dark">Rp 325.000</span></li>
                            </ul>
                            <h4 class="font-bold text-dark mb-4 text-sm flex items-center gap-2">
                                <i class="fas fa-sync-alt text-xs text-accent"></i> Biaya Lanjutan (Rutin/Berkala):
                            </h4>
                            <ul class="space-y-3 text-sm text-dark/70">
                                <li class="flex justify-between"><span>Biaya Bulanan (SPP)</span> <span class="font-semibold text-dark">Rp 650.000</span></li>
                                <li class="flex justify-between"><span>Daftar Ulang Pesantren (Tahunan)</span> <span class="font-semibold text-dark">Rp 300.000</span></li>
                                <li class="flex justify-between"><span>Biaya Semesteran</span> <span class="font-semibold text-dark">Rp 500.000</span></li>
                            </ul>
                        </div>
                    </div>

                    {{-- Paket B --}}
                    <div class="bg-surface rounded-lg overflow-hidden shadow-card border border-black/8 flex flex-col h-full border-t-4 border-t-dark">
                        <div class="p-8 pb-0">
                            <h3 class="font-display text-2xl font-bold text-dark mb-1">PAKET B</h3>
                            <p class="text-muted font-bold text-lg mb-6">Mondok Saja</p>
                            <div class="bg-surface-alt p-4 rounded-md mb-6">
                                <span class="text-[11px] font-bold uppercase tracking-[0.14em] text-muted block">Total Biaya Awal</span>
                                <span class="font-display text-3xl font-bold text-dark">Rp 2.485.000</span>
                            </div>
                        </div>
                        <div class="p-8 pt-0 flex-grow">
                            <h4 class="font-bold text-dark mb-4 text-sm flex items-center gap-2">
                                <i class="fas fa-list-ul text-xs text-accent"></i> Rincian Biaya Awal:
                            </h4>
                            <ul class="space-y-3 text-sm text-dark/70 border-b border-black/8 pb-6 mb-6">
                                <li class="flex justify-between"><span>Pendaftaran</span> <span class="font-semibold text-dark">Rp 150.000</span></li>
                                <li class="flex justify-between"><span>Uang Gedung</span> <span class="font-semibold text-dark">Rp 1.000.000</span></li>
                                <li class="flex justify-between"><span>Seragam &amp; Perlengkapan Pesantren</span> <span class="font-semibold text-dark">Rp 410.000</span></li>
                                <li class="flex justify-between"><span>Biaya Makan &amp; Syahriyah</span> <span class="font-semibold text-dark">Rp 500.000</span></li>
                                <li class="flex justify-between"><span>Infaq Kegiatan</span> <span class="font-semibold text-dark">Rp 100.000</span></li>
                                <li class="flex justify-between"><span>Loker</span> <span class="font-semibold text-dark">Rp 325.000</span></li>
                            </ul>
                            <h4 class="font-bold text-dark mb-4 text-sm flex items-center gap-2">
                                <i class="fas fa-sync-alt text-xs text-accent"></i> Biaya Lanjutan (Rutin/Berkala):
                            </h4>
                            <ul class="space-y-3 text-sm text-dark/70">
                                <li class="flex justify-between"><span>Biaya Bulanan (SPP)</span> <span class="font-semibold text-dark">Rp 500.000</span></li>
                                <li class="flex justify-between"><span>Daftar Ulang Pesantren (Tahunan)</span> <span class="font-semibold text-dark">Rp 300.000</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 3. Ketentuan --}}
            <div class="card-editorial p-8 mb-12" data-aos="fade-up">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-11 h-11 rounded-full bg-primary-soft text-primary flex items-center justify-center">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <h2 class="font-display text-2xl lg:text-3xl font-semibold text-dark">3. Ketentuan Pembayaran &amp; Fasilitas</h2>
                </div>
                <div class="grid md:grid-cols-2 gap-x-12 gap-y-6">
                    @php
                        $ketentuan = [
                            ['<strong>Waktu Pembayaran Pendaftaran:</strong> Biaya pendaftaran dibayarkan <strong class="text-red-600 underline">sebelum</strong> siswa mengisi formulir pendaftaran.', false],
                            ['<strong>Pembayaran Daftar Ulang:</strong> Biaya uang gedung, seragam, dan perlengkapan dibayar tunai (kontan) saat melakukan daftar ulang.', false],
                            ['<strong>Cakupan Seragam Pesantren:</strong> Biaya ini mencakup Jas Almamater dan Seragam Putih.', false],
                            ['<strong>Cakupan Seragam SMP (Khusus Paket A):</strong> Biaya ini mencakup LKS untuk 2 Semester dan Seragam Olahraga.', false],
                            ['<strong>Jatuh Tempo SPP:</strong> Biaya bulanan/SPP wajib dibayarkan setiap bulan maksimal tanggal 10.', false],
                            ['<strong>Biaya Tahunan:</strong> Biaya daftar ulang pesantren dibayarkan saat pemberangkatan bulan Syawal.', false],
                            ['<strong>Biaya Semesteran (Khusus Paket A):</strong> Sudah termasuk paket untuk 2 semester.', false],
                            ['<strong>Kebijakan Pengunduran Diri:</strong> Apabila santri mengundurkan diri, maka biaya yang telah masuk <strong class="text-red-600 underline">tidak dapat dikembalikan</strong>.', true],
                        ];
                    @endphp
                    @foreach ($ketentuan as $i => $k)
                        <div class="flex items-start gap-4">
                            <div class="w-8 h-8 rounded-full {{ $k[1] ? 'bg-red-50 text-red-600' : 'bg-primary-soft text-primary' }} flex items-center justify-center shrink-0 font-bold text-sm font-display">
                                {{ $i + 1 }}
                            </div>
                            <p class="text-dark/80 leading-relaxed text-[15px]">{!! $k[0] !!}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- 4. Komitmen - dark section --}}
            <div class="bg-dark text-white p-8 lg:p-10 rounded-lg shadow-soft relative overflow-hidden mb-12" data-aos="fade-up">
                <div class="absolute top-0 right-0 w-64 h-64 border border-white/5 rounded-full -mr-16 -mt-16 pointer-events-none" aria-hidden="true"></div>
                <div class="flex items-center gap-3 mb-8 relative z-10">
                    <div class="w-11 h-11 rounded-full bg-white/10 border border-white/15 flex items-center justify-center">
                        <i class="fas fa-handshake text-accent"></i>
                    </div>
                    <h2 class="font-display text-2xl lg:text-3xl font-semibold">4. Komitmen Santri &amp; Wali Santri</h2>
                </div>
                <p class="text-white/60 mb-8 relative z-10">Dengan mendaftar di Pondok Pesantren Al Anwar Pakijangan, santri dan wali santri menyatakan bersedia untuk:</p>
                <div class="grid sm:grid-cols-2 gap-x-8 gap-y-4 relative z-10">
                    @php
                        $komitmen = [
                            'Dididik dan dibina sesuai Visi dan Misi Pondok Pesantren.',
                            'Mematuhi segala peraturan dan tata tertib yang berlaku.',
                            'Menyelesaikan target pembelajaran yang ditentukan pesantren dan sekolah.',
                            'Melunasi semua biaya daftar ulang dan administrasi lainnya sesuai ketentuan.',
                            'Menerima konsekuensi/sanksi atas pelanggaran tata tertib, termasuk jika harus dikembalikan kepada orang tua.',
                            'Tidak menuntut pengembalian uang pendaftaran jika mengundurkan diri.',
                        ];
                    @endphp
                    @foreach ($komitmen as $k)
                        <div class="flex items-start gap-3">
                            <i class="fas fa-check text-primary mt-1 shrink-0"></i>
                            <span class="text-white/80 text-[15px]">{{ $k }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- CTA Section --}}
            <div class="bg-dark text-white p-10 lg:p-12 rounded-lg shadow-soft relative overflow-hidden" data-aos="zoom-in">
                <div class="absolute top-0 left-0 w-72 h-72 border border-white/8 rounded-full -ml-20 -mt-20 pointer-events-none" aria-hidden="true"></div>
                <div class="absolute bottom-0 right-0 w-80 h-80 border border-accent/10 rounded-full -mr-24 -mb-24 pointer-events-none" aria-hidden="true"></div>

                <div class="relative z-10 text-center max-w-2xl mx-auto">
                    <p class="eyebrow eyebrow-light justify-center">Siap Memulai?</p>
                    <h3 class="font-display text-2xl lg:text-4xl font-semibold mb-4">Mulai Langkah Pertama Anda Sekarang</h3>
                    <p class="text-white/70 mb-8 text-[15px] leading-relaxed">
                        Silakan kunjungi Sekretariat Pendaftaran di Pondok Pesantren Al-Anwar Pakijangan
                        untuk proses pendaftaran langsung.
                    </p>
                    <a href="https://wa.me/6289629671089" target="_blank" class="btn btn-light">
                        <i class="fab fa-whatsapp text-lg"></i>
                        Hubungi Panitia Pendaftaran
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
