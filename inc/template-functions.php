<?php
/**
* Template specific functions
* ---------------------------
* @package gyaan
* @since 1.0.0
*/

if( ! function_exists( 'gyaan_header_bg' ) ) {
	function gyaan_header_bg() {
		$header_img_src = get_header_image();
		if( $header_img_src ) {
			$img_height = get_custom_header()->height . 'px';
			echo "style='background-image: url({$header_img_src}); height: {$img_height};'";
		} else {
			echo "style='background-image: url(" . get_parent_theme_file_uri( '/img/gyaan_header_img.png' ) . ");'";
		}
	}
}

if( ! function_exists( 'gyaan_site_info' ) ) {
	function gyaan_site_info() { ?>
		<div class="site-info d-flex flex-column justify-content-center">
			<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</div>
	<?php
	}
}

if( ! function_exists( 'gyaan_entry_meta' ) ) {
	function gyaan_entry_meta( $pos = 'primary' ) {
		$categories = get_the_category();
		$category_content = '';
		if( ! empty( $categories ) ) {
			foreach( $categories as $category ) {
				$category_content .= sprintf( '<a href="%2$s" class="btn btn-outline-primary btn-sm">%1$s</a>', esc_html( $category->name ), esc_url( get_category_link( $category->term_id ) )  );
			}
		}
		$entry_meta = sprintf( '<p class="meta-primary">%1$s</p>', $category_content );
		if( $pos === 'secondary' ) {
			$posted_on = human_time_diff( get_the_time( 'U' ) ) . ' ago' ;
			$entry_meta = sprintf( '<p class="meta-secondary">Posted by <span class="posted-by">%1$s</span><span class="posted-on">%2$s</span></p>', get_the_author(), $posted_on );
		}
		echo $entry_meta;
	}
}

if( ! function_exists( 'gyaan_entry_footer' ) ) {
	function gyaan_entry_footer() {
		echo "tags";
	}
}