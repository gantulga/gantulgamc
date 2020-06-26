let mix = require('laravel-mix')
let webpack = require('webpack')

mix.setPublicPath('dist')
   .js('resources/js/field.js', 'js')
   .sourceMaps()
   .sass('resources/sass/field.scss', 'css')
   .webpackConfig({
        plugins: [
            new webpack.NormalModuleReplacementPlugin(/trix/, 'lodash/noop'),
            new webpack.NormalModuleReplacementPlugin(/composedPath/, 'lodash/noop'),

        ],
  })
