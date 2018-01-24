<?php
/**
* Template part - Image post format
* ---------------------------------
* @package gyaan
* @since 1.0.0
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'main-article', 'image-post-content' ) ); ?>>
	
	<div class="main-article-wrapper">
		
		<?php gyaan_featured_image(); ?>

		<div class="img-overlay p-0">
			<div class="img-content">

				<header class="entry-header">

					<?php if( get_post_type() === 'post' ) : ?>
							<div class="entry-meta">
								<?php gyaan_entry_meta( 'primary', array( 'btn_outline_style' => 'light' ) ); ?>
							</div>
					<?php endif; ?>

					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

					<?php if( get_post_type() === 'post' ) : ?>
							<div class="entry-meta">
								<?php gyaan_entry_meta( 'secondary' ); ?>
							</div>
					<?php endif; ?>

				</header>

				<div class="entry-content text-white">
					<?php echo wp_strip_all_tags( get_the_content() ); ?>
				</div>

				<div class="entry-footer">
					<?php
						if( get_post_type() === 'post' ) {
							gyaan_entry_footer();
						}
					?>
				</div>

			</div><!-- .img-content -->
		</div><!-- .img-overlay -->

	</div><!-- .main-article-wrapper -->

</article>