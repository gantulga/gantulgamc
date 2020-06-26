let mix = require('laravel-mix')

mix.setPublicPath('dist')
   .js('resources/js/field.js', 'js')
   .sourceMaps()
   .sass('resources/sass/field.scss', 'css')
