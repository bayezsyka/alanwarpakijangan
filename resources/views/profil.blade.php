<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Lengkap - Pondok Pesantren Al-Anwar Pakijangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                        'card': '0 4px 20px rgba(0, 131, 98, 0.1)',
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
            height: 80px;
            overflow: hidden;
        }
        .section-divider::before {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            height: 100%;
            background: linear-gradient(135deg, #00836222 0%, transparent 70%);
            transform: skewY(-2deg);
            transform-origin: top left;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans text-gray-800 antialiased">
    <!-- Header with Hero Image -->
    <header class="relative overflow-hidden">
        <div class="absolute inset-0 bg-blue-950 z-0"></div>
        
        <div class="relative z-10 max-w-4xl mx-auto px-6 py-24 md:py-32 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-3">Pondok Pesantren <span class="gradient-text">Al-Anwar</span></h1>
            <p class="text-xl text-white/90 font-light">Pakijangan, Brebes - "Kubah Jawa"</p>
        </div>
    </header>

    <!-- Back Button -->
    <div class="max-w-4xl mx-auto px-6 pt-8">
        <a href="/" class="inline-flex items-center gap-2 text-secondary hover:text-secondary/80 transition-colors">
            <i class="fas fa-arrow-left"></i>
            <span class="font-medium">Kembali ke Beranda</span>
        </a>
    </div>

    <main class="max-w-4xl mx-auto px-6 py-8">
        <!-- Identity Section -->
        <section class="mb-16">
            <div class="flex items-center gap-4 mb-8">
                <div class="h-1 w-12 bg-secondary"></div>
                <h2 class="text-2xl md:text-3xl font-bold text-dark">Identitas & Legalitas</h2>
            </div>
            
            <div class="grid md:grid-cols-2 gap-8">
                <div class="bg-white rounded-xl p-6 shadow-card">
                    <div class="space-y-5">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Nama Resmi</h3>
                            <p class="text-lg font-medium">Pondok Pesantren Al-Anwar Pakijangan</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Julukan</h3>
                            <p class="text-lg font-medium">Kubah Jawa</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Pendiri</h3>
                            <p class="text-lg font-medium">KH. Anwar Mukhtar</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Pimpinan/Pengasuh</h3>
                            <p class="text-lg font-medium">KH. Muhammad Miftah</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl p-6 shadow-card">
                    <div class="space-y-5">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Alamat</h3>
                            <p class="text-lg">Jalan Raya Pakijangan-Bulakamba No. 08. RT/RW 04/02. Brebes, Jawa Tengah</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Kontak</h3>
                            <ul class="space-y-2 text-lg">
                                <li class="flex items-center gap-3">
                                    <i class="fas fa-phone-alt text-secondary w-5"></i>
                                    <span>085161603362</span>
                                </li>
                                <li class="flex items-center gap-3">
                                    <i class="fas fa-envelope text-secondary w-5"></i>
                                    <span>ppkubahjawa@gmail.com</span>
                                </li>
                                <li class="flex items-center gap-3">
                                    <i class="fas fa-globe text-secondary w-5"></i>
                                    <span>alanwarpakijangan.com</span>
                                </li>
                                <li class="flex items-center gap-3">
                                    <i class="fab fa-instagram text-secondary w-5"></i>
                                    <span>@pesantrenalanwar</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Vision & Mission Section -->
        <section class="mb-16">
            <div class="flex items-center gap-4 mb-8">
                <div class="h-1 w-12 bg-secondary"></div>
                <h2 class="text-2xl md:text-3xl font-bold text-dark">Landasan Filosofis & Spiritual</h2>
            </div>
            
            <div class="bg-gradient-to-r from-secondary/5 to-white rounded-xl p-8 mb-8 border border-secondary/10">
                <div class="flex items-start gap-4">
                    <div class="bg-secondary/10 p-3 rounded-lg text-secondary">
                        <i class="fas fa-eye text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-dark mb-3">Visi</h3>
                        <p class="text-gray-700 italic">"Menjadi lembaga yang menumbuhkan potensi setiap santri secara personal dan reflektif, membentuk karakter yang kokoh dan bijaksana, serta menguatkan ilmu sebagai cahaya hidup yang menuntun mereka menapaki jalan dunia dan akhirat secara seimbang dan bermakna."</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl p-8 shadow-card">
                <div class="flex items-start gap-4 mb-6">
                    <div class="bg-secondary/10 p-3 rounded-lg text-secondary">
                        <i class="fas fa-bullseye text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-dark">Misi</h3>
                    </div>
                </div>
                
                <ol class="space-y-4">
                    <li class="flex gap-4">
                        <div class="flex-shrink-0 h-8 w-8 rounded-full bg-secondary/10 flex items-center justify-center text-secondary font-bold mt-1">1</div>
                        <p class="text-gray-700">Mengembangkan sistem pendidikan yang holistik dan terpadu, yang mengoptimalkan potensi spiritual, intelektual, emocional, dan keterampilan santri melalui pendekatan pembelajaran yang reflektif dan bermakna.</p>
                    </li>
                    <li class="flex gap-4">
                        <div class="flex-shrink-0 h-8 w-8 rounded-full bg-secondary/10 flex items-center justify-center text-secondary font-bold mt-1">2</div>
                        <p class="text-gray-700">Menyelenggarakan pembinaan akidah, ibadah, dan akhlak mulia yang kokoh dan konsisten, dengan menjadikan seluruh aspek kehidupan santri sebagai medan pendidikan ruhani.</p>
                    </li>
                    <li class="flex gap-4">
                        <div class="flex-shrink-0 h-8 w-8 rounded-full bg-secondary/10 flex items-center justify-center text-secondary font-bold mt-1">3</div>
                        <p class="text-gray-700">Menanamkan nilai-nilai kemandirian, kepedulian, kedisiplinan, dan kejujuran melalui budaya pembiasaan, keteladanan, serta relasi keseharian yang bermansa tarbawi.</p>
                    </li>
                    <li class="flex gap-4">
                        <div class="flex-shrink-0 h-8 w-8 rounded-full bg-secondary/10 flex items-center justify-center text-secondary font-bold mt-1">4</div>
                        <p class="text-gray-700">Mendorong pola pikir inovatif, adaptif, dan reflektif dalam diri santri agar mampu menghadapi tantangan zaman dengan kecakapan berpikir yang berlandaskan ajaran Islam.</p>
                    </li>
                    <li class="flex gap-4">
                        <div class="flex-shrink-0 h-8 w-8 rounded-full bg-secondary/10 flex items-center justify-center text-secondary font-bold mt-1">5</div>
                        <p class="text-gray-700">Menguatkan tradisi kelimuan dan literasi sebagai bagian dari ibadah dan jalan menuju kemuliaan dunia dan keselamatan akhirat, melalui pembelajaran aktif dan berkesadaran.</p>
                    </li>
                    <li class="flex gap-4">
                        <div class="flex-shrink-0 h-8 w-8 rounded-full bg-secondary/10 flex items-center justify-center text-secondary font-bold mt-1">6</div>
                        <p class="text-gray-700">Menyelenggarakan sistem pendampingan individu yang mendalam dan berkelanjutan untuk menggali, membina, dan mengarahkan potensi unik setiap santri.</p>
                    </li>
                    <li class="flex gap-4">
                        <div class="flex-shrink-0 h-8 w-8 rounded-full bg-secondary/10 flex items-center justify-center text-secondary font-bold mt-1">7</div>
                        <p class="text-gray-700">Memberkali santri dengan keterampilan berdakwah, kemampuan berkomunikasi, berpikir sistemik, dan berkontribusi positif di tengah masyarakat dengan tetap menjaga identitas keislamannya.</p>
                    </li>
                    <li class="flex gap-4">
                        <div class="flex-shrink-0 h-8 w-8 rounded-full bg-secondary/10 flex items-center justify-center text-secondary font-bold mt-1">8</div>
                        <p class="text-gray-700">Membentuk komunitas belajar yang sehat, terbuka, dan suportif, tempat santri merasa dihargai, tertantang untuk bertumbuh, dan terbiasa menilai keberhasilan dari proses, bukan semata hasil.</p>
                    </li>
                </ol>
            </div>
        </section>

        <!-- Education System Section -->
        <section class="mb-16">
            <div class="flex items-center gap-4 mb-8">
                <div class="h-1 w-12 bg-secondary"></div>
                <h2 class="text-2xl md:text-3xl font-bold text-dark">Sistem & Program Pendidikan</h2>
            </div>
            
            <div class="grid md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white rounded-xl p-6 shadow-card">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="bg-secondary/10 p-2 rounded-lg text-secondary">
                            <i class="fas fa-star"></i>
                        </div>
                        <h3 class="text-xl font-bold text-dark">Nilai-Nilai Utama</h3>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 mt-1">
                                <div class="bg-secondary/10 p-2 rounded-full text-secondary">
                                    <i class="fas fa-user-shield text-sm"></i>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">Kemandirian</h4>
                                <p class="text-gray-600 text-sm">Santri diajarkan untuk mandiri, menghadapi cepatnya perkembangan zaman dengan tetap memegang teguh prinsip-prinsip agama</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 mt-1">
                                <div class="bg-secondary/10 p-2 rounded-full text-secondary">
                                    <i class="fas fa-hands-helping text-sm"></i>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">Kepedulian</h4>
                                <p class="text-gray-600 text-sm">Santri memiliki rasa kepedulian, kasih sayang yang tinggi terhadap sesama manusia</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 mt-1">
                                <div class="bg-secondary/10 p-2 rounded-full text-secondary">
                                    <i class="fas fa-clock text-sm"></i>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">Kedisiplinan</h4>
                                <p class="text-gray-600 text-sm">Santri memiliki sifat yang tegas, profesional, dan menghargai waktu</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 mt-1">
                                <div class="bg-secondary/10 p-2 rounded-full text-secondary">
                                    <i class="fas fa-hand-holding-heart text-sm"></i>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">Kejujuran</h4>
                                <p class="text-gray-600 text-sm">Santri memiliki sifat jujur, amanah, dan dapat dipercaya</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 mt-1">
                                <div class="bg-secondary/10 p-2 rounded-full text-secondary">
                                    <i class="fas fa-lightbulb text-sm"></i>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">Inovatif</h4>
                                <p class="text-gray-600 text-sm">Santri memiliki pandangan terbuka dan mampu memperbaharui metode berdakwah seiring berkembangnya zaman</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl p-6 shadow-card">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="bg-secondary/10 p-2 rounded-lg text-secondary">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h3 class="text-xl font-bold text-dark">Struktur Pendidikan</h3>
                    </div>
                    
                    <div class="space-y-5">
                        <div>
                            <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Model Kurikulum</h4>
                            <p class="text-lg font-medium">Salaf Modern</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Jenjang Pendidikan Formal</h4>
                            <p class="text-lg font-medium">SMP</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Pendidikan Non-Formal</h4>
                            <p class="text-lg font-medium">Madrasah Diniyah</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Program Unggulan</h4>
                            <ul class="mt-2 space-y-2">
                                <li class="flex items-center gap-2">
                                    <div class="w-1.5 h-1.5 rounded-full bg-secondary"></div>
                                    <span>POTENSI (Program Orientasi Santri)</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <div class="w-1.5 h-1.5 rounded-full bg-secondary"></div>
                                    <span>Ilmu Bahasa Arab (Nahwu Shorof)</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl p-6 shadow-card">
                <div class="flex items-center gap-3 mb-6">
                    <div class="bg-secondary/10 p-2 rounded-lg text-secondary">
                        <i class="fas fa-futbol"></i>
                    </div>
                    <h3 class="text-xl font-bold text-dark">Ekstrakurikuler</h3>
                </div>
                
                <div class="grid sm:grid-cols-3 gap-4">
                    <div class="bg-gradient-to-br from-secondary/5 to-white p-5 rounded-lg border border-secondary/10 text-center transition-all hover:shadow-md">
                        <div class="bg-secondary/10 p-3 rounded-full inline-flex text-secondary mb-3">
                            <i class="fas fa-newspaper text-xl"></i>
                        </div>
                        <p class="font-semibold">Jurnalistik</p>
                    </div>
                    <div class="bg-gradient-to-br from-secondary/5 to-white p-5 rounded-lg border border-secondary/10 text-center transition-all hover:shadow-md">
                        <div class="bg-secondary/10 p-3 rounded-full inline-flex text-secondary mb-3">
                            <i class="fas fa-laptop-code text-xl"></i>
                        </div>
                        <p class="font-semibold">Teknologi Informasi dan Komunikasi</p>
                    </div>
                    <div class="bg-gradient-to-br from-secondary/5 to-white p-5 rounded-lg border border-secondary/10 text-center transition-all hover:shadow-md">
                        <div class="bg-secondary/10 p-3 rounded-full inline-flex text-secondary mb-3">
                            <i class="fas fa-flask text-xl"></i>
                        </div>
                        <p class="font-semibold">Sains</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Graduate Profile Section -->
        <section class="mb-16">
            <div class="flex items-center gap-4 mb-8">
                <div class="h-1 w-12 bg-secondary"></div>
                <h2 class="text-2xl md:text-3xl font-bold text-dark">Profil Lulusan & SDM</h2>
            </div>
            
            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-white rounded-xl p-6 shadow-card">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="bg-secondary/10 p-2 rounded-lg text-secondary">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <h3 class="text-xl font-bold text-dark">Profil Santri (Target)</h3>
                    </div>
                    <p class="text-gray-700">Santri yang diharapkan adalah pribadi mandiri dan adaptif terhadap perkembangan zaman, teguh memegang prinsip agama. Mereka dicirikan oleh kepedulian sosial, kedisiplinan tinggi, serta kejujuran dan integritas. Dengan pola pikir inovatif, santri mampu menciptakan solusi relevan dan memperbaharui pendekatan dakwah selaras dengan konteks kekinian.</p>
                </div>
                
                <div class="bg-white rounded-xl p-6 shadow-card">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="bg-secondary/10 p-2 rounded-lg text-secondary">
                            <i class="fas fa-award"></i>
                        </div>
                        <h3 class="text-xl font-bold text-dark">Profil Lulusan Ideal</h3>
                    </div>
                    <p class="text-gray-700">Lulusan ideal kami adalah pribadi yang berintegritas spiritual, tercermin dalam akhlak mulia dan ketekunan beribadah. Secara intelektual, mereka menguasai ilmu pengetahuan dan hafalan Al-Qur'an, serta memiliki keterampilan praktis yang relevan. Di tengah masyarakat, mereka berperan aktif dan positif, menunjukkan kepedulian sosial dan kontribusi nyata.</p>
                </div>
                
                <div class="bg-white rounded-xl p-6 shadow-card md:col-span-2">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="bg-secondary/10 p-2 rounded-lg text-secondary">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <h3 class="text-xl font-bold text-dark">Profil Tenaga Pendidikan</h3>
                    </div>
                    <p class="text-gray-700">Tenaga pendidikan kami adalah individu profesional dan berdedikasi yang mengintegrasikan kelimuan dengan nilai-nilai spiritual. Mereka memiliki kompetensi pedagogik yang mumpuni, mampu menciptakan lingkungan belajar yang inspiratif dan inovatif. Dengan pemahaman mendalam tentang karakter peserta didik, mereka berperan sebagai fasilitator, motivator, sekaligus teladan dalam pengembangan intelektual, spiritual, dan sosial bagi generasi penerus.</p>
                </div>
            </div>
        </section>
    </main>
</body>
</html>