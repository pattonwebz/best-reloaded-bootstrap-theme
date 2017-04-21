<?php
 /**
  * The main theme functions.php file.
  *
  * Contains all the main functions of the theme and includes files for
  * additional parts.
  *
  * @package Best_Reloaded
  * @since Best Reloaded v0.1
  */

// Contains all functions essential to setting the theme.
require( trailingslashit( get_template_directory() ) . 'inc/theme-setup.php' );
// Sets up comments and pingbacks for the theme.
require( trailingslashit( get_template_directory() ) . 'inc/comments-and-pingbacks.php' );
// Registers all dynamic sidebar areas for the theme.
require( trailingslashit( get_template_directory() ) . 'inc/register-sidebars.php' );
// Register Custom Navigation Walker - only if the class hasn't been loaded already.
if ( ! class_exists( 'wp_bootstrap_navwalker', false ) ) {
	require( trailingslashit( get_template_directory() ) . 'inc/wp_bootstrap_navwalker.php' );
}
// Adds customizer controls, settings and sanitization functions.
require( trailingslashit( get_template_directory() ) . 'inc/customizer.php' );

/**
 * Removes the filters that jetpack uses to add the share box to end of posts.
 */
function best_reloaded_jptweak_remove_share() {
	remove_filter( 'the_content', 'sharing_display',19 );
	remove_filter( 'the_excerpt', 'sharing_display',19 );
	remove_filter( 'the_content', array( 'Jetpack_Likes', 'post_likes' ), 30, 1 );
}

add_action( 'loop_end', 'best_reloaded_jptweak_remove_share' );

/**
 * Adds some classes to tags in the wordcloud.
 *
 * @param string $html html string to be modified and add the label class_exists.
 *
 * @return $html modified string with the label classnames.
 */
function best_reloaded_add_class_the_tags( $html ) {
	$postid = get_the_ID();
	$html = str_replace( '<a','<a class="label label-default"', $html );
	return $html;
}
add_filter( 'the_tags','best_reloaded_add_class_the_tags',10,1 );

/**
 * Removes some inline styles that WP adds alongside the Recent Comments Widget.
 *
 * @link Fix from here: https://core.trac.wordpress.org/changeset/16522
 * @link Details here: https://core.trac.wordpress.org/ticket/11928
 */
function best_reloaded_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'best_reloaded_remove_recent_comments_style' );

/**
 * Filter to add some bootstrap specific classes to gravity forms if installed.
 *
 * @param [type] $field_container [description].
 * @param [type] $field           [description].
 * @param [type] $form            [description].
 * @param [type] $css_class       [description].
 * @param [type] $style           [description].
 * @param [type] $field_content   [description].
 */
function best_reloaded_add_bootstrap_container_class_to_gf( $field_container, $field, $form, $css_class, $style, $field_content ) {
	$id = $field->id;
	$field_id = is_admin() || empty( $form ) ? "field_{$id}" : 'field_' . $form['id'] . "_$id";
	return '<li id="' . $field_id . '" class="' . $css_class . ' form-group">{FIELD_CONTENT}</li>';
}
add_filter( 'gform_field_container', 'best_reloaded_add_bootstrap_container_class_to_gf', 10, 6 );
