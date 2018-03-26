<?php
/**
* Template part - Quote post format
* ---------------------------------
* @package gyaan
* @since 1.0.0
*/
?>

<article id="post-<?php the_ID(); ?>" <?php gyaan_post_class( 'quote-post-content', 'content' ); ?>>

	<?php gyaan_featured_bg_image(); ?>
	
	<div class="main-article-wrapper">

		<header class="entry-header">
			<h1 class="entry-title"><?php esc_html_e( 'Quote' ); ?></h1>
		</header>

		<div class="entry-content">

			<blockquote class="blockquote mb-0 p-4">
				<span class="oi oi-double-quote-serif-left"></span>
				<?php the_content(); ?>
				<footer class="blockquote-footer">
					<?php the_title(); ?>
				</footer>
			</blockquote>

			<?php gyaan_link_pages(); ?>

		</div><!-- .entry-content -->

		<div class="entry-footer">
			<?php
				if( get_post_type() === 'post' ) {
					gyaan_entry_footer();
				}
			?>
		</div>

	</div><!-- .main-article-wrapper -->

</article>