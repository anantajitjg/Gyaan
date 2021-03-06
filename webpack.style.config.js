'use strict';

const config = require('./config'),
		path = require('path'),
		webpack = require('webpack'),
		ExtractTextPlugin = require('extract-text-webpack-plugin');

// SourceMapDevToolPlugin
//=================================
let sourceMapDevToolPlugin = new webpack.SourceMapDevToolPlugin({
	test: /\.(css|scss)$/,
	exclude: 'style.js',
	filename: config.scss.outputName + '.map'
});

// webpack config
//=================================
let webpackConfig = {
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
			},
			{
				test: /\.(eot|woff|[ot]tf|svg)$/,
				use: {
					loader: 'file-loader',
					options: {
						name: '[name].[ext]',
						outputPath: 'fonts/'
					}
				}
			}
		]
	},
	plugins: [
		new ExtractTextPlugin(config.scss.outputName)
	]
};

if(config.sourceMap) {
	webpackConfig.plugins.push(sourceMapDevToolPlugin);
}

module.exports = webpackConfig;