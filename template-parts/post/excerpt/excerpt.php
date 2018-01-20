<?php
/**
* Template part - Standard post format excerpt
* --------------------------------------------
* @package gyaan
* @since 1.0.0
*/
?>

<div id="post-<?php the_ID(); ?>" <?php post_class( array( 'card' ) ); ?>>

	<?php gyaan_featured_bg_image( 'excerpt', 'excerpt_featured_image', 'bg-image card-img-top' ); ?>
	
	<div class="card-body">

		<header class="entry-header">

			<?php if( get_post_type() === 'post' ) : ?>
					<div class="entry-meta">
						<?php gyaan_entry_meta(); ?>
					</div>
			<?php endif; ?>

			<?php the_title( '<h4 class="entry-title card-title"><a href="'. esc_url( get_permalink() ) .'">', '</a></h4>' ); ?>

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