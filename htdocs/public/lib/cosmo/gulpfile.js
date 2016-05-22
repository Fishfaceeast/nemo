'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');

gulp.task('build-sass', function () {
	return gulp.src(['./lib/*.scss', './*.scss'])
		.pipe(sourcemaps.init())
		.pipe(sass().on('error', sass.logError))
		.pipe(sourcemaps.write('./maps'))
		.pipe(gulp.dest('./dist/css'));
});

gulp.task('watch-sass', function () {
	gulp.watch(['./lib/*.scss', './*.scss'], ['sass']);
});

