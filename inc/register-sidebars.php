<?php
/**
 * The register-sidebars.php file.
 *
 * Register sidebars and widgetized areas
 *
 * @package Best_Reloaded
 * @since Best Reloaded v0.1
 */

add_action( 'widgets_init', 'best_reloaded_widgets_init' );

/**
 * Function hooked to widgets_init to add our sidebars.
 */
function best_reloaded_widgets_init() {

	// Allow shortcodes to be used in text widgets.
	add_filter( 'widget_text', 'do_shortcode' );

	register_sidebar( array(
		'name'          => __( 'Main Sidebar', 'best-reloaded' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Widgets placed in this area will appear on all posts and pages with a sidebar.', 'best-reloaded' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside><hr class="hr-row-divider">',
		'before_title'  => '<h3 class="widget-title h4">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Homepage: Right of Slider', 'best-reloaded' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Widgets placed in this area will appear to the right of the homepage slider.', 'best-reloaded' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside><hr class="hr-row-divider">',
		'before_title'  => '<h3 class="widget-title h4">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Homepage: Widget Row', 'best-reloaded' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Widgets placed in this area will appear in the row beneath the slider. A maximum of 3 widgets can be used in this area.', 'best-reloaded' ),
		'before_widget' => '<div class="col-sm-4"><aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside><hr class="hr-row-divider"></div>',
		'before_title'  => '<h3 class="widget-title h4">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Homepage: Left of Blog', 'best-reloaded' ),
		'id'            => 'sidebar-4',
		'description'   => __( 'Widgets placed in this area will appear to the left of the blog on the homepage.', 'best-reloaded' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside><hr class="hr-row-divider">',
		'before_title'  => '<h3 class="widget-title h4">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer: First Column', 'best-reloaded' ),
		'id'            => 'sidebar-5',
		'description'   => __( 'Widgets placed in this area will appear in the far left column of the footer on all pages.', 'best-reloaded' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title h4">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer: Second Column', 'best-reloaded' ),
		'id'            => 'sidebar-6',
		'description'   => __( 'Widgets placed in this area will appear in the middle left column of the footer on all pages.', 'best-reloaded' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title h4">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer: Third Column', 'best-reloaded' ),
		'id'            => 'sidebar-7',
		'description'   => __( 'Widgets placed in this area will appear in the middle right column of the footer on all pages.', 'best-reloaded' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title h4">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer: Fourth Column', 'best-reloaded' ),
		'id'            => 'sidebar-8',
		'description'   => __( 'Widgets placed in this area will appear in the far right column of the footer on all pages.', 'best-reloaded' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title h4">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Post: Before Post', 'best-reloaded' ),
		'id'            => 'sidebar-9',
		'description'   => __( 'Widgets added here will display below the post header and but before the post content. Use if for a text advert.', 'best-reloaded' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title h4">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Post: After Post', 'best-reloaded' ),
		'id'            => 'sidebar-10',
		'description'   => __( 'Widgets added here will display after post (directly after the_content). Use it for a newsletter sign-up form or other text advert.', 'best-reloaded' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title h4">',
		'after_title'   => '</h3>',
	) );

}
