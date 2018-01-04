<?php
/**
* Helper functions for theme
* --------------------------
* @package gyaan
* @since 1.0.0
*/

function get_gyaan_version( $env = 'prod' ) {
	$theme = wp_get_theme( 'gyaan' );
	$version = $theme->get('Version');
	if( $env === 'dev' ) {
		$version = str_replace( ' ', '', microtime() );
	}
	return $version;
}

function gyaan_replace_scripts_wp_version( $src ) {
	$wp_version = get_bloginfo( 'version' );
	if( strstr( $src, $wp_version ) ) {
		$src = str_replace( $wp_version, get_gyaan_version(), $src );
	}
	return $src;
}
add_filter( 'style_loader_src', 'gyaan_replace_scripts_wp_version', 100 );
add_filter( 'script_loader_src', 'gyaan_replace_scripts_wp_version', 100 );
// remove meta name generator tag
add_filter( 'the_generator', '__return_empty_string', 100 );