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
