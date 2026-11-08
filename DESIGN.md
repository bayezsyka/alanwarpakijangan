---
name: Pondok Pesantren Al-Anwar Pakijangan
description: Sistem visual arsip editorial pesantren yang hangat, tertib, dan berakar pada kegiatan nyata.
colors:
  hijau-hutan: "#0b3028"
  hijau-institusi: "#104438"
  hijau-terbitan: "#1c6a55"
  gading-hangat: "#f6f0e3"
  kertas: "#fffdf8"
  tinta: "#18231f"
  kuningan: "#b9924b"
  kuningan-fokus: "#d5af64"
  permukaan-sage: "#e9eee9"
  garis-arsip: "#d8d2c6"
  teks-sekunder: "#52665e"
typography:
  display:
    fontFamily: "Newsreader, Georgia, serif"
    fontSize: "clamp(3.2rem, 8vw, 6.5rem)"
    fontWeight: 600
    lineHeight: 0.88
    letterSpacing: "-0.035em"
  headline:
    fontFamily: "Newsreader, Georgia, serif"
    fontSize: "3rem"
    fontWeight: 600
    lineHeight: 1
    letterSpacing: "-0.025em"
  title:
    fontFamily: "Newsreader, Georgia, serif"
    fontSize: "2rem"
    fontWeight: 600
    lineHeight: 1.2
    letterSpacing: "-0.025em"
  body:
    fontFamily: "Instrument Sans, sans-serif"
    fontSize: "1rem"
    fontWeight: 400
    lineHeight: 1.75
  label:
    fontFamily: "Instrument Sans, sans-serif"
    fontSize: "0.875rem"
    fontWeight: 600
    lineHeight: 1.5
rounded:
  none: "0px"
  sm: "6px"
  md: "8px"
  lg: "12px"
  full: "9999px"
spacing:
  xs: "8px"
  sm: "12px"
  md: "16px"
  lg: "24px"
  xl: "32px"
  section-sm: "48px"
  section-md: "64px"
  section-lg: "96px"
  gutter-mobile: "20px"
  gutter-desktop: "32px"
components:
  button-primary:
    backgroundColor: "{colors.hijau-institusi}"
    textColor: "{colors.kertas}"
    typography: "{typography.label}"
    rounded: "{rounded.sm}"
    padding: "12px 24px"
    height: "48px"
  button-primary-hover:
    backgroundColor: "{colors.hijau-hutan}"
    textColor: "{colors.kertas}"
  button-secondary:
    backgroundColor: "{colors.kertas}"
    textColor: "{colors.hijau-institusi}"
    typography: "{typography.label}"
    rounded: "{rounded.sm}"
    padding: "12px 16px"
    height: "44px"
  input-search:
    backgroundColor: "{colors.kertas}"
    textColor: "{colors.tinta}"
    typography: "{typography.body}"
    rounded: "{rounded.sm}"
    padding: "12px 16px 12px 48px"
    height: "48px"
  schedule-node-active:
    backgroundColor: "{colors.hijau-institusi}"
    textColor: "{colors.kertas}"
    typography: "{typography.label}"
    rounded: "{rounded.full}"
    size: "48px"
    notificationColor: "{colors.kuningan-fokus}"
  card-featured:
    backgroundColor: "{colors.permukaan-sage}"
    textColor: "{colors.tinta}"
    rounded: "{rounded.none}"
    padding: "32px"
---

# Design System: Pondok Pesantren Al-Anwar Pakijangan

## Overview

**Creative North Star: "Arsip Hidup Pesantren"**

Arsip Hidup Pesantren menempatkan situs sebagai catatan institusi yang terus bergerak melalui jadwal, terbitan, kajian, foto, dan informasi pendaftaran. Bidang warna yang mantap, tipografi editorial, garis tipis, serta foto pesantren dan kegiatan nyata memberi bobot kelembagaan tanpa menjadikannya landing page promosi generik.

