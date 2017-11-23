import path from 'path';
import phpmin from 'gulp-php-minify';
import bsync from 'browser-sync';
import clean from 'gulp-clean';
import gulpif from 'gulp-if';
import del from 'del';
import watch from 'gulp-watch';
import uglify from 'gulp-uglify';
import plumber from 'gulp-plumber';
import rename from 'gulp-rename';
import cleancss from 'gulp-clean-css';

module.exports = {
    path: path,
    phpmin: phpmin,
    bsync: bsync,
    clean: clean,
    if : gulpif,
    del: del,
    watch: watch,
    uglify: uglify,
    plumber: plumber,
    rename: rename,
    cleancss: cleancss
};