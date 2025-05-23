import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
  base: 'https://veterinaria-laravel.onrender.com/build/',
  plugins: [
    laravel({
      input: [
        'resources/js/app.js',  // Archivo JS principal
        'resources/tailwind/main.scss',  // Tu archivo SCSS
      ],
      refresh: true,
    }),
  ],
  server: {
    proxy: {
      '/app': 'http://localhost', // Proxy para las rutas de Laravel en desarrollo
    },
  },
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'resources/js'),
    },
  },
  build: {
    outDir: path.resolve(__dirname, 'public/build'),
    emptyOutDir: true,
    manifest: true,
  },
  css: {
    preprocessorOptions: {
      scss: {
      },
    },
  },
});
