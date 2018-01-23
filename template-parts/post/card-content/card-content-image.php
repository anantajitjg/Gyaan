<?php
/**
* Template part - Image post format card content
* ----------------------------------------------
* @package gyaan
* @since 1.0.0
*/
?>

<div id="post-<?php the_ID(); ?>" <?php post_class( array( 'card', 'img-post-card' ) ); ?>>

	<?php gyaan_featured_image( 'medium_large', array( 'class' => 'card-img img-fluid' ) ); ?>

	<div class="card-img-overlay p-0">
		
		<div class="img-content w-100 h-100 d-flex flex-column justify-content-center">
			
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

		</div><!-- .img-content -->

	</div><!-- .card-img-overlay -->

</div><!-- .card.img-post-card -->