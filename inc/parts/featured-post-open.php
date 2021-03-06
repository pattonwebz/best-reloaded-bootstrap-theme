<?php
/**
 * The featured-post-open.php file.
 *
 * Displays post opening feature/ad
 *
 * @package Best_Reloaded
 * @since Best Reloaded v0.10
 */

?>
<div id="featured-bar-postopen" class="content-column-widgets">
	<?php
	if ( get_post_meta( $post->ID, 'ofo', true ) === 'true' ) {
		if ( get_post_meta( $post->ID, 'ofo-text', true ) ) {
			echo do_shortcode( wp_kses_post( get_post_meta( $post->ID, 'ofo-text', true ) ) );
		}
	} else {
		if ( is_active_sidebar( 'before-post-widgets' ) ) {
			dynamic_sidebar( 'before-post-widgets' );
		}
	}
	?>
</div>
