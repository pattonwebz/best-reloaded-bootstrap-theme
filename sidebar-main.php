<?php
/**
 * The sidebar-main.php file
 *
 * Displays the global sidebar that appears on posts and
 * pages throughout the theme
 *
 * @package Best_Reloaded
 * @since Best Reloaded v0.1
 */

?>
<div class="col-md-4 widget-area sidebar" role="complementary">
	<?php
	if ( is_active_sidebar( 'main-sidebar' ) ) {
		dynamic_sidebar( 'main-sidebar' );
	} else {
		the_widget( 'WP_Widget_Recent_Posts' );
		the_widget( 'WP_Widget_Recent_Comments' );
	}
	?>
</div><!-- end .col-md-4 .widget-area .sidebar -->
