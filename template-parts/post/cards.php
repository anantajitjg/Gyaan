<?php
/**
* Cards template file
* -------------------
* @package gyaan
* @since 1.0.0
*/
?>

<div class="card-wrapper col col-md-6 col-xl-4">
	<?php get_template_part( 'template-parts/post/card-content/card-content', get_post_format() ); ?>
</div>