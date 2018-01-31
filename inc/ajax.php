<?php
/**
* Custom handlers for AJAX requests
* ---------------------------------
* @package gyaan
* @since 1.0.0
*/

function gyaan_load_cards() {
	$page = sanitize_text_field( $_GET["page"] );
	$posts = new WP_Query( array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'paged' => $page
	) );
	if( $posts->have_posts() ) {
			while( $posts->have_posts() ) {
				$posts->the_post();
				get_template_part( 'template-parts/post/cards' );
			}
		wp_reset_postdata();
	}
	wp_die();
}
add_action( 'wp_ajax_nopriv_gyaan_load_cards', 'gyaan_load_cards' );
add_action( 'wp_ajax_gyaan_load_cards', 'gyaan_load_cards' );





