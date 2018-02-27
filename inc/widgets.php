<?php
/**
* Theme Widgets
* -------------
* @package gyaan
* @since 1.0.0
*/

/* custom widgets */


/* modify existing widgets */

function gyaan_calendar_widget( $output ) {
	$output = str_replace( 'id="wp-calendar"', 'id="wp-calendar" class="table table-sm"', $output );
	return $output;
}
add_filter( 'get_calendar', 'gyaan_calendar_widget', 11 );

function gyaan_tag_cloud_widget_data( $tags_data) {
	foreach($tags_data as $key => $tag_data) {
		$tags_data[$key]['class'] .= ' badge badge-pill badge-info';
		$tags_data[$key]['show_count'] = $tag_data['show_count'] ? ' <span class="tag-link-count badge badge-pill badge-dark">' . $tag_data['real_count'] . '</span>' : '';
	}
	return $tags_data;
}
add_filter( 'wp_generate_tag_cloud_data', 'gyaan_tag_cloud_widget_data', 11 );

function gyaan_tag_cloud_widget_args($args) {
	$args['smallest'] = 1;
	$args['largest'] = 1;
	$args['unit'] = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'gyaan_tag_cloud_widget_args', 11 );