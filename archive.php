<?php
/**
* Archive template file
* ---------------------
* @package gyaan
* @since 1.0.0
*/

get_header();
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