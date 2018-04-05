<?php
/**
* Header template file
* --------------------
* @package gyaan
* @since 1.0.0
*/
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
	
	<?php get_sidebar(); ?>

	<div class="main-wrapper">

		<div class="wrapper">
			<div class="row no-gutters">
				<div class="col">
					<div class="bg-image header-wrapper center-block" <?php gyaan_header_bg(); ?>>

						<?php
							gyaan_site_info();
							gyaan_top_menu();
						?>
						
					</div><!-- .header-wrapper -->
				</div><!-- .col -->
			</div><!-- .row -->
		</div><!-- .wrapper -->

		<?php gyaan_page_navigation(); ?>