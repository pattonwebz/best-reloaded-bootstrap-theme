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
<div id="featured-bar-postclose" class="content-column-widgets">
	<?php
	if ( is_active_sidebar( 'after-post-widgets' ) ) {
		dynamic_sidebar( 'after-post-widgets' );
	}
	?>
</div>
