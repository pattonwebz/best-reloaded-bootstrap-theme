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
require trailingslashit( get_template_directory() ) . 'inc/theme-setup.php';
// Sets up comments and pingbacks for the theme.
require trailingslashit( get_template_directory() ) . 'inc/comments-and-pingbacks.php';
// Registers all dynamic sidebar areas for the theme.
require trailingslashit( get_template_directory() ) . 'inc/register-sidebars.php';
// Register Custom Navigation Walker.
require trailingslashit( get_template_directory() ) . 'inc/class-wp-bootstrap-navwalker.php';
// Adds customizer controls, settings and sanitization functions.
require trailingslashit( get_template_directory() ) . 'inc/customizer/class-best-reloaded-customize.php';
// Some custom functions used throughout the theme.
require trailingslashit( get_template_directory() ) . 'inc/custom-functions.php';
// Contains the action hooks and filters for the theme.
require trailingslashit( get_template_directory() ) . 'inc/action-hooks.php';
// Hooks theme features to actions.
require trailingslashit( get_template_directory() ) . 'inc/actions-and-filters.php';
