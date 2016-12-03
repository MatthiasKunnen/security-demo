var gulp = require('gulp');

var autoprefixer = require('gulp-autoprefixer');
var cleanCSS = require('gulp-clean-css');
var pump = require('pump');
var rename = require('gulp-rename');
var sass = require('gulp-sass');
var util = require('gulp-util');

var paths = {
    css: 'public/css',
    fonts: 'public/fonts',
    js: 'resources/assets/js',
    nodeModules: 'node_modules',
    publicJs: 'public/js',
    scss: 'resources/assets/sass'
};

var config = {
    autoprefixer: {
        browsers: ['> 1%', 'last 2 versions']
    }
};

gulp.task('app', function (done) {
    var remains = 2;
    pump([
            gulp.src(paths.scss + '/app.scss'),
            sass({
                includePaths: [paths.nodeModules + '/bootstrap-sass/assets/stylesheets/']
            }),
            autoprefixer(config.autoprefixer),
            cleanCSS(),
            rename({suffix: '.min'}),
            gulp.dest(paths.css)
        ],
        completed
    );

    pump([
            gulp.src(paths.nodeModules + '/bootstrap-sass/assets/fonts/bootstrap/*.{ttf,woff,woff2}'),
            gulp.dest(paths.fonts + '/bootstrap')
        ],
        completed
    );

    function completed() {
        if (--remains === 0) {
            done(null, '');
        }
    }
});

gulp.task('style', function (done) {
    pump([
            gulp.src(paths.scss + '/style.scss'),
            sass(),
            autoprefixer(config.autoprefixer),
            cleanCSS(),
            rename({suffix: '.min'}),
            gulp.dest(paths.css)
        ],
        done
    );
});

gulp.task('watch-style', function () {
    gulp.watch(paths.scss + '/style.scss', ['style']);
});
