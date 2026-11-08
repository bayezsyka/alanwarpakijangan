import "./bootstrap";
import React from "react";
import { createRoot } from "react-dom/client";
import { createInertiaApp } from "@inertiajs/react";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";

createInertiaApp({
    title: (judul) => judul || "Pondok Pesantren Al-Anwar Pakijangan",
    resolve: (nama) =>
        resolvePageComponent(
            `./Pages/${nama}.jsx`,
            import.meta.glob("./Pages/**/*.jsx"),
        ),
    setup({ el, App, props }) {
        createRoot(el).render(<App {...props} />);
    },
    progress: {
        color: "#b9924b",
        showSpinner: false,
    },
});
