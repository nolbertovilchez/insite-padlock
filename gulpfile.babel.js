import gulp from 'gulp';
import phpmin from 'gulp-php-minify';
import shell from 'gulp-shell';
import browserSync from 'browser-sync';

let bsync = browserSync.create();
//let reload = browserSync.reload;

gulp.task('yii-pathreq', shell.task([
    'if [ ! -d "dist/runtime" ]; then\nmkdir dist/runtime\nchmod 777 -R dist/runtime\nfi',
    'if [ ! -d "dist/assets" ]; then\nmkdir dist/assets\nchmod 777 -R dist/assets\nfi',
]));

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
        proxy: "localhost/v3/padlock/dist",
    });

    gulp.watch(['./src/backend/**/*.php'], ['php-watch']);
});