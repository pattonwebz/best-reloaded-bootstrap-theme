<?php
/**
 * comments-and-pingbacks.php
 * Template for Comments and Pingbacks
 *
 * @package WordPress
 * @subpackage Best_Reloaded
 * @since Best Reloaded 0.1
 */

function best_reloaded_respond_comment( $comment, $args, $depth ) {
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
    ?>
    <li class="post pingback">
        <p><?php esc_html_e( 'Pingback:', 'best-reloaded' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__('Edit.', 'best-reloaded' ) . ' &#x270E;', ' </br><span class="edit-link">', '</span>' ); ?></p>
    <?php
            break;
        default :
    ?>
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

                <?php if ( $comment->comment_approved == '0' ) : ?>
                    <em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'best-reloaded' ); ?></em>
                    <br />
                <?php endif; ?>

            </footer>

            <div class="comment-content"><?php comment_text(); ?></div>

            <div class="edit-reply">
                <?php edit_comment_link( esc_html__('Edit.', 'best-reloaded' ) . ' &#x270E;', '<span class="edit-link">', '</span>' ); ?>
                <?php comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html_e( 'Reply', 'best-reloaded' ) .' <span>&#x21A9;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </div><!-- .reply -->
        </article><!-- #comment-## -->

    <?php
            break;
    endswitch;
}
