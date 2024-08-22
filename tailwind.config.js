/** @type {import('tailwindcss').Config} */
export default {
    content: ["./resources/js/**/*.{vue,js}"],
    theme: {
        extend: {
            fontFamily: {
                poppins: ["Poppins", "sans-serif"],
                "work-sans": ["Work Sans", "sans-serif"],
            },
        },
    },
    plugins: [],
};
