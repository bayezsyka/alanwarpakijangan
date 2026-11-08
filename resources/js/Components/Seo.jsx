import { Head } from "@inertiajs/react";

export default function Seo({ seo }) {
    if (!seo) return null;

    return (
        <Head title={seo.judul}>
            <meta name="description" content={seo.deskripsi} />
            <link rel="canonical" href={seo.canonical} />
            <meta property="og:locale" content="id_ID" />
            <meta property="og:type" content={seo.jenis || "website"} />
            <meta property="og:site_name" content="Pondok Pesantren Al-Anwar Pakijangan" />
            <meta property="og:title" content={seo.judul} />
            <meta property="og:description" content={seo.deskripsi} />
            <meta property="og:url" content={seo.canonical} />
            <meta property="og:image" content={seo.gambar} />
            <meta name="twitter:card" content="summary_large_image" />
            <meta name="twitter:title" content={seo.judul} />
            <meta name="twitter:description" content={seo.deskripsi} />
            <meta name="twitter:image" content={seo.gambar} />
            {(seo.schema || []).map((skema, indeks) => (
                <script key={indeks} type="application/ld+json">
                    {JSON.stringify(skema)}
                </script>
            ))}
        </Head>
    );
}
