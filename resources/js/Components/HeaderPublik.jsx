import { Link, usePage } from "@inertiajs/react";
import { Menu, X } from "lucide-react";
import { useEffect, useState } from "react";

export default function HeaderPublik({ menyatuDenganHero = false }) {
    const { navigasi = {} } = usePage().props;
    const [menuTerbuka, setMenuTerbuka] = useState(false);
    const [sudahBergulir, setSudahBergulir] = useState(false);

    useEffect(() => {
        const perbarui = () => setSudahBergulir(window.scrollY > 24);
        perbarui();
        window.addEventListener("scroll", perbarui, { passive: true });
        return () => window.removeEventListener("scroll", perbarui);
    }, []);

    useEffect(() => {
        if (!menuTerbuka) return undefined;
        const tutupDenganEscape = (event) => {
            if (event.key === "Escape") setMenuTerbuka(false);
        };
        document.addEventListener("keydown", tutupDenganEscape);
        return () => document.removeEventListener("keydown", tutupDenganEscape);
    }, [menuTerbuka]);

    const transparan = menyatuDenganHero && !sudahBergulir && !menuTerbuka;
    const tautan = [
        navigasi.rutinan ? { label: "Rutinan", href: "/#rutinan" } : null,
        navigasi.selasanan ? { label: "Selasanan", href: "/selasanan" } : null,
        navigasi.artikel ? { label: "Artikel", href: "/artikel" } : null,
        navigasi.galeri ? { label: "Galeri", href: "/galeri-acara" } : null,
        { label: "Profil", href: "/profil" },
    ].filter(Boolean);

    return (
        <header
            className={`fixed inset-x-0 top-0 z-50 border-b transition-colors duration-200 ${
                transparan
                    ? "border-white/20 bg-transparent text-white"
                    : "border-[#d9d3c6] bg-[#fffdf8]/95 text-[#0b3028] shadow-[0_10px_30px_rgba(11,48,40,0.08)] backdrop-blur"
            }`}
        >
            <nav className="container-situs flex min-h-16 items-center justify-between gap-4 lg:min-h-[4.75rem]" aria-label="Navigasi utama">
                <Link href="/" className="flex min-h-11 min-w-0 items-center gap-3" onClick={() => setMenuTerbuka(false)}>
                    <span className={`flex size-10 shrink-0 items-center justify-center rounded-full ${transparan ? "bg-white" : "bg-[#f1eadc]"}`}>
                        <img src="/images/logo.webp" alt="" className="size-8 object-contain" />
                    </span>
                    <span className="min-w-0 leading-tight">
                        <span className="block truncate text-sm font-semibold sm:text-base">Al-Anwar Pakijangan</span>
                        <span className={`hidden text-[0.7rem] sm:block ${transparan ? "text-white/70" : "text-[#48645b]"}`}>
                            Pondok Pesantren
                        </span>
                    </span>
                </Link>

                <div className="hidden items-center gap-1 lg:flex">
                    {tautan.map((item) => (
                        <Link
                            key={item.label}
                            href={item.href}
                            className={`flex min-h-11 items-center px-3.5 text-sm font-medium transition-colors ${
                                transparan ? "hover:text-[#f0d9a7]" : "hover:text-[#1c6a55]"
                            }`}
                        >
                            {item.label}
                        </Link>
                    ))}
                </div>

                <button
                    type="button"
                    className={`inline-flex min-h-10 items-center gap-2 rounded-md border px-3 text-xs font-semibold lg:hidden transition ${
                        transparan
                            ? "border-white/35 bg-black/20 text-white backdrop-blur-sm hover:bg-white/10"
                            : "border-[#d9d3c6] bg-white text-[#0b3028] shadow-sm hover:bg-[#f6f0e3]"
                    }`}
                    aria-expanded={menuTerbuka}
                    aria-controls="menu-seluler"
                    onClick={() => setMenuTerbuka((nilai) => !nilai)}
                >
                    {menuTerbuka ? <X size={18} /> : <Menu size={18} />}
                    <span>Menu</span>
                </button>
            </nav>

            {menuTerbuka && (
                <div id="menu-seluler" className="border-t border-[#d9d3c6] bg-[#fffdf8] text-[#0b3028] lg:hidden">
                    <div className="container-situs grid py-3">
                        {tautan.map((item) => (
                            <Link key={item.label} href={item.href} className="flex min-h-12 items-center border-b border-[#e6e0d5] text-base font-medium" onClick={() => setMenuTerbuka(false)}>
                                {item.label}
                            </Link>
                        ))}
                    </div>
                </div>
            )}
        </header>
    );
}
