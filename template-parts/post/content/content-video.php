<?php
/**
* Template part - Video post format
* ---------------------------------
* @package gyaan
* @since 1.0.0
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'main-article', 'video-post-content' ) ); ?>>

	<?php
		$video = gyaan_embedded_media( array( 'video' ) );
		$other_media = gyaan_embedded_media( array( 'iframe', 'embed', 'object' ) );
		if( empty( $video ) && empty( $other_media ) ) {
			gyaan_featured_bg_image();
		}
	?>
	
	<div class="main-article-wrapper">

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
				if( ! empty( $video ) ) {
					echo '<div class="entry-video">' . $video . '</div>';
				} elseif( ! empty( $other_media ) ) {
					echo '<div class="entry-video embed-responsive embed-responsive-16by9">' . $other_media . '</div>';
				} else {
					the_content();
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

	</div><!-- .main-article-wrapper -->

</article>