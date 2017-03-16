<?php
 /**
  * functions.php
  * Main theme functions file
  *
  * @package WordPress
  * @subpackage Best_Reloaded
  * @since Best Reloaded 0.1
  */

// Set the content width
if ( ! isset( $content_width ) ) $content_width = 730;

// Contains all functions essential to setting the theme
require( trailingslashit( get_template_directory() ) . 'inc/theme-setup.php' );
// Sets up comments and pingbacks for the theme
require( trailingslashit( get_template_directory() ) . 'inc/comments-and-pingbacks.php' );
// Registers all dynamic sidebar areas for the theme
require( trailingslashit( get_template_directory() ) . 'inc/register-sidebars.php' );
// Register Custom Navigation Walker - only if the class hasn't been loaded already
if (!class_exists('wp_bootstrap_navwalker', false)) {
	require( trailingslashit( get_template_directory() ) . 'inc/wp_bootstrap_navwalker.php' );
}
// Adds customizer controls, settings and sanitization functions
require( trailingslashit( get_template_directory() ) . 'inc/customizer.php' );

// Move the Jetpack social share buttons to the beginning of the post
function pwwp_jptweak_remove_share() {
	remove_filter( 'the_content', 'sharing_display',19 );
	remove_filter( 'the_excerpt', 'sharing_display',19 );
	remove_filter( 'the_content', array( 'Jetpack_Likes', 'post_likes' ), 30, 1 );
}

add_action( 'loop_end', 'pwwp_jptweak_remove_share' );

// Add classnames to the tags for bootstrap markup
function pwwp_add_class_the_tags($html){
    $postid = get_the_ID();
    $html = str_replace('<a','<a class="label label-default"',$html);
    return $html;
}
add_filter('the_tags','pwwp_add_class_the_tags',10,1);

// Remove inline styles that WordPress adds alongside the default Recent Comments widget
// Fix from here: https://core.trac.wordpress.org/changeset/16522
// Details here: https://core.trac.wordpress.org/ticket/11928
function pwwp_remove_recent_comments_style() {
    global $wp_widget_factory;
    remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
    add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'pwwp_remove_recent_comments_style' );

//Filter to add some bootstrap specific classes to gravity forms if installed
function add_bootstrap_container_class( $field_container, $field, $form, $css_class, $style, $field_content ) {
	$id = $field->id;
	$field_id = is_admin() || empty( $form ) ? "field_{$id}" : 'field_' . $form['id'] . "_$id";
	return '<li id="' . $field_id . '" class="' . $css_class . ' form-group">{FIELD_CONTENT}</li>';
}
add_filter( 'gform_field_container', 'add_bootstrap_container_class', 10, 6 );
