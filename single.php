<?php
/**
* Individual posts template file
* ------------------------------
* @package gyaan
* @since 1.0.0
*/

get_header();

?>

<div class="content-wrapper">
	<main id="main" class="site-main" role="main">
		<div class="container">
			<div class="row">
				<div class="col">
					<?php
						if( have_posts() ) :
							while( have_posts() ) : the_post();
								get_template_part( 'template-parts/post/content/content', get_post_format() );
							endwhile;
						endif;
					?>
				</div><!-- .col -->
			</div><!-- .row -->
		</div><!-- .container-fluid -->
	</main>
</div><!-- .content-wrapper -->

<?php get_footer(); ?>