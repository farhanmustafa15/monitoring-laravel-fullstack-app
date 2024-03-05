/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {
            colors: {
                "primary-color": "#0561FC",
                "white-color": "#FCFCFC",
            },
            gridTemplateColumns: {
                // 1440px
                "mentoring-layout": "250px 1100px",
                // "xl-mentoring-layout": "273px 1167px ",
                // 1280px
            },
        },
    },

    plugins: [
        require("flowbite/plugin")({
            charts: true,
        }),
    ],
};
