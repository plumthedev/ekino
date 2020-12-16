const mix = require('laravel-mix');

// javascript
mix.js('resources/js/web/app.js', 'public/build/web/js')

// stylesheet
mix.sass('resources/sass/web/app.scss', 'public/build/web/css')

// images
mix.copy('resources/images/web/**/**', 'public/build/web/images');

mix.options({
    processCssUrls: false
});

// development
if (!mix.inProduction()) {
    mix.sourceMaps();
    mix.browserSync({
        proxy: process.env.MIX_BROWSERSYNC_PROXY_ADDRESS,
    });
}

// production
if (mix.inProduction()) {
    mix.version();
}
