import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        target: 'es2019',
        cssCodeSplit: true,
        sourcemap: false,
        assetsInlineLimit: 4096,
        minify: 'esbuild',
        rollupOptions: {
            output: {
                manualChunks(id) {
                    if (!id.includes('node_modules')) {
                        return undefined;
                    }

                    if (id.includes('chart.js') || id.includes('chartjs-chart-matrix')) {
                        return 'charts';
                    }

                    if (id.includes('axios')) {
                        return 'network';
                    }

                    return 'vendor';
                },
            },
        },
    },
    optimizeDeps: {
        include: ['axios', 'chart.js/auto', 'chartjs-chart-matrix'],
    },
});
