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
                green: "#009900",
                yellow: "#ffdd00",
                "light-grey": "#8c92ac",
                "dark-grey": "#373A40",
                black: "#212226",
                white: "#f3f4f6",
            },
            gridTemplateColumns: {
                "6-fit": "repeat(6, max-content)",
            },
        },
    },
    plugins: [],
};
