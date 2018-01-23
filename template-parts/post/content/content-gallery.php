<?php
/**
* Template part - Gallery post format
* -----------------------------------
* @package gyaan
* @since 1.0.0
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'main-article', 'gallery-post-content' ) ); ?>>
	
	<div class="main-article-wrapper">

			<div class="gallery-wrapper">

				<header class="entry-header">

					<?php if( get_post_type() === 'post' ) : ?>
							<div class="entry-meta">
								<?php gyaan_entry_meta(); ?>
							</div>
					<?php endif; ?>

					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

					<?php if( get_post_type() === 'post' ) : ?>
							<div class="entry-meta">
								<?php gyaan_entry_meta( 'secondary' ); ?>
							</div>
					<?php endif; ?>

				</header>

				<div class="entry-content">
					<?php
						$image_srcs = get_post_gallery_images();
						if( ! empty( $image_srcs ) ) :
							var_dump(get_post_gallery(get_the_ID(), false));
					?>
							<div id="carousel-<?php the_ID(); ?>" class="carousel slide" data-ride="carousel">
								<div class="carousel-inner">
									<?php
										$img_count = 1;
										foreach( $image_srcs as $image_src ) :
									?>
											<div class="carousel-item<?php echo ( $img_count === 1 ) ? ' active' : ''; ?>" >
												<div class="bg-image" style="background-image: url(<?php echo esc_url( $image_src ); ?>);"></div>
											</div>
									<?php
											$img_count++;
										endforeach;
									?>
								</div>
							</div>
					<?php 
						else :
							gyaan_featured_image();
						endif;
					?>
				</div>

				<div class="entry-footer">
					<?php
						if( get_post_type() === 'post' ) {
							gyaan_entry_footer();
						}
					?>
				</div>

			</div><!-- .gallery-wrapper -->

	</div><!-- .main-article-wrapper -->

</article>