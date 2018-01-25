<?php
/**
* Template part - Gallery post format
* -----------------------------------
* @package gyaan
* @since 1.0.0
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'main-article', 'gallery-post-content' ) ); ?>>

	<?php
		$gallery_arr = get_post_gallery( get_the_ID(), false );
		if( empty ( $gallery_arr ) ) {
			gyaan_featured_image();
		}
	?>
	
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
						if( empty ( $gallery_arr ) ) {
							the_content();
						} else {
							gyaan_post_gallery( $gallery_arr );
						}
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