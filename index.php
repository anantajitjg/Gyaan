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
		<div class="container-fluid px-sm-4">
			<div class="row no-gutters">
				<div class="col post-cards">
					<div class="post-cards-container">
							<?php
								if( have_posts() ) :
									while( have_posts() ) : the_post();
										get_template_part( 'template-parts/post/cards' );
									endwhile;
								endif;
							?>
					</div><!-- .post-cards-container -->
					
					<?php gyaan_posts_pagination(); ?>

				</div><!-- .col.post-cards -->
			</div><!-- .row -->
		</div><!-- .container -->
	</main>
</div><!-- .content-wrapper -->

<?php get_footer(); ?>