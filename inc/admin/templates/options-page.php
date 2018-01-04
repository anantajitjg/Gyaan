<div class="wrap">
	<h1><?php esc_html_e( get_admin_page_title() ); ?></h1>
	<?php settings_errors(); ?>
	<form method="POST" action="options.php">
		<?php
			settings_fields( 'gyaan-general-group' );
			do_settings_sections( 'gyaan_options' );
			submit_button();
		?>
	</form>
</div>