<?php
/**
* Template part - For displaying No posts found message
* -----------------------------------------------------
* @package gyaan
* @since 1.0.0
*/
?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title border-info"><?php _e( 'No posts found!', 'gyaan' ); ?></h1>
	</header>

	<hr class="my-4">

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
				<p class="text-secondary">
					<span class="d-inline-block pb-3"><?php esc_html_e( 'Ready to publish your first post?', 'gyaan' ); ?></span>
					<a href="<?php echo esc_url( admin_url( 'post-new.php' ) ); ?>" class="btn btn-sm btn-primary ml-1"><span class="oi oi-plus"></span> <?php esc_html_e( 'Add New' ); ?></a>
				</p>
		<?php else : ?>
				<p class="text-secondary mb-4"><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'gyaan' ); ?></p>
				<?php get_search_form(); ?>
		<?php endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->