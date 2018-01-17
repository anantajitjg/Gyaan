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
					'class' => 'card-img img-fluid'
				) );
			}
		?>
		
		<div class="card-img-overlay">
			<div class="w-100 h-100 d-flex flex-column justify-content-center">

				<div class="img-card-content">
					<header class="entry-header">

						<?php if( get_post_type() === 'post' ) : ?>
								<div class="entry-meta">
									<?php gyaan_entry_meta( 'primary', array( 'btn_outline_style' => 'light' ) ); ?>
								</div>
						<?php endif; ?>

						<?php the_title( '<h4 class="entry-title card-title"><a href="'. esc_url( get_permalink() ) .'">', '</a></h4>' ); ?>

						<?php if( get_post_type() === 'post' ) : ?>
								<div class="entry-meta">
									<?php gyaan_entry_meta( 'secondary' ); ?>
								</div>
						<?php endif; ?>

					</header>

					<div class="entry-summary card-text text-white">
						<?php the_excerpt(); ?>
					</div>
				</div><!-- .img-card-content -->

			</div><!-- .d-flex -->

		</div><!-- .card-img-overlay -->

	</div><!-- .card.img-post-card -->
</div><!-- .card-wrapper -->