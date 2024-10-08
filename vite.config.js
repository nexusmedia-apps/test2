import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/nexaris.css',
                'resources/js/app.js',
                'resources/js/load-orders.js'
            ],
            refresh: true,
        }),
    ],
});
