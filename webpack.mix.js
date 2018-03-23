








let mix = require('laravel-mix');

mix.disableSuccessNotifications()

    .js('resources/assets/js/app.js', 'public/js/app.js')
    .styles('resources/assets/css/app.css', 'public/css/app.css')

    //Assetes for nearby vue compenent
    .js('resources/assets/js/nearby/nearby.js', 'public/js/nearby.js')

    //Assetes for preferred vue compenent
    .js('resources/assets/js/preferred/preferred.js', 'public/js/preferred.js');