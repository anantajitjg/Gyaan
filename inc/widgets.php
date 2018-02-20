<?php
/**
* Theme Widgets
* -------------
* @package gyaan
* @since 1.0.0
*/

function gyaan_calendar_widget($output) {
	$output = str_replace( 'id="wp-calendar"', 'id="wp-calendar" class="table table-sm"', $output );
	return $output;
}
add_filter( 'get_calendar', 'gyaan_calendar_widget', 11 );