<?php
/**
* Comments template file
* ----------------------
* @package gyaan
* @since 1.0.0
*/

if ( post_password_required() ) {
	return;
}
?>

<div class="col col-md-10 mx-auto">
	<div id="comments" class="comments-area py-3 mt-1 mb-3">
		<?php
			if( have_comments() ) : ?>
				<h5 class="comments-title text-secondary">
					<?php
						$comments_number = get_comments_number();
						printf( esc_html( _nx(
							'One Comment',
							'%1$s Comments',
							$comments_number,
							'comments title',
							'gyaan'
						) ),
							number_format_i18n( $comments_number ),
							get_the_title()
						);
					?>
				</h5><hr class="border-bottom border-primary" />
				<div class="comment-list pt-4 px-4">
					<?php
						wp_list_comments( array(
							'walker' => new Bootstrap_Walker_Comment(),
							'avatar_size' => 48,
							'style' => 'div'
						) );
					?>
				</div>
		<?php
				gyaan_pagination( 'comments', false );
			endif;

			if( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
				<div class="no-comments alert alert-outline-info" role="alert">
					<?php esc_html_e( 'Comments are closed.', 'gyaan' ); ?>
				</div>
		<?php
			endif;

			// comment form
			$commenter = wp_get_current_commenter();
			$req = get_option( 'require_name_email' );
			$req_attr = $req ? ' aria-required="true" required' : '';
			$req_label = $req ? '<span class="required">*</span>' : '';
			$user = wp_get_current_user();
			$user_identity = $user->exists() ? $user->display_name : '';

			$fields = array(
				'author' => 
					'<div class="form-group comment-form-author"><label for="author">' . __( 'Name', 'gyaan' ) . $req_label . '</label>' . '<input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="' . __( 'Your name', 'gyaan' ) . '"' . $req_attr . ' />' . ( $req ? '<div class="invalid-feedback">' . __( 'Please provide your name', 'gyaan' ) . '</div>' : '' ) . '</div>',

				'email' =>
				'<div class="form-group comment-form-email"><label for="email">' . __( 'Email', 'gyaan' ) . $req_label . '</label>' . '<input id="email" class="form-control" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" placeholder="' . __( 'Enter email', 'gyaan' ) . '"' . $req_attr . ' /><div class="invalid-feedback">' . __( 'Please provide a valid email', 'gyaan' ) . '</div></div>',

				'url' =>
				'<div class="form-group comment-form-url mb-4 pb-1"><label for="url">' . __( 'Website', 'gyaan' ) . '</label>' . '<input id="url" class="form-control" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="' . __( 'Website address', 'gyaan' ) . '" /><div class="invalid-feedback">' . __( 'Please provide a valid URL', 'gyaan' ) . '</div></div>'
			);
			$args = array(
				'class_form' => 'comment-form needs-validation',
				'class_submit' => 'btn btn-secondary submit',
				'comment_field' =>  '<div class="form-group comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . $req_label . '</label><textarea id="comment" class="form-control" name="comment" cols="45" rows="3" aria-required="true" required></textarea><div class="invalid-feedback">' . __( 'Please type a comment', 'gyaan' ) . '</div></div>',

				'logged_in_as' => '<div class="logged-in-as py-4">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" class="btn btn-primary btn-sm" title="Log out of this account"><span class="oi oi-account-logout"></span> Logout</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</div>',

				'cancel_reply_link' => '<span class="badge badge-danger">' . __( 'Cancel' ) . '</span>',
				'fields' => apply_filters( 'comment_form_default_fields', $fields )
			);
			echo '<div class="col-sm-10 col-lg-8 mx-auto"><div class="comment-form-wrapper">';
				comment_form( $args );
			echo '</div></div>';
		?>
	</div><!-- #comments -->
</div><!-- .col-* -->