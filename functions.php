<?php
/**
* Main functions for theme
* ------------------------
* @package gyaan
* @since 1.0.0
*/

require_once get_parent_theme_file_path( '/inc/helper-functions.php' );
require_once get_parent_theme_file_path( '/inc/bootstrap-walker-nav-menu.php' );
require_once get_parent_theme_file_path( '/inc/bootstrap-walker-comment.php' );
require_once get_parent_theme_file_path( '/inc/template-functions.php' );
require_once get_parent_theme_file_path( '/inc/widgets.php' );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */ 
function gyaan_theme_setup() {
	// Automatic Feed Links for post and comment in the head
	add_theme_support( 'automatic-feed-links' );

	// let WordPress handle title tag
	add_theme_support( 'title-tag' );

	// custom background support
	add_theme_support( 'custom-background' );

	// custom logo support
	add_theme_support( 'custom-logo', array(
		'height'      => 70,
		'width'       => 300,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );

	// custom header support
	add_theme_support( 'custom-header', array(
		'default-image' => get_parent_theme_file_uri( '/img/gyaan_header_img.png' ),
		'width' => 1500,
		'height' => 250,
		'flex-width' => true,
		'flex-height' => true
	) );

	register_default_headers( array(
		'gyaan_header_img' => array(
			'url' => get_parent_theme_file_uri( '/img/gyaan_header_img.png' ),
			'thumbnail_url' => get_parent_theme_file_uri( '/img/gyaan_header_thumbnail.png' ),
			'description' => esc_html__( 'Gyaan (Knowledge)', 'gyaan' )
		)
	) );

	// post formats support for the theme
	add_theme_support( 'post-formats', array(
		'audio',
		'gallery',
		'image',
		'quote',
		'video'
	) );

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

	// default content width
	$GLOBALS['content_width'] = 600;

	// register navigation menus
	register_nav_menus( array(
		'top' => 'Top Menu'
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action( 'after_setup_theme', 'gyaan_theme_setup' );

/**
 * Set the content width based on layout
 */
function gyaan_content_width() {
	global $content_width;
	if( is_singular() ) {
		$content_width = 1140;
	}
}
add_action( 'template_redirect', 'gyaan_content_width', 0 );

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
 * Load theme styles and scripts
 */
function gyaan_enqueue_scripts() {
	// load styles
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Noto+Sans:400,700', array(), get_gyaan_version() );
	wp_enqueue_style( 'gyaan-styles', get_theme_file_uri( '/css/main.css' ), array(), get_gyaan_version( 'dev' ) );

	// load js fles
	wp_enqueue_script( 'gyaan-scripts', get_theme_file_uri( '/js/bundled.js' ), array(), get_gyaan_version( 'dev' ), true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_localize_script( 'gyaan-scripts', 'gyaanData', array(
		'root_url' => esc_url( get_site_url() ),
		'is_paged' => is_paged()
	) );
}
add_action( 'wp_enqueue_scripts', 'gyaan_enqueue_scripts' );

/**
 * Custom excerpt more link
 */
function gyaan_excerpt_more( $link ) {
	$link = sprintf( '<p class="link-more"><a class="link-more-btn btn btn-secondary" href="%2$s">%1$s</a></p>', __( 'Read more', 'gyaan' ), esc_url( get_permalink() ) );
	return $link;
}
add_filter( 'excerpt_more', 'gyaan_excerpt_more' );

/**
 * Make video embeds responsive by adding Bootstrap Embed Utility
 */
function gyaan_embed_html( $html ) {
	return '<div class="embed-responsive-wrapper mb-2 mb-sm-4 pt-1 px-md-3"><div class="embed-responsive embed-responsive-16by9">' . $html . '</div></div>';
}
add_filter( 'embed_oembed_html', 'gyaan_embed_html' );
add_filter( 'video_embed_html', 'gyaan_embed_html' ); // Jetpack