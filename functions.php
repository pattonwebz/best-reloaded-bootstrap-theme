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
require 'inc/theme-setup.php';
// Sets up comments and pingbacks for the theme
require 'inc/comments-and-pingbacks.php';
// Registers all dynamic sidebar areas for the theme
require 'inc/register-sidebars.php';
// Registers custom post types for the theme
require 'inc/custom-posts.php';
// Registers custom shortcodes for the theme
include 'inc/shortcodes.php';
// Register Custom Navigation Walker
require_once('wp_bootstrap_navwalker.php');

define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
require_once dirname( __FILE__ ) . '/inc/options-framework.php';

// Loads options.php from child or parent theme
$optionsfile = locate_template( 'options.php' );
load_template( $optionsfile );

// Move the Jetpack social share buttons to the beginning of the post, this is to allow for the float effect
function pwwp_jptweak_remove_share() {
remove_filter( 'the_content', 'sharing_display',19 );
remove_filter( 'the_excerpt', 'sharing_display',19 );
remove_filter( 'the_content', array( 'Jetpack_Likes', 'post_likes' ), 30, 1 );
}

add_action( 'loop_end', 'pwwp_jptweak_remove_share' );

//Add class to the tags for bootstrap markup
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
?>
