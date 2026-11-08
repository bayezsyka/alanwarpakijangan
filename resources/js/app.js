import "./bootstrap";
import "./shareSnippet";
import Chart from "chart.js/auto";
import { MatrixController, MatrixElement } from "chartjs-chart-matrix";

Chart.register(MatrixController, MatrixElement);
window.Chart = Chart;
