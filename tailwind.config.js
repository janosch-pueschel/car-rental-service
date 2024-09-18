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
                "ec-green": "#009900",
                "ec-yellow": "#ffdd00",
                "light-grey": "#8c92ac",
                "dark-grey": "#373A40",
                black: "#212226",
                white: "#f3f4f6",
            },
            gridTemplateColumns: {
                "bookings-index": "repeat(5, 1fr) max-content",
            },
            animation: {
                "fade-out": "fadeOut 4s ease-in-out",
            },
            keyframes: {
                fadeOut: {
                    "0%, 80%": { opacity: 1 },
                    "100%": { opacity: 0 },
                },
            },
        },
    },
    plugins: [],
};
