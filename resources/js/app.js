// resources/js/app.js

import "./bootstrap";

// Share Snippet (quote-to-image) feature
import "./shareSnippet";

// Chart.js dan plugin matrix
import Chart from "chart.js/auto";
import { MatrixController, MatrixElement } from "chartjs-chart-matrix";

Chart.register(MatrixController, MatrixElement);

// AOS - Animate On Scroll (entrance animations)
import AOS from "aos";

AOS.init({
    duration: 720,
    easing: "ease-out-cubic",
    once: true,
    offset: 70,
    disable: window.matchMedia("(prefers-reduced-motion: reduce)").matches,
});

// ⬅️ Tambahkan ini agar Chart bisa diakses dari window (global di Blade)
window.Chart = Chart;
window.AOS = AOS;
