import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/**
 * OCMB Design System — SystemNomina
 * Fuente de verdad: .docs/system_design.md
 */
/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                primary: {
                    DEFAULT: '#0D1B2A',
                    hover: '#0A1622',
                },
                accent: {
                    DEFAULT: '#C9A24D',
                },
                background: '#F8F9FA',
                surface: '#FFFFFF',
                ink: {
                    DEFAULT: '#1F2937',
                    secondary: '#6B7280',
                },
                success: '#10B981',
                warning: '#F59E0B',
                danger: '#EF4444',
                info: '#3B82F6',
                border: {
                    DEFAULT: '#D1D5DB',
                },
                dark: {
                    background: '#0F172A',
                    surface: '#1E293B',
                    ink: '#F8FAFC',
                },
            },
            fontFamily: {
                sans: ['Montserrat', ...defaultTheme.fontFamily.sans],
                heading: ['Cinzel', ...defaultTheme.fontFamily.serif],
                data: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                display: ['3.5rem', { lineHeight: '1.1' }],
                h1: ['3rem', { lineHeight: '1.15' }],
                h2: ['2.5rem', { lineHeight: '1.2' }],
                h3: ['2rem', { lineHeight: '1.25' }],
                h4: ['1.5rem', { lineHeight: '1.3' }],
                h5: ['1.25rem', { lineHeight: '1.4' }],
                body: ['1rem', { lineHeight: '1.5' }],
                small: ['0.875rem', { lineHeight: '1.5' }],
                caption: ['0.75rem', { lineHeight: '1.4' }],
            },
            borderRadius: {
                xs: '4px',
                sm: '6px',
                md: '8px',
                lg: '12px',
                xl: '16px',
            },
            boxShadow: {
                'ocmb-sm': '0 1px 2px rgba(0, 0, 0, 0.05)',
                'ocmb-md': '0 4px 12px rgba(0, 0, 0, 0.08)',
                'ocmb-lg': '0 8px 24px rgba(0, 0, 0, 0.12)',
            },
            maxWidth: {
                container: '1280px',
            },
            transitionDuration: {
                ocmb: '200ms',
            },
        },
    },

    plugins: [forms],
};
