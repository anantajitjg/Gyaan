<?php
/**
* Template part - standard post format excerpt
* --------------------------------------------
* @package gyaan
* @since 1.0.0
*/
?>

<div id="post-<?php the_ID(); ?>" <?php post_class( array( 'card', 'mt-3', 'mb-1' ) ); ?>>

	<?php
		$featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
		if( $featured_img_url ) {
			printf('<a href="%1$s" class="card-img-link"><div class="card-img-top bg-image" style="background-image: url(%2$s);"></div></a>', esc_url( get_permalink() ), esc_url( $featured_img_url ) );
		}
	?>
	
	<div class="card-body">

		<header class="entry-header">

			<?php if( get_post_type() === 'post' ) : ?>
					<div class="entry-meta">
						<?php gyaan_entry_meta(); ?>
					</div>
			<?php endif; ?>

			<?php the_title( '<h3 class="entry-title card-title"><a href="'. esc_url( get_permalink() ) .'">', '</a></h3>' ); ?>

			<?php if( get_post_type() === 'post' ) : ?>
					<div class="entry-meta">
						<?php gyaan_entry_meta( 'secondary' ); ?>
					</div>
			<?php endif; ?>

		</header>

		<div class="entry-summary card-text">
			<?php the_excerpt(); ?>
		</div>

	</div><!-- .card-body -->

</div><!-- .card -->