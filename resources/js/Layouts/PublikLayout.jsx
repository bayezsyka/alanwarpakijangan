import FooterPublik from "../Components/FooterPublik";
import HeaderPublik from "../Components/HeaderPublik";

export default function PublikLayout({ children, menyatuDenganHero = false, tanpaFooter = false }) {
    return (
        <div className="relative min-h-screen w-full max-w-full overflow-x-hidden bg-[#fffdf8] text-[#18231f]">
            <HeaderPublik menyatuDenganHero={menyatuDenganHero} />
            <main className={`w-full max-w-full ${menyatuDenganHero ? "" : "pt-16 lg:pt-[4.75rem]"}`}>{children}</main>
            {!tanpaFooter && <FooterPublik />}
        </div>
    );
}
