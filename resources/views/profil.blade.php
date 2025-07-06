<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Lengkap - Pondok Pesantren Al-Anwar Kubah Jawa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#008362',
                        primarylight: '#E6F2EF',
                        primarydark: '#005C45',
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .gradient-underline {
            position: relative;
            display: inline-block;
        }
        .gradient-underline::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -6px;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #005C45 0%, #008362 100%);
            border-radius: 2px;
        }
    </style>
</head>
@include('layouts.nav')
<body class="bg-white min-h-screen">
    
    <div class="max-w-4xl mx-auto py-12 md:py-20 px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <section class="text-center mb-16">
            <div class="inline-block bg-primarylight px-6 py-3 rounded-full mb-6">
                <span class="text-primary text-xl sm:text-2xl font-medium tracking-wider">PROFIL PESANTREN</span>
            </div>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-gray-800 mb-6 leading-tight">
                <span class="gradient-underline">Pondok Pesantren Al-Anwar</span>
            </h2>
            <p class="text-xl text-primary font-medium mb-2">"Kubah Jawa"</p>
            <div class="w-20 md:w-32 h-1 bg-gradient-to-r from-primarydark to-primary mx-auto rounded-full mb-8"></div>
            
            <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-lg p-6 md:p-8 border border-gray-100">
                <div class="grid md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-lg font-semibold text-primary mb-2">Pendiri</h3>
                        <p class="text-gray-700">KH. Anwar Mukhtar</p>
                        
                        <h3 class="text-lg font-semibold text-primary mt-4 mb-2">Alamat</h3>
                        <p class="text-gray-700">Jalan Raya Pakijangan-Bulakamba No. 08. RT/RW 04/02. Brebes, Jawa Tengah</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-primary mb-2">Pimpinan</h3>
                        <p class="text-gray-700">KH. Muhammad Miftah</p>
                        
                        <h3 class="text-lg font-semibold text-primary mt-4 mb-2">Kontak</h3>
                        <p class="text-gray-700">085161603362<br>ppkubahjawa@gmail.com</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Visi Misi Section -->
        <section class="mb-20">
            <div class="bg-white rounded-xl md:rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <!-- Visi -->
                <div class="p-6 md:p-8 border-b border-gray-100">
                    <h3 class="text-2xl font-bold text-primary mb-4">Visi</h3>
                    <blockquote class="text-xl italic text-gray-700 bg-primarylight p-6 rounded-lg">
                        "Mendampingi Potensi, Membentuk Karakter"
                    </blockquote>
                </div>
                
                <!-- Misi -->
                <div class="p-6 md:p-8 border-b border-gray-100">
                    <h3 class="text-2xl font-bold text-primary mb-6">Misi</h3>
                    <div class="space-y-6">
                        <div class="flex flex-col sm:flex-row items-start gap-6">
                            <div class="flex-shrink-0 w-12 h-12 md:w-14 md:h-14 bg-primary rounded-xl flex items-center justify-center text-white text-xl font-bold">1</div>
                            <p class="text-gray-700">Mengembangkan sistem pendidikan yang holistik untuk mengoptimalkan potensi spiritual, intelektual, dan keterampilan santri.</p>
                        </div>
                        <div class="flex flex-col sm:flex-row items-start gap-6">
                            <div class="flex-shrink-0 w-12 h-12 md:w-14 md:h-14 bg-primary rounded-xl flex items-center justify-center text-white text-xl font-bold">2</div>
                            <p class="text-gray-700">Menanamkan nilai-nilai kemandirian, kepedulian, kedisiplinan, dan kejujuran melalui pembiasaan dan keteladanan.</p>
                        </div>
                        <div class="flex flex-col sm:flex-row items-start gap-6">
                            <div class="flex-shrink-0 w-12 h-12 md:w-14 md:h-14 bg-primary rounded-xl flex items-center justify-center text-white text-xl font-bold">3</div>
                            <p class="text-gray-700">Mendorong pola pikir inovatif dan adaptif pada santri agar mampu menjawab tantangan zaman dengan berlandaskan ajaran Islam.</p>
                        </div>
                        <div class="flex flex-col sm:flex-row items-start gap-6">
                            <div class="flex-shrink-0 w-12 h-12 md:w-14 md:h-14 bg-primary rounded-xl flex items-center justify-center text-white text-xl font-bold">4</div>
                            <p class="text-gray-700">Menyelenggarakan pembinaan akidah dan ibadah yang kokoh serta penanaman akhlak mulia dalam setiap aspek kehidupan santri.</p>
                        </div>
                        <div class="flex flex-col sm:flex-row items-start gap-6">
                            <div class="flex-shrink-0 w-12 h-12 md:w-14 md:h-14 bg-primary rounded-xl flex items-center justify-center text-white text-xl font-bold">5</div>
                            <p class="text-gray-700">Membekali santri dengan keterampilan berdakwah dan kemampuan berkontribusi secara positif dan relevan di tengah masyarakat.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Nilai Inti -->
                <div class="p-6 md:p-8">
                    <h3 class="text-2xl font-bold text-primary mb-6">Nilai-Nilai Inti</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                        <div class="bg-primarylight rounded-lg p-5 border border-primary/20">
                            <h4 class="font-bold text-primary mb-2">Kemandirian</h4>
                            <p class="text-sm text-gray-700">Santri diajarkan untuk mandiri menghadapi perkembangan zaman dengan prinsip agama</p>
                        </div>
                        <div class="bg-primarylight rounded-lg p-5 border border-primary/20">
                            <h4 class="font-bold text-primary mb-2">Kepedulian</h4>
                            <p class="text-sm text-gray-700">Santri memiliki rasa kepedulian dan kasih sayang terhadap sesama</p>
                        </div>
                        <div class="bg-primarylight rounded-lg p-5 border border-primary/20">
                            <h4 class="font-bold text-primary mb-2">Kedisiplinan</h4>
                            <p class="text-sm text-gray-700">Santri memiliki sifat tegas, profesional dan menghargai waktu</p>
                        </div>
                        <div class="bg-primarylight rounded-lg p-5 border border-primary/20">
                            <h4 class="font-bold text-primary mb-2">Kejujuran</h4>
                            <p class="text-sm text-gray-700">Santri memiliki sifat jujur, amanah dan dapat dipercaya</p>
                        </div>
                        <div class="bg-primarylight rounded-lg p-5 border border-primary/20">
                            <h4 class="font-bold text-primary mb-2">Inovatif</h4>
                            <p class="text-sm text-gray-700">Santri memiliki pandangan terbuka terhadap perkembangan zaman</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Pendidikan Section -->
        <section class="mb-20">
            <div class="bg-white rounded-xl md:rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <div class="p-6 md:p-8 border-b border-gray-100">
                    <h3 class="text-2xl font-bold text-primary mb-6">Sistem & Program Pendidikan</h3>
                    
                    <div class="grid md:grid-cols-2 gap-8">
                        <div>
                            <h4 class="text-lg font-semibold text-primarydark mb-3">Model Kurikulum</h4>
                            <div class="bg-primarylight rounded-lg p-4 border border-primary/20 mb-6">
                                <p class="font-medium text-primary">Salaf Modern</p>
                            </div>
                            
                            <h4 class="text-lg font-semibold text-primarydark mb-3">Jenjang Pendidikan</h4>
                            <div class="space-y-4">
                                <div class="flex items-center bg-primarylight rounded-lg p-4 border border-primary/20">
                                    <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center text-white mr-4">F</div>
                                    <div>
                                        <p class="font-medium text-primary">Formal</p>
                                        <p class="text-gray-700">SMP</p>
                                    </div>
                                </div>
                                <div class="flex items-center bg-primarylight rounded-lg p-4 border border-primary/20">
                                    <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center text-white mr-4">N</div>
                                    <div>
                                        <p class="font-medium text-primary">Non-Formal</p>
                                        <p class="text-gray-700">Madrasah Diniyah</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <h4 class="text-lg font-semibold text-primarydark mb-3">Program Unggulan</h4>
                            <div class="flex flex-wrap gap-3 mb-8">
                                <span class="px-4 py-2 bg-primary text-white rounded-full text-sm font-medium">Nahwu Shorof</span>
                                <span class="px-4 py-2 bg-primary text-white rounded-full text-sm font-medium">Alqur'an Hadits</span>
                                <span class="px-4 py-2 bg-primary text-white rounded-full text-sm font-medium">Sains dan Teknologi</span>
                            </div>
                            
                            <h4 class="text-lg font-semibold text-primarydark mb-3">Ekstrakurikuler</h4>
                            <div class="flex flex-wrap gap-3">
                                <span class="px-4 py-2 bg-primarylight text-primary rounded-full text-sm font-medium">Jurnalistik</span>
                                <span class="px-4 py-2 bg-primarylight text-primary rounded-full text-sm font-medium">Teknologi Informasi</span>
                                <span class="px-4 py-2 bg-primarylight text-primary rounded-full text-sm font-medium">Sains</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Profil Section -->
        <section>
            <div class="bg-white rounded-xl md:rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <div class="p-6 md:p-8">
                    <h3 class="text-2xl font-bold text-primary mb-6">Profil Lulusan & SDM</h3>
                    
                    <div class="grid md:grid-cols-2 gap-8">
                        <div>
                            <h4 class="text-lg font-semibold text-primarydark mb-3">Profil Santri (Target)</h4>
                            <div class="bg-primarylight rounded-lg p-5 border border-primary/20 mb-6">
                                <p class="text-gray-700">Santri yang diharapkan adalah pribadi mandiri dan adaptif terhadap perkembangan zaman, teguh memegang prinsip agama. Mereka dicirikan oleh kepedulian sosial, kedisiplinan tinggi, serta kejujuran dan integritas. Dengan pola pikir inovatif, santri mampu menciptakan solusi relevan dan memperbaharui pendekatan dakwah selaras dengan konteks kekinian.</p>
                            </div>
                            
                            <h4 class="text-lg font-semibold text-primarydark mb-3">Profil Lulusan Ideal</h4>
                            <div class="bg-primarylight rounded-lg p-5 border border-primary/20">
                                <p class="text-gray-700">Lulusan ideal kami adalah pribadi yang berintegritas spiritual, tercermin dalam akhlak mulia dan ketekunan beribadah. Secara intelektual, mereka menguasai ilmu pengetahuan dan hafalan Al-Qur'an, serta memiliki keterampilan praktis yang relevan. Di tengah masyarakat, mereka berperan aktif dan positif, menunjukkan kepedulian sosial dan kontribusi nyata.</p>
                            </div>
                        </div>
                        
                        <div>
                            <h4 class="text-lg font-semibold text-primarydark mb-3">Profil Tenaga Pendidik</h4>
                            <div class="bg-primarylight rounded-lg p-5 border border-primary/20 mb-6">
                                <p class="text-gray-700">Tenaga pendidik kami adalah individu profesional dan berdedikasi yang mengintegrasikan keilmuan dengan nilai-nilai spiritual. Mereka memiliki kompetensi pedagogik yang mumpuni, mampu menciptakan lingkungan belajar yang inspiratif dan inovatif. Dengan pemahaman mendalam tentang karakter peserta didik, mereka berperan sebagai fasilitator, motivator, sekaligus teladan dalam pengembangan intelektual, spiritual, dan sosial bagi generasi penerus.</p>
                            </div>
                            
                            <div class="bg-primarylight rounded-lg p-5 border border-primary/20">
                                <h4 class="text-lg font-semibold text-primary mb-3">Informasi Kontak</h4>
                                <div class="space-y-2">
                                    <p class="flex items-center text-gray-700">
                                        <svg class="w-5 h-5 text-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                        085161603362
                                    </p>
                                    <p class="flex items-center text-gray-700">
                                        <svg class="w-5 h-5 text-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        ppkubahjawa@gmail.com
                                    </p>
                                    <p class="flex items-center text-gray-700">
                                        <svg class="w-5 h-5 text-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                        </svg>
                                        @pesantrenalanwar
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
@include('layouts.footer')
</html>