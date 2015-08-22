<?php
/**
 * regisger-sidebars.php
 * Register sidebars and widgetized areas
 *
 * @package WordPress
 * @subpackage Best_Reloaded
 * @since Best Reloaded 0.1
 */

add_action( 'widgets_init', 'pwwp_bestreloaded_widgets_init' );

function pwwp_bestreloaded_widgets_init() {

    // Allow shortcodes to be used in text widgets
    add_filter('widget_text', 'do_shortcode');

    register_sidebar( array(
        'name'          => 'Main Sidebar',
        'id'            => 'sidebar-1',
        'description'   => 'Widgets placed in this area will appear on all posts and pages with a sidebar.',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside><hr class="hr-row-divider">',
        'before_title'  => '<h3 class="widget-title h4">',
        'after_title'   => '</h3>'
    ) );

    register_sidebar( array(
        'name'          => 'Homepage: Right of Slider',
        'id'            => 'sidebar-2',
        'description'   => 'Widgets placed in this area will appear to the right of the homepage slider.',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside><hr class="hr-row-divider">',
        'before_title'  => '<h3 class="widget-title h4">',
        'after_title'   => '</h3>'
    ) );

    register_sidebar( array(
        'name'          => 'Homepage: Widget Row',
        'id'            => 'sidebar-3',
        'description'   => 'Widgets placed in this area will appear in the row beneath the slider. A maximum of 3 widgets can be used in this area.',
        'before_widget' => '<div class="col-sm-4"><aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside><hr class="hr-row-divider"></div>',
        'before_title'  => '<h3 class="widget-title h4">',
        'after_title'   => '</h3>'
    ) );

    register_sidebar( array(
        'name'          => 'Homepage: Left of Blog',
        'id'            => 'sidebar-4',
        'description'   => 'Widgets placed in this area will appear to the left of the blog on the homepage.',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside><hr class="hr-row-divider">',
        'before_title'  => '<h3 class="widget-title h4">',
        'after_title'   => '</h3>'
    ) );

    register_sidebar( array(
        'name'          => 'Footer: First Column',
        'id'            => 'sidebar-5',
        'description'   => 'Widgets placed in this area will appear in the far left column of the footer on all pages.',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title h4">',
        'after_title'   => '</h3>'
    ) );

    register_sidebar( array(
        'name'          => 'Footer: Second Column',
        'id'            => 'sidebar-6',
        'description'   => 'Widgets placed in this area will appear in the middle left column of the footer on all pages.',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title h4">',
        'after_title'   => '</h3>'
    ) );

    register_sidebar( array(
        'name'          => 'Footer: Third Column',
        'id'            => 'sidebar-7',
        'description'   => 'Widgets placed in this area will appear in the middle right column of the footer on all pages.',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title h4">',
        'after_title'   => '</h3>'
    ) );

    register_sidebar( array(
        'name'          => 'Footer: Fourth Column',
        'id'            => 'sidebar-8',
        'description'   => 'Widgets placed in this area will appear in the far right column of the footer on all pages.',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title h4">',
        'after_title'   => '</h3>'
    ) );
	register_sidebar( array(
        'name'          => 'Post: Before Post',
        'id'            => 'sidebar-9',
        'description'   => 'Widgets added here will display below the post header and but before the post content. Use if for a text advert.',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title h4">',
        'after_title'   => '</h3>'
    ) );
	register_sidebar( array(
        'name'          => 'Post: After Post',
        'id'            => 'sidebar-10',
        'description'   => 'Widgets added here will display after post (directly after the_content). Use if for a newsletter sign-up form or other text advert..',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title h4">',
        'after_title'   => '</h3>'
    ) );

}

?>
