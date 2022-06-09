const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/script.js', 'public/js')
    .js('resources/js/stepper.js', 'public/js')
    .sass('resources/sass/style.scss', 'public/css')
    .sass('resources/sass/app.scss', 'public/css')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);



mix.copyDirectory('resources/images', 'public/images');

// copy images folder into laravel public folder
mix.copyDirectory('resources/demo1/src/assets/media', 'public/assets/media');
mix.copyDirectory('resources/demo1/src/assets/plugins', 'public/assets/plugins');
mix.copyDirectory('resources/demo1/src/assets/js', 'public/assets/js');

mix.webpackConfig({
    resolve: {
        alias: {
            'morris.js': 'morris.js/morris.js',
            'jquery-ui': 'jquery-ui',
        },
    },
});
