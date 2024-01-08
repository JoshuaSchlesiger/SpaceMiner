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
                'resources/css/auth.css',
                'resources/css/dashboard.css',
                'resources/css/welcome.css',
                'resources/css/task.css',
                'resources/js/task.js',
                'resources/js/bootstrap.js',
                'resources/js/calculator.js',
                'resources/js/dashboard.js',
            ],
            refresh: true,
        }),
    ],
});
