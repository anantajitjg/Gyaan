<?php
/**
* Page not found (404) template file
* ----------------------------------
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

					<section class="error-404 not-found">
						<header class="page-header">
							<h1 class="main-title display-4 text-secondary">404</h1>
							<h2 class="page-title border-info"><?php esc_html_e( 'Page not found!', 'gyaan' ); ?></h2>
						</header>

						<hr class="my-4">

						<div class="page-content">
							<p class="text-secondary"><?php esc_html_e( 'It looks like nothing was found at this location. Try search?', 'gyaan' ); ?></p>
							<?php get_search_form(); ?>
						</div><!-- .page-content -->
					</section><!-- .error-404 -->
					
				</div><!-- .col -->
			</div><!-- .row -->
		</div><!-- .container -->
	</main>
</div><!-- .content-wrapper -->

<?php get_footer(); ?>