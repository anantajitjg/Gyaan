<?php
/**
* Template part - Gallery post format
* -----------------------------------
* @package gyaan
* @since 1.0.0
*/
?>

<article id="post-<?php the_ID(); ?>" <?php gyaan_post_class( 'gallery-post-content', 'content' ); ?>>

	<?php gyaan_featured_bg_image(); ?>
	
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
						$gallery_arr = get_post_gallery( get_the_ID(), false );
						gyaan_post_gallery( $gallery_arr );
					?>
					<div class="default-post-content pt-4">
						<?php
							the_content();
							gyaan_link_pages();
						?>
					</div>
				</div><!-- .entry-content -->

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