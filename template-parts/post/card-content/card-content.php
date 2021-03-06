<?php
/**
* Template part - General template part for displaying card content for posts
* ---------------------------------------------------------------------------
* @package gyaan
* @since 1.0.0
*/
?>

<div id="post-<?php the_ID(); ?>" <?php gyaan_post_class(); ?>>

	<?php gyaan_featured_bg_image( 'card-content', 'card_content_featured_image', 'bg-image card-img-top' ); ?>
	
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