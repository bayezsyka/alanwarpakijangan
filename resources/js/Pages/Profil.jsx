import { Link } from "@inertiajs/react";
import { BookOpen, Check, MapPin, Phone } from "lucide-react";
import Seo from "../Components/Seo";
import PublikLayout from "../Layouts/PublikLayout";

const nilaiSantri = [
    {
        nilai: "Kemandirian",
        keterangan: "Membiasakan santri mengelola tanggung jawab pribadi, kedewasaan bertindak, dan kesiapan hidup mandiri.",
    },
    {
        nilai: "Kepedulian",
        keterangan: "Menumbuhkan kepekaan sosial, rasa persaudaraan sesama santri, serta empati kepada masyarakat luas.",
    },
    {
        nilai: "Kedisiplinan",
        keterangan: "Menjaga keteraturan waktu mengaji, belajar, beribadah, dan istirahat dalam ritme keseharian pesantren.",
    },
    {
        nilai: "Kejujuran",
        keterangan: "Menjadikan kejujuran akidah, perkataan, dan muamalah sebagai fondasi akhlakul karimah yang tak tergantikan.",
    },
    {
        nilai: "Sikap Inovatif",
        keterangan: "Mendorong daya cipta, keterbukaan terhadap wawasan sains dan teknologi tanpa mencabut akar salaf.",
    },
];

const programPendidikan = [
    {
        nama: "Pendidikan Salafiyah",
        kategori: "Kurikulum Pesantren",
        deskripsi: "Pengkajian kitab kuning berjenjang dalam bidang nahwu, shorof, fiqih, tafsir, hadits, serta tasawuf dengan metode sorogan dan bandongan.",
        poin: ["Sorogan kitab kuning harian", "Kajian tematik dan bahtsul masail", "Halaqah tafaqquh fiddin"],
    },
    {
        nama: "SMP Al-Anwar",
        kategori: "Pendidikan Formal",
        deskripsi: "Sekolah Menengah Pertama terakreditasi di lingkungan pondok yang memadukan kurikulum nasional dengan pembiasaan adab Islami santri.",
        poin: ["Terakreditasi dan terintegrasi jam pesantren", "Laboratorium sains dan komputer", "Ekstrakurikuler robotik dan bahasa"],
    },
    {
        nama: "Madrasah Diniyah",
        kategori: "Pendidikan Nonformal",
        deskripsi: "Jenjang madrasah sore dan malam untuk memperkuat fondasi baca tulis Arab, hafalan matan, tajwid, dan amaliah ibadah sehari-hari.",
        poin: ["Kelas tingkatan berjenjang", "Praktik ubudiyah dan do'a harian", "Ujian evaluasi semester kitab"],
    },
];

const fasilitasPesantren = [
    "Masjid Kubah Jawa sebagai pusat ibadah dan kajian",
    "Kompleks asrama santri putra dan putri terpisah",
    "Ruang kelas representatif untuk SMP dan Madrasah Diniyah",
    "Laboratorium komputer dan sarana teknologi santri",
    "Perpustakaan kitab kuning dan literatur umum",
    "Koperasi santri, kantin, dan dapur bersama",
    "Lapangan olahraga dan ruang aktivitas santri",
    "Lingkungan asri di jalur strategis Pakijangan, Bulakamba",
];

