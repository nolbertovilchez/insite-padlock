import gulp from 'gulp';
import config from './gulp/config.gulp';

config.isProd = false;

var tasks = require('./gulp/tasks.gulp')(gulp, config);

tasks.init();

gulp.task('init', [
    'backend',
    'frontend'
]);

//DEV
gulp.task('default', [
    'clean',
    'build',
    'js',
    'watch'
]);