<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to twentytwelve_comment() which is
 * located in the functions.php file.
 *
 * @package Graphite_Theme
 * @since Graphite 1.0.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title"><?php _e( 'Comments', 'graphite' ); ?></h3>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'graphite_comment', 'style' => 'ol' ) ); ?>
		</ol><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation clearfix" role="navigation">
			<h1 class="sr-only"><?php _e( 'Comment navigation', 'graphite' ); ?></h1>
			<div class="nav-next pull-left"><?php next_comments_link( __( '&larr; Newer Comments', 'graphite' ) ); ?></div>
			<div class="nav-previous pull-right"><?php previous_comments_link( __( 'Older Comments &rarr;', 'graphite' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

		<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'graphite' ); ?></p>
		<?php endif; ?>
	<?php endif; // have_comments() ?>

	<?php
		$post_id = get_the_ID();
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$args = array(
			'fields' => apply_filters( 'comment_form_default_fields', array(
				'author' => '<div class="form-group comment-form-author">' .
				                '<label class="sr-only" for="author">'. __( 'Name', 'graphite' ) .'</label>' .
				                '<div class="input-group">' .
				                    '<span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>' .
				                    '<input class="form-control" id="author" name="author" type="text" placeholder="' . __( 'Name', 'graphite' ) . ( $req ? ' *' : '' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' />' .
				                '</div>' .
				            '</div>',
				'email'  => '<div class="form-group comment-form-email">' .
				                '<label class="sr-only" for="author">'. __( 'Email', 'graphite' ) .'</label>' .
				                '<div class="input-group">' .
				                    '<span class="input-group-addon"><i class="fa fa-fw fa-envelope"></i></span>' .
				                    '<input class="form-control" id="email" name="email" type="text" placeholder="' . __( 'Email', 'graphite' ) . ( $req ? ' *' : '' ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) . '"' . $aria_req . ' />' .
				                '</div>' .
				            '</div>',
				'url'    => '<div class="form-group comment-form-url">' .
				                '<label class="sr-only" for="author">'. __( 'Website', 'graphite' ) .'</label>' .
				                '<div class="input-group">' .
				                    '<span class="input-group-addon"><i class="fa fa-fw fa-globe"></i></span>' .
				                    '<input class="form-control" id="url" name="url" type="text" placeholder="' . __( 'Website', 'graphite' ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) . '" />' .
				                '</div>' .
				            '</div>'
			)),
			'comment_field'        => 	'<div class="form-group comment-form-comment">' .
			                                '<label class="sr-only" for="comment">'. __( 'Comment', 'graphite' ) .'</label>' .
			                                '<textarea id="comment" name="comment" class="form-control" rows="5" aria-required="true"></textarea>' .
			                            '</div>',
			'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'graphite' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
			'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%s">%s</a>. <a title="Log out of this account" href="%s">Log out?</a></p>', 'graphite' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ),
			'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email is <em>never</em> published nor shared.', 'graphite' ) . ' ' . ( $req ? __( 'Required fields are marked <sup class="required">*</sup>', 'graphite' ) : '' ) . '</p>',
			'comment_notes_after'  => '',
			'title_reply'          => __( 'Leave a Reply', 'graphite' ),
			'title_reply_to'       => __( 'Leave a Reply to %s', 'graphite' ),
			'cancel_reply_link'    => __( 'Cancel reply', 'graphite' ),
			'label_submit'         => __( 'Post Comment', 'graphite' )
		);
		comment_form( $args );
	?>
</div><!-- #comments .comments-area -->
