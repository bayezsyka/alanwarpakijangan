# Product

<!-- impeccable:product-schema 1 -->

## Platform

web

## Users

- Calon santri dan wali santri yang membutuhkan gambaran pesantren serta informasi pendaftaran yang dapat ditindaklanjuti.
- Santri, alumni, jamaah, dan masyarakat sekitar yang mencari jadwal rutinan, artikel, dokumentasi kegiatan, serta rekaman kajian Selasanan.
- Pengelola pesantren yang menerbitkan konten melalui panel administrasi yang sudah ada.

## Product Purpose

Situs resmi Pondok Pesantren Al-Anwar Pakijangan menyatukan identitas lembaga, informasi pendidikan, agenda rutin, publikasi artikel, dokumentasi kegiatan, jurnal kajian Selasanan, dan informasi pendaftaran dalam satu kanal publik. Keberhasilan halaman publik diukur dari kemampuan pengunjung mengenali lembaga, menemukan informasi yang sedang dicari, lalu menuju tindakan nyata seperti membaca, mendengarkan kajian, melihat persyaratan, menghubungi panitia, atau membuka lokasi.

## Positioning

Al-Anwar Pakijangan menyatakan pendekatan salaf modern yang memadukan penguatan akidah, akhlak, ilmu pengetahuan, dan pembinaan karakter santri. Situs harus menyampaikan posisi ini melalui konten dan kegiatan nyata yang sudah tersedia, bukan melalui klaim promosi tambahan.

## Operating Context

- Pengunjung banyak mengakses informasi dari telepon seluler dan membutuhkan navigasi ringkas dengan target sentuh yang jelas.
- Informasi berkala mencakup jadwal rutinan tujuh hari, pengumuman aktif, artikel, galeri acara, dan jurnal Selasanan yang dapat memuat audio.
- Pendaftaran saat ini dilakukan langsung melalui sekretariat dan kontak WhatsApp yang tercantum pada halaman pendaftaran.
- Detail artikel dan Selasanan merupakan ruang baca, sehingga keterbacaan, metadata publikasi, berbagi tautan, dan kemudahan kembali ke indeks adalah kebutuhan utama.

## Capabilities and Constraints

- Backend Laravel, model, route publik, panel admin, autentikasi, dan kontrak data yang sudah ada harus dipertahankan.
- Frontend publik dimigrasikan dari Blade dan Livewire ke Inertia React tanpa mengubah URL publik.
- Konten faktual, biaya, persyaratan, kontak, alamat, tautan sosial, foto, logo, dan metadata SEO yang sudah tersedia tidak boleh direka ulang.
- Artikel mendukung pencarian, filter kategori, paginasi, gambar lokal atau eksternal, status publikasi, dan mode pratinjau untuk admin.
- Selasanan mendukung daftar terbitan, sampul, materi HTML, audio, serta unduhan audio.
- Galeri menggabungkan foto acara dan sampul Selasanan.
- Tidak ada tema gelap yang dibutuhkan untuk pengalaman publik berbasis konten.

## Brand Commitments

- Nama resmi: Pondok Pesantren Al-Anwar Pakijangan.
- Slogan: Mendampingi Potensi, Membentuk Karakter.
- Bahasa antarmuka utama: Bahasa Indonesia yang profesional dan ringkas.
- Aset identitas yang dipertahankan: `public/images/logo.webp` dan `public/images/logoarab.webp`.
- Warna hijau identitas yang sudah digunakan pada situs dipertahankan sebagai warna institusi, dengan pengembangan sistem visual yang lebih matang.

## Evidence on Hand

- Foto utama pesantren: `public/images/landingpage/bgppdb.png`.
- Logo lembaga: `public/images/logo.webp` dan `public/images/logoarab.webp`.
- Konten artikel, kategori, rutinan, pengumuman, acara, galeri, serta Selasanan berasal dari model dan basis data aplikasi.
- Informasi profil, alamat, nomor telepon, media sosial, pendaftaran, persyaratan, dan biaya tersedia pada frontend lama serta data SEO terstruktur.
- Tidak ada testimoni, statistik capaian, akreditasi, atau klaim jumlah santri yang tervalidasi di sumber yang diperiksa, sehingga tidak boleh ditambahkan.

## Product Principles

1. Informasi terpenting harus dapat ditemukan lebih cepat daripada pada tampilan lama.
2. Identitas pesantren hadir melalui materi dan tipografi yang tertib, bukan ornamen generik.
3. Data dinamis dan konten resmi menjadi sumber kebenaran utama.
4. Pengalaman membaca artikel dan kajian tetap tenang, fokus, dan mudah dibagikan.
5. Tata letak seluler merupakan komposisi khusus, bukan versi desktop yang diperkecil.

## Accessibility & Inclusion

Antarmuka publik menggunakan struktur HTML semantik, fokus keyboard yang terlihat, kontras setidaknya WCAG AA, label kontrol berbahasa Indonesia, dan target sentuh minimum 44 piksel. Gerak visual dibatasi pada transisi fungsional serta menghormati preferensi pengurangan gerak.
