<?php
/**
* Template part - Quote post format card content
* ----------------------------------------------
* @package gyaan
* @since 1.0.0
*/
?>

<div id="post-<?php the_ID(); ?>" <?php gyaan_post_class( 'quote-post-card' ); ?>>

	<?php gyaan_featured_bg_image( 'card-content', 'card_content_featured_image', 'bg-image card-img-top' ); ?>

	<div class="entry-header card-header">
		<?php printf( '<div class="entry-title"><a href="%2$s"><span class="oi oi-link-intact"></span> %1$s</a></div>', esc_html__( 'Quote' ), esc_url( get_permalink() ) ); ?>
	</div>

	<div class="card-body">

		<div class="entry-content">

			<blockquote class="blockquote mb-0">
				<span class="oi oi-double-quote-serif-left"></span>
				<?php the_content(); ?>
				<footer class="blockquote-footer">
					<?php the_title(); ?>
				</footer>
			</blockquote>

		</div><!-- .entry-content -->

	</div><!-- .card-body -->

</div><!-- .card -->