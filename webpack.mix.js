const mix = require('laravel-mix');

require('laravel-mix-tailwind');
require('laravel-mix-purgecss');

//var tailwindcss = require('tailwindcss');
var postCssNested = require('postcss-nested');

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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/axios.js', 'public/js')
    .js('resources/js/form/index.js', 'public/js/form.js')
    .js('resources/js/nova/index.js', 'public/js/nova.js')
    //.extract(['vue', 'scrollreveal', 'turbolinks', 'vue-turbolinks', 'vue-progressbar'])
    .sourceMaps(false)
    .postCss('resources/css/app.css', 'public/css')
    .tailwind()
    .options({
        postCss: [
            //tailwindcss('./tailwind.js'),
            postCssNested,
        ]
    })
    .purgeCss({
        whitelist: ['blockquote', 'table'],
        whitelistPatterns: [/\.((sm|md|lg|xl)\\:)?(m|p|-m|h)(t|r|b|l|x|y)?-\w*/g],
    })
    .styles(['public/css/app.css'],'public/css/app.css')
    .postCss('resources/css/nova.css', 'public/css')
    .styles(['public/css/nova.css'],'public/css/nova.css')
    .webpackConfig({
        resolve: {
            alias: {
                '@': path.resolve(__dirname, 'resources/js/nova'),
            },
        },
    })

if (mix.inProduction()) {
    mix.version();
}
