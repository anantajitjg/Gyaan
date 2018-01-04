<?php
/**
* Admin related functions for theme
* ---------------------------------
* @package gyaan
* @since 1.0.0
*/

if( ! is_admin() ) {
	return;
}
function gyaan_add_theme_page() {

	add_theme_page(
		'Gyaan Theme Options',
		'Gyaan Options',
		'manage_options',
		'gyaan_options',
		'gyaan_options_page'
	);

}
add_action( 'admin_menu', 'gyaan_add_theme_page' );

// Custom Settings
function gyaan_custom_settings() {

	/*-------------------- General Settings-----------------------*/

	register_setting( 'gyaan-general-group', 'gyaan_custom_background_option', array(
		'sanitize_callback' => 'sanitize_text_field'	
	) );
	register_setting( 'gyaan-general-group', 'gyaan_custom_header_option', array(
		'sanitize_callback' => 'sanitize_text_field'	
	) );
	register_setting( 'gyaan-general-group', 'gyaan_post_formats_option', array(
		'sanitize_callback' => 'gyaan_sanitize_post_formats'
	) );

	add_settings_section( 'gyaan-general-section', 'Manage Theme Features', '__return_empty_string', 'gyaan_options' );

	add_settings_field( 'custom-background', 'Custom Background', 'gyaan_general_custom_background_handler', 'gyaan_options', 'gyaan-general-section' );
	add_settings_field( 'custom-header', 'Custom Header', 'gyaan_general_custom_header_handler', 'gyaan_options', 'gyaan-general-section' );
	add_settings_field( 'post-formats', 'Post Formats', 'gyaan_general_post_formats_handler', 'gyaan_options', 'gyaan-general-section' );

	/*-------------------- End of General Settings-----------------------*/
}
add_action( 'admin_init', 'gyaan_custom_settings' );

/*------- Theme General section ------------*/

function gyaan_general_custom_background_handler() {
	$custom_background = esc_attr( get_option( 'gyaan_custom_background_option' ) );
	$checked = isset( $custom_background ) ? ( $custom_background == 1 ? 'checked' : '' ) : '';
	$html = "<label for='gyaan_custom_background_option'><input type='checkbox' id='gyaan_custom_background_option' name='gyaan_custom_background_option' value='1' {$checked} /> Enable custom background</label>";
	echo $html;
}

function gyaan_general_custom_header_handler() {
	$custom_header = esc_attr( get_option( 'gyaan_custom_header_option' ) );
	$checked = isset( $custom_header ) ? ( $custom_header == 1 ? 'checked' : '' ) : '';
	$html = "<label for='gyaan_custom_header_option'><input type='checkbox' id='gyaan_custom_header_option' name='gyaan_custom_header_option' value='1' {$checked} /> Enable custom header</label>";
	echo $html;
}

function gyaan_sanitize_post_formats( $arr ) {
	return array_map( 'sanitize_text_field', $arr );
}

function gyaan_general_post_formats_handler() {
	$html = "";
	$current_post_formats = get_option( 'gyaan_post_formats_option' );
	$post_formats = get_post_format_strings();
	unset( $post_formats['standard'] );
	foreach( $post_formats as $post_format => $post_format_name  ) {
		$checked = isset( $current_post_formats[$post_format] ) ? ( $current_post_formats[$post_format] == 1 ? 'checked' : '' ) : '';
		$html .= "<label for='{$post_format}'><input type='checkbox' id='{$post_format}' name='gyaan_post_formats_option[{$post_format}]' value='1' {$checked} /> {$post_format_name}</label><br />";
	}
	echo $html;
}

/*------- End of general section ------------*/

/*------- Gyaan Theme Options page ------------*/

function gyaan_options_page() {
	require_once get_parent_theme_file_path( '/inc/admin/templates/options-page.php' );
}