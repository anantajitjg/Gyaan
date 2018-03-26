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
	function gyaan_site_info() {
		$name = get_bloginfo( 'name' );
		$description = get_bloginfo( 'description' );
	?>
		<div class="site-info pb-5 pl-5 d-flex flex-column justify-content-center">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php printf( esc_html__( '%1$s Home', 'gyaan' ), $name ); ?>"><?php echo $name; ?></a></h1>
			<h2 class="site-description"><?php echo $description; ?></h2>
		</div>
	<?php
	}
}

if( ! function_exists( 'gyaan_post_class' ) ) {
	function gyaan_post_class( $class = '', $template_part = 'card-content' ) {
		$default_classes = array();
		if( $template_part === 'card-content' ) {
			$default_classes[] = 'card';
		} else {
			$default_classes[] = 'main-article';
		}
		if( get_post_format() ) {
			$default_classes[] = 'gyaan-post-format-' . get_post_format();
		}
		$custom_classes = array();
		if( $class ) {
			if( is_array( $class ) ) {
				array_merge( $custom_classes, $class );
			} else {
				$custom_classes[] = $class;
			}
		}
		post_class( array_merge( $default_classes, $custom_classes ) );
	}
}

if( ! function_exists( 'get_gyaan_cards_data_attrs' ) ) {
	function get_gyaan_cards_data_attrs() {
		global $wp_query;
		$infinite_scroll = true;
		$max_pages = $wp_query->max_num_pages;
		$paged = $wp_query->get( 'paged' );
		$next_link = gyaan_pagination_next_link();
		$attrs = "data-max-pages='{$max_pages}' data-paged='{$paged}' data-next='{$next_link}'";
		return $infinite_scroll ? $attrs : '';
	}
}

