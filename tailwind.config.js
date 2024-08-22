/** @type {import('tailwindcss').Config} */
export default {
    content: ["./resources/js/**/*.{vue,js}"],
    theme: {
        extend: {
            fontFamily: {
                poppins: ["Poppins", "sans-serif"],
                "work-sans": ["Work Sans", "sans-serif"],
            },
            colors: {
                blue: "#003366",
                gold: "#f5bf03",
                "light-grey": "#E0E0E0",
                "dark-grey": "#4D4D4D",
            },
        },
    },
    plugins: [],
};
