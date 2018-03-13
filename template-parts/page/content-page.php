<?php
/**
* Template part for displaying page content
* -----------------------------------------
* @package gyaan
* @since 1.0.0
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'main-article', 'page-content' ) ); ?>>

	<?php gyaan_featured_bg_image(); ?>
	
	<div class="main-article-wrapper">

		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header>

		<div class="entry-content">
			<?php
				the_content();
				gyaan_link_pages();
			?>
		</div>

	</div><!-- .main-article-wrapper -->

</article>