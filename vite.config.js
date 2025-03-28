import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/sass/app.scss',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        proxy: {
            '/api': 'http://localhost:8000', // Proxy para a API do Laravel
            '/sanctum/csrf-cookie': 'http://localhost:8000', // Caso esteja usando Sanctum para autenticação
        },
        port: 5173,
    },
});
