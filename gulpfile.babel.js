import gulp from 'gulp';
import path from 'path';
import phpmin from 'gulp-php-minify';
import browserSync from 'browser-sync';

var reload = browserSync.reload;

var fx_php = (cb, src, dest) => {
    return gulp.src(src)
            .pipe(phpmin({silent: true}))
            .pipe(gulp.dest(dest))
            .pipe(reload({stream: true}));
};

var backslash2slash = (_uri) => path.normalize(_uri).replace(new RegExp('[\\\\]+', 'gi'), '/');

var _getDestPath = (pathFile) => {
    let _path = path.resolve(__dirname, './');
    var regex_str = backslash2slash(_path) + '\\/src/backend(\\/)*';
    var regex = new RegExp(regex_str, 'gi');
    var dir = path.dirname(backslash2slash(pathFile).replace(regex, './dist/'));
    return dir;
};

gulp.task('web', () => {
    return gulp.src(['./src/**/web/**/*', '!./src/**/web/**/scripts', '!./src/**/web/**/styles'])
            .pipe(gulp.dest('./dist/'));
});

gulp.task('php', (cb) => fx_php(cb, ['./src/backend/**/*.php'], './dist/'));

gulp.task('php-watch', () => {
    gulp.watch(['./src/backend/**/*.php'], (cb) => {
        let dest = _getDestPath(cb.path);
        fx_php(cb, cb.path, dest);
    });
});

gulp.task('browser-sync', () => {
    browserSync({
        proxy: {
            target: "upch-padlock.dev"
        },
        open: false,
        notify: true
    });
});

gulp.task('default', [
    'php',
    'web',
    'browser-sync',
    'php-watch'
]);

