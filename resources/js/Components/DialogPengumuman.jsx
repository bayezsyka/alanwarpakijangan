import { ExternalLink, X } from "lucide-react";
import { useEffect, useRef, useState } from "react";

const KUNCI_PENYIMPANAN = "pengumuman_al_anwar_sudah_dilihat";

export default function DialogPengumuman({ pengumuman = [] }) {
    const [daftar, setDaftar] = useState([]);
    const [indeks, setIndeks] = useState(0);
    const tombolTutup = useRef(null);

    useEffect(() => {
        let sudahDilihat = [];
        try {
            const tersimpan = JSON.parse(localStorage.getItem(KUNCI_PENYIMPANAN) || "[]");
            sudahDilihat = Array.isArray(tersimpan) ? tersimpan : [];
        } catch {
            sudahDilihat = [];
        }
        setDaftar(pengumuman.filter((item) => !sudahDilihat.includes(item.id)));
    }, [pengumuman]);

    useEffect(() => {
        if (!daftar.length) return undefined;
        document.body.style.overflow = "hidden";
        tombolTutup.current?.focus();
        const tutupDenganEscape = (event) => {
            if (event.key === "Escape") lanjutkan();
        };
        document.addEventListener("keydown", tutupDenganEscape);
        return () => {
            document.body.style.overflow = "";
            document.removeEventListener("keydown", tutupDenganEscape);
        };
    }, [daftar.length, indeks]);

    if (!daftar.length) return null;
    const aktif = daftar[indeks];

    function simpanDilihat(id) {
        try {
            const tersimpan = JSON.parse(localStorage.getItem(KUNCI_PENYIMPANAN) || "[]");
            const nilai = Array.isArray(tersimpan) ? tersimpan : [];
            localStorage.setItem(KUNCI_PENYIMPANAN, JSON.stringify([...new Set([...nilai, id])]));
        } catch {
            // Dialog tetap dapat ditutup ketika penyimpanan browser tidak tersedia.
        }
    }

    function lanjutkan() {
        simpanDilihat(aktif.id);
        if (indeks < daftar.length - 1) {
            setIndeks((nilai) => nilai + 1);
        } else {
            setDaftar([]);
        }
    }

    function lewatiSemua() {
        daftar.forEach((item) => simpanDilihat(item.id));
        setDaftar([]);
    }

    return (
        <div className="fixed inset-0 z-[70] flex items-center justify-center bg-[#071b16]/80 p-3 sm:p-6" role="presentation" onMouseDown={(event) => event.target === event.currentTarget && lanjutkan()}>
            <section role="dialog" aria-modal="true" aria-labelledby="judul-pengumuman" className="relative max-h-[92dvh] w-full max-w-2xl overflow-y-auto rounded-xl bg-[#fffdf8] shadow-[0_24px_80px_rgba(0,0,0,0.35)]">
                <div className="flex items-start justify-between gap-4 border-b border-[#ded8cc] px-5 py-4 sm:px-7">
                    <div>
                        <p className="text-xs font-semibold text-[#6f7f79]">Pengumuman {indeks + 1} dari {daftar.length}</p>
                        <h2 id="judul-pengumuman" className="judul-editorial mt-1 text-2xl font-semibold text-[#0b3028]">{aktif.judul}</h2>
                    </div>
                    <button ref={tombolTutup} type="button" onClick={lanjutkan} className="flex size-11 shrink-0 items-center justify-center rounded-full border border-[#d9d3c6] text-[#0b3028] hover:bg-[#eee7d9]" aria-label="Tutup pengumuman">
                        <X size={20} />
                    </button>
                </div>
                <div className="p-4 sm:p-7">
                    {aktif.tautan ? (
                        <a href={aktif.tautan} target="_blank" rel="noreferrer" className="group block">
                            <img src={aktif.gambar} alt={aktif.judul} className="max-h-[62dvh] w-full rounded-lg object-contain" />
                            <span className="mt-4 inline-flex min-h-11 items-center gap-2 font-semibold text-[#104438] group-hover:underline">
                                Buka tautan pengumuman <ExternalLink size={17} />
                            </span>
                        </a>
                    ) : (
                        <img src={aktif.gambar} alt={aktif.judul} className="max-h-[62dvh] w-full rounded-lg object-contain" />
                    )}
                </div>
                {daftar.length > 1 && (
                    <div className="border-t border-[#ded8cc] px-5 py-3 text-right sm:px-7">
                        <button type="button" onClick={lewatiSemua} className="min-h-11 text-sm font-semibold text-[#5b6d66] hover:text-[#0b3028]">Tutup semua pengumuman</button>
                    </div>
                )}
            </section>
        </div>
    );
}