Sistem ini terasa hangat, tertib, dan berwibawa. Komposisi bergerak antara bidang penuh, daftar berlapis garis, grid foto, dan kolom baca yang tenang. Hijau hutan membangun identitas, gading dan kertas menjaga kehangatan, sedangkan kuningan dipakai jarang sebagai penanda perhatian. Dials sistem: **ENERGY 2 / RHYTHM 3 / MOTION 1**.

**Key Characteristics:**

- Arsip editorial yang mengutamakan bukti kegiatan dan terbitan nyata.
- Hierarki kuat melalui bidang hijau, skala judul besar, dan komposisi asimetris.
- Garis arsip tipis sebagai struktur, bukan tumpukan card berbayang.
- Gerak terbatas pada perubahan keadaan, umpan balik, dan pembesaran gambar yang halus.
- Tata letak seluler dengan target sentuh sekurang-kurangnya 44 piksel.

## Colors

Palet mengambil karakter dari hijau institusi pesantren, kertas arsip yang hangat, tinta gelap, dan kuningan yang dipakai sebagai aksen terukur.

### Primary

- **Hijau Hutan:** Bidang institusi paling pekat untuk hero, footer, overlay gelap, dan keadaan hover yang membutuhkan bobot tertinggi.
- **Hijau Institusi:** Warna tindakan utama, tab aktif, panel terbitan, ikon audio, dan tautan operasional.
- **Hijau Terbitan:** Aksen kategori, metadata, serta keadaan hover pada judul dan tautan editorial.

### Secondary

- **Gading Hangat:** Bidang pengantar, header artikel, area agenda, dan tombol terang di atas latar hijau.
- **Kuningan:** Penanda perhatian pada ikon, garis kutipan, kemajuan baca, dan detail institusional yang perlu dibedakan tanpa menjadi warna tindakan utama.

### Neutral

- **Kertas:** Kanvas utama dan permukaan kontrol.
- **Tinta:** Teks utama dengan kontras tinggi.
- **Permukaan Sage:** Lapisan informasi sekunder, panel media, dan bidang editorial lembut.
- **Garis Arsip:** Pemisah daftar, batas section, dan struktur grid.
- **Teks Sekunder:** Isi pendamping dan metadata yang tetap terbaca di atas permukaan terang.

### Named Rules

**The Institutional Green Rule.** Hijau menjadi identitas dan hierarki, bukan warna dekoratif yang disebar ke setiap elemen.

**The Brass Accent Rule.** Kuningan hanya menandai momen penting seperti fokus, progres, ikon pengantar, atau garis kutipan.

**The Warm Paper Rule.** Latar terang tetap hangat; putih dingin tidak menjadi kanvas utama.

## Typography

**Display Font:** Newsreader (with Georgia and serif fallback)  
**Body Font:** Instrument Sans (with sans-serif fallback)

**Character:** Newsreader membawa nada kitab, jurnal, dan terbitan tanpa terasa ornamental. Instrument Sans menjaga jadwal, metadata, navigasi, formulir, dan informasi biaya tetap lugas serta mudah dipindai.

### Hierarchy

- **Display** (600, fluid 51.2-104px, line-height 0.88): Judul hero beranda dan momen identitas utama; dipakai hanya sekali pada satu layar.
- **Headline** (600, 48px pada layar besar, line-height 1): Judul halaman dan section utama, turun ke 36px pada layar kecil.
- **Title** (600, sekitar 32px, line-height 1.2): Judul terbitan unggulan, dialog, dan blok informasi utama.
- **Body** (400, 16px, line-height 1.75): Informasi umum; prosa artikel menggunakan ukuran cair hingga 18px, line-height 1.85, dan lebar maksimum 72ch.
- **Label** (600, 14px, line-height 1.5): Navigasi, tombol, kategori, tanggal, dan kontrol. Kapitalisasi mengikuti kalimat, bukan uppercase dengan tracking lebar.

### Named Rules

