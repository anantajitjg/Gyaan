'use strict';

const config = require('./config'),
		path = require('path'),
		webpack = require('webpack');

module.exports = {
	entry: config.scripts.entry,
	output: {
		path: config.scripts.output,
		filename: config.scripts.outputName
	},
	module: {
		rules: [
			{
				test: /\.js$/,
				exclude: /node_modules/,
				use: {
					loader: 'babel-loader',
					options: {
						presets: ['env'],
						cacheDirectory: true
					}
				}
			}
		]
	},
	plugins: [
		new webpack.ProvidePlugin({
			$: 'jquery',
			jQuery: 'jquery',
			'window.jQuery': 'jquery',
			Popper: ['popper.js', 'default'],
			Util: 'exports-loader?Util!bootstrap/js/dist/util'
		})
	]
};