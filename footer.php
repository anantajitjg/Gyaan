<?php
/**
* Footer template file
* --------------------
* @package gyaan
* @since 1.0.0
*/
?>
		<div class="footer-wrapper">
			<footer class="site-footer">
				<?php
					$wp_link = sprintf( '<a href="%2$s">%1$s</a>', esc_html__( 'WordPress', 'gyaan' ), esc_url( 'https://wordpress.org/' ) );
				?>
				<div class="theme-footer">
					<span class="footer-text"><strong><?php esc_html_e( 'Gyaan', 'gyaan' ); ?></strong></span>
					<span class="footer-text"><?php printf( esc_html__( 'Proudly powered by %s', 'gyaan' ), $wp_link ); ?></span>
					<?php
						if ( function_exists( 'the_privacy_policy_link' ) ) {
							the_privacy_policy_link( '<span class="footer-text">', '</span>' );
						}
					?>
				</div>
			</footer>
		</div><!-- .footer-wrapper -->
	</div><!-- .main-wrapper -->

	<div class="back-to-top">
		<a href="#top" title="Go to top"><span class="oi oi-arrow-top"></span></a>
	</div><!--. back-to-top -->

	<?php wp_footer(); ?>
</body>
</html>