**The Editorial Voice Rule.** Newsreader menyuarakan identitas dan isi terbitan; Instrument Sans menangani operasi dan metadata.

**The One Display Rule.** Setiap viewport memiliki satu fokus tipografis utama; judul lain turun satu atau lebih tingkat.

## Layout

Kanvas menggunakan container terpusat dengan lebar maksimum 76rem. Gutter horizontal berukuran 32px pada layar umum dan 20px di bawah 640px. Ritme section umumnya 64px pada layar kecil dan meningkat hingga 96px pada layar besar, dengan jeda 48px untuk blok yang lebih ringkas.

Komposisi desktop memakai grid asimetris seperti 0.8/1.6, 0.55/1.45, dan 1.25/0.75 agar hierarki mengikuti isi, bukan pola kartu seragam. Pada layar kecil, kolom ditumpuk, tindakan menjadi vertikal bila perlu, filter dan tab dapat digulir horizontal, dan target sentuh dipertahankan sekurang-kurangnya 44px. Breakpoint yang benar-benar dipakai adalah 640px, 768px, dan 1024px.

Beranda memakai foto pesantren sebagai bukti utama di samping bidang hijau. Halaman indeks memberi ruang lebih besar pada terbitan pertama. Detail artikel dan Selasanan menyempit menjadi kolom baca maksimum 72ch, sementara galeri memakai perbedaan skala gambar untuk membangun urutan pandang.

**The Content-Led Grid Rule.** Rasio kolom berubah mengikuti bobot konten, bukan diseragamkan antarseksi.

**The Mobile Composition Rule.** Tata letak seluler disusun ulang menjadi alur tunggal yang jelas, bukan sekadar versi desktop yang dikecilkan.

## Elevation & Depth

Sistem bersifat datar secara default. Kedalaman terutama dibentuk oleh pergantian bidang hijau, gading, kertas, dan sage, ditambah garis arsip sebagai pemisah. Shadow hanya muncul ketika elemen benar-benar berada di atas lapisan lain: header setelah bergulir, dialog, toast, mode pratinjau, dan label jumlah foto.

### Shadow Vocabulary

- **Navigasi Melekat** (`0 10px 30px rgba(11,48,40,0.08)`): Memisahkan header dari isi setelah latarnya berubah menjadi kertas.
- **Label Melayang** (`0 10px 30px rgba(11,48,40,0.16)`): Memberi keterbacaan pada jumlah foto di atas montase gambar.
- **Dialog** (`0 24px 80px rgba(0,0,0,0.35)`): Menegaskan modal di atas overlay hijau gelap.

### Named Rules

**The Flat Archive Rule.** Surface tetap datar pada keadaan normal; shadow hanya menandai lapisan yang benar-benar mengambang.

## Shapes

Bentuk dasar bersudut tegas untuk section, grid, daftar, dan card editorial. Kontrol utama memakai lengkung kecil 6px, media baca memakai 8px, dan dialog pengumuman memakai 12px. Bentuk bulat penuh terbatas pada wadah logo, tombol ikon tutup, ikon audio, dan ikon sosial yang memang membutuhkan siluet kompak.

Foto galeri dan terbitan umumnya dipotong persegi atau 4:3 tanpa radius. Potongan sudut diagonal tersedia sebagai motif gambar khusus, tetapi bukan bentuk default seluruh media.

**The Rectangular Archive Rule.** Struktur editorial memakai sudut tegas; radius tidak boleh mengubah seluruh antarmuka menjadi kumpulan kapsul.

## Components

### Buttons

- **Shape:** Lengkung kecil (6px) dengan tinggi 44px atau 48px sesuai kepentingan tindakan.
- **Primary:** Hijau Institusi di atas teks Kertas, padding horizontal 20-24px, dan bobot 600.
- **Hover / Focus:** Hover berpindah ke Hijau Hutan; fokus memakai outline Kuningan Fokus setebal 3px dengan offset 3px.
- **Secondary / Ghost:** Permukaan Kertas dengan border netral atau transparan di atas bidang hijau. Tindakan teks memakai underline saat hover dan tidak dipaksa menjadi tombol berisi.

