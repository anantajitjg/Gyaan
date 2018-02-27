<?php
/**
* Template for displaying search form
* -----------------------------------
* @package gyaan
* @since 1.0.0
*/
?>

<?php $id = esc_attr( uniqid( 'gyaan-search-field-' ) ); ?>

<form role="search" method="get" class="search-form gyaan-search-form form-inline needs-validation" action="<?php echo esc_url( home_url( '/' ) ); ?>" novalidate>
	<div class="input-group">
		<label class="screen-reader-text" for="<?php echo $id; ?>"><?php echo _x( 'Search for:', 'label' ); ?></label>
		<input type="search" id="<?php echo $id; ?>" class="search-field form-control" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder' ); ?>" value="<?php echo get_search_query(); ?>" name="s" required />
		<div class="input-group-append">
			<button type="submit" class="search-submit btn btn-primary"><span class="oi oi-magnifying-glass"></span></button>
		</div>
	</div>
</form>
