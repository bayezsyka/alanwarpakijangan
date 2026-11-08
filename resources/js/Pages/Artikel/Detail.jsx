import { Link } from "@inertiajs/react";
import { ArrowUp, ChevronLeft, Clock, Copy, Eye, Quote, Share2 } from "lucide-react";
import { useEffect, useRef, useState } from "react";
import ModalKutipan from "../../Components/ModalKutipan";
import Seo from "../../Components/Seo";
import PublikLayout from "../../Layouts/PublikLayout";

export default function DetailArtikel({ artikel, artikelTerkait = [], pratinjau, seo }) {
    const [kemajuan, setKemajuan] = useState(0);
    const [pesan, setPesan] = useState("");
    const [bukaModalKutipan, setBukaModalKutipan] = useState(false);
    const [teksKutipan, setTeksKutipan] = useState("");
    const [posisiTombolSorot, setPosisiTombolSorot] = useState(null);
    const artikelRef = useRef(null);

    useEffect(() => {
        const perbarui = () => {
            const tinggi = document.documentElement.scrollHeight - window.innerHeight;
            setKemajuan(tinggi > 0 ? Math.min((window.scrollY / tinggi) * 100, 100) : 0);
        };
        perbarui();
        window.addEventListener("scroll", perbarui, { passive: true });
        return () => window.removeEventListener("scroll", perbarui);
    }, []);

    // Listener seleksi teks pada isi artikel (kompatibel desktop & mobile touch)
    useEffect(() => {
        function tanganiSeleksi() {
            const sel = window.getSelection();
            if (!sel || sel.isCollapsed || !artikelRef.current) {
                setPosisiTombolSorot(null);
                return;
            }

            if (!sel.rangeCount) {
                setPosisiTombolSorot(null);
                return;
            }

            const range = sel.getRangeAt(0);
            if (!artikelRef.current.contains(range.commonAncestorContainer)) {
                setPosisiTombolSorot(null);
                return;
            }

            const teks = sel.toString().trim();
            if (teks.length < 8) {
                setPosisiTombolSorot(null);
                return;
            }

            const rect = range.getBoundingClientRect();
            if (!rect || (rect.width === 0 && rect.height === 0)) {
                setPosisiTombolSorot(null);
                return;
            }

            const windowW = window.innerWidth;
            const tombolW = 160;
            const idealLeft = rect.left + rect.width / 2 - tombolW / 2;
            const left = Math.max(12, Math.min(windowW - tombolW - 12, idealLeft));
            const top = rect.top > 65 ? rect.top - 50 : rect.bottom + 12;

            setPosisiTombolSorot({
                top,
                left,
                teks,
            });
        }

        document.addEventListener("selectionchange", tanganiSeleksi);
        document.addEventListener("mouseup", tanganiSeleksi);
        document.addEventListener("touchend", () => {
            setTimeout(tanganiSeleksi, 100);
        });

        return () => {
            document.removeEventListener("selectionchange", tanganiSeleksi);
            document.removeEventListener("mouseup", tanganiSeleksi);
        };
    }, []);

    function bukaKutipan() {
        // Cek apakah ada teks aktif yang sedang diseleksi pengguna
        const sel = window.getSelection();
        const teks = sel?.toString()?.trim();

        if (teks && teks.length >= 8 && artikelRef.current && artikelRef.current.contains(sel.getRangeAt(0).commonAncestorContainer)) {
            setTeksKutipan(teks);
            setBukaModalKutipan(true);
            setPosisiTombolSorot(null);
            return;
        }

        if (posisiTombolSorot?.teks) {
            setTeksKutipan(posisiTombolSorot.teks);
            setBukaModalKutipan(true);
            setPosisiTombolSorot(null);
            return;
        }

        tampilkanPesan("Silakan sorot (highlight) kalimat artikel yang ingin dijadikan kutipan terlebih dahulu.");
    }

    async function salinTautan() {
        try {
            await navigator.clipboard.writeText(seo.canonical);
            tampilkanPesan("Tautan artikel telah disalin.");
        } catch {
            tampilkanPesan("Tautan belum dapat disalin.");
        }
    }

    async function bagikanWebShare() {
        if (navigator.share) {
            try {
                await navigator.share({ title: artikel.judul, url: seo.canonical });
                return;
            } catch {
                // dibatalkan pengguna
            }
        }
        salinTautan();
    }

    function tampilkanPesan(teks) {
        setPesan(teks);
        window.setTimeout(() => setPesan(""), 3200);
    }

    const encodedUrl = encodeURIComponent(seo.canonical);
    const encodedTitle = encodeURIComponent(artikel.judul);

    return (
        <PublikLayout>
            <Seo seo={seo} />

            {/* Indikator Progres Membaca */}
            <div className="fixed inset-x-0 top-0 z-[60] h-1 bg-transparent" aria-hidden="true">
                <div className="h-full bg-[#b9924b] transition-all duration-150" style={{ width: `${kemajuan}%` }} />
            </div>

            {/* Floating Share Bar Samping (Hanya Desktop) */}
            <aside aria-label="Bagikan artikel" className="fixed left-6 top-1/2 z-40 hidden -translate-y-1/2 flex-col gap-2.5 rounded-full border border-[#d8d2c6] bg-[#fffdf8]/95 p-2 shadow-lg backdrop-blur lg:flex">
                <a
                    href={`https://wa.me/?text=${encodedTitle}%20${encodedUrl}`}
                    target="_blank"
                    rel="noreferrer"
                    aria-label="Bagikan ke WhatsApp"
                    className="flex size-10 items-center justify-center rounded-full bg-[#25D366] text-white hover:opacity-90"
                >
                    <svg className="size-5 fill-current" viewBox="0 0 24 24"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0 0 12.04 2zm.01 1.67c2.2 0 4.26.86 5.82 2.42a8.17 8.17 0 0 1 2.41 5.82c0 4.54-3.7 8.24-8.24 8.24-1.44 0-2.85-.38-4.09-1.11l-.29-.17-3.05.8 0.81-2.97-.19-.31a8.19 8.19 0 0 1-1.25-4.47c0-4.54 3.7-8.25 8.24-8.25zm4.52 11.66c-.25-.13-1.47-.72-1.7-.81-.23-.08-.39-.13-.56.13-.17.25-.64.81-.79.97-.14.17-.29.19-.54.06-.25-.13-1.06-.39-2.02-1.24-.75-.67-1.26-1.49-1.4-1.74-.15-.25-.02-.39.11-.51.11-.11.25-.29.37-.44.13-.14.17-.25.25-.42.08-.17.04-.31-.02-.44-.06-.13-.56-1.35-.77-1.85-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.44.06-.67.31-.23.25-.88.86-.88 2.1 0 1.24.9 2.45 1.03 2.62.13.17 1.78 2.72 4.31 3.81.6.26 1.07.42 1.44.54.61.19 1.16.17 1.6.1 1.09-.16 1.47-1.12 1.61-1.48.14-.36.14-.68.1-.81-.04-.13-.2-.2-.45-.33z"/></svg>
                </a>
                <a
                    href={`https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}`}
                    target="_blank"
                    rel="noreferrer"
                    aria-label="Bagikan ke Facebook"
                    className="flex size-10 items-center justify-center rounded-full bg-[#1877F2] text-white hover:opacity-90"
                >
                    <svg className="size-5 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
                <a
                    href={`https://twitter.com/intent/tweet?url=${encodedUrl}&text=${encodedTitle}`}
                    target="_blank"
                    rel="noreferrer"
                    aria-label="Bagikan ke Twitter / X"
                    className="flex size-10 items-center justify-center rounded-full bg-black text-white hover:opacity-90"
                >
                    <svg className="size-4 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </a>
                <button
                    type="button"
                    onClick={bukaKutipan}
                    aria-label="Buat kartu kutipan dari teks yang disorot"
                    title="Buat Kartu Kutipan"
                    className="flex size-10 items-center justify-center rounded-full bg-[#104438] text-white hover:bg-[#0b3028]"
                >
                    <Quote size={18} />
                </button>
                <button
                    type="button"
                    onClick={salinTautan}
                    aria-label="Salin tautan artikel"
                    title="Salin Tautan"
                    className="flex size-10 items-center justify-center rounded-full bg-[#f6f0e3] text-[#104438] hover:bg-[#e6ddc9]"
                >
                    <Copy size={18} />
                </button>
            </aside>

            {/* Bubble Melayang Saat Teks Disorot (Highlight) - Sentuhan Mudah di Mobile */}
            {posisiTombolSorot && (
                <button
                    type="button"
                    style={{ top: `${posisiTombolSorot.top}px`, left: `${posisiTombolSorot.left}px` }}
                    onClick={() => {
                        setTeksKutipan(posisiTombolSorot.teks);
                        setPosisiTombolSorot(null);
                        setBukaModalKutipan(true);
                    }}
                    className="fixed z-50 inline-flex min-h-11 items-center gap-2 rounded-full bg-[#0b3028] px-4 py-2 text-xs font-semibold text-white shadow-2xl transition-transform active:scale-95"
                >
                    <Quote size={15} className="text-[#b9924b]" /> Jadikan Kutipan
                </button>
            )}

            {pratinjau && (
                <aside className="fixed bottom-16 left-4 z-50 flex max-w-[calc(100%-2rem)] items-center gap-3 rounded-lg bg-[#18231f] px-4 py-3 text-sm text-white shadow-xl lg:bottom-4">
                    <span>Mode pratinjau: {artikel.status}</span>
                    <button type="button" onClick={() => window.close()} className="min-h-11 font-semibold text-[#e6d6b1]">Tutup</button>
                </aside>
            )}

            <article className="pb-20 lg:pb-0">
                <header className="border-b border-[#d8d2c6] bg-[#f6f0e3] py-5 sm:py-8 lg:py-10">
                    <div className="container-situs max-w-5xl">
                        <Link href="/artikel" className="inline-flex items-center gap-1.5 text-xs font-semibold text-[#104438] hover:underline">
                            <ChevronLeft size={16} /> Kembali ke Artikel
                        </Link>
                        <div className="mt-4 max-w-4xl">
                            <p className="text-[11px] font-semibold uppercase tracking-wider text-[#1c6a55] sm:text-xs">{artikel.kategori?.nama || "Artikel"}</p>
                            <h1 className="judul-editorial mt-2 text-2xl font-semibold leading-[1.14] text-[#0b3028] sm:text-4xl lg:text-5xl">{artikel.judul}</h1>
                            <div className="mt-3 flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-[#5b6d66]">
                                <span className="font-semibold text-[#263a33]">{artikel.penulis}</span>
                                <span>·</span>
                                <time>{artikel.tanggal}</time>
                                <span>·</span>
                                <span className="inline-flex items-center gap-1"><Clock size={13} /> {artikel.waktu_baca || "3 mnt"}</span>
                                <span>·</span>
                                <span className="inline-flex items-center gap-1"><Eye size={13} /> {artikel.dilihat}x dibaca</span>
                            </div>

                            {/* Tombol aksi artikel SEBARIS (Kompak & Rapi) */}
                            <div className="mt-4 flex items-center gap-2">
                                <button
                                    type="button"
                                    onClick={bukaKutipan}
                                    className="inline-flex min-h-9 items-center gap-1.5 rounded-md bg-[#104438] px-3 text-xs font-semibold text-white hover:bg-[#0b3028]"
                                >
                                    <Quote size={14} /> <span>Buat Kutipan</span>
                                </button>
                                <button
                                    type="button"
                                    onClick={bagikanWebShare}
                                    className="inline-flex min-h-9 items-center gap-1.5 rounded-md border border-[#c4bcaf] bg-white px-3 text-xs font-semibold text-[#104438] hover:bg-[#f6f0e3]"
                                >
                                    <Share2 size={14} /> <span>Bagikan</span>
                                </button>
                                <button
                                    type="button"
                                    onClick={salinTautan}
                                    className="inline-flex min-h-9 items-center gap-1.5 rounded-md border border-[#c4bcaf] bg-white px-3 text-xs font-semibold text-[#104438] hover:bg-[#f6f0e3]"
                                >
                                    <Copy size={14} /> <span>Salin</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </header>

                <div className="container-situs max-w-5xl py-5 sm:py-8">
                    <img src={artikel.gambar} alt={artikel.judul} className="max-h-[34rem] w-full rounded-lg object-cover" />
                </div>

                <div className="container-situs max-w-4xl pb-12 sm:pb-16">
                    {/* Petunjuk Ringkas Sorot Teks */}
                    <div className="mb-5 rounded-md border border-[#d8d2c6] bg-[#f6f0e3]/60 px-3.5 py-2 text-xs text-[#52665e]">
                        <span className="font-semibold text-[#0b3028]">Tip:</span> Sorot (highlight) kalimat di artikel untuk menjadikannya kartu kutipan visual.
                    </div>

                    <div ref={artikelRef} className="prosa-artikel" dangerouslySetInnerHTML={{ __html: artikel.isi }} />

                    {/* Tombol Aksi Akhir Artikel (Hanya tampil di Desktop; di Mobile memakai sticky action bar agar tidak ganda) */}
                    <div className="mt-10 flex items-center justify-between border-t border-[#d8d2c6] pt-5">
                        <div className="hidden items-center gap-2.5 lg:flex">
                            <span className="text-xs font-semibold text-[#52665e]">Bagikan:</span>
                            <a
                                href={`https://wa.me/?text=${encodedTitle}%20${encodedUrl}`}
                                target="_blank"
                                rel="noreferrer"
                                className="inline-flex min-h-8 items-center gap-1.5 rounded-full bg-[#25D366] px-3 text-xs font-semibold text-white hover:opacity-90"
                            >
                                WhatsApp
                            </a>
                            <a
                                href={`https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}`}
                                target="_blank"
                                rel="noreferrer"
                                className="inline-flex min-h-8 items-center gap-1.5 rounded-full bg-[#1877F2] px-3 text-xs font-semibold text-white hover:opacity-90"
                            >
                                Facebook
                            </a>
                            <button
                                type="button"
                                onClick={bukaKutipan}
                                className="inline-flex min-h-8 items-center gap-1.5 rounded-full bg-[#104438] px-3 text-xs font-semibold text-white hover:bg-[#0b3028]"
                            >
                                <Quote size={13} /> Kutipan Gambar
                            </button>
                        </div>
                        <button type="button" onClick={() => window.scrollTo({ top: 0, behavior: "smooth" })} className="inline-flex min-h-9 items-center gap-2 font-semibold text-[#104438] hover:underline text-xs sm:text-sm">
                            <ArrowUp size={16} /> Kembali ke atas
                        </button>
                    </div>
                </div>

                {/* Artikel Terkait */}
                {artikelTerkait.length > 0 && (
                    <section className="border-t border-[#d8d2c6] bg-[#fbf9f4] py-12 sm:py-20">
                        <div className="container-situs max-w-5xl">
                            <div className="flex items-center justify-between">
                                <h2 className="judul-editorial text-2xl font-semibold text-[#0b3028] sm:text-3xl">Artikel Terkait</h2>
                                <Link href="/artikel" className="text-sm font-semibold text-[#104438] hover:underline">Lihat Semua</Link>
                            </div>
                            <div className="mt-6 grid gap-6 sm:grid-cols-3">
                                {artikelTerkait.map((item) => (
                                    <Link key={item.id} href={item.tautan} className="group block overflow-hidden rounded-lg border border-[#d8d2c6] bg-white transition hover:shadow-md">
                                        <div className="overflow-hidden bg-[#e9eee9]">
                                            <img src={item.gambar} alt={item.judul} className="aspect-[16/10] w-full object-cover transition-transform duration-300 group-hover:scale-105" />
                                        </div>
                                        <div className="p-4 sm:p-5">
                                            <p className="text-xs font-semibold text-[#1c6a55]">{item.kategori?.nama || "Artikel"}</p>
                                            <h3 className="judul-editorial mt-2 text-lg font-semibold leading-snug text-[#0b3028] group-hover:text-[#1c6a55] sm:text-xl">{item.judul}</h3>
                                            <p className="mt-3 text-xs text-[#718078]">{item.penulis} · {item.tanggal_singkat}</p>
                                        </div>
                                    </Link>
                                ))}
                            </div>
                        </div>
                    </section>
                )}
            </article>

            {/* Sticky Action Bar Bawah Khusus Mobile */}
            <div className="fixed inset-x-0 bottom-0 z-40 flex items-center justify-between border-t border-[#d8d2c6] bg-[#fffdf8]/95 px-4 py-2.5 shadow-lg backdrop-blur lg:hidden">
                <button
                    type="button"
                    onClick={bukaKutipan}
                    className="inline-flex min-h-10 items-center gap-1.5 rounded-full bg-[#104438] px-3.5 text-xs font-semibold text-white"
                >
                    <Quote size={14} /> Kutipan
                </button>
                <div className="flex items-center gap-2">
                    <a
                        href={`https://wa.me/?text=${encodedTitle}%20${encodedUrl}`}
                        target="_blank"
                        rel="noreferrer"
                        aria-label="Bagikan ke WhatsApp"
                        className="flex size-10 items-center justify-center rounded-full bg-[#25D366] text-white"
                    >
                        <svg className="size-4 fill-current" viewBox="0 0 24 24"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0 0 12.04 2zm.01 1.67c2.2 0 4.26.86 5.82 2.42a8.17 8.17 0 0 1 2.41 5.82c0 4.54-3.7 8.24-8.24 8.24-1.44 0-2.85-.38-4.09-1.11l-.29-.17-3.05.8 0.81-2.97-.19-.31a8.19 8.19 0 0 1-1.25-4.47c0-4.54 3.7-8.25 8.24-8.25zm4.52 11.66c-.25-.13-1.47-.72-1.7-.81-.23-.08-.39-.13-.56.13-.17.25-.64.81-.79.97-.14.17-.29.19-.54.06-.25-.13-1.06-.39-2.02-1.24-.75-.67-1.26-1.49-1.4-1.74-.15-.25-.02-.39.11-.51.11-.11.25-.29.37-.44.13-.14.17-.25.25-.42.08-.17.04-.31-.02-.44-.06-.13-.56-1.35-.77-1.85-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.44.06-.67.31-.23.25-.88.86-.88 2.1 0 1.24.9 2.45 1.03 2.62.13.17 1.78 2.72 4.31 3.81.6.26 1.07.42 1.44.54.61.19 1.16.17 1.6.1 1.09-.16 1.47-1.12 1.61-1.48.14-.36.14-.68.1-.81-.04-.13-.2-.2-.45-.33z"/></svg>
                    </a>
                    <button
                        type="button"
                        onClick={bagikanWebShare}
                        aria-label="Bagikan"
                        className="flex size-10 items-center justify-center rounded-full border border-[#d8d2c6] bg-white text-[#104438]"
                    >
                        <Share2 size={17} />
                    </button>
                    <button
                        type="button"
                        onClick={salinTautan}
                        aria-label="Salin Tautan"
                        className="flex size-10 items-center justify-center rounded-full border border-[#d8d2c6] bg-white text-[#104438]"
                    >
                        <Copy size={17} />
                    </button>
                </div>
            </div>

            {/* Modal Generator Kartu Kutipan */}
            <ModalKutipan
                terbuka={bukaModalKutipan}
                padaTutup={() => setBukaModalKutipan(false)}
                teksAwal={teksKutipan}
                judulArtikel={artikel.judul}
            />

            {/* Pesan Toast Feedback */}
            {pesan && (
                <div role="status" className="fixed bottom-16 left-1/2 z-[70] -translate-x-1/2 rounded-md bg-[#0b3028] px-4 py-2.5 text-center text-xs font-semibold text-white shadow-2xl lg:bottom-5 sm:text-sm">
                    {pesan}
                </div>
            )}
        </PublikLayout>
    );
}
