<section class="py-12 md:py-20 px-2 md:px-4 bg-gradient-to-b from-white to-green-50">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-10 md:mb-16">
            <div class="inline-block bg-[#008362] text-white px-4 md:px-6 py-2 md:py-3 rounded-full shadow-lg mb-8">
                <h2 class="text-xl sm:text-2xl md:text-3xl font-medium tracking-wider">PROFIL PESANTREN</h2>
            </div> 
        </div>

        <div class="bg-white rounded-xl md:rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            
            <div class="p-6 md:p-8 border-b border-slate-100">
                <div class="flex items-start gap-4 md:gap-6">
                    <div class="w-12 h-12 md:w-14 md:h-14 bg-green-700 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl md:text-2xl font-bold text-slate-800 mb-2">Visi</h3>
                        <p class="text-slate-600 text-base md:text-lg leading-relaxed italic">
                            “Menjadi lembaga yang menumbuhkan potensi setiap santri secara personal dan reflektif, membentuk karakter yang kokoh dan bijaksana, serta menguatkan ilmu sebagai cahaya hidup yang menuntun santri menapaki jalan dunia dan akhirat secara seimbang dan bermakna.”
                        </p>
                    </div>
                </div>
            </div>

            <div class="p-6 md:p-8 border-b border-slate-100">
                <div class="flex items-start gap-4 md:gap-6">
                    <div class="w-12 h-12 md:w-14 md:h-14 bg-green-700 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl md:text-2xl font-bold text-slate-800 mb-4">Misi</h3>
                        <ol class="list-decimal pl-5 space-y-3 text-slate-600 text-base md:text-lg leading-relaxed">
                            <li>Mengembangkan sistem pendidikan yang holistik dan terpadu, yang mengoptimalkan potensi spiritual, intelektual, emosional, dan keterampilan santri melalui pendekatan pembelajaran yang reflektif dan bermakna.</li>
                            <li>Menyelenggarakan pembinaan akidah, ibadah, dan akhlak mulia yang kokoh dan konsisten, dengan menjadikan pesantren sebagai pendidikan spiritual bagi para santri.</li>
                            <li>Menanamkan nilai-nilai integritas, visioner, kemandirian, empati, inovatif, adaptif, dan tawadhu’ secara konsisten melalui budaya pembiasaan yang sistematis, menyeluruh, dan terintegrasi dalam seluruh aktivitas pendidikan.</li>
                            <li>Mendorong pola pikir inovatif, adaptif, dan reflektif dalam diri santri agar mampu menghadapi tantangan zaman dengan kecakapan berpikir yang berlandaskan ajaran Islam.</li>
                            <li>Menguatkan tradisi keilmuan dan literasi sebagai bagian dari ibadah dan jalan menuju kemuliaan dunia dan keselamatan akhirat, melalui pembelajaran aktif dan berkesadaran.</li>
                            <li>Menyelenggarakan sistem pendampingan individu yang mendalam dan berkelanjutan untuk menggali, membina, dan mengarahkan potensi unik setiap santri.</li>
                            <li>Membekali santri dengan keterampilan berdakwah, kemampuan berkomunikasi, berpikir sistemik, dan berkontribusi positif di tengah masyarakat dengan tetap menjaga identitas Islam ala Ahlus Sunnah Wal Jamaah.</li>
                            <li>Membentuk komunitas belajar yang sehat, terbuka, dan suportif, tempat santri merasa dihargai, tertantang untuk bertumbuh, dan terbiasa menilai keberhasilan dari proses, bukan semata hasil.</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="p-6 md:p-8">
                <div class="flex items-start gap-4 md:gap-6">
                    <div class="w-12 h-12 md:w-14 md:h-14 bg-green-700 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl md:text-2xl font-bold text-slate-800 mb-4">Nilai-Nilai Inti</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach(['Integritas', 'Visioner', 'Mandiri', 'Empati', 'Inovatif', 'Adaptif', 'Tawadhu’'] as $nilai)
                            <div class="bg-green-50/50 rounded-lg p-4 border border-green-100">
                                <h4 class="font-bold text-green-900 text-base">{{ $nilai }}</h4>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>