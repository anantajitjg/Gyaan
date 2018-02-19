<?php
/**
* Sidebar template file
* ---------------------
* @package gyaan
* @since 1.0.0
*/

if( ! is_active_sidebar( 'sidebar-gyaan' ) ) {
	return;
}
?>

<div id="gyaan-sidebar-wrapper" class="sidebar-hidden">
	<div id="gyaan-sidebar">
		
		<button class="btn btn-secondary btn-sm sidebar-toggle-btn" type="button" aria-expanded="false" aria-label="Toggle Sidebar">
		<?php esc_html_e( 'Sidebar', 'gyaan' ); ?> <span class="oi oi-menu"></span>
		</button><!-- .sidebar-toggle-btn -->

		<button type="button" class="close sidebar-close-btn px-2" aria-label="Close Sidebar">
			<span aria-hidden="true">&times;</span>
		</button><!-- .sidebar-close-btn -->

		<aside id="secondary" class="widget-area" role="complementary" aria-label="<?php esc_attr_e( 'Gyaan: Sidebar', 'gyaan' ); ?>">
			<?php dynamic_sidebar( 'sidebar-gyaan' ); ?>
		</aside><!-- .widget-area -->

	</div><!-- #gyaan-sidebar -->
</div><!-- .gyaan-sidebar-wrapper -->

<div class="screen-overlay sidebar-overlay"></div>