export default function Profil({ seo }) {
    return (
        <PublikLayout>
            <Seo seo={seo} />

            {/* Header Profil (Archetype Deep Forest Green Berwibawa) */}
            <section className="relative overflow-hidden border-b border-white/10 bg-[#0b3028] py-12 text-[#f6f0e3] sm:py-16 lg:py-20">
                <div className="pointer-events-none absolute -right-24 -top-24 size-96 rounded-full bg-[#b9924b]/10 blur-3xl" />
                <div className="container-situs relative z-10">
                    <div className="max-w-3xl">
                        <span className="text-xs font-semibold uppercase tracking-widest text-[#d4ad5b] sm:text-sm">
                            Profil Lembaga
                        </span>
                        <h1 className="judul-editorial mt-2 text-3xl font-semibold leading-[1.08] tracking-tight text-white sm:text-5xl lg:text-6xl">
                            Pondok Pesantren Al-Anwar
                        </h1>
                        <p className="mt-2 text-base font-medium text-[#cbe0d7] sm:text-xl">
                            Pendidikan Salaf Modern & Ikon Masjid Kubah Jawa
                        </p>
                        <p className="mt-4 max-w-2xl text-xs leading-relaxed text-[#d8e5df] sm:text-sm sm:leading-7">
                            Lembaga pendidikan Islam di Desa Pakijangan, Bulakamba, Brebes yang mengintegrasikan pendalaman kitab kuning salafiyah, pendidikan formal SMP Al-Anwar, dan pembinaan karakter akhlak santri.
                        </p>
                    </div>

                    <div className="mt-8 grid grid-cols-2 gap-3 border-t border-white/15 pt-5 text-xs sm:mt-10 sm:grid-cols-4 sm:gap-4 sm:pt-6 sm:text-sm">
                        <div className="rounded-md bg-white/[0.04] p-3 border border-white/10 sm:bg-transparent sm:p-0 sm:border-0">
                            <span className="block text-[11px] text-[#aebfb8] sm:text-xs">Lokasi Pesantren</span>
                            <strong className="mt-0.5 block font-semibold text-white">Pakijangan, Brebes</strong>
                        </div>
                        <div className="rounded-md bg-white/[0.04] p-3 border border-white/10 sm:bg-transparent sm:p-0 sm:border-0">
                            <span className="block text-[11px] text-[#aebfb8] sm:text-xs">Model Pendidikan</span>
                            <strong className="mt-0.5 block font-semibold text-white">Salaf Modern</strong>
                        </div>
                        <div className="rounded-md bg-white/[0.04] p-3 border border-white/10 sm:bg-transparent sm:p-0 sm:border-0">
                            <span className="block text-[11px] text-[#aebfb8] sm:text-xs">Pendidikan Formal</span>
                            <strong className="mt-0.5 block font-semibold text-white">SMP Al-Anwar</strong>
                        </div>
                        <div className="rounded-md bg-white/[0.04] p-3 border border-white/10 sm:bg-transparent sm:p-0 sm:border-0">
                            <span className="block text-[11px] text-[#aebfb8] sm:text-xs">Sebutan Khas</span>
                            <strong className="mt-0.5 block font-semibold text-white">Kubah Jawa</strong>
                        </div>
                    </div>
                </div>
            </section>

            {/* Narasi Sejarah & Karakter Lembaga */}
            <section className="border-b border-[#d8d2c6] bg-[#fffdf8] py-16 sm:py-24">
                <div className="container-situs grid gap-12 lg:grid-cols-[1.1fr_0.9fr] lg:gap-16">
                    <div>
                        <h2 className="judul-editorial text-3xl font-semibold leading-tight text-[#0b3028] sm:text-4xl">
                            Tradisi salaf yang teguh, pandangan zaman yang terbuka.
                        </h2>
                        <div className="mt-6 space-y-5 text-base leading-8 text-[#3a4d46] sm:text-lg">
                            <p>
                                Pondok Pesantren Al-Anwar Pakijangan bermula dari niat ikhlas untuk menghidupkan majelis ilmu dan menjaga ketersambungan sanad keilmuan para ulama di pesisir barat Brebes. Dinamai Al-Anwar sebagai doa agar ilmu yang dipelajari senantiasa memancarkan cahaya (*nur*) bagi kehidupan santri dan masyarakat.
                            </p>
                            <p>
                                Kehadiran kubah masjid dengan ragam arsitektur bernuansa khas menjadikan pesantren ini akrab dikenal oleh masyarakat sebagai <em>Pesantren Kubah Jawa</em>. Di bawah naungan kubah ini, ratusan santri menimba kearifan kitab klasik sekaligus menyiapkan diri menyongsong tantangan zaman melalui jenjang pendidikan formal SMP.
                            </p>
                            <p>
                                Kami meyakini bahwa santri abad ini tidak cukup hanya menguasai teori teks, tetapi harus memiliki integritas moral, kemandirian hidup, dan keterampilan praktis agar mampu memberi manfaat nyata saat terjun ke tengah masyarakat.
                            </p>
                        </div>
                    </div>

                    <div className="space-y-6">
                        <div className="rounded-lg border border-[#d8d2c6] bg-[#f6f0e3] p-7 sm:p-9">
                            <h3 className="judul-editorial text-2xl font-semibold text-[#0b3028]">
                                Masyayikh & Pimpinan
                            </h3>

                            <dl className="mt-6 divide-y divide-[#dfd7c8] text-sm">
                                <div className="grid grid-cols-[6.5rem_1fr] gap-3 py-4">
                                    <dt className="text-[#6d7e77]">Pendiri</dt>
                                    <dd className="font-semibold text-[#18231f]">KH. Anwar Mukhtar</dd>
                                </div>
                                <div className="grid grid-cols-[6.5rem_1fr] gap-3 py-4">
                                    <dt className="text-[#6d7e77]">Pengasuh</dt>
                                    <dd className="font-semibold text-[#18231f]">KH. Muhammad Miftah</dd>
                                </div>
                                <div className="grid grid-cols-[6.5rem_1fr] gap-3 py-4">
                                    <dt className="text-[#6d7e77]">Afiliasi</dt>
                                    <dd className="text-[#364942]">Ahlussunnah wal Jama&apos;ah An-Nahdliyyah</dd>
                                </div>
                                <div className="grid grid-cols-[6.5rem_1fr] gap-3 py-4">
                                    <dt className="text-[#6d7e77]">Fokus Asasi</dt>
                                    <dd className="leading-relaxed text-[#364942]">
                                        Penguatan akidah, adab kesantrian, keluhuran budi pekerti, serta keunggulan nalar ilmu pengetahuan.
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        <div className="rounded-lg border border-[#104438]/20 bg-[#104438] p-7 text-white sm:p-8">
                            <span className="font-serif italic text-[#e6d6b1] text-sm">Visi Pembinaan</span>
                            <blockquote className="mt-2 text-xl font-medium leading-snug">
                                &ldquo;Mendampingi potensi santri, membentuk karakter, dan menguatkan ilmu sebagai lentera hidup.&rdquo;
                            </blockquote>
                        </div>
                    </div>
                </div>
            </section>

            {/* Jenjang dan Program Pendidikan */}
            <section className="border-b border-[#d8d2c6] bg-[#fbf9f4] py-16 sm:py-24">
                <div className="container-situs">
                    <div className="max-w-2xl">
                        <span className="font-serif italic text-[#b9924b] text-base">Sistem Pembelajaran</span>
                        <h2 className="judul-editorial mt-1 text-3xl font-semibold leading-tight text-[#0b3028] sm:text-4xl">
                            Tiga pilar pendidikan yang saling menguatkan.
                        </h2>
                    </div>

                    <div className="mt-12 grid gap-8 md:grid-cols-3">
                        {programPendidikan.map((item) => (
                            <div key={item.nama} className="flex flex-col justify-between rounded-lg border border-[#d8d2c6] bg-white p-7 sm:p-8">
                                <div>
                                    <p className="text-xs font-semibold uppercase tracking-wider text-[#1c6a55]">
                                        {item.kategori}
                                    </p>
                                    <h3 className="judul-editorial mt-3 text-2xl font-semibold text-[#0b3028]">
                                        {item.nama}
                                    </h3>
                                    <p className="mt-4 text-sm leading-6 text-[#52665e]">
                                        {item.deskripsi}
                                    </p>
                                </div>

                                <div className="mt-8 border-t border-[#ece7dc] pt-6">
                                    <ul className="space-y-2.5 text-xs text-[#364942]">
                                        {item.poin.map((p) => (
                                            <li key={p} className="flex items-start gap-2.5">
                                                <Check size={15} className="mt-0.5 shrink-0 text-[#104438]" />
                                                <span>{p}</span>
                                            </li>
                                        ))}
                                    </ul>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            </section>

            {/* Nilai Utama Karakter Santri */}
            <section className="border-b border-[#d8d2c6] bg-[#fffdf8] py-16 sm:py-24">
                <div className="container-situs">
                    <div className="grid gap-12 lg:grid-cols-[0.9fr_1.1fr] lg:gap-16">
                        <div>
                            <span className="font-serif italic text-[#b9924b] text-base">Pijakan Akhlak</span>
                            <h2 className="judul-editorial mt-1 text-3xl font-semibold leading-tight text-[#0b3028] sm:text-4xl">
                                Lima nilai karakter santri Al-Anwar Pakijangan.
                            </h2>
                            <p className="mt-5 text-base leading-7 text-[#52665e]">
                                Nilai-nilai ini bukan sekadar semboyan dinding, melainkan tata laku keseharian yang dilatih sejak santri bangun tidur hingga kembali beristirahat di malam hari.
                            </p>
                        </div>

                        <div className="divide-y divide-[#d8d2c6] border-y border-[#d8d2c6]">
                            {nilaiSantri.map((n, indeks) => (
                                <div key={n.nilai} className="grid grid-cols-[2.5rem_1fr] gap-4 py-5 sm:grid-cols-[3.5rem_1fr] sm:gap-6">
                                    <span className="font-serif italic text-2xl font-semibold text-[#b9924b]">
                                        0{indeks + 1}
                                    </span>
                                    <div>
                                        <h3 className="judul-editorial text-2xl font-semibold text-[#0b3028]">
                                            {n.nilai}
                                        </h3>
                                        <p className="mt-2 text-sm leading-6 text-[#52665e]">
                                            {n.keterangan}
                                        </p>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>
                </div>
            </section>

            {/* Sarana & Lingkungan */}
            <section className="border-b border-[#d8d2c6] bg-[#fbf9f4] py-16 sm:py-24">
                <div className="container-situs">
                    <div className="max-w-2xl">
                        <span className="font-serif italic text-[#b9924b] text-base">Fasilitas Penunjang</span>
                        <h2 className="judul-editorial mt-1 text-3xl font-semibold leading-tight text-[#0b3028] sm:text-4xl">
                            Lingkungan belajar yang kondusif dan terpadu.
                        </h2>
                    </div>

                    <div className="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                        {fasilitasPesantren.map((fasilitas) => (
                            <div key={fasilitas} className="rounded-md border border-[#d8d2c6] bg-white p-5">
                                <BookOpen size={19} className="text-[#1c6a55]" />
                                <p className="mt-3 text-sm font-medium leading-relaxed text-[#263a33]">
                                    {fasilitas}
                                </p>
                            </div>
                        ))}
                    </div>
                </div>
            </section>

            {/* Lokasi & Kontak */}
            <section id="lokasi" className="bg-[#fffdf8] py-16 sm:py-24">
                <div className="container-situs grid gap-10 lg:grid-cols-[1.1fr_0.9fr] lg:gap-16">
                    <div>
                        <span className="font-serif italic text-[#b9924b] text-base">Kunjungan & Silaturahmi</span>
                        <h2 className="judul-editorial mt-1 text-3xl font-semibold leading-tight text-[#0b3028] sm:text-4xl">
                            Alamat dan Lokasi Pesantren
                        </h2>
                        <p className="mt-4 text-base leading-7 text-[#52665e]">
                            Pondok Pesantren Al-Anwar berlokasi strategis di tepi jalur utama Pantura Brebes, mudah diakses kendaraan roda dua, roda empat, maupun angkutan umum.
                        </p>

                        <div className="mt-8 space-y-4 text-sm text-[#263a33]">
                            <div className="flex items-start gap-3">
                                <MapPin size={20} className="mt-0.5 shrink-0 text-[#104438]" />
                                <div>
                                    <strong className="block text-base font-semibold text-[#0b3028]">Pondok Pesantren Al-Anwar Pakijangan</strong>
                                    <p className="mt-1 leading-relaxed text-[#52665e]">
                                        Jl. Raya Pakijangan Bulakamba No. 08, RT 04 / RW 02, Desa Pakijangan, Kecamatan Bulakamba, Kabupaten Brebes, Jawa Tengah 52253.
                                    </p>
                                </div>
                            </div>
                            <div className="flex items-center gap-3">
                                <Phone size={20} className="shrink-0 text-[#104438]" />
                                <span>(0283) 870290 / WhatsApp: 0851 6160 3362</span>
                            </div>
                        </div>

                        <div className="mt-10 flex flex-wrap gap-4">
                            <a
                                href="https://www.google.com/maps?q=Pondok+Pesantren+Al+Anwar+Pakijangan"
                                target="_blank"
                                rel="noreferrer"
                                className="inline-flex min-h-12 items-center justify-center rounded-md bg-[#104438] px-6 font-semibold text-white hover:bg-[#0b3028]"
                            >
                                Buka Petunjuk Arah di Google Maps
                            </a>
                            <a
                                href="https://wa.me/6285161603362"
                                target="_blank"
                                rel="noreferrer"
                                className="inline-flex min-h-12 items-center justify-center rounded-md border border-[#c9c0b0] px-5 font-semibold text-[#18231f] hover:bg-[#f6f0e3]"
                            >
                                Hubungi Pengurus via WhatsApp
                            </a>
                        </div>
                    </div>

                    <div className="flex flex-col justify-between rounded-lg border border-[#d8d2c6] bg-[#f6f0e3] p-7 sm:p-9">
                        <div>
                            <h3 className="judul-editorial text-2xl font-semibold text-[#0b3028]">
                                Jam Layanan & Silaturahmi
                            </h3>
                            <p className="mt-3 text-sm leading-6 text-[#52665e]">
                                Kantor sekretariat pesantren melayani silaturahmi wali santri dan masyarakat setiap hari dengan memperhatikan jadwal ibadah dan jam mengaji santri.
                            </p>

                            <dl className="mt-6 space-y-3 border-t border-[#dfd7c8] pt-6 text-sm">
                                <div className="flex justify-between">
                                    <dt className="text-[#6d7e77]">Senin – Ahad</dt>
                                    <dd className="font-semibold text-[#0b3028]">08.00 – 16.30 WIB</dd>
                                </div>
                                <div className="flex justify-between">
                                    <dt className="text-[#6d7e77]">Kunjungan Wali Santri</dt>
                                    <dd className="font-semibold text-[#0b3028]">Jumat & Ahad</dd>
                                </div>
                                <div className="flex justify-between">
                                    <dt className="text-[#6d7e77]">Waktu Salat Berjamaah</dt>
                                    <dd className="font-semibold text-[#0b3028]">Istirahat Pelayanan</dd>
                                </div>
                            </dl>
                        </div>

                        <div className="mt-8 border-t border-[#dfd7c8] pt-5 text-xs text-[#6d7e77]">
                            <p>
                                Untuk keperluan sowan pimpinan atau kunjungan rombongan, disarankan mengonfirmasi terlebih dahulu kepada sekretariat melalui nomor WhatsApp di atas.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </PublikLayout>
    );
}

