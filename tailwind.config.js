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
                sans: ['"DM Sans"', ...defaultTheme.fontFamily.sans],
                display: ['"Playfair Display"', 'Georgia', 'serif'],
            },
            colors: {
                primary: {
                    DEFAULT: '#008362',
                    hover: '#006b50',
                    soft: '#e6f4ef',
                    50: '#ecfdf5',
                    100: '#d1fae5',
                    600: '#008362',
                    700: '#006b50',
                    900: '#064e3b',
                },
                secondary: '#008362',
                accent: {
                    DEFAULT: '#b8932d',
                    soft: '#f3ead2',
                },
                dark: '#1b1b18',
                surface: {
                    DEFAULT: '#ffffff',
                    alt: '#f6f4ef',
                },
                muted: '#6b6b66',
            },
            borderRadius: {
                sm: '10px',
                md: '18px',
                lg: '28px',
            },
            boxShadow: {
                soft: '0 18px 48px rgba(27, 27, 24, 0.09)',
                card: '0 8px 28px rgba(27, 27, 24, 0.07)',
            },
            container: {
                center: true,
                padding: {
                    DEFAULT: '16px',
                    sm: '20px',
                    lg: '20px',
                },
                screens: {
                    sm: '640px',
                    md: '768px',
                    lg: '1024px',
                    xl: '1180px',
                    '2xl': '1180px',
                },
            },
        },
    },

    plugins: [forms],
};
