/**
 * Gulpfile
 *
 * @since 1.0.0
 *
 * Load gulp plugins and assign them semantic names.
 */
var gulp = require('gulp');
var zip = require('gulp-zip');
var notify = require('gulp-notify');

/**
 * Build Plugin Zip
 */
gulp.task('zip', function () {
    return gulp.src([
        // Include
        './**/*',

        // Exclude
        '!./.idea',
        '!./prepros.cfg',
        '!./**/.DS_Store',
        '!./sass/**/*.scss',
        '!./sass',
        '!./node_modules/**',
        '!./node_modules',
        '!./package.json',
        '!./gulpfile.js',
        '!./*.sublime-project',
        '!./*.sublime-workspace'
    ])
        .pipe(zip('easy-boats.zip'))
        .pipe(gulp.dest('../'))
        .pipe(notify({
            message: 'Easy Boats plugin zip is ready.',
            onLast: true
        }));
});