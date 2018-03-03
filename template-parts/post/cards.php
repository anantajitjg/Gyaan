<?php
/**
* Cards template file
* -------------------
* @package gyaan
* @since 1.0.0
*/
?>

<div class="post-cards-container" <?php echo get_gyaan_cards_data_attrs(); ?>>
	<?php while( have_posts() ) : the_post(); ?>
		<div class="card-wrapper col col-md-6 col-xl-4">
			<?php get_template_part( 'template-parts/post/card-content/card-content', get_post_format() ); ?>
		</div>
	<?php endwhile; ?>
</div><!-- .post-cards-container -->

<?php
gyaan_cards_load_status();
gyaan_pagination();