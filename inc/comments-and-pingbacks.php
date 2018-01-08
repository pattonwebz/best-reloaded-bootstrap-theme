<?php
/**
 * The comments-and-pingbacks.php file.
 *
 * Template for Comments and Pingbacks
 *
 * @package Best_Reloaded
 * @since Best Reloaded v0.1
 */

if ( ! function_exists( 'best_reloaded_respond_comment' ) ) {

	/**
	 * Function for comment responses
	 *
	 * @param  object  $comment 	a WP_Comment object.
	 * @param  array   $args		an array of arguments to use.
	 * @param  integer $depth		a current depth value.
	 */
	function best_reloaded_respond_comment( $comment, $args, $depth ) {
		switch ( $comment->comment_type ) {
			case 'pingback' :
				// for pingbacks theres no reponses.
			case 'trackback' :
				// trackbacks can be responded to/edited.?>
				<li class="post pingback">
					<p><?php esc_html_e( 'Pingback:', 'best-reloaded' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__( 'Edit.', 'best-reloaded' ) . ' &#x270E;', ' </br><span class="edit-link">', '</span>' ); ?></p>
				<?php
				break;
			default :
				// in all other default cases we can assume normal comment.	?>
				<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
					<article id="comment-<?php comment_ID(); ?>" class="comment clearfix">
						<footer class="comment-meta">
							<div class="comment-author vcard clearfix">
								<?php
									$avatar_size = 48;

									echo get_avatar( $comment, $avatar_size );

									/* translators: 1: comment author, 2: date and time */
									printf( '%1$s %2$s',
										sprintf( '<span class="fn">%s</span><br/>', get_comment_author_link() ),
										sprintf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
											esc_url( get_comment_link( $comment->comment_ID ) ),
											get_comment_time( 'c' ),
											/* translators: 1: date, 2: time */
											sprintf( '%1$s at %2$s', get_comment_date(), get_comment_time() )
										)
									);
								?>
							</div><!-- .comment-author .vcard -->

							<?php if ( '0' === $comment->comment_approved ) : ?>
								<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'best-reloaded' ); ?></em>
								<br />
							<?php endif; ?>

						</footer>

						<div class="comment-content"><?php comment_text(); ?></div>

						<div class="edit-reply">
							<?php edit_comment_link( esc_html__( 'Edit.', 'best-reloaded' ) . ' &#x270E;', '<span class="edit-link">', '</span>' ); ?>
							<?php comment_reply_link( array_merge( $args, array(
								'reply_text' => esc_html__( 'Reply ', 'best-reloaded' ) . ' <span>&#x21A9;</span>',
								'depth' => $depth,
								'max_depth' => $args['max_depth'],
							) ) ); ?>
						</div><!-- .reply -->
					</article><!-- #comment-## -->

					<?php
					break;
			// no more cases to test for.
		} // End switch().
	}
} // End if().
