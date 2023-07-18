let mix = require('laravel-mix');
const path = require('path');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/css/app.scss', 'public/css')
    .alias({
        '@': path.join(__dirname, 'resources/js'),
    })
    .sourceMaps();