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
            screens: {
                'xs': '320px',
            }
        },
    },

    plugins: [forms],

    safelist: [
        'bg-green-500',

        'border-red-500',
        'border-green-500',
        'border-yellow-500',
        'border-gray-500',

        'text-red-500',
        'text-green-500',
        'text-yellow-500',
        'text-gray-500',
    ],
};
