<?php
/**
* Theme setup helper functions
* ----------------------------
* @package gyaan
* @since 1.0.0
*/

function gyaan_custom_background_setup() {
	$custom_bg = get_option( 'gyaan_custom_background_option' );
	if( $custom_bg ) {
		add_theme_support( 'custom-background' );
	}
}

function gyaan_custom_header_setup() {
	$custom_header = get_option( 'gyaan_custom_header_option' );
	if( $custom_header ) {
		$defaults = array(
			'default-image' => get_parent_theme_file_uri( '/img/gyaan_header_img.png' ),
			'width' => 1500,
			'height' => 250,
			'flex-width' => true,
			'flex-height' => true
		);
		add_theme_support( 'custom-header', $defaults );
		
		register_default_headers( array(
			'gyaan_header_img' => array(
				'url' => get_parent_theme_file_uri( '/img/gyaan_header_img.png' ),
				'thumbnail_url' => get_parent_theme_file_uri( '/img/gyaan_header_thumbnail.png' ),
				'description' => 'Gyaan (Knowledge)'
			)
		) );
	}
}

function gyaan_post_formats_setup() {
	$post_formats = array();
	$current_post_formats = get_option( 'gyaan_post_formats_option' );
	if( ! empty( $current_post_formats ) ) {
		foreach( $current_post_formats as $post_format => $val ) {
			$post_formats[] = $post_format;
		}
		add_theme_support( 'post-formats', $post_formats );
	}
}