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

mix
    .js('Modules/Category/js/index.js', 'public/js')
    .js('Modules/Auth/js/main', 'public/js')
    .js('Modules/Dashboard/js/Dashboard.js', 'public/js')
    .react()
    .sass('Modules/Category/sass/app.scss', 'public/css')
    .sass('Modules/Auth/sass/app.scss', 'public/css')
    .sass('Modules/Dashboard/sass/app.scss', 'public/css')
