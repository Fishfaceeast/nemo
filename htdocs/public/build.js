'use strict'

var gulp = require('gulp')
var del = require('del')

var config = require('./config')
var dist = config.dist

function cleanBuiltFiles(cb) {
	del([
		dist + '/d'
	], {
		force: true,
	}, cb)
}

gulp.task('clean', cleanBuiltFiles)

gulp.task('build', gulp.parallel(
	'build-css',
	'build-scripts'
))

gulp.task('clean-build', gulp.series('clean', 'build'))