if( ! function_exists( 'gyaan_entry_meta' ) ) {
	function gyaan_entry_meta( $pos = 'primary', $attrs = array( 'badge_class' => 'badge-pill badge-primary' ) ) {
		$categories = get_the_category();
		$category_content = '';
		if( ! empty( $categories ) ) {
			foreach( $categories as $category ) {
				$category_content .= sprintf( '<a href="%2$s" class="category-link badge %3$s">%1$s</a>', esc_html( $category->name ), esc_url( get_category_link( $category->term_id ) ), esc_attr( $attrs['badge_class'] ) );
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

if( ! function_exists( 'gyaan_post_gallery' ) ) {
	function gyaan_post_gallery( $gallery_arr, $template_part = 'content' ) {
		if( ! empty( $gallery_arr ) ) :
	?>
			<div id="carousel-<?php the_ID(); ?>" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner bg-secondary">
					<?php
						$ids = explode( ",", $gallery_arr['ids'] );
						if ( ! empty( $ids ) || $template_part === 'card-content' ) :
							$i = 0;
							foreach( $gallery_arr['src'] as $image_src ) :
					?>
								<div class="carousel-item<?php echo ( $i === 0 ) ? ' active' : ''; ?>" >
									<div class="w-100 bg-image" style="background-image: url(<?php echo esc_url( $image_src ); ?>);"></div>
									<?php
										$caption = wp_get_attachment_caption( $ids[$i] );
										if( $template_part === 'content' && $caption ) :
									?>
											<div class="carousel-caption">
												<?php echo $caption; ?>
											</div>
									<?php
										endif;
									?>
								</div><!-- .carousel-item -->
					<?php
								$i++;
							endforeach;
						endif;
					?>
				</div><!-- .carousel-inner -->
				<?php if( $template_part === 'content' ) : ?>
						<a class="carousel-control-prev" href="#carousel-<?php the_ID(); ?>" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carousel-<?php the_ID(); ?>" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
				<?php endif; ?>
			</div><!-- .carousel -->
	<?php
		endif;
	}
}

if( ! function_exists( 'gyaan_archive_title' ) ) {
	function gyaan_archive_title() {
		$titleBefore = '<h1 class="page-title">';
		$titleAfter = "</h1>";
		if( is_category() ) {
			echo $titleBefore . single_cat_title( '', false ) . $titleAfter;
		} else {
			the_archive_title( $titleBefore, $titleAfter );
		}
		the_archive_description( '<div class="taxonomy-description pl-4 pt-3">', '</div>' );
	}
}

if( ! function_exists( 'gyaan_page_navigation' ) ) {
	function gyaan_page_navigation() {
		if( is_paged() ) {
			echo '<nav class="page-navigation">';
			previous_posts_link( '<span class="prev-page-icon"><span class="oi oi-chevron-left"></span></span><span class="prev-page-label">' . esc_html__( 'Previous Page' ) . '</span>' );
			echo '</nav>';
		}
	}
}

if( ! function_exists( 'gyaan_pagination' ) ) {
	function gyaan_pagination( $location = 'posts', $pagination_class = 'pagination-lg' ) {
		$args = array(
			'type' => 'array',
			'prev_text' => __('Previous', 'gyaan'),
			'next_text' => __('Next', 'gyaan')
		);
		$links = array();
		if( $location === 'comments' ) {
			$args['echo'] = false;
			$links = paginate_comments_links( $args );
		} else {
			$links = paginate_links( $args );
		}
		if( ! empty( $links ) ) {
			$pagination_class = $pagination_class ? ' ' . $pagination_class : '';
			$pagination_class .= ' ' . $location . '-' . 'pagination';
			echo '<nav class="pagination-wrapper pt-4"><ul class="pagination justify-content-center' . $pagination_class . '">';
			foreach( $links as $link ) {
				$class = ( strpos( $link, 'current' ) !== false || strpos( $link, 'dots' ) !== false ) ? ' disabled' : '';
				$link = str_replace( 'page-numbers', 'page-link', $link );
				echo "<li class='page-item{$class}'>{$link}</li>";
			}
			echo '</ul></nav>';
		}
	}
}

if( ! function_exists( 'gyaan_post_navigation' ) ) {
	function gyaan_post_navigation() {
		$previous = get_previous_post_link( '<div class="nav-previous">%link</div>', '<span class="badge badge-dark"><span class="oi oi-chevron-left"></span></span><span class="nav-title">%title</span>' );
		$next = get_next_post_link( '<div class="nav-next text-right">%link</div>', '<span class="nav-title">%title</span><span class="badge badge-dark"><span class="oi oi-chevron-right"></span></span>' );
		if( $previous || $next ) {
			echo '<nav class="container-fluid post-navigation"><h2 class="screen-reader-text">' . esc_html__( 'Post navigation' ) . '</h2><div class="row nav-links py-4"><div class="col-12 col-sm-6">' . $previous . '</div><div class="col-12 col-sm-6">' . $next . '</div></div></nav>';
		}
	}
}

if( ! function_exists( 'gyaan_link_pages' ) ) {
	function gyaan_link_pages() {
		$args = array(
			'before' => '<div class="link-pages pt-2"><span class="page-links-text text-secondary font-weight-bold mr-2">' . __( 'Pages:', 'gyaan' ) . '</span>',
			'after' => '</div>',
			'link_before' => '<span class="page-number">',
			'link_after' => '</span>'
		);
		wp_link_pages( $args );
	}
}

if( ! function_exists( 'gyaan_pre_loader' ) ) {
	function gyaan_pre_loader( $loader, $class = array() ) {
		$loader_class = '';
		$html = '';
		switch( $loader ) {
			case 'grid':
				$class[] = 'grid-loader';
				$html = '<i></i><i></i><i></i><i></i><i></i>';
				break;
		}
		$loader_class = implode( ' ', $class );
		echo "<div class='{$loader_class}'>{$html}</div>";
	}
}

if( ! function_exists( 'gyaan_cards_load_status' ) ) {
	function gyaan_cards_load_status() {
		$msg = '<div class="alert alert-light mx-auto text-center">' . esc_html__( 'There are no more posts to show.', 'gyaan' ) . '</div>';
?>
		<div class="page-load-status">
			<?php gyaan_pre_loader( 'grid', array( 'infinite-scroll-request' ) ); ?>
			<div class="infinite-scroll-last pt-3 mt-1"><?php echo $msg; ?></div>
			<div class="infinite-scroll-error pt-3 mt-1"><?php echo $msg; ?></div>
		</div><!-- .page-load-status -->
<?php
	}
}