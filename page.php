<?php
/**
* Page template file
* ------------------
* @package gyaan
* @since 1.0.0
*/

get_header();
?>

<div class="content-wrapper">
	<main id="main" class="site-main" role="main">
		<div class="container px-2">
			<div class="row no-gutters">
				<div class="col">
					<?php
						if( have_posts() ) :
							while( have_posts() ) : the_post();
								get_template_part( 'template-parts/page/content', 'page' );
								
								if( comments_open() || get_comments_number() ) :
									comments_template();
								endif;
							endwhile;
						endif;
					?>
				</div><!-- .col -->
			</div><!-- .row -->
		</div><!-- .container -->
	</main>
</div><!-- .content-wrapper -->

<?php get_footer(); ?>