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
		<div class="container-fluid">
			<div class="row">
				<div class="col">
					<?php
						if( have_posts() ) :
							while( have_posts() ) : the_post();
								get_template_part( 'template-parts/post/content', get_post_format() );
							endwhile;
						endif;
					?>
				</div>
			</div>
		</div>
	</main><!-- #main -->
</div><!-- .content-wrapper -->

<?php get_footer(); ?>