<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Lengkap - Pondok Pesantren Al-Anwar Pakijangan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        secondary: '#008362',
                        dark: '#1a1a1a',
                    },
                    fontFamily: {
                        'sans': ['Poppins', 'sans-serif'],
                    },
                    boxShadow: {
                        'card': '0 20px 45px rgba(0, 131, 98, 0.18)',
                        'soft': '0 10px 30px rgba(15, 23, 42, 0.10)',
                    }
                }
            }
        }
    </script>
    <style>
        .gradient-text {
            background: linear-gradient(90deg, #008362 0%, #00a381 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        .section-divider {
            position: relative;
            height: 48px;
            overflow: hidden;
        }
        .section-divider::before {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            height: 100%;
            background: linear-gradient(135deg, #00836211 0%, transparent 70%);
            transform: skewY(-2deg);
            transform-origin: top left;
        }
        .hero-orbit {
            position: absolute;
            width: 480px;
            height: 480px;
            border-radius: 999px;
            border: 1px solid rgba(148, 163, 184, 0.35);
            top: -120px;
            right: -120px;
            pointer-events: none;
        }
        .hero-orbit::before {
            content: "";
            position: absolute;
            inset: 20%;
            border-radius: inherit;
            border: 1px dashed rgba(148, 163, 184, 0.25);
        }
        .blur-pill {
            filter: blur(40px);
            opacity: 0.55;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans text-gray-800 antialiased">
    <!-- Header & Hero -->
    <header class="relative overflow-hidden bg-white">
        <div class="absolute inset-0 bg-gradient-to-br from-white via-emerald-50/70 to-blue-50/60"></div>
        <div class="hero-orbit hidden md:block"></div>
        <div class="absolute blur-pill bg-secondary/15 w-40 h-40 rounded-full -left-10 top-32"></div>
        <div class="absolute blur-pill bg-blue-400/15 w-40 h-40 rounded-full right-4 bottom-6"></div>

        <div class="relative z-10 max-w-6xl mx-auto px-6 pt-6 pb-20 md:pt-8 md:pb-24">
            <!-- Top nav -->
            <nav class="flex items-center justify-between mb-10 md:mb-14">
                <a href="/" class="inline-flex items-center gap-2 text-sm text-secondary hover:text-secondary/80 transition-colors">
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-white shadow-soft border border-gray-100">
                        <i class="fas fa-arrow-left text-xs"></i>
                    </span>
                    <span class="font-medium">Kembali ke Beranda</span>
                </a>

                <div class="hidden sm:flex items-center gap-3 text-xs text-gray-600 bg-white/80 px-3 py-1.5 rounded-full border border-gray-200 shadow-sm">
                    <span class="inline-flex items-center gap-1.5">
                        <i class="fas fa-location-dot text-[11px] text-secondary"></i>
                        Pakijangan, Brebes
                    </span>
                    <span class="w-px h-4 bg-gray-200"></span>
                    <span class="inline-flex items-center gap-1.5">
                        <i class="fas fa-mosque text-[11px] text-secondary"></i>
                        Kubah Jawa
                    </span>
                </div>
            </nav>

            <!-- Hero content -->
            <div class="grid md:grid-cols-[1.5fr,1.2fr] gap-10 items-center">
                <div>
                    <div class="inline-flex items-center gap-2 bg-white/80 border border-secondary/15 px-3 py-1 rounded-full text-xs text-secondary font-medium shadow-sm mb-4">
                        <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-secondary/10 text-secondary">
                            <i class="fas fa-star text-[10px]"></i>
                        </span>
                        Lembaga Pendidikan Islam Berbasis Salaf Modern
                    </div>

                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-dark mb-4 leading-tight">
                        Pondok Pesantren <span class="gradient-text">Al-Anwar</span>
                    </h1>
                    <p class="text-base sm:text-lg text-gray-700 mb-6 max-w-xl">
                        Pusat pendidikan, pembinaan akhlak, dan pengembangan potensi santri
                        yang menyeimbangkan tradisi keilmuan klasik dengan kebutuhan zaman.
                    </p>

                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mb-7">
                        <div class="bg-white rounded-2xl px-4 py-3 border border-gray-200 shadow-soft">
                            <p class="text-[11px] uppercase tracking-wide text-secondary/80 mb-1 font-semibold">Model Kurikulum</p>
                            <p class="text-sm font-semibold text-dark">Salaf Modern</p>
                        </div>
                        <div class="bg-white rounded-2xl px-4 py-3 border border-gray-200 shadow-soft">
                            <p class="text-[11px] uppercase tracking-wide text-secondary/80 mb-1 font-semibold">Jenjang Formal</p>
                            <p class="text-sm font-semibold text-dark">SMP</p>
                        </div>
                        <div class="bg-white rounded-2xl px-4 py-3 border border-gray-200 shadow-soft">
                            <p class="text-[11px] uppercase tracking-wide text-secondary/80 mb-1 font-semibold">Non Formal</p>
                            <p class="text-sm font-semibold text-dark">Madrasah Diniyah</p>
                        </div>
                    </div>
                </div>

                <!-- Highlight card -->
                <div class="bg-white/90 border border-gray-200 rounded-3xl p-5 sm:p-6 lg:p-7 shadow-card">
                    <div class="flex items-center justify-between gap-3 mb-4">
                        <div>
                            <p class="text-[11px] font-semibold tracking-[0.18em] uppercase text-secondary/80 mb-1">Identitas Singkat</p>
                            <p class="text-base sm:text-lg font-semibold text-dark">Pondok Pesantren Al-Anwar Pakijangan</p>
                            <p class="text-xs text-gray-500 mt-1">
                                Dikenal luas sebagai <span class="font-semibold text-secondary">"Kubah Jawa"</span>
                            </p>
                        </div>
                        <div class="hidden sm:flex items-center justify-center w-14 h-14 rounded-2xl bg-secondary/5 text-secondary border border-secondary/25">
                            <i class="fas fa-mosque text-xl"></i>
                        </div>
                    </div>

                    <div class="grid gap-4 text-sm mb-5">
                        <div class="flex gap-3">
                            <span class="mt-1 inline-flex items-center justify-center w-8 h-8 rounded-2xl bg-secondary/5 border border-secondary/20 text-secondary">
                                <i class="fas fa-user-tie text-xs"></i>
                            </span>
                            <div>
                                <p class="text-[11px] uppercase tracking-wide text-gray-500 font-semibold">Pendiri</p>
                                <p class="text-sm font-medium text-dark">KH. Anwar Mukhtar</p>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <span class="mt-1 inline-flex items-center justify-center w-8 h-8 rounded-2xl bg-secondary/5 border border-secondary/20 text-secondary">
                                <i class="fas fa-user-graduate text-xs"></i>
                            </span>
                            <div>
                                <p class="text-[11px] uppercase tracking-wide text-gray-500 font-semibold">Pimpinan / Pengasuh</p>
                                <p class="text-sm font-medium text-dark">KH. Muhammad Miftah</p>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <span class="mt-1 inline-flex items-center justify-center w-8 h-8 rounded-2xl bg-secondary/5 border border-secondary/20 text-secondary">
                                <i class="fas fa-location-dot text-xs"></i>
                            </span>
                            <div>
                                <p class="text-[11px] uppercase tracking-wide text-gray-500 font-semibold">Alamat</p>
                                <p class="text-xs sm:text-sm text-gray-700">
                                    Jalan Raya Pakijangan-Bulakamba No. 08, RT/RW 04/02, Brebes, Jawa Tengah
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-4 mt-2">
                        <p class="text-[11px] uppercase tracking-[0.2em] text-gray-500 font-semibold mb-2">Kontak</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs sm:text-sm text-gray-700">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-phone-alt text-secondary text-xs w-4"></i>
                                <span>085161603362</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-envelope text-secondary text-xs w-4"></i>
                                <span>ppkubahjawa@gmail.com</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-globe text-secondary text-xs w-4"></i>
                                <span>alanwarpakijangan.com</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fab fa-instagram text-secondary text-xs w-4"></i>
                                <span>@pesantrenalanwar</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Curve divider -->
    <div class="section-divider bg-gray-50">
        <div class="absolute inset-x-0 bottom-0 h-6 bg-gray-50 rounded-t-[32px]"></div>
    </div>

    <main class="relative -mt-10 md:-mt-16 pb-16 md:pb-24">
        <div class="max-w-6xl mx-auto px-6">
            <!-- Main wrapper -->
            <div class="bg-white border border-gray-200 rounded-[32px] p-5 sm:p-7 lg:p-8 shadow-soft space-y-16">
                <!-- Identity Section -->
                <section id="identitas" class="scroll-mt-28">
                    <div class="flex flex-wrap items-center gap-4 mb-8">
                        <div class="inline-flex items-center gap-2 bg-secondary/5 border border-secondary/20 text-secondary px-3 py-1 rounded-full text-xs font-medium">
                            <span class="w-5 h-5 rounded-full bg-secondary/10 flex items-center justify-center">
                                <i class="fas fa-id-card text-[11px]"></i>
                            </span>
                            Identitas & Legalitas
                        </div>
                        <div class="h-px flex-1 bg-gradient-to-r from-secondary/60 via-secondary/10 to-transparent"></div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6 lg:gap-8">
                        <div class="bg-white rounded-2xl p-5 sm:p-6 border border-gray-200 shadow-soft hover:-translate-y-1 hover:shadow-card transition-all duration-300">
                            <h2 class="text-xl sm:text-2xl font-semibold text-dark mb-5 flex items-center gap-2">
                                <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-secondary/5 text-secondary border border-secondary/25">
                                    <i class="fas fa-building-columns text-sm"></i>
                                </span>
                                Identitas Lembaga
                            </h2>
                            <div class="space-y-4 text-sm sm:text-base">
                                <div class="flex gap-3">
                                    <span class="w-1 rounded-full bg-secondary/80"></span>
                                    <div>
                                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Nama Resmi</p>
                                        <p class="font-medium text-dark">Pondok Pesantren Al-Anwar Pakijangan</p>
                                    </div>
                                </div>
                                <div class="flex gap-3">
                                    <span class="w-1 rounded-full bg-secondary/60"></span>
                                    <div>
                                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Julukan</p>
                                        <p class="font-medium text-dark">Kubah Jawa</p>
                                    </div>
                                </div>
                                <div class="flex gap-3">
                                    <span class="w-1 rounded-full bg-secondary/60"></span>
                                    <div>
                                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Pendiri</p>
                                        <p class="font-medium text-dark">KH. Anwar Mukhtar</p>
                                    </div>
                                </div>
                                <div class="flex gap-3">
                                    <span class="w-1 rounded-full bg-secondary/60"></span>
                                    <div>
                                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Pimpinan / Pengasuh</p>
                                        <p class="font-medium text-dark">KH. Muhammad Miftah</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl p-5 sm:p-6 border border-gray-200 shadow-soft hover:-translate-y-1 hover:shadow-card transition-all duration-300">
                            <h2 class="text-xl sm:text-2xl font-semibold text-dark mb-5 flex items-center gap-2">
                                <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-secondary/5 text-secondary border border-secondary/25">
                                    <i class="fas fa-map-location-dot text-sm"></i>
                                </span>
                                Alamat & Kontak
                            </h2>
                            <div class="space-y-4 text-sm sm:text-base">
                                <div>
                                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Alamat</p>
                                    <p class="text-gray-700">
                                        Jalan Raya Pakijangan-Bulakamba No. 08, RT/RW 04/02,<br>
                                        Brebes, Jawa Tengah
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-3">Kontak</p>
                                    <ul class="space-y-2 text-gray-700">
                                        <li class="flex items-center gap-3">
                                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-secondary/5 text-secondary border border-secondary/25">
                                                <i class="fas fa-phone-alt text-xs"></i>
                                            </span>
                                            <span>085161603362</span>
                                        </li>
                                        <li class="flex items-center gap-3">
                                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-secondary/5 text-secondary border border-secondary/25">
                                                <i class="fas fa-envelope text-xs"></i>
                                            </span>
                                            <span>ppkubahjawa@gmail.com</span>
                                        </li>
                                        <li class="flex items-center gap-3">
                                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-secondary/5 text-secondary border border-secondary/25">
                                                <i class="fas fa-globe text-xs"></i>
                                            </span>
                                            <span>alanwarpakijangan.com</span>
                                        </li>
                                        <li class="flex items-center gap-3">
                                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-secondary/5 text-secondary border border-secondary/25">
                                                <i class="fab fa-instagram text-xs"></i>
                                            </span>
                                            <span>@pesantrenalanwar</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Vision & Mission Section -->
                <section id="visi-misi" class="scroll-mt-28">
                    <div class="flex flex-wrap items-center gap-4 mb-8">
                        <div class="inline-flex items-center gap-2 bg-secondary/5 border border-secondary/20 text-secondary px-3 py-1 rounded-full text-xs font-medium">
                            <span class="w-5 h-5 rounded-full bg-secondary/10 flex items-center justify-center">
                                <i class="fas fa-seedling text-[11px]"></i>
                            </span>
                            Landasan Filosofis & Spiritual
                        </div>
                        <div class="h-px flex-1 bg-gradient-to-r from-secondary/60 via-secondary/10 to-transparent"></div>
                    </div>

                    <div class="space-y-8">
                        <div class="bg-gradient-to-r from-secondary/5 via-secondary/0 to-transparent rounded-2xl p-5 sm:p-7 border border-secondary/15 shadow-soft">
                            <div class="flex flex-col sm:flex-row sm:items-start gap-4">
                                <div class="bg-white border border-secondary/30 p-3 rounded-xl text-secondary self-start shadow-sm">
                                    <i class="fas fa-eye text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-dark mb-2">Visi</h3>
                                    <p class="text-sm sm:text-base text-gray-700 italic leading-relaxed">
                                        "Menjadi lembaga yang menumbuhkan potensi setiap santri secara personal dan reflektif,
                                        membentuk karakter yang kokoh dan bijaksana, serta menguatkan ilmu sebagai cahaya hidup
                                        yang menuntun mereka menapaki jalan dunia dan akhirat secara seimbang dan bermakna."
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl p-5 sm:p-7 border border-gray-200 shadow-soft">
                            <div class="flex flex-col sm:flex-row sm:items-start gap-4 mb-5">
                                <div class="bg-secondary/5 border border-secondary/30 p-3 rounded-xl text-secondary self-start">
                                    <i class="fas fa-bullseye text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-dark">Misi</h3>
                                    <p class="text-sm text-gray-500 mt-1">
                                        Rangkaian misi yang menjiwai seluruh aktivitas pendidikan di pesantren.
                                    </p>
                                </div>
                            </div>

                            <ol class="space-y-4">
                                <li class="flex gap-4">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <div class="h-9 w-9 rounded-full bg-secondary/5 border border-secondary/30 flex items-center justify-center text-secondary font-bold text-sm">
                                            1
                                        </div>
                                    </div>
                                    <p class="text-sm sm:text-base text-gray-700">
                                        Mengembangkan sistem pendidikan yang holistik dan terpadu, yang mengoptimalkan potensi spiritual,
                                        intelektual, emocional, dan keterampilan santri melalui pendekatan pembelajaran yang reflektif dan bermakna.
                                    </p>
                                </li>
                                <li class="flex gap-4">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <div class="h-9 w-9 rounded-full bg-secondary/5 border border-secondary/30 flex items-center justify-center text-secondary font-bold text-sm">
                                            2
                                        </div>
                                    </div>
                                    <p class="text-sm sm:text-base text-gray-700">
                                        Menyelenggarakan pembinaan akidah, ibadah, dan akhlak mulia yang kokoh dan konsisten, dengan menjadikan
                                        seluruh aspek kehidupan santri sebagai medan pendidikan ruhani.
                                    </p>
                                </li>
                                <li class="flex gap-4">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <div class="h-9 w-9 rounded-full bg-secondary/5 border border-secondary/30 flex items-center justify-center text-secondary font-bold text-sm">
                                            3
                                        </div>
                                    </div>
                                    <p class="text-sm sm:text-base text-gray-700">
                                        Menanamkan nilai-nilai kemandirian, kepedulian, kedisiplinan, dan kejujuran melalui budaya pembiasaan,
                                        keteladanan, serta relasi keseharian yang bermansa tarbawi.
                                    </p>
                                </li>
                                <li class="flex gap-4">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <div class="h-9 w-9 rounded-full bg-secondary/5 border border-secondary/30 flex items-center justify-center text-secondary font-bold text-sm">
                                            4
                                        </div>
                                    </div>
                                    <p class="text-sm sm:text-base text-gray-700">
                                        Mendorong pola pikir inovatif, adaptif, dan reflektif dalam diri santri agar mampu menghadapi tantangan zaman
                                        dengan kecakapan berpikir yang berlandaskan ajaran Islam.
                                    </p>
                                </li>
                                <li class="flex gap-4">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <div class="h-9 w-9 rounded-full bg-secondary/5 border border-secondary/30 flex items-center justify-center text-secondary font-bold text-sm">
                                            5
                                        </div>
                                    </div>
                                    <p class="text-sm sm:text-base text-gray-700">
                                        Menguatkan tradisi kelimuan dan literasi sebagai bagian dari ibadah dan jalan menuju kemuliaan dunia dan
                                        keselamatan akhirat, melalui pembelajaran aktif dan berkesadaran.
                                    </p>
                                </li>
                                <li class="flex gap-4">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <div class="h-9 w-9 rounded-full bg-secondary/5 border border-secondary/30 flex items-center justify-center text-secondary font-bold text-sm">
                                            6
                                        </div>
                                    </div>
                                    <p class="text-sm sm:text-base text-gray-700">
                                        Menyelenggarakan sistem pendampingan individu yang mendalam dan berkelanjutan untuk menggali, membina,
                                        dan mengarahkan potensi unik setiap santri.
                                    </p>
                                </li>
                                <li class="flex gap-4">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <div class="h-9 w-9 rounded-full bg-secondary/5 border border-secondary/30 flex items-center justify-center text-secondary font-bold text-sm">
                                            7
                                        </div>
                                    </div>
                                    <p class="text-sm sm:text-base text-gray-700">
                                        Memberkali santri dengan keterampilan berdakwah, kemampuan berkomunikasi, berpikir sistemik, dan
                                        berkontribusi positif di tengah masyarakat dengan tetap menjaga identitas keislamannya.
                                    </p>
                                </li>
                                <li class="flex gap-4">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <div class="h-9 w-9 rounded-full bg-secondary/5 border border-secondary/30 flex items-center justify-center text-secondary font-bold text-sm">
                                            8
                                        </div>
                                    </div>
                                    <p class="text-sm sm:text-base text-gray-700">
                                        Membentuk komunitas belajar yang sehat, terbuka, dan suportif, tempat santri merasa dihargai, tertantang
                                        untuk bertumbuh, dan terbiasa menilai keberhasilan dari proses, bukan semata hasil.
                                    </p>
                                </li>
                            </ol>
                        </div>
                    </div>
                </section>

                <!-- Education System Section -->
                <section id="pendidikan" class="scroll-mt-28">
                    <div class="flex flex-wrap items-center gap-4 mb-8">
                        <div class="inline-flex items-center gap-2 bg-secondary/5 border border-secondary/20 text-secondary px-3 py-1 rounded-full text-xs font-medium">
                            <span class="w-5 h-5 rounded-full bg-secondary/10 flex items-center justify-center">
                                <i class="fas fa-graduation-cap text-[11px]"></i>
                            </span>
                            Sistem & Program Pendidikan
                        </div>
                        <div class="h-px flex-1 bg-gradient-to-r from-secondary/60 via-secondary/10 to-transparent"></div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6 lg:gap-8 mb-7">
                        <!-- Nilai Utama -->
                        <div class="bg-white rounded-2xl p-5 sm:p-6 border border-gray-200 shadow-soft">
                            <div class="flex items-center gap-3 mb-5">
                                <div class="bg-secondary/5 p-3 rounded-xl text-secondary border border-secondary/25">
                                    <i class="fas fa-star text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-dark">Nilai-Nilai Utama</h3>
                                    <p class="text-xs text-gray-500 mt-1">Karakter dasar yang dibangun dalam diri setiap santri.</p>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div class="flex gap-3">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <div class="bg-secondary/5 p-2 rounded-full text-secondary border border-secondary/25">
                                            <i class="fas fa-user-shield text-xs"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-dark text-sm sm:text-base">Kemandirian</h4>
                                        <p class="text-xs sm:text-sm text-gray-600">
                                            Santri diajarkan untuk mandiri, menghadapi cepatnya perkembangan zaman dengan tetap memegang teguh
                                            prinsip-prinsip agama.
                                        </p>
                                    </div>
                                </div>
                                <div class="flex gap-3">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <div class="bg-secondary/5 p-2 rounded-full text-secondary border border-secondary/25">
                                            <i class="fas fa-hands-helping text-xs"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-dark text-sm sm:text-base">Kepedulian</h4>
                                        <p class="text-xs sm:text-sm text-gray-600">
                                            Santri memiliki rasa kepedulian, kasih sayang yang tinggi terhadap sesama manusia.
                                        </p>
                                    </div>
                                </div>
                                <div class="flex gap-3">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <div class="bg-secondary/5 p-2 rounded-full text-secondary border border-secondary/25">
                                            <i class="fas fa-clock text-xs"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-dark text-sm sm:text-base">Kedisiplinan</h4>
                                        <p class="text-xs sm:text-sm text-gray-600">
                                            Santri memiliki sifat yang tegas, profesional, dan menghargai waktu.
                                        </p>
                                    </div>
                                </div>
                                <div class="flex gap-3">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <div class="bg-secondary/5 p-2 rounded-full text-secondary border border-secondary/25">
                                            <i class="fas fa-hand-holding-heart text-xs"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-dark text-sm sm:text-base">Kejujuran</h4>
                                        <p class="text-xs sm:text-sm text-gray-600">
                                            Santri memiliki sifat jujur, amanah, dan dapat dipercaya.
                                        </p>
                                    </div>
                                </div>
                                <div class="flex gap-3">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <div class="bg-secondary/5 p-2 rounded-full text-secondary border border-secondary/25">
                                            <i class="fas fa-lightbulb text-xs"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-dark text-sm sm:text-base">Inovatif</h4>
                                        <p class="text-xs sm:text-sm text-gray-600">
                                            Santri memiliki pandangan terbuka dan mampu memperbaharui metode berdakwah seiring berkembangnya zaman.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Struktur Pendidikan -->
                        <div class="bg-white rounded-2xl p-5 sm:p-6 border border-gray-200 shadow-soft">
                            <div class="flex items-center gap-3 mb-5">
                                <div class="bg-secondary/5 p-3 rounded-xl text-secondary border border-secondary/25">
                                    <i class="fas fa-layer-group text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-dark">Struktur Pendidikan</h3>
                                    <p class="text-xs text-gray-500 mt-1">Integrasi kurikulum formal dan diniyah.</p>
                                </div>
                            </div>

                            <div class="space-y-4 text-sm sm:text-base">
                                <div>
                                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Model Kurikulum</p>
                                    <p class="font-medium text-dark">Salaf Modern</p>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Jenjang Pendidikan Formal</p>
                                    <p class="font-medium text-dark">SMP</p>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Pendidikan Non-Formal</p>
                                    <p class="font-medium text-dark">Madrasah Diniyah</p>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Program Unggulan</p>
                                    <ul class="mt-2 space-y-2 text-gray-700">
                                        <li class="flex items-center gap-2 text-sm">
                                            <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                                            <span>POTENSI (Program Orientasi Santri)</span>
                                        </li>
                                        <li class="flex items-center gap-2 text-sm">
                                            <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                                            <span>Ilmu Bahasa Arab (Nahwu Shorof)</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ekstrakurikuler -->
                    <div class="bg-white rounded-2xl p-5 sm:p-6 border border-gray-200 shadow-soft">
                        <div class="flex flex-col sm:flex-row sm:items-center gap-3 mb-6">
                            <div class="flex items-center gap-3">
                                <div class="bg-secondary/5 p-3 rounded-xl text-secondary border border-secondary/25">
                                    <i class="fas fa-futbol text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-dark">Ekstrakurikuler</h3>
                                    <p class="text-xs text-gray-500 mt-1">Ruang aktualisasi minat dan bakat santri.</p>
                                </div>
                            </div>
                        </div>

                        <div class="grid sm:grid-cols-3 gap-4">
                            <div class="bg-gradient-to-br from-secondary/5 via-white to-white p-5 rounded-2xl border border-secondary/20 text-center hover:-translate-y-1 hover:shadow-card transition-all">
                                <div class="bg-secondary/5 p-3 rounded-full inline-flex text-secondary mb-3 border border-secondary/25">
                                    <i class="fas fa-newspaper text-lg"></i>
                                </div>
                                <p class="font-semibold text-dark text-sm">Jurnalistik</p>
                                <p class="text-xs text-gray-600 mt-1">Melatih kemampuan menulis, observasi, dan publikasi.</p>
                            </div>
                            <div class="bg-gradient-to-br from-secondary/5 via-white to-white p-5 rounded-2xl border border-secondary/20 text-center hover:-translate-y-1 hover:shadow-card transition-all">
                                <div class="bg-secondary/5 p-3 rounded-full inline-flex text-secondary mb-3 border border-secondary/25">
                                    <i class="fas fa-laptop-code text-lg"></i>
                                </div>
                                <p class="font-semibold text-dark text-sm">Teknologi Informasi dan Komunikasi</p>
                                <p class="text-xs text-gray-600 mt-1">Mengenalkan literasi digital dan teknologi terkini.</p>
                            </div>
                            <div class="bg-gradient-to-br from-secondary/5 via-white to-white p-5 rounded-2xl border border-secondary/20 text-center hover:-translate-y-1 hover:shadow-card transition-all">
                                <div class="bg-secondary/5 p-3 rounded-full inline-flex text-secondary mb-3 border border-secondary/25">
                                    <i class="fas fa-flask text-lg"></i>
                                </div>
                                <p class="font-semibold text-dark text-sm">Sains</p>
                                <p class="text-xs text-gray-600 mt-1">Mengasah logika, eksperimen, dan rasa ingin tahu.</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Graduate Profile Section -->
                <section id="profil-lulusan" class="scroll-mt-28">
                    <div class="flex flex-wrap items-center gap-4 mb-8">
                        <div class="inline-flex items-center gap-2 bg-secondary/5 border border-secondary/20 text-secondary px-3 py-1 rounded-full text-xs font-medium">
                            <span class="w-5 h-5 rounded-full bg-secondary/10 flex items-center justify-center">
                                <i class="fas fa-user-graduate text-[11px]"></i>
                            </span>
                            Profil Lulusan & SDM
                        </div>
                        <div class="h-px flex-1 bg-gradient-to-r from-secondary/60 via-secondary/10 to-transparent"></div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6 lg:gap-8">
                        <div class="bg-white rounded-2xl p-5 sm:p-6 border border-gray-200 shadow-soft">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="bg-secondary/5 p-3 rounded-xl text-secondary border border-secondary/25">
                                    <i class="fas fa-user-graduate text-lg"></i>
                                </div>
                                <h3 class="text-xl font-semibold text-dark">Profil Santri (Target)</h3>
                            </div>
                            <p class="text-sm sm:text-base text-gray-700 leading-relaxed">
                                Santri yang diharapkan adalah pribadi mandiri dan adaptif terhadap perkembangan zaman, teguh memegang
                                prinsip agama. Mereka dicirikan oleh kepedulian sosial, kedisiplinan tinggi, serta kejujuran dan integritas.
                                Dengan pola pikir inovatif, santri mampu menciptakan solusi relevan dan memperbaharui pendekatan dakwah
                                selaras dengan konteks kekinian.
                            </p>
                        </div>

                        <div class="bg-white rounded-2xl p-5 sm:p-6 border border-gray-200 shadow-soft">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="bg-secondary/5 p-3 rounded-xl text-secondary border border-secondary/25">
                                    <i class="fas fa-award text-lg"></i>
                                </div>
                                <h3 class="text-xl font-semibold text-dark">Profil Lulusan Ideal</h3>
                            </div>
                            <p class="text-sm sm:text-base text-gray-700 leading-relaxed">
                                Lulusan ideal kami adalah pribadi yang berintegritas spiritual, tercermin dalam akhlak mulia dan ketekunan
                                beribadah. Secara intelektual, mereka menguasai ilmu pengetahuan dan hafalan Al-Qur'an, serta memiliki
                                keterampilan praktis yang relevan. Di tengah masyarakat, mereka berperan aktif dan positif, menunjukkan
                                kepedulian sosial dan kontribusi nyata.
                            </p>
                        </div>

                        <div class="bg-white rounded-2xl p-5 sm:p-6 border border-gray-200 shadow-soft md:col-span-2">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="bg-secondary/5 p-3 rounded-xl text-secondary border border-secondary/25">
                                    <i class="fas fa-chalkboard-teacher text-lg"></i>
                                </div>
                                <h3 class="text-xl font-semibold text-dark">Profil Tenaga Pendidikan</h3>
                            </div>
                            <p class="text-sm sm:text-base text-gray-700 leading-relaxed">
                                Tenaga pendidikan kami adalah individu profesional dan berdedikasi yang mengintegrasikan kelimuan dengan
                                nilai-nilai spiritual. Mereka memiliki kompetensi pedagogik yang mumpuni, mampu menciptakan lingkungan belajar
                                yang inspiratif dan inovatif. Dengan pemahaman mendalam tentang karakter peserta didik, mereka berperan sebagai
                                fasilitator, motivator, sekaligus teladan dalam pengembangan intelektual, spiritual, dan sosial bagi generasi penerus.
                            </p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>
</body>
</html>
