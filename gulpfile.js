var elixir = require('laravel-elixir');

require('laravel-elixir-imagemin');
require('laravel-elixir-sass-compass');
require('laravel-elixir-vue');

//todo: webpack
elixir(function (mix) {
    mix
        .copy('resources/assets/sass/mdl-selectfield.min.css', 'public/css/mdl-selectfield.min.css')
        .copy('resources/assets/js/mdl-selectfield.min.js', 'public/js/mdl-selectfield.min.js')
        .copy('resources/assets/sass/mdl-stepper.min.css', 'public/css/mdl-stepper.min.css')
        .copy('resources/assets/js/mdl-stepper.min.js', 'public/js/mdl-stepper.min.js')
        .compass('*', 'public/css')

        .webpack('inbox.js')
        .webpack('clients.js')
        .webpack('control.js')
        .webpack('tasks.js')
        .webpack('projects.js')
        .webpack('workers.js')
        .webpack('worksheets.js')
        .webpack('chat.js')
        .webpack('tasks.js', 'public/js/user')

        .imagemin('resources/assets/images', 'public/images')
});
