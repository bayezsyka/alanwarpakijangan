import { Link } from "@inertiajs/react";
import { BookOpen, Headphones } from "lucide-react";
import Paginasi from "../../Components/Paginasi";
import Seo from "../../Components/Seo";
import PublikLayout from "../../Layouts/PublikLayout";

export default function IndeksSelasanan({ terbaru, arsip, seo }) {
    const terbitanLain = arsip.data.filter((item) => item.id !== terbaru?.id);

    return (
        <PublikLayout>
            <Seo seo={seo} />
            <section className="relative overflow-hidden border-b border-white/10 bg-[#0b3028] py-10 text-white sm:py-14 lg:py-16">
                <div className="pointer-events-none absolute -right-20 -top-20 size-80 rounded-full bg-[#d5af64]/10 blur-3xl" />
                <div className="container-situs relative z-10 grid gap-6 lg:grid-cols-[1.1fr_0.9fr] lg:items-end">
                    <div>
                        <span className="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-[#d4ad5b] sm:text-sm">
                            <BookOpen size={15} /> Jurnal Mingguan Pengasuh
                        </span>
                        <h1 className="judul-editorial mt-2 text-3xl font-semibold leading-[1.08] sm:text-5xl lg:text-6xl">Kajian Selasanan</h1>
                        <p className="mt-3 max-w-xl text-xs leading-relaxed text-[#cbdad4] sm:text-sm sm:leading-6">Rangkuman pemikiran, catatan fiqih, dan rekaman audio pengajian rutin bersama KH. Muhammad Miftah.</p>
                    </div>
                    <div className="flex flex-wrap items-center gap-3 text-xs text-[#aebfb8] lg:justify-self-end">
                        <span className="rounded-full border border-white/20 bg-white/[0.05] px-3 py-1">Kajian Rutin Selasa</span>
                        <span className="rounded-full border border-white/20 bg-white/[0.05] px-3 py-1">Tersedia Audio & Naskah</span>
                    </div>
                </div>
            </section>

            {terbaru && (
                <section className="py-12 sm:py-16 lg:py-20">
                    <div className="container-situs">
                        <Link href={terbaru.tautan} className="group grid overflow-hidden bg-[#e9eee9] lg:grid-cols-[1.15fr_0.85fr]">
                            <div className="min-h-64 overflow-hidden lg:min-h-[29rem]">
                                <img src={terbaru.gambar} alt={terbaru.judul} className="h-full w-full object-cover transition-transform duration-500 group-hover:scale-[1.025]" />
                            </div>
                            <div className="flex flex-col justify-between p-6 sm:p-10 lg:p-12">
                                <div>
                                    <p className="text-sm font-semibold text-[#1c6a55]">Terbitan terbaru · {terbaru.periode}</p>
                                    <h2 className="judul-editorial mt-5 text-4xl font-semibold leading-tight text-[#0b3028] sm:text-5xl">{terbaru.judul}</h2>
                                    <p className="mt-6 leading-7 text-[#53675f]">{terbaru.pembicara}<br />{terbaru.tanggal}</p>
                                </div>
                                <div className="mt-10 flex flex-wrap gap-3">
                                    <span className="inline-flex min-h-12 items-center justify-center rounded-md bg-[#104438] px-5 font-semibold text-white">Baca Jurnal</span>
                                    {terbaru.audio && <span className="inline-flex min-h-12 items-center gap-2 rounded-md border border-[#104438] px-5 font-semibold text-[#104438]"><Headphones size={18} /> Tersedia audio</span>}
                                </div>
                            </div>
                        </Link>
                    </div>
                </section>
            )}

            <section className="border-t border-[#d8d2c6] py-12 sm:py-16 lg:py-20">
                <div className="container-situs">
                    <h2 className="judul-editorial text-4xl font-semibold text-[#0b3028]">Arsip kajian</h2>
                    {terbitanLain.length > 0 ? (
                        <div className="mt-8 grid gap-x-7 gap-y-10 sm:grid-cols-2 lg:grid-cols-3">
                            {terbitanLain.map((item) => (
                                <article key={item.id}>
                                    <Link href={item.tautan} className="group block">
                                        <div className="relative overflow-hidden bg-[#e9eee9]">
                                            <img src={item.gambar} alt={item.judul} className="aspect-[4/3] w-full object-cover transition-transform duration-500 group-hover:scale-[1.025]" />
                                            {item.audio && <span className="absolute bottom-3 right-3 inline-flex size-10 items-center justify-center rounded-full bg-[#fffdf8] text-[#104438]" aria-label="Tersedia audio"><Headphones size={18} /></span>}
                                        </div>
                                        <p className="mt-5 text-xs font-semibold text-[#1c6a55]">{item.periode}</p>
                                        <h3 className="judul-editorial mt-2 text-2xl font-semibold leading-snug text-[#0b3028] group-hover:text-[#1c6a55]">{item.judul}</h3>
                                        <div className="mt-4 flex items-center justify-between gap-3 border-t border-[#d8d2c6] pt-4 text-xs text-[#6f7f79]">
                                            <span className="truncate">{item.pembicara}</span>
                                            <span className="shrink-0">{item.tanggal_singkat}</span>
                                        </div>
                                    </Link>
                                </article>
                            ))}
                        </div>
                    ) : (
                        <div className="mt-8 border-y border-[#d8d2c6] py-10 text-[#65766f]">Belum ada terbitan lain dalam arsip Selasanan.</div>
                    )}
                    <Paginasi links={arsip.links} />
                </div>
            </section>
        </PublikLayout>
    );
}
