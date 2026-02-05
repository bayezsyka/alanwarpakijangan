// resources/js/app.js

import "./bootstrap";

// Share Snippet (quote-to-image) feature
import "./shareSnippet";

// Chart.js dan plugin matrix
import Chart from "chart.js/auto";
import { MatrixController, MatrixElement } from "chartjs-chart-matrix";

Chart.register(MatrixController, MatrixElement);

// ⬅️ Tambahkan ini agar Chart bisa diakses dari window (global di Blade)
window.Chart = Chart;
