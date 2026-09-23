import tailwindcss from '@tailwindcss/vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import useClassy from 'vite-plugin-useclassy';
import { defineConfig, lazyPlugins } from 'vite-plus';

export default defineConfig({
    plugins: lazyPlugins(() => [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            fonts: [
                bunny('Instrument Sans', {
                    weights: [400, 500, 600],
                }),
            ],
        }),
        useClassy({
            language: 'blade',
        }),
        tailwindcss(),
    ]),
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
