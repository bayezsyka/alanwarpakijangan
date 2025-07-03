<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index()
    {
        // Data artikel dummy. Dalam aplikasi nyata, ini akan diambil dari database.
        $articles = [
            [
                'id' => 1,
                'judul' => 'Dana Kampanye Fiktif: Modus Cuci Uang Politisi',
                'gambar' => 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', // Ganti dengan URL gambar Anda
                'tanggal' => '2023-12-12',
                'penulis' => 'Lina Marlina',
                'isi' => 'Dancok kabeh... Ini adalah isi singkat dari artikel Dana Kampanye Fiktif: Modus Cuci Uang Politisi. Dalam investigasi terbaru, terungkap praktik licik di balik dana kampanye beberapa politisi. Modus pencucian uang melalui sumbangan fiktif menjadi sorotan utama, menimbulkan kekhawatiran serius tentang integritas pemilu. Analisis mendalam menunjukkan pola yang terstruktur dalam manipulasi laporan keuangan, melibatkan pihak-pihak yang tidak terduga. Artikel ini akan membahas secara rinci bagaimana skema ini dijalankan, siapa saja yang terlibat, dan dampak luasnya terhadap demokrasi kita.',
            ],
            [
                'id' => 2,
                'judul' => 'Skandal Asmara dan Penggelapan Dana Partai',
                'gambar' => 'https://images.unsplash.com/photo-1516053335503-4f997c67530e?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', // Ganti dengan URL gambar Anda
                'tanggal' => '2023-10-08',
                'penulis' => 'Rina Dewi',
                'isi' => 'Ketua Fraksi F ternyata menggunakan dana partai untuk membiayai hubungan gelapnya dengan sekretaris pribadi.... Investigasi internal mengungkap skandal ganda yang mengguncang partai besar. Bukan hanya penyalahgunaan dana, tetapi juga terungkap hubungan terlarang antara petinggi partai dan stafnya. Temuan ini memicu gelombang protes dari anggota partai dan masyarakat, menuntut transparansi dan akuntabilitas. Artikel ini akan mengupas tuntas kronologi kejadian, bukti-bukti yang ditemukan, dan konsekuensi hukum serta etika yang mungkin dihadapi para pelaku.',
            ],
            [
                'id' => 3,
                'judul' => 'Proyek Fiktif Senilai Triliunan: Modus Baru Korupsi',
                'gambar' => 'https://images.unsplash.com/photo-1628126388909-7756f4d9943f?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', // Ganti dengan URL gambar Anda
                'tanggal' => '2023-09-05',
                'penulis' => 'Dewi Anggraeni',
                'isi' => 'Investigasi menemukan 15 proyek fiktif yang dikerjakan perusahaan shell milik politikus. Kerugian negara mencapai Rp2,3.... Sebuah laporan investigasi terbaru mengungkap jaringan korupsi skala besar yang melibatkan proyek-proyek fiktif dengan kerugian negara mencapai triliunan rupiah. Modus operandi baru yang menggunakan perusahaan cangkang (shell companies) untuk mengalirkan dana publik ke kantong pribadi para politikus terungkap. Artikel ini akan membongkar detail modus tersebut, mengidentifikasi perusahaan-perusahaan yang terlibat, dan menganalisis dampak ekonomi yang ditimbulkannya. Kami juga akan menyoroti langkah-langkah yang harus diambil untuk mencegah praktik serupa di masa depan.',
            ],
            [
                'id' => 4,
                'judul' => 'Peran Blockchain dalam Pencegahan Korupsi',
                'gambar' => 'https://images.unsplash.com/photo-1620325754593-3d077b960b76?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', // Ganti dengan URL gambar Anda
                'tanggal' => '2023-08-20',
                'penulis' => 'Budi Santoso',
                'isi' => 'Teknologi Blockchain menawarkan solusi transparan untuk melacak aliran dana dan mencegah praktik korupsi. Dengan sifatnya yang imutabel dan terdistribusi, blockchain dapat menciptakan catatan transaksi yang tidak dapat dimanipulasi, sehingga meminimalkan peluang penyalahgunaan kekuasaan. Artikel ini akan menjelaskan bagaimana implementasi blockchain dapat meningkatkan akuntabilitas dalam pengadaan publik, pengelolaan anggaran, dan penyaluran bantuan sosial. Kami akan membahas studi kasus dari berbagai negara yang telah berhasil mengintegrasikan teknologi ini untuk memerangi korupsi, serta tantangan yang mungkin dihadapi dalam adopsinya di Indonesia.',
            ],
            [
                'id' => 5,
                'judul' => 'Dampak Korupsi Terhadap Pembangunan Ekonomi Nasional',
                'gambar' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', // Ganti dengan URL gambar Anda
                'tanggal' => '2023-07-15',
                'penulis' => 'Siti Aminah',
                'isi' => 'Korupsi menghambat investasi, menurunkan kepercayaan publik, dan memperlambat pertumbuhan ekonomi. Artikel ini akan menganalisis dampak multidimensional korupsi terhadap perekonomian Indonesia. Kami akan mengkaji bagaimana korupsi mengikis fondasi institusi, merusak iklim investasi, dan menciptakan ketidaksetaraan sosial. Data empiris dari berbagai sektor akan digunakan untuk menunjukkan korelasi antara tingkat korupsi dan indikator ekonomi makro seperti PDB, inflasi, dan tingkat kemiskinan. Selain itu, artikel ini juga akan mengusulkan strategi-strategi komprehensif untuk memberantas korupsi dan memulihkan kepercayaan investor demi pembangunan ekonomi yang berkelanjutan.',
            ],
            [
                'id' => 6,
                'judul' => 'Strategi Penindakan Korupsi di Era Digital',
                'gambar' => 'https://images.unsplash.com/photo-1549926639-6ff14b0b8c6f?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', // Ganti dengan URL gambar Anda
                'tanggal' => '2023-06-10',
                'penulis' => 'Faisal Rahman',
                'isi' => 'Penggunaan big data, AI, dan forensik digital menjadi kunci dalam mengungkap kasus korupsi yang semakin kompleks. Di era digital ini, para koruptor menggunakan metode yang canggih untuk menyembunyikan jejak kejahatan mereka. Oleh karena itu, aparat penegak hukum harus mengadopsi teknologi mutakhir untuk melawan kejahatan ini. Artikel ini akan membahas bagaimana alat-alat seperti analisis big data, kecerdasan buatan, dan teknik forensik digital dapat digunakan untuk mendeteksi pola-pola mencurigakan, melacak aliran dana ilegal, dan mengumpulkan bukti yang kuat. Kami juga akan mengeksplorasi tantangan privasi dan etika yang muncul seiring dengan penggunaan teknologi ini dalam penindakan korupsi.',
            ],
             [
                'id' => 7,
                'judul' => 'Strategi Penindakan Korupsi di Era Digital',
                'gambar' => 'https://images.unsplash.com/photo-1549926639-6ff14b0b8c6f?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', // Ganti dengan URL gambar Anda
                'tanggal' => '2023-06-10',
                'penulis' => 'Faisal Rahman',
                'isi' => 'Penggunaan big data, AI, dan forensik digital menjadi kunci dalam mengungkap kasus korupsi yang semakin kompleks. Di era digital ini, para koruptor menggunakan metode yang canggih untuk menyembunyikan jejak kejahatan mereka. Oleh karena itu, aparat penegak hukum harus mengadopsi teknologi mutakhir untuk melawan kejahatan ini. Artikel ini akan membahas bagaimana alat-alat seperti analisis big data, kecerdasan buatan, dan teknik forensik digital dapat digunakan untuk mendeteksi pola-pola mencurigakan, melacak aliran dana ilegal, dan mengumpulkan bukti yang kuat. Kami juga akan mengeksplorasi tantangan privasi dan etika yang muncul seiring dengan penggunaan teknologi ini dalam penindakan korupsi.',
            ],
        ];

        // Urutkan artikel dari terbaru ke terlama
        usort($articles, function ($a, $b) {
            return strtotime($b['tanggal']) - strtotime($a['tanggal']);
        });

        return view('artikel', compact('articles'));
    }

    public function show($id)
    {
        $allArticles = [
            [
                'id' => 1,
                'judul' => 'Dana Kampanye Fiktif: Modus Cuci Uang Politisi',
                'gambar' => 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'tanggal' => '2023-12-12',
                'penulis' => 'Lina Marlina',
                'isi' => 'Ini adalah isi lengkap dari artikel Dana Kampanye Fiktif: Modus Cuci Uang Politisi. Dalam investigasi terbaru, terungkap praktik licik di balik dana kampanye beberapa politisi. Modus pencucian uang melalui sumbangan fiktif menjadi sorotan utama, menimbulkan kekhawatiran serius tentang integritas pemilu. Analisis mendalam menunjukkan pola yang terstruktur dalam manipulasi laporan keuangan, melibatkan pihak-pihak yang tidak terduga. Artikel ini akan membahas secara rinci bagaimana skema ini dijalankan, siapa saja yang terlibat, dan dampak luasnya terhadap demokrasi kita.  Lebih lanjut, artikel ini akan mengeksplorasi implikasi hukum dari praktik ini dan langkah-langkah yang dapat diambil untuk memperkuat regulasi pendanaan kampanye. Kami juga akan melihat beberapa kasus serupa di negara lain untuk mendapatkan perspektif global tentang masalah ini. Penting untuk diingat bahwa korupsi politik bukan hanya masalah etika, tetapi juga ancaman nyata terhadap stabilitas dan kemakmuran suatu negara. Oleh karena itu, partisipasi aktif masyarakat dan penegakan hukum yang tegas sangat diperlukan untuk memberantas praktik semacam ini.',
            ],
            [
                'id' => 2,
                'judul' => 'Skandal Asmara dan Penggelapan Dana Partai',
                'gambar' => 'https://images.unsplash.com/photo-1516053335503-4f997c67530e?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'tanggal' => '2023-10-08',
                'penulis' => 'Rina Dewi',
                'isi' => 'Ini adalah isi lengkap dari artikel Skandal Asmara dan Penggelapan Dana Partai. Investigasi internal mengungkap skandal ganda yang mengguncang partai besar. Bukan hanya penyalahgunaan dana, tetapi juga terungkap hubungan terlarang antara petinggi partai dan stafnya. Temuan ini memicu gelombang protes dari anggota partai dan masyarakat, menuntut transparansi dan akuntabilitas. Artikel ini akan mengupas tuntas kronologi kejadian, bukti-bukti yang ditemukan, dan konsekuensi hukum serta etika yang mungkin dihadapi para pelaku.  Kasus ini menyoroti pentingnya tata kelola partai yang bersih dan kebutuhan akan pengawasan yang ketat terhadap pejabat publik. Dampak dari skandal semacam ini tidak hanya merusak reputasi individu yang terlibat, tetapi juga mengikis kepercayaan publik terhadap institusi politik. Pendidikan etika dan integritas harus menjadi prioritas dalam pembentukan kader-kader partai untuk mencegah terulangnya kejadian serupa di masa depan. Selain itu, reformasi sistem pengawasan internal partai juga sangat mendesak.',
            ],
            [
                'id' => 3,
                'judul' => 'Proyek Fiktif Senilai Triliunan: Modus Baru Korupsi',
                'gambar' => 'https://images.unsplash.com/photo-1628126388909-7756f4d9943f?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'tanggal' => '2023-09-05',
                'penulis' => 'Dewi Anggraeni',
                'isi' => 'Ini adalah isi lengkap dari artikel Proyek Fiktif Senilai Triliunan: Modus Baru Korupsi. Sebuah laporan investigasi terbaru mengungkap jaringan korupsi skala besar yang melibatkan proyek-proyek fiktif dengan kerugian negara mencapai triliunan rupiah. Modus operandi baru yang menggunakan perusahaan cangkang (shell companies) untuk mengalirkan dana publik ke kantong pribadi para politikus terungkap. Artikel ini akan membongkar detail modus tersebut, mengidentifikasi perusahaan-perusahaan yang terlibat, dan menganalisis dampak ekonomi yang ditimbulkannya. Kami juga akan menyoroti langkah-langkah yang harus diambil untuk mencegah praktik serupa di masa depan.  Pentingnya kerja sama lintas lembaga dalam memerangi korupsi jenis baru ini tidak bisa diremehkan. Dengan semakin canggihnya modus korupsi, diperlukan juga pendekatan penegakan hukum yang inovatif. Edukasi publik tentang bahaya korupsi dan pentingnya pelaporan juga merupakan bagian integral dari upaya pencegahan. Mari bersama-sama membangun sistem yang lebih transparan dan akuntabel demi kemajuan bangsa.',
            ],
            [
                'id' => 4,
                'judul' => 'Peran Blockchain dalam Pencegahan Korupsi',
                'gambar' => 'https://images.unsplash.com/photo-1620325754593-3d077b960b76?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'tanggal' => '2023-08-20',
                'penulis' => 'Budi Santoso',
                'isi' => 'Ini adalah isi lengkap dari artikel Peran Blockchain dalam Pencegahan Korupsi. Teknologi Blockchain menawarkan solusi transparan untuk melacak aliran dana dan mencegah praktik korupsi. Dengan sifatnya yang imutabel dan terdistribusi, blockchain dapat menciptakan catatan transaksi yang tidak dapat dimanipulasi, sehingga meminimalkan peluang penyalahgunaan kekuasaan. Artikel ini akan menjelaskan bagaimana implementasi blockchain dapat meningkatkan akuntabilitas dalam pengadaan publik, pengelolaan anggaran, dan penyaluran bantuan sosial. Kami akan membahas studi kasus dari berbagai negara yang telah berhasil mengintegrasikan teknologi ini untuk memerangi korupsi, serta tantangan yang mungkin dihadapi dalam adopsinya di Indonesia.  Meskipun blockchain menawarkan potensi besar, implementasinya memerlukan pemahaman mendalam tentang teknologi dan regulasi yang tepat. Tantangan seperti skalabilitas, interoperabilitas, dan resistensi terhadap perubahan harus diatasi. Namun, dengan kolaborasi antara pemerintah, sektor swasta, dan akademisi, blockchain dapat menjadi alat yang ampuh dalam menciptakan ekosistem yang lebih bersih dan transparan.',
            ],
            [
                'id' => 5,
                'judul' => 'Dampak Korupsi Terhadap Pembangunan Ekonomi Nasional',
                'gambar' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'tanggal' => '2023-07-15',
                'penulis' => 'Siti Aminah',
                'isi' => 'Ini adalah isi lengkap dari artikel Dampak Korupsi Terhadap Pembangunan Ekonomi Nasional. Korupsi menghambat investasi, menurunkan kepercayaan publik, dan memperlambat pertumbuhan ekonomi. Artikel ini akan menganalisis dampak multidimensional korupsi terhadap perekonomian Indonesia. Kami akan mengkaji bagaimana korupsi mengikis fondasi institusi, merusak iklim investasi, dan menciptakan ketidaksetaraan sosial. Data empiris dari berbagai sektor akan digunakan untuk menunjukkan korelasi antara tingkat korupsi dan indikator ekonomi makro seperti PDB, inflasi, dan tingkat kemiskinan. Selain itu, artikel ini juga akan mengusulkan strategi-strategi komprehensif untuk memberantas korupsi dan memulihkan kepercayaan investor demi pembangunan ekonomi yang berkelanjutan.  Untuk mencapai pembangunan ekonomi yang inklusif dan merata, pemberantasan korupsi harus menjadi prioritas utama. Ini melibatkan penguatan lembaga anti-korupsi, penegakan hukum yang adil, dan peningkatan kesadaran masyarakat. Investasi dalam pendidikan dan kesehatan juga penting untuk menciptakan masyarakat yang lebih berdaya dan kurang rentan terhadap praktik korupsi.',
            ],
            [
                'id' => 6,
                'judul' => 'Strategi Penindakan Korupsi di Era Digital',
                'gambar' => 'https://images.unsplash.com/photo-1549926639-6ff14b0b8c6f?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'tanggal' => '2023-06-10',
                'penulis' => 'Faisal Rahman',
                'isi' => 'Ini adalah isi lengkap dari artikel Strategi Penindakan Korupsi di Era Digital. Penggunaan big data, AI, dan forensik digital menjadi kunci dalam mengungkap kasus korupsi yang semakin kompleks. Di era digital ini, para koruptor menggunakan metode yang canggih untuk menyembunyikan jejak kejahatan mereka. Oleh karena itu, aparat penegak hukum harus mengadopsi teknologi mutakhir untuk melawan kejahatan ini. Artikel ini akan membahas bagaimana alat-alat seperti analisis big data, kecerdasan buatan, dan teknik forensik digital dapat digunakan untuk mendeteksi pola-pola mencurigakan, melacak aliran dana ilegal, dan mengumpulkan bukti yang kuat. Kami juga akan mengeksplorasi tantangan privasi dan etika yang muncul seiring dengan penggunaan teknologi ini dalam penindakan korupsi.  Meningkatnya kejahatan siber dan penggunaan teknologi oleh koruptor menuntut inovasi dalam strategi penindakan. Kolaborasi internasional juga menjadi krusial mengingat sifat transnasional dari beberapa kasus korupsi. Pelatihan berkelanjutan bagi penegak hukum dalam bidang teknologi informasi dan keamanan siber adalah investasi penting untuk masa depan pemberantasan korupsi.',
            ],
        ];

        $article = collect($allArticles)->firstWhere('id', $id);

        if (!$article) {
            abort(404); // Tampilkan halaman 404 jika artikel tidak ditemukan
        }

        return view('artikel_detail', compact('article'));
    }
}
