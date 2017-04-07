var elixir = require('laravel-elixir')

require('./tasks/concatScripts.task.js')
require('laravel-elixir-karma')
require('./tasks/angular.task.js')
require('./tasks/bower.task.js')
require('./tasks/ngHtml2Js.task.js')

if (!elixir.config.production) {
  require('./tasks/phpcs.task.js')
}

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function (mix) {
  var jsOutputFolder = config.js.outputFolder
  var cssOutputFolder = config.css.outputFolder
  var fontsOutputFolder = config.fonts.outputFolder
  var buildPath = config.buildPath

  var adminFolder = './angular-admin/'
  var indexFolder = './angular/'

  var assets = [
      'public/js/admin-final.js',
      'public/js/final.js',
      'public/css/admin-final.css',
      'public/css/final.css'
    ],

    adminScripts = [
      './public/js/vendor.js',
      './public/js/partials.js',
      './public/js/admin-app.js',
      './public/dist/js/admin-app.js'
    ],
    adminStyles = [
      './public/css/vendor.css',
      './public/css/admin-app.css'
    ],

    indexScripts = [
      './public/js/vendor.js',
      './public/js/partials.js',
      './public/js/app.js',
      './public/dist/js/app.js'
    ],
    indexStyles = [
      './public/css/vendor.css',
      './public/css/app.css'
    ],

    karmaJsDir = [
      jsOutputFolder + '/vendor.js',
      'node_modules/angular-mocks/angular-mocks.js',
      'node_modules/ng-describe/dist/ng-describe.js',
      jsOutputFolder + '/partials.js',
      jsOutputFolder + '/app.js',
      jsOutputFolder + '/admin-app.js',
      'tests/angular/**/*.spec.js'
  ]

  mix
    .bower()
    
    /* admin */
    .angular(adminFolder, 'admin')
    .ngHtml2Js(adminFolder + '**/*.html')
    .concatScripts(adminScripts, 'admin-final.js')
    .sass(adminFolder + '**/*.scss', 'public/css/admin-app.css')
    .styles(adminStyles, './public/css/admin-final.css')
    
    /* portfolio */
    // .angular(indexFolder, 'index')
    // .ngHtml2Js(indexFolder + '**/*.html')
    // .concatScripts(indexScripts, 'final.js')
    // .sass(indexFolder + '**/*.scss', 'public/css')
    // .styles(indexStyles, './public/css/final.css')

    .version(assets)
    .browserSync({
      proxy: 'localhost:8000'
    })
    .karma({
      jsDir: karmaJsDir
    })

  mix
    .copy(fontsOutputFolder, buildPath + '/fonts')
})
