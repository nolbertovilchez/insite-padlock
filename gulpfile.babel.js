import gulp from 'gulp';
import phpmin from 'gulp-php-minify';
import browserSync from 'browser-sync';

let bsync = browserSync.create();

gulp.task('php', (cb) => {
    return gulp.src(['./src/backend/**/*.php'])
            .pipe(phpmin({silent: true}))
            .pipe(gulp.dest('./dist/'));
});

gulp.task('php-watch', ["php"], (done) => {
    bsync.reload();
    done();
});

gulp.task('server',["php"],() => {
    bsync.init({
        proxy: "localhost/v3/upch-padlock/dist",
    });

    gulp.watch(['./src/backend/**/*.php'], ['php-watch']);
});
