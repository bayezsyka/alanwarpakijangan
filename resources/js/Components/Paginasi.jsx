import { Link } from "@inertiajs/react";

export default function Paginasi({ links = [] }) {
    if (links.length <= 3) return null;

    function labelIndonesia(label) {
        if (label.includes("Previous")) return "Sebelumnya";
        if (label.includes("Next")) return "Berikutnya";
        return label;
    }

    return (
        <nav className="mt-12 flex flex-wrap items-center justify-center gap-2" aria-label="Paginasi">
            {links.map((tautan, indeks) => (
                tautan.url ? (
                    <Link
                        key={`${tautan.label}-${indeks}`}
                        href={tautan.url}
                        preserveScroll
                        className={`inline-flex min-h-11 min-w-11 items-center justify-center rounded-md border px-3 text-sm font-semibold ${tautan.active ? "border-[#104438] bg-[#104438] text-white" : "border-[#d9d3c6] bg-white text-[#375349] hover:border-[#104438]"}`}
                        dangerouslySetInnerHTML={{ __html: labelIndonesia(tautan.label) }}
                    />
                ) : (
                    <span key={`${tautan.label}-${indeks}`} className="inline-flex min-h-11 min-w-11 items-center justify-center px-3 text-sm text-[#8a938f]" dangerouslySetInnerHTML={{ __html: labelIndonesia(tautan.label) }} />
                )
            ))}
        </nav>
    );
}
