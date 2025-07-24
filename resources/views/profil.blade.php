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
                    },
                    fontFamily: {
                        'sans': ['Poppins', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        .hero-pattern {
            background-image: radial-gradient(#00836222 1px, transparent 1px);
            background-size: 20px 20px;
        }
        .mission-list {
            counter-reset: mission-counter;
        }
        .mission-item {
            position: relative;
            padding-left: 2rem;
            margin-bottom: 1rem;
        }
        .mission-item:before {
            counter-increment: mission-counter;
            content: counter(mission-counter) ".";
            position: absolute;
            left: 0;
            font-weight: bold;
            color: #008362;
        }
    </style>
</head>
<body class="bg-white font-sans text-gray-800">
    <!-- Header -->
    <header class="relative">
        <div class="hero-pattern h-64 w-full flex items-center justify-center">
            <div class="text-center px-4 max-w-2xl">
                <h1 class="text-4xl md:text-5xl font-bold text-secondary mb-2">Pondok Pesantren Al-Anwar Pakijangan</h1>
                <p class="text-xl text-gray-600">"Kubah Jawa"</p>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8 max-w-5xl">
        <!-- Identity Section -->
        <section class="mb-12 bg-gray-50 p-6 rounded-lg">
            <h2 class="text-3xl font-semibold mb-6 text-secondary border-b pb-2">Identitas & Legalitas</h2>
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <div class="mb-4">
                        <h3 class="text-lg font-medium text-gray-700">Nama Resmi</h3>
                        <p class="text-gray-600">Pondok Pesantren Al-Anwar Pakijangan</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-medium text-gray-700">Julukan</h3>
                        <p class="text-gray-600">Kubah Jawa</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-medium text-gray-700">Pendiri</h3>
                        <p class="text-gray-600">KH. Anwar Mukhtar</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-medium text-gray-700">Pimpinan/Pengasuh</h3>
                        <p class="text-gray-600">KH. Muhammad Miftah</p>
                    </div>
                </div>
                <div>
                    <div class="mb-4">
                        <h3 class="text-lg font-medium text-gray-700">Alamat</h3>
                        <p class="text-gray-600">Jalan Raya Pakijangan-Bulakamba No. 08. RT/RW 04/02. Brebes, Jawa Tengah</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-medium text-gray-700">Kontak</h3>
                        <ul class="text-gray-600 space-y-1">
                            <li><i class="fas fa-phone-alt mr-2 text-secondary"></i>085161603362</li>
                            <li><i class="fas fa-envelope mr-2 text-secondary"></i>ppkubahjawa@gmail.com</li>
                            <li><i class="fas fa-globe mr-2 text-secondary"></i>alanwarpakijangan.com</li>
                            <li><i class="fab fa-instagram mr-2 text-secondary"></i>@pesantrenalanwar</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Vision & Mission Section -->
        <section class="mb-12">
            <h2 class="text-3xl font-semibold mb-6 text-secondary border-b pb-2">Landasan Filosofis & Spiritual</h2>
            
            <div class="bg-secondary bg-opacity-5 p-6 rounded-lg mb-6">
                <h3 class="text-2xl font-semibold mb-3 text-secondary">Visi</h3>
                <p class="text-gray-700 italic">"Menjadi lembaga yang menumbuhkan potensi setiap santri secara personal dan reflektif, membentuk karakter yang kokoh dan bijaksana, serta menguatkan ilmu sebagai cahaya hidup yang menuntun mereka menapaki jalan dunia dan akhirat secara seimbang dan bermakna."</p>
            </div>
            
            <div>
                <h3 class="text-2xl font-semibold mb-3 text-secondary">Misi</h3>
                <ul class="mission-list pl-4">
                    <li class="mission-item text-gray-700 mb-3">Mengembangkan sistem pendidikan yang holistik dan terpadu, yang mengoptimalkan potensi spiritual, intelektual, emocional, dan keterampilan santri melalui pendekatan pembelajaran yang reflektif dan bermakna.</li>
                    <li class="mission-item text-gray-700 mb-3">Menyelenggarakan pembinaan akidah, ibadah, dan akhlak mulia yang kokoh dan konsisten, dengan menjadikan seluruh aspek kehidupan santri sebagai medan pendidikan ruhani.</li>
                    <li class="mission-item text-gray-700 mb-3">Menanamkan nilai-nilai kemandirian, kepedulian, kedisiplinan, dan kejujuran melalui budaya pembiasaan, keteladanan, serta relasi keseharian yang bermansa tarbawi.</li>
                    <li class="mission-item text-gray-700 mb-3">Mendorong pola pikir inovatif, adaptif, dan reflektif dalam diri santri agar mampu menghadapi tantangan zaman dengan kecakapan berpikir yang berlandaskan ajaran Islam.</li>
                    <li class="mission-item text-gray-700 mb-3">Menguatkan tradisi kelimuan dan literasi sebagai bagian dari ibadah dan jalan menuju kemuliaan dunia dan keselamatan akhirat, melalui pembelajaran aktif dan berkesadaran.</li>
                    <li class="mission-item text-gray-700 mb-3">Menyelenggarakan sistem pendampingan individu yang mendalam dan berkelanjutan untuk menggali, membina, dan mengarahkan potensi unik setiap santri.</li>
                    <li class="mission-item text-gray-700 mb-3">Memberkali santri dengan keterampilan berdakwah, kemampuan berkomunikasi, berpikir sistemik, dan berkontribusi positif di tengah masyarakat dengan tetap menjaga identitas keislamannya.</li>
                    <li class="mission-item text-gray-700">Membentuk komunitas belajar yang sehat, terbuka, dan suportif, tempat santri merasa dihargai, tertantang untuk bertumbuh, dan terbiasa menilai keberhasilan dari proses, bukan semata hasil.</li>
                </ul>
            </div>
        </section>

        <!-- Education System Section -->
        <section class="mb-12">
            <h2 class="text-3xl font-semibold mb-6 text-secondary border-b pb-2">Sistem & Program Pendidikan</h2>
            
            <div class="grid md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
                    <h3 class="text-xl font-semibold mb-3 text-secondary">Nilai-Nilai Utama</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <div class="bg-secondary bg-opacity-10 p-1 rounded-full mr-3 mt-1">
                                <i class="fas fa-user-shield text-secondary text-sm"></i>
                            </div>
                            <span class="text-gray-700"><strong>Kemandirian:</strong> Santri diajarkan untuk mandiri, menghadapi cepatnya perkembangan zaman dengan tetap memegang teguh prinsip-prinsip agama</span>
                        </li>
                        <li class="flex items-start">
                            <div class="bg-secondary bg-opacity-10 p-1 rounded-full mr-3 mt-1">
                                <i class="fas fa-hands-helping text-secondary text-sm"></i>
                            </div>
                            <span class="text-gray-700"><strong>Kepedulian:</strong> Santri memiliki rasa kepedulian, kasih sayang yang tinggi terhadap sesama manusia</span>
                        </li>
                        <li class="flex items-start">
                            <div class="bg-secondary bg-opacity-10 p-1 rounded-full mr-3 mt-1">
                                <i class="fas fa-clock text-secondary text-sm"></i>
                            </div>
                            <span class="text-gray-700"><strong>Kedisiplinan:</strong> Santri memiliki sifat yang tegas, profesional, dan menghargai waktu</span>
                        </li>
                        <li class="flex items-start">
                            <div class="bg-secondary bg-opacity-10 p-1 rounded-full mr-3 mt-1">
                                <i class="fas fa-hand-holding-heart text-secondary text-sm"></i>
                            </div>
                            <span class="text-gray-700"><strong>Kejujuran:</strong> Santri memiliki sifat jujur, amanah, dan dapat dipercaya</span>
                        </li>
                        <li class="flex items-start">
                            <div class="bg-secondary bg-opacity-10 p-1 rounded-full mr-3 mt-1">
                                <i class="fas fa-lightbulb text-secondary text-sm"></i>
                            </div>
                            <span class="text-gray-700"><strong>Inovatif:</strong> Santri memiliki pandangan terbuka dan mampu memperbaharui metode berdakwah seiring berkembangnya zaman</span>
                        </li>
                    </ul>
                </div>
                
                <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
                    <h3 class="text-xl font-semibold mb-3 text-secondary">Struktur Pendidikan</h3>
                    <div class="mb-4">
                        <h4 class="font-medium text-gray-700 mb-1">Model Kurikulum</h4>
                        <p class="text-gray-600">Salaf Modern</p>
                    </div>
                    <div class="mb-4">
                        <h4 class="font-medium text-gray-700 mb-1">Jenjang Pendidikan Formal</h4>
                        <p class="text-gray-600">SMP</p>
                    </div>
                    <div class="mb-4">
                        <h4 class="font-medium text-gray-700 mb-1">Pendidikan Non-Formal</h4>
                        <p class="text-gray-600">Madrasah Diniyah</p>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-700 mb-1">Program Unggulan</h4>
                        <ul class="text-gray-600 list-disc pl-5">
                            <li>POTENSI (Program Orientasi Santri)</li>
                            <li>Ilmu Bahasa Arab (Nahwu Shorof)</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
                <h3 class="text-xl font-semibold mb-3 text-secondary">Ekstrakurikuler</h3>
                <div class="grid sm:grid-cols-3 gap-4">
                    <div class="bg-secondary bg-opacity-5 p-4 rounded-lg text-center">
                        <i class="fas fa-newspaper text-3xl text-secondary mb-2"></i>
                        <p class="font-medium">Jurnalistik</p>
                    </div>
                    <div class="bg-secondary bg-opacity-5 p-4 rounded-lg text-center">
                        <i class="fas fa-laptop-code text-3xl text-secondary mb-2"></i>
                        <p class="font-medium">Teknologi Informasi dan Komunikasi</p>
                    </div>
                    <div class="bg-secondary bg-opacity-5 p-4 rounded-lg text-center">
                        <i class="fas fa-flask text-3xl text-secondary mb-2"></i>
                        <p class="font-medium">Sains</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Profile Section -->
        <section class="mb-12">
            <h2 class="text-3xl font-semibold mb-6 text-secondary border-b pb-2">Profil Lulusan & SDM</h2>
            
            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
                    <h3 class="text-xl font-semibold mb-3 text-secondary">Profil Santri (Target)</h3>
                    <p class="text-gray-700">Santri yang diharapkan adalah pribadi mandiri dan adaptif terhadap perkembangan zaman, teguh memegang prinsip agama. Mereka dicirikan oleh kepedulian sosial, kedisiplinan tinggi, serta kejujuran dan integritas. Dengan pola pikir inovatif, santri mampu menciptakan solusi relevan dan memperbaharui pendekatan dakwah selaras dengan konteks kekinian.</p>
                </div>
                
                <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
                    <h3 class="text-xl font-semibold mb-3 text-secondary">Profil Lulusan Ideal</h3>
                    <p class="text-gray-700">Lulusan ideal kami adalah pribadi yang berintegritas spiritual, tercermin dalam akhlak mulia dan ketekunan beribadah. Secara intelektual, mereka menguasai ilmu pengetahuan dan hafalan Al-Qur'an, serta memiliki keterampilan praktis yang relevan. Di tengah masyarakat, mereka berperan aktif dan positif, menunjukkan kepedulian sosial dan kontribusi nyata.</p>
                </div>
                
                <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm md:col-span-2">
                    <h3 class="text-xl font-semibold mb-3 text-secondary">Profil Tenaga Pendidikan</h3>
                    <p class="text-gray-700">Tenaga pendidikan kami adalah individu profesional dan berdedikasi yang mengintegrasikan kelimuan dengan nilai-nilai spiritual. Mereka memiliki kompetensi pedagogik yang mumpuni, mampu menciptakan lingkungan belajar yang inspiratif dan inovatif. Dengan pemahaman mendalam tentang karakter peserta didik, mereka berperan sebagai fasilitator, motivator, sekaligus teladan dalam pengembangan intelektual, spiritual, dan sosial bagi generasi penerus.</p>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-50 py-8 border-t">
        <div class="container mx-auto px-4 max-w-5xl">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <h3 class="text-xl font-bold text-secondary mb-2">Pondok Pesantren Al-Anwar Pakijangan</h3>
                    <p class="text-gray-600">"Kubah Jawa" - Brebes, Jawa Tengah</p>
                </div>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-500 hover:text-secondary text-xl">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-secondary text-xl">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-secondary text-xl">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-secondary text-xl">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
            </div>
            <div class="mt-6 pt-6 border-t border-gray-200 text-center text-gray-500 text-sm">
                <p>© 2023 Pondok Pesantren Al-Anwar Pakijangan. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>