let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
    .js('resources/assets/js/role-create.js', 'public/js')
    .js('resources/assets/js/role-edit.js', 'public/js')
    .js('resources/assets/js/permission-create.js', 'public/js')
    .js('resources/assets/js/permission-edit.js', 'public/js')
    .js('resources/assets/js/permission.js', 'public/js')
    .js('resources/assets/js/profile.js', 'public/js')
    .js('resources/assets/js/genre-create.js', 'public/js')
    .js('resources/assets/js/genre-edit.js', 'public/js')
    .js('resources/assets/js/genre.js', 'public/js')
    .js('resources/assets/js/manga-create.js', 'public/js')
    .js('resources/assets/js/manga-edit.js', 'public/js')
    .js('resources/assets/js/author-create.js', 'public/js')
    .js('resources/assets/js/chap-create.js', 'public/js')
    .js('resources/assets/js/chap-edit.js', 'public/js')
    .js('resources/assets/js/manga-chap-create.js', 'public/js')
    .js('resources/assets/js/translate-team-create.js', 'public/js')
    .js('resources/assets/js/translate-team.js', 'public/js')
    .js('resources/assets/js/translate-team-edit.js', 'public/js')
    .js('resources/assets/js/author.js', 'public/js')
