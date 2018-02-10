<?php
/**
* Archive template file
* ---------------------
* @package gyaan
* @since 1.0.0
*/

get_header();

gyaan_page_navigation();
?>

<div class="content-wrapper">
	<main id="main" class="site-main" role="main">
		<div class="container-fluid px-sm-5">

			<?php if( have_posts() ) : ?>
					<header class="page-header py-1 text-secondary">
						<?php gyaan_archive_title(); ?>
					</header>
			<?php endif; ?>

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

					<div class="page-load-status">
						<?php gyaan_pre_loader( 'grid', array( 'infinite-scroll-request' ) ); ?>
					</div><!-- .page-load-status -->
					
					<?php gyaan_posts_pagination(); ?>

				</div><!-- .col.post-cards -->
			</div><!-- .row -->
		</div><!-- .container -->
	</main>
</div><!-- .content-wrapper -->

<?php get_footer(); ?>