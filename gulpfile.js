var gulp = require('gulp');
var phpcs = require('gulp-phpcs');
var phpcbf = require('gulp-phpcbf');
var gutil = require('gulp-util');
var elixir = require('laravel-elixir');

require('laravel-elixir-imagemin');
require('laravel-elixir-sass-compass');
require('laravel-elixir-js-uglify');
require('laravel-elixir-vue');

//todo: webpack
elixir(function (mix) {
    mix
        .copy('resources/assets/sass/mdl-selectfield.min.css', 'public/css/mdl-selectfield.min.css')
        .copy('resources/assets/js/mdl-selectfield.min.js', 'public/js/mdl-selectfield.min.js')
        .copy('resources/assets/sass/mdl-stepper.min.css', 'public/css/mdl-stepper.min.css')
        .copy('resources/assets/js/mdl-stepper.min.js', 'public/js/mdl-stepper.min.js')
        .uglify([
            'resources/assets/js/inbox.js',
            'resources/assets/js/clients.js',
            'resources/assets/js/control.js',
            'resources/assets/js/tasks.js',
            'resources/assets/js/projects.js',
            'resources/assets/js/workers.js',
            'resources/assets/js/worksheets.js'
        ])
        .webpack('tasks.js', 'public/js/user')
        .webpack('chat.js')
        .compass('*', 'public/css', {
        	'style': 'compressed'
        })
        .imagemin('resources/assets/images', 'public/images')
        .version(['public/js', 'public/js/user', 'public/css', 'public/images']);
});

gulp.task('phpcs', function () {
    return gulp.src(['**/*.php', '!database/**/*.*', '!storage/**/*.*', '!vendor/**/*.*', '!node_modules/**/*.*', '!bootstrap/cache/**/*.*'])
        .pipe(phpcs({
            bin: 'vendor/bin/phpcs',
            colors: true,
            standard: 'PSR2',
            warningSeverity: 0
        }))
        .pipe(phpcs.reporter('log'));
});

gulp.task('phpcbf', function() {
    return gulp.src(['**/*.php', '!storage/**/*.*', '!vendor/**/*.*', '!node_modules/**/*.*', '!bootstrap/cache/**/*.*'])
        .pipe(phpcbf({
            bin: 'vendor/bin/phpcbf',
            standard: 'PSR2'
        }))
        .on('error', gutil.log)
        .pipe(gulp.dest(''));
});
