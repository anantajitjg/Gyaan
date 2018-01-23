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
		<div class="site-info pb-5 pl-5 d-flex flex-column justify-content-center">
			<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</div>
	<?php
	}
}

if( ! function_exists( 'gyaan_entry_meta' ) ) {
	function gyaan_entry_meta( $pos = 'primary', $attrs = array( 'btn_outline_style' => 'primary' ) ) {
		$categories = get_the_category();
		$category_content = '';
		if( ! empty( $categories ) ) {
			foreach( $categories as $category ) {
				$category_content .= sprintf( '<a href="%2$s" class="btn btn-outline-%3$s btn-sm">%1$s</a>', esc_html( $category->name ), esc_url( get_category_link( $category->term_id ) ), esc_attr( $attrs['btn_outline_style'] ) );
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
		$tags = get_the_tags();
		$tag_list = '';
		if( ! empty( $tags ) ) {
			$tag_list .= sprintf( '<div class="tag-list"><span class="oi oi-tags"></span> <strong>%1$s</strong> ', __( 'Tags:', 'gyaan' ) );
			foreach( $tags as $tag ) {
				$tag_list .= sprintf( '<a href="%2$s" class="badge badge-primary">%1$s</a>', esc_html( $tag->name ), esc_url( get_tag_link( $tag->term_id ) ) );
			}
			$tag_list .= '</div>';
		}
		echo '<div class="post-footer-wrapper">' . $tag_list . '</div>';
	}
}

if( ! function_exists( 'gyaan_featured_image' ) ) {
	function gyaan_featured_image( $size = 'full', $attr = array( 'class' => 'img-fluid post-thumbnail' ) ) {
		if( get_the_post_thumbnail() !== '' ) {
			the_post_thumbnail( $size, $attr );
		} else {
			$attached_images = get_attached_media( 'image' );
			if( ! empty( $attached_images ) ) {
				$attached_image_id = 0;
				foreach( $attached_images as $attached_image ) {
					$attached_image_id = $attached_image->ID;
				}
				echo wp_get_attachment_image( $attached_image_id, $size, false, $attr );
			}
		}
	}
}

if( ! function_exists( 'gyaan_featured_bg_image' ) ) {
	function gyaan_featured_bg_image( $template_part = 'content' , $size = 'content_featured_image', $class = 'bg-image post-thumbnail rounded-top' ) {
		$featured_img_url = get_the_post_thumbnail_url( get_the_ID(), $size );
		if( $featured_img_url ) {
			$featured_bg_image = sprintf( '<div class="%2$s" style="background-image: url(%1$s);"></div>', esc_url( $featured_img_url ), esc_attr( $class ) );
			if( $template_part === 'card-content' ) {
				$featured_bg_image = sprintf( '<a href="%2$s" class="card-img-link">%1$s<div class="card-img-overlay"></div></a>', $featured_bg_image, esc_url( get_permalink() ) );
			}
			echo $featured_bg_image;
		}
	}
}

if( ! function_exists( 'gyaan_embedded_media' ) ) {
	function gyaan_embedded_media( $types = array() ) {
		$media = false;
		$content = apply_filters( 'the_content', get_the_content() );
		if( strpos( $content, 'wp-playlist-script' ) === false ) {
			$media_array = get_media_embedded_in_content( $content, $types );
			if( ! empty( $media_array ) ) {
				$media = $media_array[0];
			}
		}
		return $media;
	}
}