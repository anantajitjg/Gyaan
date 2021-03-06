<?php
/**
* Template part - Video post format card content
* ----------------------------------------------
* @package gyaan
* @since 1.0.0
*/
?>

<div id="post-<?php the_ID(); ?>" <?php gyaan_post_class( 'video-post-card' ); ?>>

	<?php
		$video = gyaan_embedded_media( array( 'video' ) );
		$other_media = gyaan_embedded_media( array( 'iframe', 'embed', 'object' ) );
		if( empty( $video ) && empty( $other_media ) ) {
			gyaan_featured_bg_image( 'card-content', 'card_content_featured_image', 'bg-image card-img-top' );
		}
	?>
	
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

		<div class="entry-content">
			<?php
				if( ! empty( $video ) ) {
					echo '<div class="entry-video">' . $video . '</div>';
				} elseif( ! empty( $other_media ) ) {
					echo '<div class="entry-video embed-responsive embed-responsive-16by9">' . $other_media . '</div>';
				} else {
					the_excerpt();
				}
			?>
		</div>

	</div><!-- .card-body -->

</div><!-- .card.video-post-card -->