import { Link } from "@inertiajs/react";
import { ArrowUp, ChevronLeft, Copy, Download, Headphones, Share2 } from "lucide-react";
import { useEffect, useState } from "react";
import Seo from "../../Components/Seo";
import PublikLayout from "../../Layouts/PublikLayout";

export default function DetailSelasanan({ selasanan, seo }) {
    const [kemajuan, setKemajuan] = useState(0);
    const [pesan, setPesan] = useState("");

    useEffect(() => {
        const perbarui = () => {
            const tinggi = document.documentElement.scrollHeight - window.innerHeight;
            setKemajuan(tinggi > 0 ? Math.min((window.scrollY / tinggi) * 100, 100) : 0);
        };
        perbarui();
        window.addEventListener("scroll", perbarui, { passive: true });
        return () => window.removeEventListener("scroll", perbarui);
    }, []);

    async function salinTautan() {
        try {
            await navigator.clipboard.writeText(seo.canonical);
            setPesan("Tautan kajian telah disalin.");
        } catch {
            setPesan("Tautan belum dapat disalin. Silakan salin dari bilah alamat.");
        }
        window.setTimeout(() => setPesan(""), 2600);
    }

    async function bagikan() {
        if (navigator.share) {
            await navigator.share({ title: selasanan.judul, url: seo.canonical }).catch(() => {});
            return;
        }
        salinTautan();
    }

    return (
        <PublikLayout>
            <Seo seo={seo} />
            <div className="fixed inset-x-0 top-0 z-[60] h-1" aria-hidden="true"><div className="h-full bg-[#b9924b]" style={{ width: `${kemajuan}%` }} /></div>
            <article>
                <header className="border-b border-[#ded8cc] bg-[#f6f0e3] py-5 sm:py-8 lg:py-10">
                    <div className="container-situs max-w-5xl">
                        <Link href="/selasanan" className="inline-flex items-center gap-1.5 text-xs font-semibold text-[#104438] hover:underline">
                            <ChevronLeft size={16} /> Kembali ke Kajian Selasanan
                        </Link>
                        <div className="mt-4 max-w-4xl">
                            <span className="text-[11px] font-semibold uppercase tracking-wider text-[#1c6a55] sm:text-xs">{selasanan.periode}</span>
                            <h1 className="judul-editorial mt-2 text-2xl font-semibold leading-[1.12] text-[#0b3028] sm:text-4xl lg:text-5xl">{selasanan.judul}</h1>
                            <div className="mt-3 flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-[#5b6d66]">
                                <span className="font-semibold text-[#263a33]">{selasanan.pembicara}</span>
                                <span>·</span>
                                <time>{selasanan.tanggal}</time>
                            </div>
                            <div className="mt-4 flex items-center gap-2">
                                <button type="button" onClick={bagikan} className="inline-flex min-h-9 items-center gap-1.5 rounded-md bg-[#104438] px-3.5 text-xs font-semibold text-white hover:bg-[#0b3028] transition-colors">
                                    <Share2 size={14} /> <span>Bagikan</span>
                                </button>
                                <button type="button" onClick={salinTautan} className="inline-flex min-h-9 items-center gap-1.5 rounded-md border border-[#c4bcaf] bg-white px-3 text-xs font-semibold text-[#104438] hover:bg-[#f6f0e3] transition-colors">
                                    <Copy size={14} /> <span>Salin</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </header>

                <div className="container-situs max-w-5xl py-8 sm:py-12">
                    <img src={selasanan.gambar} alt={selasanan.judul} className="max-h-[38rem] w-full rounded-lg object-cover" />
                </div>

                <div className="container-situs max-w-4xl pb-16 sm:pb-24">
                    {selasanan.audio && (
                        <section className="mb-10 border-y border-[#cfd7d2] bg-[#e9eee9] p-5 sm:p-7" aria-labelledby="judul-audio">
                            <div className="flex items-start gap-4">
                                <span className="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#104438] text-white"><Headphones size={21} /></span>
                                <div className="min-w-0 flex-1">
                                    <h2 id="judul-audio" className="judul-editorial text-2xl font-semibold text-[#0b3028]">Rekaman audio kajian</h2>
                                    <audio controls preload="metadata" className="mt-5 w-full">
                                        <source src={selasanan.audio.url} type={selasanan.audio.mime} />
                                        Peramban Anda tidak mendukung pemutar audio.
                                    </audio>
                                    <a href={selasanan.audio.unduh} className="mt-5 inline-flex min-h-11 items-center gap-2 font-semibold text-[#104438] hover:underline"><Download size={18} /> Unduh audio{selasanan.audio.ukuran ? ` (${selasanan.audio.ukuran})` : ""}</a>
                                </div>
                            </div>
                        </section>
                    )}
                    <div className="prosa-artikel" dangerouslySetInnerHTML={{ __html: selasanan.isi }} />
                    <div className="mt-14 flex justify-end border-t border-[#d8d2c6] pt-6">
                        <button type="button" onClick={() => window.scrollTo({ top: 0, behavior: "smooth" })} className="inline-flex min-h-11 items-center gap-2 font-semibold text-[#104438] hover:underline"><ArrowUp size={18} /> Kembali ke atas</button>
                    </div>
                </div>
            </article>
            {pesan && <div role="status" className="fixed bottom-5 left-1/2 z-[70] -translate-x-1/2 rounded-md bg-[#18231f] px-5 py-3 text-sm text-white shadow-xl">{pesan}</div>}
        </PublikLayout>
    );
}
