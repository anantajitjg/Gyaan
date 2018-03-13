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
require_once get_parent_theme_file_path( '/inc/bootstrap-walker-comment.php' );
require_once get_parent_theme_file_path( '/inc/template-functions.php' );
require_once get_parent_theme_file_path( '/inc/widgets.php' );

/**
 * sets up theme defaults and registers support for various WordPress features.
 */ 
function gyaan_theme_setup() {
	// let WordPress handle title tag
	add_theme_support( 'title-tag' );

	// custom background support
	gyaan_custom_background_setup();

	// custom header support
	gyaan_custom_header_setup();

	// post formats support for the theme
	gyaan_post_formats_setup();

	// html5 support for search forms, comments, gallery and caption
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'search-form',
		'gallery',
		'caption'
	) );

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

/**
 * Register widgets and widget area
 */
function gyaan_init_widgets() {
	register_sidebar( array(
		'id' => 'sidebar-gyaan',
		'name' => __( 'Gyaan: Sidebar', 'gyaan' ),
		'description' => __( 'Right Sidebar', 'gyaan' ),
		'before_widget' => '<div id="%1$s" class="gyaan-widget %2$s">',
		'before_title' => '<h3 class="widget-title text-primary">',
		'after_title' => '</h3><hr class="gyaan-hr border-bottom" />',
		'after_widget' => '</div>'
	) );
}
add_action( 'widgets_init', 'gyaan_init_widgets' );

/**
 * load theme styles and scripts
 */
function gyaan_enqueue_scripts() {
	// load styles
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Noto+Sans:400,700', array(), get_gyaan_version() );
	wp_enqueue_style( 'gyaan-styles', get_theme_file_uri( '/css/main.css' ), array(), get_gyaan_version( 'dev' ) );

	// load js fles
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', array(), '3.3.1', true );

	wp_enqueue_script( 'gyaan-scripts', get_theme_file_uri( '/js/bundled.js' ), array(), get_gyaan_version( 'dev' ), true );

	wp_localize_script( 'gyaan-scripts', 'gyaanData', array(
		'root_url' => esc_url( get_site_url() ),
		'is_paged' => is_paged()
	) );
}
add_action( 'wp_enqueue_scripts', 'gyaan_enqueue_scripts', 11 );

/**
 * custom excerpt more link
 */
function gyaan_excerpt_more( $link ) {
	$link = sprintf( '<p class="link-more"><a class="link-more-btn btn btn-secondary" href="%2$s">%1$s</a></p>', __( 'Read more', 'gyaan' ), esc_url( get_permalink() ) );
	return $link;
}
add_filter( 'excerpt_more', 'gyaan_excerpt_more' );

/**
 * make video embeds responsive by adding Bootstrap Embed Utility
 */
function gyaan_embed_html( $html ) {
	return '<div class="embed-responsive-wrapper mb-4"><div class="embed-responsive embed-responsive-16by9">' . $html . '</div></div>';
}
add_filter( 'embed_oembed_html', 'gyaan_embed_html' );
add_filter( 'video_embed_html', 'gyaan_embed_html' ); // Jetpack