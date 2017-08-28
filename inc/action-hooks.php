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
	 * Used to output whatever featured content is desired in the opening bar.
	 */
	do_action( 'best_reloaded_do_navbar_brand' );
}

/**
 * Fires after outputting the_title() on various pages.
 *
 * @since 1.2.2
 *
 * @param  boolean $echo flag for echo or return.
 * @param  boolean $type a type setting for the meta we want. Can be blank.
 */
function best_reloaded_do_post_meta( $echo = true, $type = false ) {
	/**
	 * Used to output whatever after post meta items you want
	 */
	do_action( 'best_reloaded_do_post_meta', $echo, $type );
}

/**
 * Fires during the main row div before content layout is decided.
 *
 * @since 1.3.0
 *
 * @param string $classname_string  a string containing any classnames
 *                                  to output for layout reasons.
 */
function best_reloaded_do_layout_selection( $classname_string = 'row' ) {
	/**
	 * Used to output classnames at the layout select div.
	 */
	do_action( 'best_reloaded_do_layout_selection', $classname_string );
}

/**
 * Fires during nabar output.
 *
 * @param  string $classnames any classnames wanting to pass to the navbar.
 */
function best_reloaded_do_navbar_classes( $classnames = '' ) {
	/**
	 * Used to output the classnames based on option selection.
	 *
	 * @var string of classnames
	 */
	do_action( 'best_reloaded_do_navbar_classes', $classnames );
}

/**
 * Fires before the main content container.
 */
function best_reloaded_do_before_main_content_row() {
	/**
	 * Can be used to output an additional row above the main content row.
	 */
	do_action( 'best_reloaded_do_before_content_row' );
}
