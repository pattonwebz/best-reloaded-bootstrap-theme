<?php
/**
 * featured-post-open.php
 * Displays post opening feature/ad
 *
 * @subpackage Best_Reloaded
 * @since Best Reloaded 0.10
 */
?>
<div id="post-open" class="content-column-widgets">
    <?php
	if( get_post_meta($post->ID, 'ofo', true) == 'true' ) {
		if( get_post_meta($post->ID, 'ofo-text', true) ) {
			echo do_shortcode( wp_kses_post( get_post_meta( $post->ID, 'ofo-text', true ) ) );
		}
	} else {
		if ( dynamic_sidebar('sidebar-9') ) {
			dynamic_sidebar('sidebar-9');
		}
	} ?>
</div>
