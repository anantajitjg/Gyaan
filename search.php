<?php
/**
* Search result page template file
* --------------------------------
* @package gyaan
* @since 1.0.0
*/

get_header();
?>

<div class="content-wrapper">
	<main id="main" class="site-main" role="main">
		<div class="container px-2 px-sm-0">
			<header class="page-header py-1 text-secondary">
				<?php if( have_posts() ) : ?>
						<h1 class="page-title"><?php printf( esc_html__( 'Search results for: %s', 'gyaan' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				<?php else : ?>
						<h1 class="page-title border-info"><?php esc_html_e( 'No result found!', 'gyaan' ); ?></h1>
				<?php endif; ?>
			</header>

			<div class="row no-gutters">

				<div class="col post-cards">
						<?php if( have_posts() ) :
								get_template_part( 'template-parts/post/cards' ); ?>
						<?php else : ?>
								<div class="p-4 mb-3">
									<p class="lead mb-4"><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'gyaan' ); ?></p>
									<?php get_search_form(); ?>
								</div>
						<?php endif; ?>
				</div><!-- .col.post-cards -->

			</div><!-- .row -->
		</div><!-- .container -->
	</main>
</div><!-- .content-wrapper -->

<?php get_footer(); ?>