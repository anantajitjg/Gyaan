<?php
/**
 * Bootstrap_Walker_Comment class
 * Description: Custom Walker class for Comments for Bootstrap
 * @package gyaan
 * @since 1.0.0
 */

class Bootstrap_Walker_Comment extends Walker_Comment {
	/**
	 * Starts the list before the elements are added.
	 *
	 * @since 2.7.0
	 *
	 * @see Walker::start_lvl()
	 * @global int $comment_depth
	 *
	 * @param string $output Used to append additional content (passed by reference).
	 * @param int    $depth  Optional. Depth of the current comment. Default 0.
	 * @param array  $args   Optional. Uses 'style' argument for type of HTML list. Default empty array.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$GLOBALS['comment_depth'] = $depth + 1;

		switch ( $args['style'] ) {
			case 'div':
				break;
			case 'ol':
				$output .= '<ol class="children list-unstyled pl-3 pl-sm-4 pl-md-5">' . "\n";
				break;
			case 'ul':
			default:
				$output .= '<ul class="children list-unstyled pl-3 pl-sm-4 pl-md-5">' . "\n";
				break;
		}
	}

	/**
	 * Outputs a single comment.
	 *
	 * @since 3.6.0
	 *
	 * @see wp_list_comments()
	 *
	 * @param WP_Comment $comment Comment to display.
	 * @param int        $depth   Depth of the current comment.
	 * @param array      $args    An array of arguments.
	 */
	protected function comment( $comment, $depth, $args ) {
		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
?>
		<<?php echo $tag; ?> <?php comment_class( array( $this->has_children ? 'parent' : '', $depth > 1 ? 'mt-3' : 'mb-4' ), $comment ); ?> id="comment-<?php comment_ID(); ?>">

		<div class="comment-container">
			<div class="comment-author-avatar">
				<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
			</div><!-- .comment-author-avatar -->

			
			<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">

				<div class="comment-meta-top">
					<?php
						printf( '<span class="comment-author"><b>%s</b></span>', get_comment_author_link( $comment ) );
					?>
					<a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>" class="comment-time"><span class="oi oi-clock"></span>
						<?php printf( esc_html__( ' %1$s ago', 'gyaan' ), human_time_diff( get_comment_time( 'U' ) ) ); ?>
					</a>
				</div><!-- .comment-meta-top -->

				<?php if ( '0' == $comment->comment_approved ) : ?>
					<div class="alert alert-outline-info comment-awaiting-moderation mt-2 mb-1 py-2 px-3"><?php _e( 'Your comment is awaiting moderation.', 'gyaan' ); ?></div>
				<?php endif; ?>

				<div class="comment-content mt-1">
					<?php comment_text( $comment, array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .comment-content -->

				<div class="comment-footer">
					<?php
						comment_reply_link( array_merge( $args, array(
							'add_below' => $add_below,
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
							'before'    => '<span class="reply">',
							'after'     => '</span>'
						) ) );
						edit_comment_link( __( 'Edit', 'gyaan' ), '<span class="edit-link">', '</span>' );
					?>
				</div>
			</div><!-- .comment-body -->
		</div><!-- .comment-container -->
<?php
	}

	/**
	 * Outputs a comment in the HTML5 format.
	 *
	 * @since 3.6.0
	 *
	 * @see wp_list_comments()
	 *
	 * @param WP_Comment $comment Comment to display.
	 * @param int        $depth   Depth of the current comment.
	 * @param array      $args    An array of arguments.
	 */
	protected function html5_comment( $comment, $depth, $args ) {
		global $post;
		$post_author = $post->post_author;
		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
?>
		<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( array( $this->has_children ? 'parent' : '', $depth > 1 ? 'mt-3' : 'mb-4' ), $comment ); ?>>

			<div class="comment-container">
				<div class="comment-author-avatar">
					<?php
						if ( 0 != $args['avatar_size'] ) {
							$avatar = get_avatar( $comment, $args['avatar_size'] );
							if( $avatar ) {
								echo $avatar;
							} else {
								echo '<span class="comment-user-icon"><span class="oi oi-person"></span></span>';
							}
						}
					?>
				</div><!-- .comment-author-avatar -->

				<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
					<header class="comment-meta-top">
						<?php
							printf( '<span class="comment-author"><strong>%1$s</strong></span><span class="post-author-badge badge badge-pill badge-secondary">%2$s</span>', get_comment_author_link( $comment ), ( $comment->user_id === $post_author ) ? esc_html__( 'author', 'gyaan' ) : '' );
						?>
						<a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>" class="comment-time">
							<span class="oi oi-clock"></span>
							<?php printf( esc_html__( ' %1$s ago', 'gyaan' ), human_time_diff( get_comment_time( 'U' ) ) ); ?>
						</a>
					</header><!-- .comment-meta-top -->

					<div class="comment-meta-bottom">
						<?php if ( '0' == $comment->comment_approved ) : ?>
							<div class="alert alert-outline-info comment-awaiting-moderation mt-2 mb-1 py-2 px-3"><small><?php _e( 'Your comment is awaiting moderation.', 'gyaan' ); ?></small></div>
						<?php endif; ?>
					</div><!-- .comment-meta-bottom -->

					<div class="comment-content mt-1">
						<?php comment_text(); ?>
					</div><!-- .comment-content -->

					<footer class="comment-footer">
						<?php
							comment_reply_link( array_merge( $args, array(
								'add_below' => 'div-comment',
								'depth'     => $depth,
								'max_depth' => $args['max_depth'],
								'before'    => '<span class="reply pr-2">',
								'after'     => '</span>'
							) ) );
							edit_comment_link( __( 'Edit', 'gyaan' ), '<span class="edit-link">', '</span>' );
						?>
					</footer><!-- .comment-footer -->
				</div><!-- .comment-body -->
			</div><!-- .comment-container -->
<?php
	}
}