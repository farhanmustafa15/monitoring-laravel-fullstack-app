/** @type {import('tailwindcss').Config} */
export default {
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
                "mentoring-layout": "273px 1167px",
            },
        },
    },

    plugins: [
        require("flowbite/plugin")({
            charts: true,
        }),
    ],
};
