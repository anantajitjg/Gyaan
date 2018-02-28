/**
* config file for development
* ---------------------------
* @package gyaan
* @since 1.0.0
*/
'use strict';

const path = require('path'),
		scripts_DIR = './js/';

module.exports = {
	previewURL: 'http://localhost/Gyaan/',
	webpack_stats: false,
	sourceMap: true,
	scripts: {
		main_DIR: scripts_DIR,
		modules_DIR: scripts_DIR + 'modules/',
		entry: scripts_DIR + 'scripts.js',
		output: path.resolve(__dirname, 'js/'),
		outputName: 'bundled.js'
	},
	scss: {
		src_DIR: './scss/',
		src: 'style.scss',
		dest_DIR: './css/',
		output: path.resolve(__dirname, 'css/'),
		outputName: 'main.css',
		outputStyle: 'expanded', // css output style: default: compressed, other options: nested, expanded and compact
		precision: 6
	}
};

