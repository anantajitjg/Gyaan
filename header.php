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
	<div class="main-wrapper">
		<div class="wrapper">
			<div class="row no-gutters">
				<div class="col">
					<div class="bg-image header-wrapper center-block" <?php gyaan_header_bg(); ?>>

						<?php gyaan_site_info(); ?>

						<nav class="navbar navbar-expand-lg navbar-dark" id="top-menu">
							<div class="container-fluid">

								<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
									<span class="navbar-toggler-icon"></span>
								</button>

								<div id="navbarContent" class="collapse navbar-collapse">
									<?php
										wp_nav_menu( array(
											'theme_location' => 'top',
											'walker' => new Bootstrap_Walker_Nav_Menu(),
											'container' => false,
											'fallback_cb' => false,
											'menu_class' => 'navbar-nav'
										) );
									?>
								</div>
								
							</div>
						</nav>
						<!-- End of top navigation menu -->
					</div>
					<!-- End of header -->
				</div>
				<!-- End of column -->
			</div>
			<!-- End of row -->
		</div>
		<!-- End of container -->
