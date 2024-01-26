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

// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css');


mix.styles([
    '../public_html/backend/all.css',
	// '../public_html/public/plugins/perfect-scrollbar/css/perfect-scrollbar.css',
], '../public_html/backend/all-bundle.css');

// mix.scripts([
// 	'public/src/js/vendor/modernizr-2.8.3.min.js',
//     'public/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js',
// 	'public/plugins/screenfull/dist/screenfull.js',
// ], 'public/all.js');