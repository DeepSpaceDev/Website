var gulp = require('gulp');
var del = require('del');
var browserify = require('browserify');

gulp.task('default', function() {
	// default task
});

gulp.task('clear', function () {
	return del(['elements.min.html']);
});

gulp.task('minify', function() {
	var b = browserify('bower_components/**/*');
	
});