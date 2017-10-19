<?php
/**
 * The action-hooks.php file.
 *
 * Sets up any action hooks used in the theme
 *
 * @package Best_Reloaded
 * @since Best Reloaded v1
 */

/**
 * Fires the featurebar action hook.
 *
 * @since 1.0.0
 */
function best_reloaded_do_featurebar() {
	/**
	 * Used to output whatever featured content is desired in the opening bar.
	 */
	do_action( 'best_reloaded_do_featurebar' );
}

/**
 * Fires the navbar-brand action hook.
 *
 * @since 1.2.0
 */
function best_reloaded_do_navbar_brand() {
	/**
	 * Used to output some content to the brand portion of the navbar.
	 */
	do_action( 'best_reloaded_do_navbar_brand' );
}

/**
 * Fires the action used to handle various post meta scenarios.
 *
 * @since 1.4.3
 */
function best_reloaded_do_post_meta( $type = 'full', $echo = true ) {
	/**
	 * Used to output different post meta blocks for the theme.
	 */
	do_action( 'best_reloaded_do_post_meta' );
}
