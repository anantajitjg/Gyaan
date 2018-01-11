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
		$entry_meta = '<p class="meta-primary">' . $category_content . '</p>';
		if( $pos === 'secondary' ) {
			$meta_secondary = sprintf( '<a href="%2$s" class="posted-by"><span class="oi oi-person"></span> %1$s</a><span class="posted-on">%3$s</span>', get_the_author(), get_author_posts_url( get_the_author_meta( 'ID' ) ), get_the_date() );
			$comments_count = get_comments_number();
			if( comments_open() && $comments_count ) {
				$comments_str = sprintf( __( '%1$s Comments', 'gyaan' ), $comments_count );
				if( $comments_count == 1 ) {
					$comments_str = __( "1 Comment", 'gyaan' );
				}
				$meta_secondary .= sprintf( '<a href="%2$s" class="post-comments"><span class="oi oi-comment-square"></span> %1$s</a>', $comments_str, get_comments_link() );
			}
			$entry_meta = '<p class="meta-secondary">' . $meta_secondary . '</p>';
		}
		echo $entry_meta;
	}
}

if( ! function_exists( 'gyaan_entry_footer' ) ) {
	function gyaan_entry_footer() {
		$tag_list = get_the_tag_list( sprintf( '<div class="tag-list"><span class="oi oi-tags"></span> <strong>%1$s</strong> ', __( 'Tags:', 'gyaan' ) ), ' ', '</div>' );
		echo '<div class="post-footer-wrapper">' . $tag_list . '</div>';
	}
}