### Chips

- **Style:** Filter kategori berbentuk tab garis bawah, bukan kapsul. Hari agenda ditempatkan sebagai node tanggal pada satu garis waktu tujuh hari tanpa gulir horizontal.
- **State:** Node aktif memakai Hijau Institusi penuh, hari ini memakai garis hijau, dan jumlah kegiatan ditampilkan sebagai penanda angka kecil. Hover, fokus, dan sentuhan membuka lembar rincian di bawah garis waktu.

### Cards / Containers

- **Corner Style:** Umumnya tanpa radius agar terasa seperti lembar arsip dan susunan terbitan.
- **Background:** Kertas untuk isi umum, Permukaan Sage untuk terbitan unggulan, atau Hijau Institusi untuk kajian utama.
- **Shadow Strategy:** Tidak ada shadow pada card biasa; kedalaman dibangun dengan warna, garis, dan skala gambar.
- **Border:** Garis tipis pada pemisah metadata, daftar, dan grid.
- **Internal Padding:** 24-32px pada layar kecil hingga 40-48px pada terbitan unggulan layar besar.

### Inputs / Fields

- **Style:** Permukaan Kertas, border hangat, radius 6px, tinggi minimum 48px, dan placeholder abu-hijau.
- **Focus:** Border dan ring bergeser ke Hijau Institusi, lalu outline fokus global tetap terlihat.
- **Error / Disabled:** Source publik saat ini belum menetapkan pola khusus; jangan mengada-adakan varian sebelum kebutuhan nyata muncul.

### Navigation

Header menyatu dengan hero dalam keadaan transparan, lalu berubah menjadi Kertas semiopak dengan border dan shadow ringan setelah bergulir. Tautan desktop berukuran 14px dengan target sentuh minimum 44px. Navigasi seluler memakai daftar satu kolom, divider, tombol Menu yang eksplisit, dan tindakan pendaftaran penuh di bagian bawah.

### Editorial Publication

Terbitan unggulan menggabungkan gambar besar dan bidang informasi berwarna dengan hierarki yang tidak simetris. Daftar artikel sekunder memakai thumbnail tetap, label kategori, judul Newsreader, serta metadata di bawah garis. Gambar hanya membesar sangat halus pada hover selama 500ms.

### Dialog

Dialog pengumuman dan galeri menggunakan overlay hijau sangat gelap, permukaan Kertas, judul editorial, tombol tutup bulat 44px, dan fokus awal pada kontrol tutup. Dialog dapat ditutup dengan Escape dan menjaga isi tetap dapat digulir pada viewport pendek.

## Do's and Don'ts

### Do:

- **Do** gunakan foto pesantren, kegiatan, sampul, dan terbitan nyata sebagai bukti visual utama.
- **Do** gunakan garis arsip, pembagian bidang, dan perubahan skala untuk membentuk hierarki sebelum menambahkan shadow.
- **Do** pertahankan satu fokus dominan pada setiap layar dan beri ruang pada judul editorial.
- **Do** variasikan komposisi section sesuai jadwal, bacaan, galeri, atau informasi operasional yang dibawanya.
- **Do** pertahankan target sentuh minimum 44px, fokus yang terlihat, dan dukungan pengurangan gerak.

### Don't:

- **Don't** ubah situs menjadi landing promosi dengan heading, subtitle, dan grid card seragam pada setiap section.
- **Don't** gunakan badge eyebrow kapsul, label uppercase dengan tracking lebar, atau microcopy yang hanya mengulang judul.
- **Don't** gunakan gradien neon ungu, glow generik, atau shadow pada setiap container.
- **Don't** gunakan radius besar pada card, input, tombol, dan label secara bersamaan.
- **Don't** menambahkan statistik, testimoni, klaim, foto, atau program yang tidak memiliki sumber nyata.
