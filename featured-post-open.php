<?php
/**
 * featured-post-open.php
 * Displays post opening feature/ad
 *
 * @package WordPress
 * @subpackage Best_Reloaded
 * @since Best Reloaded 0.0
 */
?>
<div id="post-open" class="content-column-widgets">
    <?php if( get_post_meta($post->ID, 'ofo', true) == 'true' ) {
		if( get_post_meta($post->ID, 'ofo-text', true) ) {
			echo do_shortcode(get_post_meta($post->ID, 'ofo-text', true));
		}
	} else {
		if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-9') ) :
		endif;
	} ?>
</div>
