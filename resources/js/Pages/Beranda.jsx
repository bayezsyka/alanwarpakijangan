import { Link } from "@inertiajs/react";
import { ArrowRight, BookOpen, Headphones, MapPin } from "lucide-react";
import { useState } from "react";
import DialogPengumuman from "../Components/DialogPengumuman";
import Seo from "../Components/Seo";
import PublikLayout from "../Layouts/PublikLayout";

function AgendaMingguan({ jadwal }) {
    const indeksHariIni = Math.max(jadwal.findIndex((hari) => hari.hari_ini), 0);
    const [indeksPratinjau, setIndeksPratinjau] = useState(null);
    const [indeksTerpilih, setIndeksTerpilih] = useState(null);
    const [indeksTerakhir, setIndeksTerakhir] = useState(indeksHariIni);
    const indeksAktif = indeksPratinjau ?? indeksTerpilih;
    const hariAktif = jadwal[indeksAktif ?? indeksTerakhir];
    const panelTerbuka = indeksAktif !== null;

    const sorotHari = (indeks) => {
        setIndeksPratinjau(indeks);
        setIndeksTerakhir(indeks);
    };

    const pilihHari = (indeks) => {
        setIndeksPratinjau(null);
        setIndeksTerakhir(indeks);
        setIndeksTerpilih((indeksSebelumnya) => (indeksSebelumnya === indeks ? null : indeks));
    };

    return (
        <section id="rutinan" className="w-full border-t border-[#d8d2c6] bg-[#f6f0e3] py-12 sm:py-16 lg:py-20">
            <div className="container-situs">
                <h2 className="judul-editorial max-w-2xl text-3xl font-semibold leading-tight text-[#0b3028] sm:text-5xl">
                    Jadwal rutinan pekan ini
                </h2>
            </div>

            <div
                className="mx-auto mt-8 w-full max-w-[80rem] px-1.5 sm:mt-10 sm:px-8"
                onMouseLeave={() => setIndeksPratinjau(null)}
            >
                <div className="relative">
                    <div className="pointer-events-none absolute left-[7.142857%] right-[7.142857%] top-[3.15rem] h-px bg-[#b8c2ba] sm:top-[3.4rem]" aria-hidden="true" />
                    <div
                        className="pointer-events-none absolute left-[7.142857%] right-[7.142857%] top-[3.15rem] h-0.5 origin-left bg-[#104438] transition-[transform,opacity] duration-500 ease-[cubic-bezier(0.16,1,0.3,1)] motion-reduce:transition-none sm:top-[3.4rem]"
                        style={{
                            opacity: panelTerbuka ? 1 : 0,
                            transform: `scaleX(${Math.max((indeksAktif ?? indeksTerakhir) / Math.max(jadwal.length - 1, 1), 0.015)})`,
                        }}
                        aria-hidden="true"
                    />

                    <div className="relative grid grid-cols-7" aria-label="Jadwal rutinan tujuh hari">
                        {jadwal.map((hari, indeks) => {
                            const jumlahKegiatan = hari.kegiatan?.length ?? 0;
                            const sedangAktif = indeksAktif === indeks;
                            const namaSingkat = hari.nama_hari.slice(0, 3);

                            return (
                                <button
                                    key={hari.tanggal_penuh}
                                    id={`tanggal-rutinan-${hari.tanggal_penuh}`}
                                    type="button"
                                    aria-expanded={sedangAktif}
                                    aria-controls="rincian-rutinan"
                                    aria-label={`${hari.nama_hari}, ${hari.tanggal} ${hari.bulan}${jumlahKegiatan ? `, ${jumlahKegiatan} kegiatan` : ", tidak ada kegiatan"}`}
                                    onMouseEnter={() => sorotHari(indeks)}
                                    onFocus={() => sorotHari(indeks)}
                                    onBlur={() => setIndeksPratinjau(null)}
                                    onClick={() => pilihHari(indeks)}
                                    className="group relative flex min-h-24 min-w-0 flex-col items-center px-0.5 text-center text-[#52665e] focus-visible:z-20 sm:min-h-28 sm:px-1"
                                >
                                    <span className={`mb-2 text-xs font-semibold leading-none transition-colors duration-200 sm:text-sm ${sedangAktif ? "text-[#104438]" : "text-[#52665e]"}`}>
                                        <span className="sm:hidden">{namaSingkat}</span>
                                        <span className="hidden sm:inline">{hari.nama_hari}</span>
                                    </span>

                                    <span
                                        className={`relative z-10 flex size-10 items-center justify-center rounded-full border bg-[#fffdf8] text-sm font-semibold leading-none transition-[transform,background-color,border-color,color] duration-300 ease-[cubic-bezier(0.16,1,0.3,1)] motion-reduce:transition-none sm:size-12 sm:text-base ${
                                            sedangAktif
                                                ? "scale-110 border-[#104438] bg-[#104438] text-white"
                                                : hari.hari_ini
                                                  ? "border-[#104438] text-[#104438]"
                                                  : jumlahKegiatan
                                                    ? "border-[#7fa294] text-[#18231f] group-hover:border-[#104438]"
                                                    : "border-[#c8cdc8] text-[#66736d]"
                                        }`}
                                    >
                                        {hari.tanggal}
                                        {jumlahKegiatan > 0 && (
                                            <span
                                                className={`absolute -right-1.5 -top-1.5 flex h-5 min-w-5 items-center justify-center rounded-full px-1 text-xs font-bold leading-none transition-colors duration-200 ${
                                                    sedangAktif ? "bg-[#d5af64] text-[#0b3028]" : "bg-[#104438] text-white"
                                                }`}
                                                aria-hidden="true"
                                            >
                                                {jumlahKegiatan}
                                            </span>
                                        )}
                                    </span>

                                    <span className={`mt-2 text-xs font-semibold leading-none transition-colors duration-200 ${sedangAktif ? "text-[#104438]" : "text-[#6b7872]"}`}>
                                        {hari.bulan}
                                    </span>
                                    {hari.hari_ini && <span className="mt-1 hidden text-xs font-medium text-[#104438] sm:block">Hari ini</span>}
                                </button>
                            );
                        })}
                    </div>
                </div>

                <div
                    className={`grid transition-[grid-template-rows,opacity] duration-500 ease-[cubic-bezier(0.16,1,0.3,1)] motion-reduce:transition-none ${
                        panelTerbuka ? "grid-rows-[1fr] opacity-100" : "grid-rows-[0fr] opacity-0"
                    }`}
                >
                    <div className="min-h-0 overflow-hidden">
                        <div
                            id="rincian-rutinan"
                            role="region"
                            aria-labelledby={`tanggal-rutinan-${hariAktif.tanggal_penuh}`}
                            aria-hidden={!panelTerbuka}
                            className="grid gap-6 border-t border-[#b8c2ba] px-2 pb-2 pt-6 sm:px-0 sm:pt-8 lg:grid-cols-[0.55fr_1.45fr] lg:gap-12"
                        >
                            <div>
                                <p className="text-sm font-semibold text-[#1c6a55]">
                                    {hariAktif.nama_hari}, {hariAktif.tanggal} {hariAktif.bulan}
                                </p>
                                <h3 className="judul-editorial mt-2 text-2xl font-semibold leading-tight text-[#0b3028] sm:text-3xl">
                                    {hariAktif.kegiatan.length > 0 ? `${hariAktif.kegiatan.length} kegiatan` : "Tidak ada rutinan"}
                                </h3>
                                {hariAktif.hari_ini && <p className="mt-2 text-sm text-[#52665e]">Jadwal hari ini</p>}
                            </div>

                            {hariAktif.kegiatan.length > 0 ? (
                                <ol className="divide-y divide-[#d8d2c6] border-y border-[#d8d2c6]">
                                    {hariAktif.kegiatan.map((kegiatan) => (
                                        <li key={`${hariAktif.tanggal_penuh}-${kegiatan.id}`} className="grid gap-2 py-5 sm:grid-cols-[7rem_1fr] sm:gap-6 sm:py-6">
                                            <p className={`text-sm font-semibold ${kegiatan.libur ? "text-[#9a4a38]" : "text-[#1c6a55]"}`}>
                                                {kegiatan.libur ? "Libur" : kegiatan.waktu}
                                            </p>
                                            <div className="min-w-0">
                                                <h4 className="judul-editorial text-xl font-semibold leading-snug text-[#18231f] sm:text-2xl">{kegiatan.nama}</h4>
                                                {(kegiatan.tempat || kegiatan.pengisi || kegiatan.kitab || kegiatan.keterangan) && (
                                                    <dl className="mt-3 grid gap-x-8 gap-y-2 text-sm leading-relaxed text-[#52665e] sm:grid-cols-2">
                                                        {kegiatan.tempat && <div><dt className="font-semibold text-[#18231f]">Tempat</dt><dd>{kegiatan.tempat}</dd></div>}
                                                        {kegiatan.pengisi && <div><dt className="font-semibold text-[#18231f]">Pengisi</dt><dd>{kegiatan.pengisi}</dd></div>}
                                                        {kegiatan.kitab && <div><dt className="font-semibold text-[#18231f]">Kitab</dt><dd>{kegiatan.kitab}</dd></div>}
                                                        {kegiatan.keterangan && <div><dt className="font-semibold text-[#18231f]">Keterangan</dt><dd>{kegiatan.keterangan}</dd></div>}
                                                    </dl>
                                                )}
                                            </div>
                                        </li>
                                    ))}
                                </ol>
                            ) : (
                                <p className="border-y border-[#d8d2c6] py-6 text-sm text-[#52665e]">Belum ada kegiatan yang dijadwalkan pada tanggal ini.</p>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
}

export default function Beranda({ artikelTerbaru, selasananTerbaru, jadwal, galeri, pengumuman, seo }) {
    return (
        <PublikLayout menyatuDenganHero>
            <Seo seo={seo} />
            <section className="relative flex min-h-screen min-h-[100dvh] w-full max-w-full items-center overflow-hidden bg-[#0b3028] text-white">
                <div className="absolute inset-0 w-full h-full lg:left-auto lg:right-0 lg:w-[58%]">
                    <img src="/images/landingpage/bgppdb.png" alt="Pondok Pesantren Al-Anwar Pakijangan" className="h-full w-full object-cover object-center" />
                    <div className="absolute inset-0 bg-gradient-to-t from-[#0b3028] via-[#0b3028]/75 to-[#0b3028]/45 lg:bg-gradient-to-r lg:from-[#0b3028] lg:via-[#0b3028]/35 lg:to-transparent" />
                </div>
                <div className="container-situs relative z-10 flex min-h-screen min-h-[100dvh] w-full max-w-full items-center pb-12 pt-20 sm:pb-16 sm:pt-28 lg:py-24">
                    <div className="max-w-3xl lg:w-[54%]">
                        <p className="max-w-lg text-xs font-medium leading-relaxed text-[#e6d6b1] sm:text-sm">Pendidikan salaf modern di Pakijangan, Bulakamba, Brebes</p>
                        <h1 className="judul-editorial mt-4 text-[clamp(2.35rem,7vw,6.5rem)] font-semibold leading-[0.92] tracking-[-0.035em]">
                            Mendampingi potensi, membentuk karakter.
                        </h1>
                        <p className="mt-5 max-w-xl text-sm leading-relaxed text-[#e1e9e5] sm:mt-7 sm:text-lg sm:leading-7">
                            Pondok Pesantren Al-Anwar mendampingi potensi santri melalui penguatan akidah, akhlak, ilmu pengetahuan, dan kemandirian.
                        </p>
                        <div className="mt-7 flex flex-col gap-2.5 sm:flex-row sm:gap-3">
                            <Link href="/profil" className="inline-flex min-h-11 items-center justify-center rounded-md bg-[#f6f0e3] px-6 text-sm font-semibold text-[#0b3028] hover:bg-white sm:min-h-12">
                                Profil Pesantren
                            </Link>
                            <a href="#rutinan" className="inline-flex min-h-11 items-center justify-center rounded-md border border-white/40 px-6 text-sm font-semibold text-white hover:bg-white/10 sm:min-h-12">
                                Jadwal Rutinan
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            {jadwal.length > 0 && <AgendaMingguan jadwal={jadwal} />}

            {(selasananTerbaru || artikelTerbaru.length > 0) && (
                <section className="w-full py-12 sm:py-20 lg:py-24">
                    <div className="container-situs">
                        <div className="flex flex-col justify-between gap-4 border-b border-[#d8d2c6] pb-5 sm:flex-row sm:items-end sm:pb-7">
                            <h2 className="judul-editorial max-w-2xl text-3xl font-semibold leading-tight text-[#0b3028] sm:text-5xl">Bacaan dan kajian terbaru</h2>
                            {artikelTerbaru.length > 0 && <Link href="/artikel" className="inline-flex min-h-10 items-center gap-2 self-start text-sm font-semibold text-[#104438] hover:underline sm:self-auto">Semua artikel <ArrowRight size={16} /></Link>}
                        </div>

                        <div className="mt-6 grid gap-8 lg:grid-cols-[1.25fr_0.75fr] lg:gap-14">
                            {selasananTerbaru && (
                                <Link href={selasananTerbaru.tautan} className="group grid overflow-hidden rounded-lg bg-[#104438] text-white sm:grid-cols-[1.05fr_0.95fr]">
                                    <div className="aspect-[16/9] sm:aspect-auto sm:min-h-64 overflow-hidden">
                                        <img src={selasananTerbaru.gambar} alt={selasananTerbaru.judul} className="h-full w-full object-cover transition-transform duration-500 group-hover:scale-[1.03]" />
                                    </div>
                                    <div className="flex flex-col justify-between p-5 sm:p-8">
                                        <div>
                                            <div className="flex items-center gap-2.5 text-xs text-[#cbdad4] sm:text-sm">
                                                <BookOpen size={16} /> Kajian Selasanan
                                                {selasananTerbaru.ada_audio && <Headphones size={16} aria-label="Tersedia audio" />}
                                            </div>
                                            <h3 className="judul-editorial mt-3 text-xl font-semibold leading-tight sm:mt-5 sm:text-3xl">{selasananTerbaru.judul}</h3>
                                        </div>
                                        <div className="mt-6 border-t border-white/20 pt-3 text-xs text-[#cbdad4] sm:mt-10 sm:pt-4 sm:text-sm">
                                            <p className="font-semibold text-white">{selasananTerbaru.pembicara}</p>
                                            <p className="mt-0.5">{selasananTerbaru.tanggal}</p>
                                        </div>
                                    </div>
                                </Link>
                            )}

                            <div className="divide-y divide-[#d8d2c6] border-y border-[#d8d2c6]">
                                {artikelTerbaru.map((artikel) => (
                                    <Link key={artikel.id} href={artikel.tautan} className="group grid grid-cols-[5rem_1fr] gap-3.5 py-4 sm:grid-cols-[8rem_1fr] sm:gap-4 sm:py-5">
                                        <img src={artikel.gambar} alt="" className="aspect-[4/3] w-full rounded object-cover" />
                                        <div className="min-w-0">
                                            <p className="text-[11px] font-semibold text-[#1c6a55]">{artikel.kategori?.nama || "Artikel"}</p>
                                            <h3 className="judul-editorial mt-1 text-base font-semibold leading-snug text-[#18231f] group-hover:text-[#1c6a55] sm:text-xl">{artikel.judul}</h3>
                                            <p className="mt-2 text-[11px] text-[#6f7f79] sm:text-xs">{artikel.penulis} · {artikel.tanggal_singkat}</p>
                                        </div>
                                    </Link>
                                ))}
                                {!artikelTerbaru.length && <p className="py-8 text-sm text-[#6f7f79]">Belum ada artikel terbaru.</p>}
                            </div>
                        </div>
                    </div>
                </section>
            )}

            {galeri.length > 0 && (
                <section className="w-full py-12 sm:py-20 lg:py-24">
                    <div className="container-situs">
                        <div className="grid gap-8 lg:grid-cols-[0.55fr_1.45fr] lg:gap-14">
                            <div>
                                <h2 className="judul-editorial text-3xl font-semibold leading-tight text-[#0b3028] sm:text-5xl">Kehidupan di Al-Anwar</h2>
                                <p className="mt-3 text-sm leading-relaxed text-[#52665e] sm:mt-5 sm:text-base sm:leading-7">Dokumentasi kajian, pendidikan, dan kegiatan pesantren yang telah diterbitkan pengurus.</p>
                                <Link href="/galeri-acara" className="mt-5 inline-flex min-h-10 items-center gap-2 text-sm font-semibold text-[#104438] hover:underline sm:mt-7">Buka galeri <ArrowRight size={16} /></Link>
                            </div>
                            <div className="grid grid-cols-2 gap-2 sm:grid-cols-4">
                                {galeri.slice(0, 8).map((item, indeks) => (
                                    <Link key={item.id} href={item.tautan} className={`group overflow-hidden rounded-md ${indeks === 0 ? "col-span-2 row-span-2" : ""}`} aria-label={item.judul}>
                                        <img src={item.gambar} alt={item.judul} className="aspect-square h-full w-full object-cover transition-transform duration-500 group-hover:scale-[1.04]" />
                                    </Link>
                                ))}
                            </div>
                        </div>
                    </div>
                </section>
            )}

            <section className="w-full border-t border-[#d8d2c6] bg-[#fffdf8] py-10 sm:py-14">
                <div className="container-situs flex flex-col justify-between gap-5 sm:flex-row sm:items-center">
                    <div className="flex gap-3.5 sm:gap-4">
                        <MapPin className="mt-1 shrink-0 text-[#b9924b]" size={24} />
                        <div>
                            <h2 className="judul-editorial text-xl font-semibold text-[#0b3028] sm:text-2xl">Kunjungi Pondok Pesantren Al-Anwar</h2>
                            <p className="mt-1 max-w-2xl text-xs leading-relaxed text-[#52665e] sm:text-sm">Jl. Raya Pakijangan R. Bulakamba No.08, Pakijangan, Bulakamba, Brebes.</p>
                        </div>
                    </div>
                    <a href="https://www.google.com/maps?q=Pondok+Pesantren+Al+Anwar+Pakijangan" target="_blank" rel="noreferrer" className="inline-flex min-h-11 shrink-0 items-center justify-center rounded-md bg-[#104438] px-5 text-sm font-semibold text-white hover:bg-[#0b3028]">Buka Petunjuk Arah</a>
                </div>
            </section>

            <DialogPengumuman pengumuman={pengumuman} />
        </PublikLayout>
    );
}
