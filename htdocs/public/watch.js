'use strict'

var gulp = require('gulp')


gulp.task('watch-css', function () {
	return gulp.watch([
		'./css/**/*.styl'
	], gulp.series(
		'build-css'
	))
})

gulp.task('watch', gulp.parallel(
	'watch-css',
	'watch-scripts'
))
