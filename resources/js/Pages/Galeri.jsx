import { Link } from "@inertiajs/react";
import { ArrowRight, Camera, X } from "lucide-react";
import { useEffect, useRef, useState } from "react";
import Seo from "../Components/Seo";
import PublikLayout from "../Layouts/PublikLayout";

function DialogFoto({ acara, tutup }) {
    const tombolTutup = useRef(null);

    useEffect(() => {
        document.body.style.overflow = "hidden";
        tombolTutup.current?.focus();
        const tanganiTombol = (event) => {
            if (event.key === "Escape") tutup();
        };
        document.addEventListener("keydown", tanganiTombol);
        return () => {
            document.body.style.overflow = "";
            document.removeEventListener("keydown", tanganiTombol);
        };
    }, [tutup]);

    return (
        <div className="fixed inset-0 z-[70] overflow-y-auto bg-[#071b16]/90 p-3 sm:p-6" role="presentation" onMouseDown={(event) => event.target === event.currentTarget && tutup()}>
            <section role="dialog" aria-modal="true" aria-labelledby="judul-dialog-galeri" className="mx-auto max-w-6xl bg-[#fffdf8] p-4 shadow-2xl sm:p-7">
                <div className="flex items-start justify-between gap-6 border-b border-[#d8d2c6] pb-5">
                    <div>
                        <h2 id="judul-dialog-galeri" className="judul-editorial text-3xl font-semibold text-[#0b3028]">{acara.nama}</h2>
                        {acara.tanggal && <p className="mt-2 text-sm text-[#65766f]">{acara.tanggal}</p>}
                    </div>
                    <button ref={tombolTutup} type="button" onClick={tutup} className="flex size-11 shrink-0 items-center justify-center rounded-full border border-[#c9c0b0] text-[#0b3028] hover:bg-[#eee7d9]" aria-label="Tutup galeri"><X size={20} /></button>
                </div>
                <div className="mt-6 grid grid-cols-2 gap-2 sm:grid-cols-3 sm:gap-4">
                    {acara.foto.map((foto) => <img key={foto.id} src={foto.url} alt={foto.alt} className="aspect-square w-full object-cover" />)}
                </div>
            </section>
        </div>
    );
}

export default function Galeri({ acara, selasanan, seo }) {
    const [acaraAktif, setAcaraAktif] = useState(null);

    return (
        <PublikLayout>
            <Seo seo={seo} />
            <section className="border-b border-[#ded8cc] bg-[#f6f0e3] py-10 sm:py-14 lg:py-16">
                <div className="container-situs grid gap-6 lg:grid-cols-[1.1fr_0.9fr] lg:items-end">
                    <div>
                        <span className="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-[#1c6a55]">
                            <Camera size={15} /> Dokumentasi Visual
                        </span>
                        <h1 className="judul-editorial mt-2 text-3xl font-semibold leading-[1.08] text-[#0b3028] sm:text-5xl lg:text-6xl">Galeri Pesantren</h1>
                        <p className="mt-3 max-w-xl text-xs leading-relaxed text-[#52665e] sm:text-sm sm:leading-6">Dokumentasi fotografi kegiatan santri, agenda pengajian madrasah, dan potret kehidupan sehari-hari di Al-Anwar.</p>
                    </div>
                    <div className="flex flex-wrap items-center gap-3 text-xs text-[#62736c] lg:justify-self-end">
                        <span className="rounded-full border border-[#d8d2c6] bg-white px-3.5 py-1 font-medium">{acara.length} Album Dokumentasi</span>
                        <span className="rounded-full border border-[#d8d2c6] bg-white px-3.5 py-1 font-medium">Kajian & Santri</span>
                    </div>
                </div>
            </section>

            {selasanan.length > 0 && (
                <section className="border-b border-[#d8d2c6] py-12 sm:py-16">
                    <div className="container-situs grid gap-8 lg:grid-cols-[0.55fr_1.45fr] lg:items-center">
                        <div>
                            <h2 className="judul-editorial text-3xl font-semibold text-[#0b3028] sm:text-4xl">Dokumentasi Selasanan</h2>
                            <p className="mt-4 leading-7 text-[#52665e]">Sampul dan dokumentasi terbitan kajian rutin mingguan.</p>
                            <Link href="/selasanan" className="mt-6 inline-flex min-h-11 items-center gap-2 font-semibold text-[#104438] hover:underline">Buka arsip kajian <ArrowRight size={18} /></Link>
                        </div>
                        <div className="grid grid-cols-2 gap-2 sm:grid-cols-4">
                            {selasanan.slice(0, 8).map((item, indeks) => (
                                <Link key={item.id} href={item.tautan} className={`group overflow-hidden ${indeks === 0 ? "col-span-2 row-span-2" : ""}`}>
                                    <img src={item.gambar} alt={item.judul} className="aspect-square h-full w-full object-cover transition-transform duration-500 group-hover:scale-[1.035]" />
                                </Link>
                            ))}
                        </div>
                    </div>
                </section>
            )}

            <section className="py-14 sm:py-20">
                <div className="container-situs space-y-16 sm:space-y-24">
                    {acara.map((item, indeks) => (
                        <article key={item.id} className={`grid gap-7 lg:grid-cols-2 lg:items-center lg:gap-14 ${indeks % 2 ? "lg:[&>*:first-child]:order-2" : ""}`}>
                            <button type="button" onClick={() => setAcaraAktif(item)} className="group relative block min-h-64 w-full overflow-hidden bg-[#e9eee9] text-left" aria-label={`Lihat semua foto ${item.nama}`}>
                                <div className="grid h-full min-h-64 grid-cols-2 gap-1">
                                    {item.foto.slice(0, 4).map((foto, fotoIndeks) => (
                                        <img key={foto.id} src={foto.url} alt={foto.alt} className={`h-full min-h-32 w-full object-cover transition-transform duration-500 group-hover:scale-[1.025] ${item.foto.length === 1 || (fotoIndeks === 0 && item.foto.length === 2) ? "col-span-2" : ""}`} />
                                    ))}
                                </div>
                                <span className="absolute bottom-4 right-4 inline-flex min-h-11 items-center rounded-md bg-[#fffdf8] px-4 text-sm font-semibold text-[#104438] shadow-[0_10px_30px_rgba(11,48,40,0.16)]">{item.foto.length} foto</span>
                            </button>
                            <div>
                                {item.tanggal && <p className="text-sm font-semibold text-[#1c6a55]">{item.tanggal}</p>}
                                <h2 className="judul-editorial mt-3 text-4xl font-semibold leading-tight text-[#0b3028] sm:text-5xl">{item.nama}</h2>
                                {item.deskripsi && <p className="mt-5 max-w-xl leading-7 text-[#52665e]">{item.deskripsi}</p>}
                                <button type="button" onClick={() => setAcaraAktif(item)} className="mt-7 inline-flex min-h-12 items-center gap-2 rounded-md bg-[#104438] px-5 font-semibold text-white hover:bg-[#0b3028]"><Camera size={18} /> Lihat Semua Foto</button>
                            </div>
                        </article>
                    ))}
                    {!acara.length && <div className="border-y border-[#d8d2c6] py-12 text-[#65766f]">Belum ada galeri acara yang diterbitkan.</div>}
                </div>
            </section>

            {acaraAktif && <DialogFoto acara={acaraAktif} tutup={() => setAcaraAktif(null)} />}
        </PublikLayout>
    );
}
