import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                poppins: ["Poppins"],
            },
            colors: {
                primary: "#1960A9",
                secondary: "#06202B",
                success: "#077A7D",
                light: "#838083",
                dark: "#121212",
                input_bg: "#e8eff6",
            },
        },
    },

    plugins: [forms],
};
