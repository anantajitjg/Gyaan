<?php
/**
* Template part - Image post format excerpt
* -----------------------------------------
* @package gyaan
* @since 1.0.0
*/
?>

<div class="card-wrapper col col-md-6 col-xl-8">
	<div id="post-<?php the_ID(); ?>" <?php post_class( array( 'card', 'img-post-card' ) ); ?>>

		<?php
			if( get_the_post_thumbnail() !== '' ) {
				the_post_thumbnail( 'medium_large', array(
					'class' => 'card-img img-fluid',
					'title' => esc_attr( get_the_title() )
				) );
			}
		?>
		
		<div class="card-img-overlay">
			<div class="w-100 h-100 p-3 d-flex flex-column justify-content-center">
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
			</div>

		</div><!-- .card-img-overlay -->

	</div><!-- .card.img-post-card -->
</div><!-- .card-wrapper -->