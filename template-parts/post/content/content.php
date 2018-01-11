<?php
/**
* Template part - standard post format
* ------------------------------------
* @package gyaan
* @since 1.0.0
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'main-article' ); ?>>

	<?php
		$featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
		if( $featured_img_url ) {
			printf('<div class="post-thumbnail bg-image" style="background-image: url(%1$s);"></div>', esc_url( $featured_img_url ) );
		}
	?>

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
		<?php the_content(); ?>
	</div>

	<div class="entry-footer">
		<?php gyaan_entry_footer(); ?>
	</div>

</article>