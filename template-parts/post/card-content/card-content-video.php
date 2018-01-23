<?php
/**
* Template part - Video post format card content
* ----------------------------------------------
* @package gyaan
* @since 1.0.0
*/
?>

<div id="post-<?php the_ID(); ?>" <?php post_class( array( 'card', 'video-post-card' ) ); ?>>

	<?php
		$video = gyaan_embedded_media( array( 'video', 'iframe', 'embed', 'object' ) );
		if( empty( $video ) ) {
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
					echo '<div class="entry-video embed-responsive">';
						echo $video;
					echo '</div>';
				} else {
					the_content();
				}
			?>
		</div>

	</div><!-- .card-body -->

</div><!-- .card.video-post-card -->