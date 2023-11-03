import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/calculator.js',
                'resources/css/calculator.css',
                'resources/js/task.js',
            ],
            refresh: true,
        }),
    ],
});
