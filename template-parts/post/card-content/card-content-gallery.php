<?php
/**
* Template part - Gallery post format card content
* ------------------------------------------------
* @package gyaan
* @since 1.0.0
*/
?>

<div id="post-<?php the_ID(); ?>" <?php post_class( array( 'card', 'gallery-post-card' ) ); ?>>

	<?php
		$image_srcs = get_post_gallery_images();
		if( ! empty( $image_srcs ) ) :
	?>
			<div id="carousel-<?php the_ID(); ?>" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner">
					<?php
						$img_count = 1;
						foreach( $image_srcs as $image_src ) :
					?>
							<div class="carousel-item<?php echo ( $img_count === 1 ) ? ' active' : ''; ?>" >
								<div class="card-img bg-image" style="background-image: url(<?php echo esc_url( $image_src ); ?>);"></div>
							</div>
					<?php
							$img_count++;
						endforeach;
					?>
				</div>
			</div>
	<?php 
		else :
			gyaan_featured_image( 'medium_large', array( 'class' => 'card-img img-fluid' ) );
		endif;
	?>

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