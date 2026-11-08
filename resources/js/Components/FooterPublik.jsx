import { Link, usePage } from "@inertiajs/react";
import { MapPin, Phone } from "lucide-react";

function IkonInstagram({ className = "size-5" }) {
    return (
        <svg className={className} viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
            <rect width="20" height="20" x="2" y="2" rx="5" ry="5" />
            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
            <line x1="17.5" x2="17.51" y1="6.5" y2="6.5" />
        </svg>
    );
}

function IkonYoutube({ className = "size-5" }) {
    return (
        <svg className={className} viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
            <path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17" />
            <polygon points="10 15 15 12 10 9 10 15" fill="currentColor" />
        </svg>
    );
}

export default function FooterPublik() {
    const { identitas, navigasi = {} } = usePage().props;

    return (
        <footer className="w-full bg-[#0b3028] text-[#f6f0e3]">
            <div className="container-situs grid gap-6 py-8 sm:gap-8 sm:py-10 md:grid-cols-[1.3fr_0.8fr_1fr] lg:gap-12 lg:py-12">
                {/* Identitas Lembaga */}
                <div>
                    <div className="flex items-center gap-3">
                        <span className="flex size-11 shrink-0 items-center justify-center rounded-full bg-[#f6f0e3]">
                            <img src="/images/logo.webp" alt="Logo Al-Anwar Pakijangan" className="size-8 object-contain" />
                        </span>
                        <div>
                            <h2 className="judul-editorial text-lg font-semibold leading-tight sm:text-xl">Pondok Pesantren</h2>
                            <p className="text-sm font-medium text-[#d4ad5b]">Al-Anwar Pakijangan</p>
                        </div>
                    </div>
                    <p className="mt-3 max-w-sm text-xs leading-relaxed text-[#c7d6cf] sm:text-sm">
                        Mendampingi potensi santri, membentuk karakter, dan menguatkan ilmu sebagai cahaya hidup.
                    </p>
                </div>

                {/* Akses Cepat (Kompak, 2 Kolom di Layar Ponsel) */}
                <div>
                    <h3 className="text-xs font-semibold uppercase tracking-wider text-[#d4ad5b] sm:text-sm">Akses Cepat</h3>
                    <div className="mt-2.5 grid grid-cols-2 gap-x-4 gap-y-1.5 text-xs sm:grid-cols-1 sm:gap-y-2 sm:text-sm text-[#d6e0db]">
                        <Link href="/profil" className="py-0.5 hover:text-white transition-colors">Profil</Link>
                        {navigasi.artikel && <Link href="/artikel" className="py-0.5 hover:text-white transition-colors">Artikel</Link>}
                        {navigasi.selasanan && <Link href="/selasanan" className="py-0.5 hover:text-white transition-colors">Kajian Selasanan</Link>}
                        {navigasi.galeri && <Link href="/galeri-acara" className="py-0.5 hover:text-white transition-colors">Galeri Kegiatan</Link>}
                    </div>
                </div>

                {/* Kontak dan Lokasi */}
                <div>
                    <h3 className="text-xs font-semibold uppercase tracking-wider text-[#d4ad5b] sm:text-sm">Kontak & Lokasi</h3>
                    <div className="mt-2.5 space-y-2 text-xs sm:text-sm text-[#d6e0db]">
                        <a href={identitas?.telepon_url || "#"} className="flex items-center gap-2.5 hover:text-white transition-colors">
                            <Phone size={15} className="shrink-0 text-[#d4ad5b]" aria-hidden="true" />
                            <span>{identitas?.telepon}</span>
                        </a>
                        <a href={identitas?.lokasi || "#"} target="_blank" rel="noreferrer" className="flex items-start gap-2.5 leading-snug hover:text-white transition-colors">
                            <MapPin size={15} className="mt-0.5 shrink-0 text-[#d4ad5b]" aria-hidden="true" />
                            <span className="line-clamp-2">{identitas?.alamat}</span>
                        </a>
                    </div>
                    <div className="mt-3 flex items-center gap-2.5">
                        <a href={identitas?.instagram || "#"} target="_blank" rel="noreferrer" aria-label="Instagram Al-Anwar Pakijangan" className="flex size-8 items-center justify-center rounded-full border border-white/20 text-[#d6e0db] hover:border-white hover:bg-white hover:text-[#0b3028] transition"><IkonInstagram className="size-4" /></a>
                        <a href={identitas?.youtube || "#"} target="_blank" rel="noreferrer" aria-label="YouTube Al-Anwar Pakijangan" className="flex size-8 items-center justify-center rounded-full border border-white/20 text-[#d6e0db] hover:border-white hover:bg-white hover:text-[#0b3028] transition"><IkonYoutube className="size-4" /></a>
                    </div>
                </div>
            </div>

            {/* Hak Cipta & Kredit Sangkolo */}
            <div className="border-t border-white/10">
                <div className="container-situs flex flex-col items-center justify-between gap-3 py-4 text-xs text-[#aebfb8] sm:flex-row sm:py-5 sm:text-sm">
                    <p>© {new Date().getFullYear()} Pondok Pesantren Al-Anwar Pakijangan.</p>
                    <a
                        href="https://sangkolo.com"
                        target="_blank"
                        rel="noreferrer"
                        className="group inline-flex items-center gap-2.5 text-xs text-[#aebfb8] transition-colors hover:text-white sm:text-sm"
                        title="Sangkolo"
                    >
                        <span>Dibuat oleh</span>
                        <img
                            src="/images/Logo%20Sangkolo%20Transparan%20Web.png"
                            alt="Sangkolo"
                            className="h-7 w-auto object-contain brightness-0 invert opacity-90 transition-opacity group-hover:opacity-100 sm:h-8"
                        />
                    </a>
                </div>
            </div>
        </footer>
    );
}
