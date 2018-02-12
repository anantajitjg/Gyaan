<?php
/**
* Comments template file
* ----------------------
* @package gyaan
* @since 1.0.0
*/

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
	<?php
		if( have_comments() ) : ?>
			<h2 class="comments-title">
				<?php
					$comments_number = get_comments_number();
					printf( esc_html( _nx(
						'One reply to &ldquo;%2$s&rdquo;',
						'%1$s replies to &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'gyaan'
					) ),
						number_format_i18n( $comments_number ),
						get_the_title()
					);
				?>
			</h2>
			<ol class="list-unstyled comment-list">
				<?php
					wp_list_comments( array(
						'avatar_size' => 64,
						'style' => 'ol'
					) );
				?>
			</ol>
	<?php
			gyaan_pagination( 'comments' );
		endif;
		if( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
			<div class="no-comments alert alert-info" role="alert">
				<?php esc_html_e( 'Comments are closed.', 'gyaan' ); ?>
			</div>
	<?php
		endif;
		comment_form();
	?>
</div><!-- #comments -->