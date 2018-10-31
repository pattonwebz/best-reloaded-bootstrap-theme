<?php
/**
 * The comments.php file.
 *
 * Template for comments and pingbacks
 *
 * @package Best_Reloaded
 * @since Best Reloaded v0.1
 */

?>
	<div id="comments">
	<?php
	if ( post_password_required() ) {
		/*
		 * Output a password protected message, close the div and return early.
		 */
		?>
		<p class="nopassword hero-p"><?php esc_html_e( 'This post is password protected.', 'best-reloaded' ); ?><br/><?php esc_html_e( 'Please enter the password to view any comments.', 'best-reloaded' ); ?></p>
	</div><!-- #comments -->
	<hr class="hr-row-divider">
	<?php
	return;
	}

	if ( have_comments() ) {
		?>
		<h3 id="comments-title">
			<?php
				printf( // translators: 1 is a total number of comments.
					esc_html(
						_n( '%1$s Response to &ldquo;%2$s&rdquo;', '%1$s Responses to &ldquo;%2$s&rdquo;', get_comments_number(), 'best-reloaded' )
					),
					absint( number_format_i18n( get_comments_number() ) ),
					'<span>' . get_the_title() . '</span>'
				);
			?>
		</h3>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="clearfix">
			<h3 class="sr-only"><?php esc_html_e( 'comment navigation', 'best-reloaded' ); ?></h3>
			<div class="nav-previous pull-left"><?php previous_comments_link( '<i class="fa fa-arrow-left"></i> ' . esc_html__( 'older comments', 'best-reloaded' ) ); ?></div>
			<div class="nav-next pull-right"><?php next_comments_link( esc_html__( 'newer comments', 'best-reloaded' ) . ' <i class="fa fa-arrow-right"></i>' ); ?></div>
		</nav>
		<?php } // Check for comment navigation. ?>

		<ol class="commentlist">
			<?php

				/*
				 * Loop through and list the comments. Tell wp_list_comments()
				 * to use best_reloaded_respond_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define best_reloaded_respond_comment() and that will be used instead.
				 * See best_reloaded_respond_comment() in comments-and-pingpacks.php for more.
				 */
				wp_list_comments(
					array(
						'callback' => 'best_reloaded_respond_comment',
					)
				);
			?>
		</ol>

		<?php
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { // Are there comments to navigate through?
			?>
			<nav id="comment-nav-below" class="clearfix">
				<h3 class="sr-only"><?php esc_html_e( 'comment navigation', 'best-reloaded' ); ?></h3>
				<div class="nav-previous pull-left"><?php previous_comments_link( '<i class="fa fa-arrow-left" aria-hidden="true"></i> ' . esc_html__( 'older comments', 'best-reloaded' ) ); ?></div>
				<div class="nav-next pull-right"><?php next_comments_link( esc_html__( 'newer comments', 'best-reloaded' ) . ' <i class="fa fa-arrow-right" aria-hidden="true"></i>' ); ?></div>
			</nav>
			<?php
		}

		/*
		 * If there are no comments and comments are closed, let's leave a little note, shall we?
		 * But we don't want the note on pages or post types that do not support comments.
		 */
	} elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) {
	?>
		<p class="nocomments hero-p"><?php esc_html_e( 'Comments are closed.', 'best-reloaded' ); ?></p>
	<?php
	}
	?>
	<div class="comment-fields">
		<?php
		$commenter = wp_get_current_commenter();
		$req       = get_option( 'require_name_email' );
		$aria_req  = ( $req ? " aria-required='true'" : '' );
		$consent   = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
		comment_form(
			array(
				'comment_field'       =>
					'<div class="comment-form-comment form-group row">' .
						'<label for="comment" class="col-12">' . esc_html__( 'Enter Your Comment', 'best-reloaded' ) . '</label>' .
						'<textarea id="comment" name="comment" class="form-control col-12" rows="5" aria-required="true"></textarea>' .
					'</div>',
				'label_submit'        => esc_html__( 'Leave Comment', 'best-reloaded' ),
				'comment_notes_after' => '',
				'fields'              => array(
					'author'  =>
						'<div class="comment-form-author form-group row"><label for="author" class="col-2">' . __( 'Name', 'best-reloaded' ) . ' ' . ( $req ? '<span class="required">*</span>' : '' ) . '</label>' .
						'<input id="author" name="author" type="text" class="form-control col-10" value="' . esc_attr( $commenter['comment_author'] ) .
						'" size="30"' . $aria_req . ' /></div>',

					'email'   =>
						'<div class="comment-form-email form-group row"><label for="email" class="col-2">' . __( 'Email', 'best-reloaded' ) . ' ' . ( $req ? '<span class="required">*</span>' : '' ) . '</label>' .
						'<input id="email" name="email" type="email" class="form-control col-10" value="' . esc_attr( $commenter['comment_author_email'] ) .
						'" size="30"' . $aria_req . ' /></div>',

					'url'     =>
						'<div class="comment-form-url form-group row"><label for="url" class="col-2">' . __( 'Website', 'best-reloaded' ) . '</label>' .
						'<input id="url" name="url" type="text" class="form-control col-10" value="' . esc_attr( $commenter['comment_author_url'] ) .
						'" size="30" /></div>',
					'cookies' => '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' .
						'<label for="wp-comment-cookies-consent">' . esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'best-reloaded' ) . '</label></p>',
				),
				'class_submit'        => 'submit btn btn-lg btn-theme',
			)
		);
		?>
	</div>
</div><!-- #comments -->
