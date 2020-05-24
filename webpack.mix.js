const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpackn build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 | targetはnginxのコンテナサービス名と一致させる
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/responsive.scss', 'public/css')
    .browserSync({
        files:[
            "resources/views/**/*.blade.php",
            "public/**/*.*"
        ],
        proxy:{
            target:"http://nginx"
        },
    });
