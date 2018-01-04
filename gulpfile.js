'use strict';

const gulp = require('gulp'),
		del = require('del'),
		config = require('./config'),
		webpack = require('webpack-stream'),
		browserSync = require('browser-sync').create();

gulp.task('browser-sync', function() {
	browserSync.init({
		ghostMode: false,
		proxy: config.previewURL,
    	notify: false
    });
});

gulp.task('webpack', function() {
	return gulp.src(config.scripts.entry)
		.pipe(webpack(require('./webpack.config.js'), null, function(err, stats) {
			if(err) {
				console.log(err.toString());
			}
			if(config.webpack_stats) {
				console.log(stats.toString());
			}
		}))
		.pipe(gulp.dest(config.scripts.main_DIR));
});

gulp.task('webpackStyles', function() {
	return gulp.src(config.scss.src_DIR + config.scss.src)
		.pipe(webpack(require('./webpack.style.config.js'), null, function(err, stats) {
			if(err) {
				console.log(err.toString());
			}
			if(config.webpack_stats) {
				console.log(stats.toString());
			}
		}))
		.pipe(gulp.dest(config.scss.dest_DIR));
});

gulp.task('loadStyles', ['webpackStyles'], function() {

	del([config.scss.dest_DIR + 'style.js']);

	return gulp.src(config.scss.dest_DIR + config.scss.outputName)
		.pipe(browserSync.stream());
});

gulp.task('loadScripts', ['webpack'], function() {
	browserSync.reload();
});

gulp.task('watch', ['browser-sync'], function() {
    gulp.watch('./**/*.php', function() {
    	browserSync.reload();
    });
    gulp.watch(config.scss.src_DIR + '**/*.scss', ['loadStyles']);
    gulp.watch([config.scripts.modules_DIR + "*.js", config.scripts.entry], ['loadScripts']);
});

gulp.task('default', ['browser-sync', 'loadScripts', 'loadStyles']);