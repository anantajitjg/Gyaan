<?php
/**
* Main template file
* ------------------
* @package gyaan
* @since 1.0.0
*/

get_header();
?>

<div class="content-wrapper">
	<main id="main" class="site-main" role="main">
		<div class="container px-2 px-sm-0">
			<div class="row no-gutters">

				<div class="col post-cards">
					<?php
						if( have_posts() ) {
							get_template_part( 'template-parts/post/cards' );
						} else {
							get_template_part( 'template-parts/post/card-content/card-content', 'none' );
						}
					?>
				</div><!-- .col.post-cards -->

			</div><!-- .row -->
		</div><!-- .container -->
	</main>
</div><!-- .content-wrapper -->

<?php get_footer(); ?>