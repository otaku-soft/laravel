import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            server: {
                host: '0.0.0.0',
                hmr: {
                    host: 'localhost'
                },
                watch: {
                    // https://vitejs.dev/config/server-options.html#server-watch
                    usePolling: true
                }
            },
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
