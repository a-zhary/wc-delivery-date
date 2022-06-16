/*
 * Check the documentation at
 * https://laravel-mix.com/
 */

let mix = require('laravel-mix')

// Autloading jQuery to make it accessible to all the packages, because, you know, reasons
// You can comment this line if you don't need jQuery.
// mix.autoload({
//     jquery: ['$', 'window.jQuery', 'jQuery'],
// });

mix.setPublicPath('./assets');

// Compile assets.
mix
    // BrowserSync and LiveReload on `npm run watch` command
    // Update the `proxy` and the location of your SSL Certificates if you're developing over HTTPS
    .browserSync({
        proxy: 'http://wctest.loc/',
        files: [
            '**/*.php',
            'assets/css/**/*.css',
            'assets/js/**/*.js'
        ],
        injectChanges: true,
        open: true,
    })
    .js('resources/js/app.js', 'js')
    .sass('resources/scss/main.scss', 'css')
    .options({
        processCssUrls: false,
    })
    .copyDirectory('resources/images', 'assets/images');

mix.disableSuccessNotifications();

// Add source map and versioning to assets in production environment.
if (mix.inProduction()) {
    mix.version();
}

