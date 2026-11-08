import { Link, router } from "@inertiajs/react";
import { Clock, Eye, LayoutGrid, List, Search, X } from "lucide-react";
import { useEffect, useState } from "react";
import Paginasi from "../../Components/Paginasi";
import Seo from "../../Components/Seo";
import PublikLayout from "../../Layouts/PublikLayout";

export default function IndeksArtikel({ artikel, kategori, filter, seo }) {
    const [kataKunci, setKataKunci] = useState(filter.q || "");
    const [sedangMemuat, setSedangMemuat] = useState(false);
    const [modeTampilan, setModeTampilan] = useState("grid");

    useEffect(() => {
        const hapusMulai = router.on("start", () => setSedangMemuat(true));
        const hapusSelesai = router.on("finish", () => setSedangMemuat(false));
        return () => {
            hapusMulai();
            hapusSelesai();
        };
    }, []);

    function bukaFilter(perubahan) {
        router.get("/artikel", { q: kataKunci, kategori: filter.kategori, ...perubahan }, { preserveState: true, preserveScroll: true, replace: true });
    }

    function cari(event) {
        event.preventDefault();
        bukaFilter({ q: kataKunci });
    }

    return (
        <PublikLayout>
            <Seo seo={seo} />
            <section className="border-b border-[#ded8cc] bg-[#f6f0e3] py-10 sm:py-14 lg:py-16">
                <div className="container-situs grid gap-6 lg:grid-cols-[1.1fr_0.9fr] lg:items-end">
                    <div>
                        <span className="text-xs font-semibold uppercase tracking-wider text-[#1c6a55]">Wacana & Opini</span>
                        <h1 className="judul-editorial mt-2 text-3xl font-semibold leading-[1.08] text-[#0b3028] sm:text-5xl lg:text-6xl">Artikel & Wawasan</h1>
                        <p className="mt-3 max-w-xl text-xs leading-relaxed text-[#52665e] sm:text-sm sm:leading-6">Kumpulan gagasan, fiqih keseharian, pendidikan santri, dan dinamika keislaman di Pondok Pesantren Al-Anwar Pakijangan.</p>
                    </div>
                    <form onSubmit={cari} className="flex gap-2 lg:justify-self-end w-full lg:max-w-md" role="search">
                        <label className="relative flex-1">
                            <span className="sr-only">Cari artikel</span>
                            <Search className="absolute left-3.5 top-1/2 -translate-y-1/2 text-[#718078]" size={17} />
                            <input value={kataKunci} onChange={(event) => setKataKunci(event.target.value)} type="search" placeholder="Cari topik atau judul artikel..." className="min-h-11 w-full rounded-md border-[#c9c0b0] bg-[#fffdf8] pl-10 pr-3.5 text-xs sm:text-sm text-[#18231f] placeholder:text-[#7f8984] focus:border-[#104438] focus:ring-[#104438]" />
                        </label>
                        <button type="submit" className="min-h-11 rounded-md bg-[#104438] px-4 text-xs sm:text-sm font-semibold text-white hover:bg-[#0b3028] transition-colors">Cari</button>
                    </form>
                </div>
            </section>

            <section className="py-10 sm:py-14 lg:py-20">
                <div className="container-situs">
                    {/* Baris Filter Kategori & Tombol Toggle Tampilan (Grid / List) */}
                    <div className="flex flex-wrap items-center justify-between gap-4 border-b border-[#d8d2c6] pb-4">
                        <div className="flex gap-2 overflow-x-auto" aria-label="Filter kategori">
                            <button
                                type="button"
                                onClick={() => bukaFilter({ kategori: "" })}
                                className={`min-h-11 shrink-0 border-b-2 px-3 text-sm font-semibold ${!filter.kategori ? "border-[#104438] text-[#104438]" : "border-transparent text-[#65766f] hover:text-[#104438]"}`}
                            >
                                Semua Artikel
                            </button>
                            {kategori.map((item) => (
                                <button
                                    key={item.slug}
                                    type="button"
                                    onClick={() => bukaFilter({ kategori: item.slug })}
                                    className={`min-h-11 shrink-0 border-b-2 px-3 text-sm font-semibold ${filter.kategori === item.slug ? "border-[#104438] text-[#104438]" : "border-transparent text-[#65766f] hover:text-[#104438]"}`}
                                >
                                    {item.name}
                                </button>
                            ))}
                        </div>

                        {/* View Mode Toggle */}
                        <div className="flex items-center gap-1 rounded-md border border-[#d8d2c6] bg-[#f6f0e3] p-1" aria-label="Pilihan tampilan">
                            <button
                                type="button"
                                onClick={() => setModeTampilan("grid")}
                                title="Tampilan Grid"
                                aria-label="Tampilan Grid"
                                className={`rounded p-1.5 transition ${modeTampilan === "grid" ? "bg-white text-[#104438] shadow-sm" : "text-[#718078] hover:text-[#0b3028]"}`}
                            >
                                <LayoutGrid size={18} />
                            </button>
                            <button
                                type="button"
                                onClick={() => setModeTampilan("list")}
                                title="Tampilan Daftar (List)"
                                aria-label="Tampilan Daftar"
                                className={`rounded p-1.5 transition ${modeTampilan === "list" ? "bg-white text-[#104438] shadow-sm" : "text-[#718078] hover:text-[#0b3028]"}`}
                            >
                                <List size={18} />
                            </button>
                        </div>
                    </div>

                    {(filter.q || filter.kategori) && (
                        <div className="mt-6 flex flex-wrap items-center gap-3 text-sm text-[#52665e]">
                            <span>{artikel.total} hasil ditemukan</span>
                            <button type="button" onClick={() => { setKataKunci(""); router.get("/artikel", {}, { replace: true }); }} className="inline-flex min-h-11 items-center gap-2 font-semibold text-[#104438] hover:underline">
                                <X size={16} /> Hapus filter
                            </button>
                        </div>
                    )}

                    {sedangMemuat && <div className="mt-8 border-y border-[#d8d2c6] py-5 text-sm text-[#65766f]" role="status">Memuat artikel...</div>}

                    {/* Mode Grid */}
                    {!sedangMemuat && artikel.data.length > 0 && modeTampilan === "grid" && (
                        <div className="mt-8 grid gap-x-7 gap-y-10 sm:grid-cols-2 lg:grid-cols-3">
                            {artikel.data.map((item, indeks) => (
                                <article key={item.id} className={indeks === 0 ? "sm:col-span-2 lg:col-span-2" : ""}>
                                    <Link href={item.tautan} className={`group block overflow-hidden rounded-lg border border-[#d8d2c6] bg-white transition hover:shadow-md ${indeks === 0 ? "sm:grid sm:grid-cols-[1.1fr_0.9fr] sm:bg-[#f6f0e3]" : ""}`}>
                                        <div className="overflow-hidden bg-[#e9eee9]">
                                            <img src={item.gambar} alt={item.judul} className={`w-full object-cover transition-transform duration-500 group-hover:scale-[1.025] ${indeks === 0 ? "aspect-[16/10] h-full" : "aspect-[4/3]"}`} />
                                        </div>
                                        <div className={indeks === 0 ? "flex flex-col justify-center p-6 sm:p-8" : "p-5"}>
                                            <p className="text-xs font-semibold text-[#1c6a55]">{item.kategori?.nama || "Artikel"}</p>
                                            <h2 className={`judul-editorial mt-3 font-semibold leading-tight text-[#0b3028] group-hover:text-[#1c6a55] ${indeks === 0 ? "text-3xl sm:text-4xl" : "text-2xl"}`}>{item.judul}</h2>
                                            <p className={`mt-4 leading-7 text-[#586a63] ${indeks === 0 ? "line-clamp-3" : "line-clamp-2 text-sm"}`}>{item.ringkasan}</p>
                                            <div className="mt-5 flex items-center justify-between gap-4 border-t border-[#cdd5d1] pt-4 text-xs text-[#6f7f79]">
                                                <span className="truncate">{item.penulis}</span>
                                                <div className="flex shrink-0 items-center gap-3">
                                                    {item.waktu_baca && <span className="inline-flex items-center gap-1"><Clock size={13} /> {item.waktu_baca}</span>}
                                                    <span>{item.tanggal_singkat}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </Link>
                                </article>
                            ))}
                        </div>
                    )}

                    {/* Mode List */}
                    {!sedangMemuat && artikel.data.length > 0 && modeTampilan === "list" && (
                        <div className="mt-8 space-y-4">
                            {artikel.data.map((item) => (
                                <article key={item.id}>
                                    <Link href={item.tautan} className="group grid gap-4 overflow-hidden rounded-lg border border-[#d8d2c6] bg-white p-4 transition hover:shadow-md sm:grid-cols-[14rem_1fr] sm:gap-6 sm:p-6">
                                        <div className="overflow-hidden rounded-md bg-[#e9eee9]">
                                            <img src={item.gambar} alt={item.judul} className="aspect-[16/10] h-full w-full object-cover transition-transform duration-500 group-hover:scale-[1.03] sm:aspect-auto" />
                                        </div>
                                        <div className="flex flex-col justify-center">
                                            <div className="flex items-center gap-2">
                                                <span className="rounded bg-[#104438]/10 px-2 py-0.5 text-xs font-semibold text-[#1c6a55]">{item.kategori?.nama || "Artikel"}</span>
                                                {item.waktu_baca && <span className="text-xs text-[#718078] flex items-center gap-1"><Clock size={12} /> {item.waktu_baca}</span>}
                                            </div>
                                            <h2 className="judul-editorial mt-2.5 text-2xl font-semibold leading-snug text-[#0b3028] group-hover:text-[#1c6a55] sm:text-3xl">{item.judul}</h2>
                                            <p className="mt-3 line-clamp-2 text-sm leading-6 text-[#586a63]">{item.ringkasan}</p>
                                            <div className="mt-4 flex items-center justify-between border-t border-[#ece7dc] pt-3 text-xs text-[#6f7f79]">
                                                <span>Ditulis oleh: <strong className="text-[#263a33]">{item.penulis}</strong></span>
                                                <div className="flex items-center gap-4">
                                                    <span className="inline-flex items-center gap-1"><Eye size={13} /> {item.dilihat}x</span>
                                                    <span>{item.tanggal_singkat}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </Link>
                                </article>
                            ))}
                        </div>
                    )}

                    {!sedangMemuat && artikel.data.length === 0 && (
                        <div className="mx-auto max-w-xl py-20 text-center">
                            <h2 className="judul-editorial text-3xl font-semibold text-[#0b3028]">Artikel tidak ditemukan</h2>
                            <p className="mt-4 leading-7 text-[#65766f]">Gunakan kata kunci yang lebih singkat atau pilih kategori lain.</p>
                            <button type="button" onClick={() => { setKataKunci(""); router.get("/artikel"); }} className="mt-7 inline-flex min-h-12 items-center justify-center rounded-md bg-[#104438] px-6 font-semibold text-white">Tampilkan semua artikel</button>
                        </div>
                    )}

                    <Paginasi links={artikel.links} />
                </div>
            </section>
        </PublikLayout>
    );
}
