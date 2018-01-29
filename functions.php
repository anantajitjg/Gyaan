<?php
/**
* Main functions for theme
* ------------------------
* @package gyaan
* @since 1.0.0
*/

require_once get_parent_theme_file_path( '/inc/helper-functions.php' );
require_once get_parent_theme_file_path( '/inc/admin/functions.php' );
require_once get_parent_theme_file_path( '/inc/setup.php' );
require_once get_parent_theme_file_path( '/inc/bootstrap-walker-nav-menu.php' );
require_once get_parent_theme_file_path( '/inc/template-functions.php' );
require_once get_parent_theme_file_path( '/inc/ajax.php' );

// sets up theme defaults and registers support for various WordPress features.
function gyaan_theme_setup() {
	// let WordPress handle title tag
	add_theme_support( 'title-tag' );

	// custom background support
	gyaan_custom_background_setup();

	// custom header support
	gyaan_custom_header_setup();

	// post formats support for the theme
	gyaan_post_formats_setup();

	// featured image support
	add_theme_support( 'post-thumbnails' );
	// custom image sizes
	add_image_size( 'card_content_featured_image', 750, 250, true );
	add_image_size( 'content_featured_image', 1500, 500, true );

	// register navigation menus
	register_nav_menus( array(
		'top' => 'Top Menu'
	) );
}
add_action( 'after_setup_theme', 'gyaan_theme_setup');

// load theme styles/scripts
function gyaan_enqueue_scripts() {
	// load styles
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Noto+Sans:400,700', array(), get_gyaan_version() );
	wp_enqueue_style( 'gyaan-styles', get_theme_file_uri( '/css/main.css' ), array(), get_gyaan_version( 'dev' ) );

	// deregister built-in MediaElement.js
	wp_deregister_script( 'wp-mediaelement' );

	// load js fles
	wp_enqueue_script( 'gyaan-scripts', get_theme_file_uri( '/js/bundled.js' ), array(), get_gyaan_version( 'dev' ), true );

	wp_localize_script( 'gyaan-scripts', 'gyaanData', array(
		'root_url' => esc_url( get_site_url() ),
		'ajax_url' => esc_url( admin_url( 'admin-ajax.php' ) )
	) );
}
add_action( 'wp_enqueue_scripts', 'gyaan_enqueue_scripts' );

// custom excerpt more link
function gyaan_excerpt_more( $link ) {
	$link = sprintf( '<p class="link-more"><a class="btn btn-secondary" href="%2$s">%1$s</a></p>', __( 'Read more', 'gyaan' ), esc_url( get_permalink() ) );
	return $link;
}
add_filter( 'excerpt_more', 'gyaan_excerpt_more' );
