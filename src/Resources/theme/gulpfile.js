const gulp          = require('gulp');

const rename        = require('gulp-rename');
const sass          = require('gulp-sass');
const pump          = require('pump');
const concat        = require('gulp-concat');

const paths = {
    scripts: 'js/',
    sass: 'sass/',
    dist: '../public/dist/'
};

const scripts = [
    // External libs

    // App script
    paths.scripts + 'components/*.js',
    paths.scripts + '*.js'
];

function scss() {
    return gulp
        .src( paths.sass + 'style.scss' )
        .pipe( sass() )
        .on('error', sass.logError)
        .pipe( rename('flipbert.css') )
        .pipe( gulp.dest(paths.dist) );
}

function js(cb) {
    return pump([
        gulp.src(scripts),
        concat('flipbert.js'),
        gulp.dest(paths.dist)
    ], cb);
}

function watchjs(cb) {
    gulp.watch( paths.scripts + '**/*.js', js );
}

function watchscss() {
    gulp.watch( paths.sass + '**/*.scss', scss );
}


const build = gulp.series( gulp.parallel( scss, js ) );
const watch = gulp.series( gulp.parallel( watchscss, watchjs ) );

exports.build = build;
exports.watch = watch;
