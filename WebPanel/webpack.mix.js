const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js','public/js/app.js')
    .sass('resources/sass/app.scss',
        'public/css/sass.css')
    .styles(['public/css/sass.css', './node_modules/vue-multiselect/dist/vue-multiselect.min.css'], 'public/css/app.css');

//This is for WSL2 compatibility
// mix.browserSync('172.25.160.1:8083');

mix.browserSync('localhost:8083');
