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
		<div class="container">
			<div class="row no-gutters">
				<div class="col post-cards">
					<div class="container-fluid">
						<?php
							if( have_posts() ) :
								while( have_posts() ) : the_post();
									get_template_part( 'template-parts/post/excerpt/excerpt', get_post_format() );
								endwhile;
							endif;
						?>
					</div>
				</div><!-- .col.post-cards -->

				<!-- <div class="col col-lg-4">
					<div class="sidebar">
					</div>
				</div> -->

			</div><!-- .row -->
		</div><!-- .container -->
	</main>
</div><!-- .content-wrapper -->

<?php get_footer(); ?>