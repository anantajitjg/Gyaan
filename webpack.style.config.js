'use strict';

const config = require('./config'),
		path = require('path'),
		webpack = require('webpack'),
		ExtractTextPlugin = require('extract-text-webpack-plugin');

module.exports = {
	entry: config.scss.src_DIR + config.scss.src,
	output: {
		path: config.scss.output,
		filename: 'style.js'
	},
	module: {
		rules: [
			{
				test: /\.scss$/,
				use: ExtractTextPlugin.extract({
						fallback: 'style-loader',
						use: [{
							loader: 'css-loader',
							options: {
								importLoaders: 2,
								sourceMap: true
							}
						}, {
							loader: 'postcss-loader',
							options: {
								ident: 'postcss',
								plugins: () => [
									require('autoprefixer')()
								],
								sourceMap: true
							}
						}, {
							loader: 'sass-loader',
							options: {
								indentType: 'tab',
								indentWidth: 1,
								outputStyle: config.scss.outputStyle,
								precision: config.scss.precision,
								sourceMap: true
							}
						}]
					})
			}
		]
	},
	plugins: [
		new ExtractTextPlugin(config.scss.outputName),
		new webpack.SourceMapDevToolPlugin({
			test: /\.(css|scss)$/,
			exclude: 'style.js',
			filename: config.scss.outputName + '.map'
		})
	]
};