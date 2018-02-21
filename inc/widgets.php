<?php
/**
* Theme Widgets
* -------------
* @package gyaan
* @since 1.0.0
*/

function gyaan_calendar_widget( $output ) {
	$output = str_replace( 'id="wp-calendar"', 'id="wp-calendar" class="table table-sm"', $output );
	return $output;
}
add_filter( 'get_calendar', 'gyaan_calendar_widget', 11 );

function gyaan_search_widget( $form ) {
	$form = '<form role="search" method="get" class="search-form gyaan-search-form form-inline needs-validation" action="' . esc_url( home_url( '/' ) ) . '" novalidate>
		<div class="input-group">
			<label class="screen-reader-text" for="gyaan-search-field">' . _x( 'Search for:', 'label' ) . '</label>
			<input type="search" id="gyaan-search-field" class="search-field form-control" placeholder="' . esc_attr_x( 'Search', 'placeholder' ) . '" value="' . get_search_query() . '" name="s" required />
			<div class="input-group-append">
				<button type="submit" class="search-submit btn btn-primary"><span class="oi oi-magnifying-glass"></span></button>
			</div>
		</div>
	</form>';
	return $form;
}
add_filter( 'get_search_form', 'gyaan_search_widget', 11 );

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