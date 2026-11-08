import { Download, Share2, X } from "lucide-react";
import { useEffect, useRef, useState } from "react";

const FORMATS = {
    square: { w: 1080, h: 1080, label: "1:1 Persegi (Feed)" },
    portrait: { w: 1080, h: 1350, label: "4:5 Potret (Story / Reels)" },
    landscape: { w: 1200, h: 628, label: "1.91:1 Lanskap" },
};

function normalisasiTeks(teks) {
    if (!teks) return "";
    return teks.replace(/\s+/g, " ").replace(/\u00A0/g, " ").trim();
}

function bersihkanTandaKutip(teks) {
    if (!teks) return "";
    return normalisasiTeks(teks).replace(/^["'“”«»\s]+/, "").replace(/["'“”«»\s]+$/, "").trim();
}

function potongTeks(teks, batas = 340) {
    const t = bersihkanTandaKutip(teks);
    if (t.length <= batas) return t;
    return t.slice(0, batas - 1).trimEnd() + "…";
}

function bungkusTeks(ctx, teks, lebarMaksimal) {
    if (!teks) return [];
    const paragraf = String(teks).split(/\n+/g);
    const baris = [];

    for (const p of paragraf) {
        const kata = p.split(/\s+/g).filter(Boolean);
        if (kata.length === 0) continue;
        let barisAktif = kata[0];
        for (let i = 1; i < kata.length; i++) {
            const uji = barisAktif + " " + kata[i];
            if (ctx.measureText(uji).width <= lebarMaksimal) {
                barisAktif = uji;
            } else {
                baris.push(barisAktif);
                barisAktif = kata[i];
            }
        }
        baris.push(barisAktif);
    }
    return baris;
}

function gambarKotakBulat(ctx, x, y, w, h, r) {
    const radius = Math.min(r, w / 2, h / 2);
    ctx.beginPath();
    ctx.moveTo(x + radius, y);
    ctx.arcTo(x + w, y, x + w, y + h, radius);
    ctx.arcTo(x + w, y + h, x, y + h, radius);
    ctx.arcTo(x, y + h, x, y, radius);
    ctx.arcTo(x, y, x + w, y, radius);
    ctx.closePath();
}

export default function ModalKutipan({ terbuka, padaTutup, teksAwal = "", judulArtikel = "", logoUrl = "/images/logo.webp" }) {
    const [kutipan, setKutipan] = useState("");
    const [format, setFormat] = useState("square");
    const [sedangMemproses, setSedangMemproses] = useState(false);
    const [notif, setNotif] = useState("");
    const canvasRef = useRef(null);

    useEffect(() => {
        if (terbuka) {
            setKutipan(potongTeks(teksAwal, 340));
        }
    }, [terbuka, teksAwal]);

    useEffect(() => {
        if (terbuka && canvasRef.current && kutipan) {
            gambarKartu();
        }
    }, [terbuka, kutipan, format, judulArtikel]);

    async function gambarKartu() {
        const canvas = canvasRef.current;
        if (!canvas) return;

        // Pastikan font web siap agar render teks tajam dan tidak bergeser
        if (document.fonts?.ready) {
            try {
                await document.fonts.ready;
            } catch {
                // fallback bila terjadi error font
            }
        }

        const fmt = FORMATS[format] || FORMATS.square;
        const dpr = Math.max(1, Math.min(2, window.devicePixelRatio || 1));
        canvas.width = fmt.w * dpr;
        canvas.height = fmt.h * dpr;

        const ctx = canvas.getContext("2d");
        if (!ctx) return;

        ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
        ctx.clearRect(0, 0, fmt.w, fmt.h);

        // 1. Latar Belakang Gradien Emerald Al-Anwar
        const grad = ctx.createLinearGradient(0, 0, fmt.w, fmt.h);
        grad.addColorStop(0, "#08261e");
        grad.addColorStop(0.45, "#0d3b2f");
        grad.addColorStop(1, "#051611");
        ctx.fillStyle = grad;
        ctx.fillRect(0, 0, fmt.w, fmt.h);

        // Aksen pendaran halus di sudut
        ctx.save();
        ctx.globalAlpha = 0.08;
        ctx.fillStyle = "#b9924b";
        ctx.beginPath();
        ctx.arc(fmt.w * 0.9, fmt.h * 0.15, fmt.w * 0.35, 0, Math.PI * 2);
        ctx.fill();
        ctx.beginPath();
        ctx.arc(fmt.w * 0.1, fmt.h * 0.88, fmt.w * 0.38, 0, Math.PI * 2);
        ctx.fill();
        ctx.restore();

        // 2. Bingkai Tipografi Elegan (Single Unified Frame)
        const margin = Math.round(fmt.w * (format === "landscape" ? 0.045 : 0.052));
        const innerPadding = Math.round(margin * 0.6);
        const innerX = margin + innerPadding;
        const innerRight = fmt.w - margin - innerPadding;
        const usableW = innerRight - innerX;

        // Garis batas luar beraksen emas klasik
        ctx.save();
        ctx.strokeStyle = "rgba(185, 146, 75, 0.35)";
        ctx.lineWidth = 1.5;
        gambarKotakBulat(ctx, margin, margin, fmt.w - margin * 2, fmt.h - margin * 2, 22);
        ctx.stroke();
        ctx.restore();

        // 3. HEADER KARTU (Identitas Pesantren)
        const isLandscape = format === "landscape";
        const headerTop = margin + innerPadding;
        const logoH = Math.round(fmt.h * (isLandscape ? 0.095 : 0.065));
        let logoW = logoH;

        if (logoUrl) {
            try {
                const img = await new Promise((resolve, reject) => {
                    const el = new Image();
                    el.crossOrigin = "anonymous";
                    el.onload = () => resolve(el);
                    el.onerror = reject;
                    el.src = logoUrl;
                });
                logoW = Math.round((img.width / img.height) * logoH);
                ctx.save();
                ctx.drawImage(img, innerX, headerTop, logoW, logoH);
                ctx.restore();
            } catch {
                logoW = 0;
            }
        }

        const headerTextX = innerX + (logoW > 0 ? logoW + 16 : 0);
        const headerTitleSize = Math.round(fmt.w * (isLandscape ? 0.016 : 0.021));
        const headerSubSize = Math.round(fmt.w * (isLandscape ? 0.012 : 0.015));

        // Teks Lembaga
        ctx.save();
        ctx.fillStyle = "#d4ad5b";
        ctx.font = `700 ${headerTitleSize}px "Instrument Sans", sans-serif`;
        ctx.textBaseline = "top";
        ctx.fillText("PONDOK PESANTREN AL-ANWAR", headerTextX, headerTop + 2);

        ctx.fillStyle = "#a8beaf";
        ctx.font = `500 ${headerSubSize}px "Instrument Sans", sans-serif`;
        ctx.fillText("Pakijangan · Bulakamba · Brebes", headerTextX, headerTop + headerTitleSize + 8);
        ctx.restore();

        // Tag Kanan Header
        const badgeSize = Math.round(fmt.w * (isLandscape ? 0.012 : 0.014));
        ctx.save();
        ctx.fillStyle = "#d4ad5b";
        ctx.font = `600 ${badgeSize}px "Instrument Sans", sans-serif`;
        ctx.textAlign = "right";
        ctx.textBaseline = "middle";
        ctx.fillText("KUTIPAN ARTIKEL", innerRight, headerTop + logoH / 2);
        ctx.restore();

        // Garis Pembatas Header
        const divider1Y = headerTop + Math.max(logoH, 46) + Math.round(innerPadding * 0.7);
        ctx.save();
        ctx.strokeStyle = "rgba(185, 146, 75, 0.25)";
        ctx.lineWidth = 1;
        ctx.beginPath();
        ctx.moveTo(innerX, divider1Y);
        ctx.lineTo(innerRight, divider1Y);
        ctx.stroke();
        ctx.restore();

        // 4. FOOTER (Sumber Artikel - DIBERIKAN RUANG PENUH AGAR TIDAK PERNAH TERPOTONG)
        const labelSize = Math.round(fmt.w * (isLandscape ? 0.013 : 0.016));
        let titleFontSize = Math.round(fmt.w * (isLandscape ? 0.022 : 0.027));
        const minTitleFontSize = Math.round(fmt.w * (isLandscape ? 0.014 : 0.018));
        let titleLines = [];
        let titleLineH = 0;

        // Auto-wrap judul artikel memanfaatkan LEBAR PENUH usableW tanpa hambatan logo
        while (titleFontSize >= minTitleFontSize) {
            ctx.font = `600 ${titleFontSize}px "Newsreader", Georgia, serif`;
            titleLines = bungkusTeks(ctx, judulArtikel, usableW);
            titleLineH = Math.round(titleFontSize * 1.34);
            // Muat hingga 4 baris jika judul panjang sekali
            if (titleLines.length <= 4) {
                break;
            }
            titleFontSize -= 1;
        }

        const footerBottom = fmt.h - margin - innerPadding;
        const totalTitleH = titleLines.length * titleLineH;
        const footerContentH = labelSize + 12 + totalTitleH;
        const footerTop = footerBottom - footerContentH;

        // Garis Pembatas Footer
        const divider2Y = footerTop - Math.round(innerPadding * 0.7);
        ctx.save();
        ctx.strokeStyle = "rgba(185, 146, 75, 0.32)";
        ctx.lineWidth = 1;
        ctx.beginPath();
        ctx.moveTo(innerX, divider2Y);
        ctx.lineTo(innerRight, divider2Y);
        ctx.stroke();
        ctx.restore();

        // Gambar Label Sumber
        ctx.save();
        ctx.fillStyle = "#d4ad5b";
        ctx.font = `600 ${labelSize}px "Instrument Sans", sans-serif`;
        ctx.textAlign = "left";
        ctx.textBaseline = "top";
        ctx.fillText("Dikutip dari Artikel:", innerX, footerTop);

        // Gambar Judul Artikel Lengkap (Tidak Terpotong)
        ctx.fillStyle = "#ffffff";
        ctx.font = `600 ${titleFontSize}px "Newsreader", Georgia, serif`;
        const titleStartY = footerTop + labelSize + 10;
        for (let i = 0; i < titleLines.length; i++) {
            ctx.fillText(titleLines[i], innerX, titleStartY + i * titleLineH);
        }
        ctx.restore();

        // 5. AREA UTAMA KUTIPAN (Tengah, Luas, Bernapas Lega & Terpusat Simetris)
        const quoteAreaTop = divider1Y + Math.round(innerPadding * 0.5);
        const quoteAreaBottom = divider2Y - Math.round(innerPadding * 0.5);
        const quoteAreaH = quoteAreaBottom - quoteAreaTop;

        const teksKutipanBersih = bersihkanTandaKutip(kutipan);
        const teksKutipanFormat = `“${teksKutipanBersih}”`;

        let quoteFontSize = Math.round(fmt.w * (isLandscape ? 0.034 : 0.046));
        const minQuoteFontSize = Math.round(fmt.w * (isLandscape ? 0.018 : 0.022));
        let quoteLines = [];
        let quoteLineH = 0;

        while (quoteFontSize >= minQuoteFontSize) {
            ctx.font = `italic 500 ${quoteFontSize}px "Newsreader", Georgia, serif`;
            quoteLines = bungkusTeks(ctx, teksKutipanFormat, usableW);
            quoteLineH = Math.round(quoteFontSize * 1.48);
            if ((quoteLines.length * quoteLineH) <= (quoteAreaH - 30)) {
                break;
            }
            quoteFontSize -= 1;
        }

        const totalQuoteH = quoteLines.length * quoteLineH;
        const quoteStartY = quoteAreaTop + Math.max(0, Math.round((quoteAreaH - totalQuoteH) / 2));

        // Watermark tanda kutip klasik di latar kutipan
        ctx.save();
        ctx.globalAlpha = 0.12;
        ctx.fillStyle = "#b9924b";
        ctx.font = `italic 700 ${Math.round(fmt.w * 0.18)}px "Newsreader", Georgia, serif`;
        ctx.textBaseline = "top";
        ctx.fillText("“", innerX - 8, quoteStartY - Math.round(quoteFontSize * 0.4));
        ctx.restore();

        // Teks Kutipan
        ctx.save();
        ctx.fillStyle = "#fffdf8";
        ctx.font = `italic 500 ${quoteFontSize}px "Newsreader", Georgia, serif`;
        ctx.textAlign = "left";
        ctx.textBaseline = "top";

        for (let j = 0; j < quoteLines.length; j++) {
            ctx.fillText(quoteLines[j], innerX, quoteStartY + j * quoteLineH);
        }
        ctx.restore();
    }

    async function unduhGambar() {
        const canvas = canvasRef.current;
        if (!canvas) return;
        setSedangMemproses(true);
        try {
            canvas.toBlob((blob) => {
                if (!blob) throw new Error("Gagal membuat gambar");
                const a = document.createElement("a");
                a.href = URL.createObjectURL(blob);
                a.download = `kutipan-alanwar-${format}.png`;
                document.body.appendChild(a);
                a.click();
                a.remove();
                URL.revokeObjectURL(a.href);
                tampilkanNotif("Gambar kutipan berhasil diunduh.");
            }, "image/png");
        } catch {
            tampilkanNotif("Gagal mengunduh gambar.");
        } finally {
            setSedangMemproses(false);
        }
    }

    async function bagikanWebShare() {
        const canvas = canvasRef.current;
        if (!canvas) return;
        setSedangMemproses(true);
        try {
            canvas.toBlob(async (blob) => {
                if (!blob) throw new Error("Gagal membuat blob");
                const file = new File([blob], "kutipan-alanwar.png", { type: "image/png" });
                if (navigator.canShare && navigator.canShare({ files: [file] })) {
                    await navigator.share({
                        title: judulArtikel,
                        text: `"${kutipan}" — Al-Anwar Pakijangan`,
                        files: [file],
                    });
                } else {
                    unduhGambar();
                }
            }, "image/png");
        } catch {
            unduhGambar();
        } finally {
            setSedangMemproses(false);
        }
    }

    function tampilkanNotif(pesan) {
        setNotif(pesan);
        window.setTimeout(() => setNotif(""), 2600);
    }

    if (!terbuka) return null;

    return (
        <div className="fixed inset-0 z-[120] flex items-center justify-center bg-black/75 p-3 sm:p-4 backdrop-blur-sm" role="dialog" aria-modal="true" aria-label="Bagikan Kutipan">
            <div className="relative flex max-h-[94vh] w-full max-w-xl flex-col overflow-hidden rounded-xl border border-[#d8d2c6] bg-[#fffdf8] shadow-2xl">
                {/* Header Modal */}
                <div className="flex items-center justify-between border-b border-[#d8d2c6] px-5 py-3 sm:px-6 sm:py-3.5">
                    <div>
                        <h3 className="judul-editorial text-lg font-semibold text-[#0b3028] sm:text-xl">Kartu Kutipan</h3>
                        <p className="text-xs text-[#677770]">Kalimat terpilih dari artikel yang siap dibagikan.</p>
                    </div>
                    <button type="button" onClick={padaTutup} className="rounded-md p-1.5 text-[#677770] hover:bg-[#f6f0e3] hover:text-[#0b3028]" aria-label="Tutup modal">
                        <X size={20} />
                    </button>
                </div>

                {/* Konten Modal (Kompak, Efektif & Optimal Layar Mobile) */}
                <div className="flex flex-1 flex-col gap-3.5 overflow-y-auto p-4 sm:p-5">
                    {/* Ringkasan Kutipan Terpilih */}
                    <div className="rounded-lg border border-[#d8d2c6] bg-[#f6f0e3]/75 p-3">
                        <p className="mb-1 text-[11px] font-semibold text-[#8b6b23]">Teks Kutipan:</p>
                        <blockquote className="judul-editorial line-clamp-2 text-xs italic leading-relaxed text-[#18231f] sm:text-sm">
                            &ldquo;{kutipan}&rdquo;
                        </blockquote>
                    </div>

                    {/* Pemilihan Rasio */}
                    <div>
                        <span className="mb-1.5 block text-xs font-semibold text-[#52665e]">Pilih Rasio Gambar:</span>
                        <div className="grid grid-cols-3 gap-2">
                            {Object.entries(FORMATS).map(([kunci, val]) => (
                                <button
                                    key={kunci}
                                    type="button"
                                    onClick={() => setFormat(kunci)}
                                    className={`min-h-9 rounded-md border px-2 py-1 text-xs font-semibold transition ${
                                        format === kunci
                                            ? "border-[#104438] bg-[#104438] text-white shadow-sm"
                                            : "border-[#d8d2c6] bg-white text-[#3d524a] hover:bg-[#f6f0e3]"
                                    }`}
                                >
                                    {val.label}
                                </button>
                            ))}
                        </div>
                    </div>

                    {/* Pratinjau Canvas (Tinggi terukur & proporsional) */}
                    <div className="flex flex-col items-center justify-center rounded-lg border border-[#d8d2c6] bg-[#18231f]/5 p-2 sm:p-3">
                        <canvas ref={canvasRef} className="max-h-60 sm:max-h-80 w-auto max-w-full rounded-md object-contain shadow-md" />
                    </div>

                    {/* Tombol Aksi */}
                    <div className="grid grid-cols-2 gap-2.5 pt-0.5">
                        <button
                            type="button"
                            onClick={unduhGambar}
                            disabled={sedangMemproses}
                            className="inline-flex min-h-11 items-center justify-center gap-2 rounded-md bg-[#104438] px-3 text-xs sm:text-sm font-semibold text-white hover:bg-[#0b3028] disabled:opacity-50"
                        >
                            <Download size={16} /> Unduh Gambar
                        </button>
                        <button
                            type="button"
                            onClick={bagikanWebShare}
                            disabled={sedangMemproses}
                            className="inline-flex min-h-11 items-center justify-center gap-2 rounded-md border border-[#104438] bg-white px-3 text-xs sm:text-sm font-semibold text-[#104438] hover:bg-[#f6f0e3] disabled:opacity-50"
                        >
                            <Share2 size={16} /> Bagikan
                        </button>
                    </div>
                </div>

                {/* Notifikasi Toast */}
                {notif && (
                    <div className="border-t border-[#104438] bg-[#104438] px-4 py-2 text-center text-xs font-semibold text-white">
                        {notif}
                    </div>
                )}
            </div>
        </div>
    );
}
