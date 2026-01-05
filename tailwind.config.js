import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            // Tambahan: Warna khusus sesuai desain gambar
            colors: {
                'belo': {
                    'cream': '#F9F5F0', // Warna background utama
                    'black': '#1a1a1a', // Warna teks utama
                    'grey': '#f0ece6',  // Warna aksen kotak
                }
            }
        },
    },

    plugins: [forms],
};
