/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            colors: {
                neu: '#F6F9FF',
                'neu-alt': '#EFF4FB',
                'section-blue': '#DCE9FE',
                brand: {
                    blue: '#2681FA', 
                    navy: '#2655B6',  
                    green: '#4CC71C',
                },
                ink: '#40484B',
                dark: '#171C21',
                muted: '#70787B',
            },
            boxShadow: {
                'neu-out': '6px 6px 12px #BABECC, -6px -6px 12px #FFFFFF',
                'neu-in': 'inset 6px 6px 12px #BABECC, inset -6px -6px 12px #FFFFFF',
                'neu-lg': '8px 8px 16px #BABECC, -8px -8px 16px #FFFFFF',
                'neu-flat': '6px 6px 12px #BABECC',
                'neu-footer': 'inset 6px 0px 12px #BABECC',
            },
            fontFamily: {
                sans: ['"Plus Jakarta Sans"', 'ui-sans-serif', 'system-ui'],
            },
        },
    },
    plugins: [require('@tailwindcss/forms')],
};