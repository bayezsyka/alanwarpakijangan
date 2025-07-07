<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>SPMB &amp; PSB Al Anwar</title>
  <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.1/dist/flowbite.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script src="node_modules/flowbite/dist/flowbite.min.js"></script>
  <style>
    html.loading { visibility: hidden; }
    * { box-sizing: border-box; }
    body {
      font-family: 'Poppins', sans-serif;
      scroll-behavior: smooth;
      -webkit-font-smoothing: antialiased;
      margin: 0;
      padding: 0;
      width: 100%;
      overflow-x: hidden;
    }
    @media (max-width: 768px) {
      body { font-size: 14px; }
    }
    .gradient-text { background: linear-gradient(90deg, #0e7490, #0891b2); -webkit-background-clip: text; background-clip: text; color: transparent; }
    .floating { animation: floating 3s ease-in-out infinite; }
    @keyframes floating { 0% { transform: translateY(0px); } 50% { transform: translateY(-15px); } 100% { transform: translateY(0px); } }
    .card-hover { transition: all 0.3s ease; }
    .card-hover:hover { transform: translateY(-5px); box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); }
  </style>
</head>
<body class="bg-gray-50">
    <!-- Hero Section -->
    <section class="relative py-32 md:py-40 overflow-hidden" style="background:linear-gradient(rgba(8, 145, 178, 0.9), rgba(6, 95, 117, 0.9)), url('foto_utama/bgppdb.png'); background-size: cover; background-position: center;">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="absolute bottom-0 left-0 right-0 top-auto h-20 bg-gradient-to-t from-gray-50 to-transparent"></div>
        </div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">
                    <span class="block">SPMB &amp; PSB 2025/2026</span>
                    <span class="text-cyan-200">Pondok Pesantren Al-Anwar Pakijangan &amp; SMP Al-Anwar</span>
                </h1>
                <p class="text-xl text-cyan-100 max-w-3xl mx-auto mb-10">Bergabunglah dengan keluarga besar Al-Anwar untuk pendidikan yang berkualitas dan berkarakter</p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ url('pendaftaran') }}" class="px-8 py-4 bg-white text-cyan-700 font-semibold rounded-lg shadow-lg hover:bg-cyan-50 transition-all duration-300 flex items-center justify-center gap-2">
                        <i class=""></i>
                        Daftar Sekarang
                    </a>
                    <a href="/" class="px-8 py-4 bg-transparent border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:text-cyan-700 transition-all duration-300 flex items-center justify-center gap-2">
                        <i class="fas fa-home"></i>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Dokumen Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-cyan-800 mb-4">Persyaratan Pendaftaran</h2>
                <div class="w-20 h-1 bg-cyan-600 mx-auto"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-white rounded-xl shadow-md p-6 card-hover">
                    <div class="w-16 h-16 bg-cyan-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <i class="fas fa-id-card text-3xl text-cyan-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-center text-gray-800 mb-2">Kartu Keluarga</h3>
                    <p class="text-gray-600 text-center">Fotocopy Kartu Keluarga (2 lembar)</p>
                </div>
                <div class="bg-white rounded-xl shadow-md p-6 card-hover">
                    <div class="w-16 h-16 bg-cyan-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <i class="fas fa-birthday-cake text-3xl text-cyan-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-center text-gray-800 mb-2">Akta Kelahiran</h3>
                    <p class="text-gray-600 text-center">Fotocopy Akta Kelahiran (2 lembar)</p>
                </div>
                <div class="bg-white rounded-xl shadow-md p-6 card-hover">
                    <div class="w-16 h-16 bg-cyan-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <i class="fas fa-graduation-cap text-3xl text-cyan-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-center text-gray-800 mb-2">Ijazah &amp; SKHU</h3>
                    <p class="text-gray-600 text-center">Fotocopy Ijazah &amp; SKHUSD/MI (2 lembar)</p>
                </div>
                <div class="bg-white rounded-xl shadow-md p-6 card-hover">
                    <div class="w-16 h-16 bg-cyan-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <i class="fas fa-camera text-3xl text-cyan-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-center text-gray-800 mb-2">Pas Foto</h3>
                    <p class="text-gray-600 text-center">Pas Foto 3×4 (4 lembar) &amp; 2×3 (2 lembar)</p>
                </div>
            </div>
            <div class="mt-12 text-center">
                <p class="text-gray-600 mb-6">* Fotocopy KTP Orang Tua dan Kartu KIP (jika ada) masing-masing 2 lembar</p>
                <a href="#biaya" class="inline-block px-6 py-3 bg-cyan-600 text-white rounded-lg hover:bg-cyan-700 transition-all duration-300">
                    Lihat Rincian Biaya <i class="fas fa-arrow-down ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Administrasi Section -->
    <section id="biaya" class="py-20 bg-gradient-to-b from-cyan-50 to-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-cyan-800 mb-4">Administrasi Pendaftaran</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Biaya pendaftaran awal sebesar <strong>Rp150.000</strong> berlaku untuk semua calon santri sebagai langkah awal sebelum memilih paket daftar ulang.</p>
                <div class="w-20 h-1 bg-cyan-600 mx-auto mt-6"></div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-5xl mx-auto">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden card-hover">
                    <div class="bg-cyan-600 py-6 px-8">
                        <h3 class="text-2xl font-bold text-white">Paket 1 - Mondok + SMP</h3>
                    </div>
                    <div class="p-8">
                        <div class="text-center mb-8">
                            <span class="text-4xl font-bold text-cyan-600">Rp2.160.000</span>
                            <span class="text-gray-500 ml-2">daftar ulang</span>
                        </div>
                        <div class="space-y-4 mb-8">
                            <div class="flex justify-between py-3 border-b border-gray-100">
                                <span class="text-gray-600">Uang Gedung Pondok</span>
                                <span class="font-semibold">Rp1.000.000</span>
                            </div>
                            <div class="flex justify-between py-3 border-b border-gray-100">
                                <span class="text-gray-600">Seragam &amp; Perlengkapan</span>
                                <span class="font-semibold">Rp410.000</span>
                            </div>
                            <div class="flex justify-between py-3 border-b border-gray-100">
                                <span class="text-gray-600">Makan &amp; Bulanan</span>
                                <span class="font-semibold">Rp650.000</span>
                            </div>
                            <div class="flex justify-between py-3 border-b border-gray-100">
                                <span class="text-gray-600">Al-Anwar Bersholawat</span>
                                <span class="font-semibold">Rp100.000</span>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 italic">Uang gedung SMP dibicarakan terpisah bersama komite.</p>
                    </div>
                </div>
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden card-hover">
                    <div class="bg-teal-600 py-6 px-8">
                        <h3 class="text-2xl font-bold text-white">Paket 2 - Mondok Saja</h3>
                    </div>
                    <div class="p-8">
                        <div class="text-center mb-8">
                            <span class="text-4xl font-bold text-teal-600">Rp2.010.000</span>
                            <span class="text-gray-500 ml-2">daftar ulang</span>
                        </div>
                        <div class="space-y-4 mb-8">
                            <div class="flex justify-between py-3 border-b border-gray-100">
                                <span class="text-gray-600">Uang Gedung</span>
                                <span class="font-semibold">Rp1.000.000</span>
                            </div>
                            <div class="flex justify-between py-3 border-b border-gray-100">
                                <span class="text-gray-600">Seragam &amp; Perlengkapan</span>
                                <span class="font-semibold">Rp410.000</span>
                            </div>
                            <div class="flex justify-between py-3 border-b border-gray-100">
                                <span class="text-gray-600">Makan &amp; Syahriyah</span>
                                <span class="font-semibold">Rp500.000</span>
                            </div>
                            <div class="flex justify-between py-3 border-b border-gray-100">
                                <span class="text-gray-600">Al-Anwar Bersholawat</span>
                                <span class="font-semibold">Rp100.000</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="max-w-3xl mx-auto mt-12 bg-white rounded-2xl shadow-xl overflow-hidden card-hover">
                <div class="bg-gradient-to-r from-cyan-600 to-teal-600 py-6 px-8">
                    <h3 class="text-2xl font-bold text-white text-center">Rangkuman Biaya</h3>
                </div>
                <div class="p-8">
                    <div class="space-y-4">
                        <div class="flex justify-between py-3 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">Pendaftaran Awal</span>
                            <span class="font-bold text-xl text-cyan-600">Rp150.000</span>
                        </div>
                        <div class="flex justify-between py-3 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">Paket 1 (Mondok + SMP)</span>
                            <span class="font-bold text-xl text-cyan-600">Rp2.160.000</span>
                        </div>
                        <div class="flex justify-between py-3">
                            <span class="text-gray-600 font-medium">Paket 2 (Mondok Saja)</span>
                            <span class="font-bold text-xl text-cyan-600">Rp2.010.000</span>
                        </div>
                    </div>
                    <div class="mt-8 bg-cyan-50 rounded-lg p-4">
                        <p class="text-center text-cyan-700 font-medium">
                            <i class="fas fa-info-circle mr-2"></i>
                            Pembayaran dapat dilakukan secara bertahap sesuai ketentuan yang berlaku
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Prosedur Section -->
    <section class="py-12 md:py-20 bg-white">
      <div class="container mx-auto px-4 md:px-6">
          <div class="text-center mb-12 md:mb-16">
              <h2 class="text-2xl md:text-4xl font-bold text-cyan-800 mb-3">Prosedur Pendaftaran</h2>
              <p class="text-lg md:text-xl text-gray-600 max-w-2xl mx-auto">Ikuti 4 langkah mudah bergabung dengan Al-Anwar</p>
              <div class="w-16 md:w-20 h-1 bg-cyan-600 mx-auto mt-4 md:mt-6"></div>
          </div>
          <div class="max-w-4xl mx-auto">
              <div class="space-y-8 md:space-y-12">
                  <div class="flex flex-col md:flex-row items-start md:items-center gap-4 md:gap-0">
                      <div class="md:w-1/2 md:pr-8 md:text-right order-1">
                          <div class="bg-cyan-50 p-5 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                              <h3 class="text-lg md:text-xl font-bold text-cyan-700 mb-2 flex items-center">
                                  <span class="md:hidden w-8 h-8 bg-cyan-600 rounded-full text-white flex items-center justify-center mr-3">1</span>
                                  Mengisi Formulir
                              </h3>
                              <p class="text-gray-600 text-sm md:text-base">Formulir tersedia di kantor atau website resmi. Wajib diisi oleh calon santri dan orang tua.</p>
                          </div>
                      </div>
                      <div class="hidden md:flex w-12 h-12 rounded-full bg-cyan-600 border-4 border-white items-center justify-center z-10 mx-auto order-2">
                          <span class="text-white font-bold">1</span>
                      </div>
                      <div class="md:w-1/2 order-3"></div>
                  </div>
                  <div class="flex flex-col md:flex-row items-start md:items-center gap-4 md:gap-0">
                      <div class="md:w-1/2 order-3"></div>
                      <div class="hidden md:flex w-12 h-12 rounded-full bg-teal-600 border-4 border-white items-center justify-center z-10 mx-auto order-2">
                          <span class="text-white font-bold">2</span>
                      </div>
                      <div class="md:w-1/2 md:pl-8 order-1 md:order-3">
                          <div class="bg-teal-50 p-5 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                              <h3 class="text-lg md:text-xl font-bold text-teal-700 mb-2 flex items-center">
                                  <span class="md:hidden w-8 h-8 bg-teal-600 rounded-full text-white flex items-center justify-center mr-3">2</span>
                                  Menyerahkan Berkas
                              </h3>
                              <p class="text-gray-600 text-sm md:text-base">Fotokopi KTP orang tua, akta kelahiran, dan surat keterangan sehat. Berkas harus jelas dan lengkap.</p>
                          </div>
                      </div>
                  </div>
                  <div class="flex flex-col md:flex-row items-start md:items-center gap-4 md:gap-0">
                      <div class="md:w-1/2 md:pr-8 md:text-right order-1">
                          <div class="bg-cyan-50 p-5 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                              <h3 class="text-lg md:text-xl font-bold text-cyan-700 mb-2 flex items-center">
                                  <span class="md:hidden w-8 h-8 bg-cyan-600 rounded-full text-white flex items-center justify-center mr-3">3</span>
                                  Pembayaran
                              </h3>
                              <p class="text-gray-600 text-sm md:text-base">Bayar biaya pendaftaran via transfer bank atau langsung di kantor pesantren.</p>
                          </div>
                      </div>
                      <div class="hidden md:flex w-12 h-12 rounded-full bg-cyan-600 border-4 border-white items-center justify-center z-10 mx-auto order-2">
                          <span class="text-white font-bold">3</span>
                      </div>
                      <div class="md:w-1/2 order-3"></div>
                  </div>
                  <div class="flex flex-col md:flex-row items-start md:items-center gap-4 md:gap-0">
                      <div class="md:w-1/2 order-3"></div>
                      <div class="hidden md:flex w-12 h-12 rounded-full bg-teal-600 border-4 border-white items-center justify-center z-10 mx-auto order-2">
                          <span class="text-white font-bold">4</span>
                      </div>
                      <div class="md:w-1/2 md:pl-8 order-1 md:order-3">
                          <div class="bg-teal-50 p-5 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                              <h3 class="text-lg md:text-xl font-bold text-teal-700 mb-2 flex items-center">
                                  <span class="md:hidden w-8 h-8 bg-teal-600 rounded-full text-white flex items-center justify-center mr-3">4</span>
                                  Informasi Keberangkatan
                              </h3>
                              <p class="text-gray-600 text-sm md:text-base">Update melalui grup WhatsApp. Pastikan bergabung untuk info terkini.</p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="mt-12 md:mt-16 text-center">
                  <a href="https://wa.me/6281917941714" class="inline-block px-6 py-3 md:px-8 md:py-4 bg-cyan-600 hover:bg-cyan-700 text-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
                      <i class="fab fa-whatsapp mr-2"></i> Hubungi Panitia
                  </a>
              </div>
          </div>
      </div>
  </section>

    <!-- FAQ Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-cyan-800 mb-4">Pertanyaan Umum</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Informasi penting seputar pendaftaran di Al-Anwar</p>
                <div class="w-20 h-1 bg-cyan-600 mx-auto mt-6"></div>
            </div>
            <div class="max-w-4xl mx-auto space-y-4">
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <button class="flex justify-between items-center w-full px-6 py-5 text-left focus:outline-none" onclick="toggleFAQ(this)">
                        <span class="text-lg font-semibold text-gray-800">Apa perbedaan antara SPMB dan PSB di Pondok Pesantren Al-Anwar?</span>
                        <i class="fas fa-chevron-down text-cyan-600 transition-transform duration-300"></i>
                    </button>
                    <div class="hidden px-6 pb-5 pt-0">
                        <p class="text-gray-700">SPMB (Sistem Penerimaan Murid Baru) adalah proses masuk ke jenjang pendidikan formal (SMP Al-Anwar), sedangkan PSB (Penerimaan Santri Baru) adalah untuk masuk ke lingkungan pondok pesantren. Mulai tahun 2025, santri yang mukim di Pondok Pesantren Al-Anwar diwajibkan untuk bersekolah di SMP Al-Anwar, kecuali bagi yang memilih tidak melanjutkan pendidikan formal.</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <button class="flex justify-between items-center w-full px-6 py-5 text-left focus:outline-none" onclick="toggleFAQ(this)">
                        <span class="text-lg font-semibold text-gray-800">Kapan pendaftaran SPMB dan PSB dibuka?</span>
                        <i class="fas fa-chevron-down text-cyan-600 transition-transform duration-300"></i>
                    </button>
                    <div class="hidden px-6 pb-5 pt-0">
                        <p class="text-gray-700">Pendaftaran biasanya dibuka mulai Januari hingga Juni setiap tahun, atau hingga kuota terpenuhi.</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <button class="flex justify-between items-center w-full px-6 py-5 text-left focus:outline-none" onclick="toggleFAQ(this)">
                        <span class="text-lg font-semibold text-gray-800">Apakah ada proses seleksi untuk calon santri?</span>
                        <i class="fas fa-chevron-down text-cyan-600 transition-transform duration-300"></i>
                    </button>
                    <div class="hidden px-6 pb-5 pt-0">
                        <p class="text-gray-700">Untuk saat ini, tidak ada proses seleksi khusus. Semua calon santri secara otomatis akan diterima sebagai santri dan siswa SMP Al-Anwar, kecuali jika ada informasi tambahan di kemudian hari.</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <button class="flex justify-between items-center w-full px-6 py-5 text-left focus:outline-none" onclick="toggleFAQ(this)">
                        <span class="text-lg font-semibold text-gray-800">Apakah calon santri dari luar daerah boleh mendaftar?</span>
                        <i class="fas fa-chevron-down text-cyan-600 transition-transform duration-300"></i>
                    </button>
                    <div class="hidden px-6 pb-5 pt-0">
                        <p class="text-gray-700">Tentu saja. Tidak ada batasan wilayah asal, pendaftaran terbuka untuk seluruh calon santri dari berbagai daerah.</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <button class="flex justify-between items-center w-full px-6 py-5 text-left focus:outline-none" onclick="toggleFAQ(this)">
                        <span class="text-lg font-semibold text-gray-800">Apakah santri boleh bersekolah di luar pesantren?</span>
                        <i class="fas fa-chevron-down text-cyan-600 transition-transform duration-300"></i>
                    </button>
                    <div class="hidden px-6 pb-5 pt-0">
                        <p class="text-gray-700">Tidak, santri yang mukim harus bersekolah di dalam pesantren.</p>
                    </div>
                </div>
            </div>
            <div class="mt-16 text-center">
                <h4 class="text-xl font-semibold mb-4">Masih ada pertanyaan?</h4>
                <p class="text-gray-600 mb-6">Tim penerimaan santri baru siap membantu Anda</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="https://wa.me/6281917941714" class="flex items-center px-6 py-3 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition-all">
                        <i class="fab fa-whatsapp text-xl mr-2"></i> WhatsApp
                    </a>
                    <a href="tel:+6281917941714" class="flex items-center px-6 py-3 bg-cyan-600 text-white rounded-lg shadow hover:bg-cyan-700 transition-all">
                        <i class="fas fa-phone-alt text-xl mr-2"></i> Telepon
                    </a>
                </div>
            </div>
        </div>
    </section>

    <script src="main.js"></script>
</body>
</html>
