const mix = require('laravel-mix');

// javascript
mix.js('resources/js/app.js', 'public/build/web/js')

// stylesheet
mix.sass('resources/sass/web/app.scss', 'public/build/web/css')

mix.options({
    processCssUrls: false
});

// development
if (!mix.inProduction()) {
    mix.sourceMaps();
}

// production
if (mix.inProduction()) {
    mix.version();
}
