import preset from 'tailwindcss/defaultConfig.js';

export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        './app/Filament/**/*.php',
    ],
    theme: {
        extend: {},
    },
    plugins: [],
};
