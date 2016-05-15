// liuxiaojie@baixing.com

'use strict'

var maxParallelTasksCount = require('os').cpus().length - 1
/**
 * Run parallel tasks in multiple processes
 * @param {...string} task names
 */
function gulpParallelProcesses() {
	var tasks = [].slice.call(arguments)
	var tasksCount = tasks.length

	var execFile = require('child_process').execFile
	var gulpCmd = require.resolve('gulp/bin/gulp')

	return function parallelTasks(cb) {
		var tasksFinishedCount = 0
		var index = 0
		function runNextTask(onAllFinished) {
			var task = tasks[index++]
			var cmd = 'gulp ' + task

			execFile(gulpCmd, [task], function(err, stdout, stderr) {
				console.log('child process stdout:\t' + cmd)
				console.log(stdout)

				if (stderr) {
					console.log('child process stderr:\t' + cmd)
					console.log(stderr)
				}
				if (err) {
					console.log('child process err:\t' + cmd)
					console.log(err)
					tasksFinishedCount = 0
					index = 0
					throw new Error('error thrown from child process:\t' + cmd)
				}
				if (++tasksFinishedCount === tasksCount) {
					tasksFinishedCount = 0
					index = 0
					return onAllFinished()
				}
				if (index < tasksCount) {
					return runNextTask(onAllFinished)
				}
			})
		}

		for (var i = 0, count = Math.min(tasksCount, maxParallelTasksCount); i < count; i++) {
			runNextTask(cb)
		}
	}
}

module.exports = gulpParallelProcesses

/** comment code above and un-comment following code to enable serial build (instead of parallel) */
//var gulp = require('gulp')
//module.exports = gulp.parallel.bind(gulp)
