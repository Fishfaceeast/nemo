/**
 * Created by yuqian on 16/5/13.
 */
'use strict'

var gulp = require('gulp')

var config = require('./config')

// stylus
require('./build-css')

// js
require('./build-scripts')

// base
require('./build')
require('./watch')

gulp.task('default', gulp.parallel('build'))
