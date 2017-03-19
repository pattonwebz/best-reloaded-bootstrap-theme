<?php
/**
 * theme-setup.php
 * Theme setup functions
 *
 * @package WordPress
 * @subpackage Best_Reloaded
 * @since Best Reloaded 0.1
 */

/* =============================================================
 * Theme Setup Function
 * ============================================================= */

add_action( 'after_setup_theme', 'best_reloaded_setup' );
if ( !function_exists( 'best_reloaded_setup' ) ) {
    function best_reloaded_setup() {

        // Set the content width
        if ( ! isset( $content_width ) ) $content_width = 690;

        // This theme uses wp_nav_menu() in two locations
        register_nav_menus( array(
            'best_reloaded_nav_topbar' => __('Topbar Navigation', 'best-reloaded' ),
            'best_reloaded_nav_footer' => __('Footer Navigation', 'best-reloaded' )
        ) );

        // Fallback function for Topbar Navigation if it isn't set
        function best_reloaded_topbar_nav_fallback() {
			if( is_user_logged_in() ) {
				echo '<ul class="navbar-nav mr-auto"><li class="nav-item"><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '" class="nav-link">'. esc_html__('Add a menu', 'best-reloaded') .'</a></li></ul>';
			} else {
	            echo '<ul class="navbar-nav mr-auto"><li class="nav-item"><a href="' . esc_url( home_url() ) . '" title="Home" class="nav-link">Home</a></li></ul>';
			}
        }


        // Fallback function for Footer Navigation if it isn't set
        function best_reloaded_footer_nav_fallback() {
			if( is_user_logged_in() ) {
				echo '<ul class="nav"><li class="nav-item"><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '" class="nav-link">'. esc_html__('Add a menu', 'best-reloaded') .'</a></li></ul>';
			} else {
	            echo '<ul class="nav"><li class="nav-item"><a href="' . esc_url( home_url() ) . '" title="Home" class="nav-link">Home</a></li></ul>';
			}
        }

        // This theme uses Featured Images (also known as post thumbnails)
        add_theme_support( 'post-thumbnails' );

		// Adds the image sizes we use
		add_image_size('featured-slide', '865', '370', true);

        // This feature enables post and comment RSS feed links to head
        add_theme_support( 'automatic-feed-links' );

        // This enables WP 4.1+ title-tag support. Fallback in place for
        // old versions
        // FALLBACK REMOVED - ONLY NEED TO SUPPORT 2 VERSIONS PREVIOUS
        add_theme_support( 'title-tag' );

		// custom logo and background support via customizer
		$custom_logo_args = array(
		    'height'      => 100,
		    'width'       => 760,
		    'flex-height' => true,
		    'flex-width'  => true
		);
		add_theme_support( 'custom-logo', $custom_logo_args );
		$custom_bg_args = array(
			'default-color' => 'dddddd',
		);
		add_theme_support( 'custom-background', $custom_bg_args );

    }
    /* ===| end bestreloaded_setup() |================================== */
}
/* ===| end !function_exists |================================== */

/* =============================================================
 * Enqueue Styles
 * ============================================================= */

add_action( 'wp_enqueue_scripts', 'best_reloaded_load_styles' );
if ( !function_exists( 'best_reloaded_load_styles' ) ) {
    function best_reloaded_load_styles() {
        if ( !is_admin() ) {
			wp_register_style( 'bootstrap-styles', get_template_directory_uri() . '/assets/css/bootstrap.min.css', '4.0.0-alpha.6' );
			wp_enqueue_style ( 'bootstrap-styles' );
            wp_register_style( 'best-reloaded-styles', get_template_directory_uri() . '/assets/css/style.min.css', array(), '0.10.0' );
            wp_enqueue_style ( 'best-reloaded-styles' );
        }
    }
}

/* =============================================================
 * Enqueue Javascript
 * ============================================================= */

add_action( 'wp_enqueue_scripts', 'best_reloaded_load_scripts' );
if ( !function_exists( 'best_reloaded_load_scripts' ) ) {
    function best_reloaded_load_scripts() {
        if ( !is_admin() ) {

			// this is the main theme scripts file
            wp_register_script( 'best-reloaded-scripts', get_template_directory_uri() . '/assets/js/scripts.min.js', array('bootstrap'), '0.10.0', true );
            // bootstrap scripts
			wp_register_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery', 'tether'), '4.0.0-alpha.6', true );
			// tether - needed by bootstrap affix
			wp_register_script( 'tether', get_template_directory_uri() . '/assets/js/tether.min.js', array('jquery'), '1.4.0', true );

			// enqueue the main theme scripts file - which will in turn include
			// bootstrap, tether and jQuery due to dependancy chaing
			wp_enqueue_script( 'best-reloaded-scripts' );

			// only enqueue comment-reply script on single pages
            if ( is_single() ) wp_enqueue_script( 'comment-reply' );
        }
    }
}



/* =============================================================
 * Echo out color options from admin panel
 * ============================================================= */

add_action( 'wp_head', 'best_reloaded_theme_options' );

if ( !function_exists( 'best_reloaded_theme_options' ) ) {
    function best_reloaded_theme_options() {

		// these are all hex values
        $text_color_featured    	= get_theme_mod( 'bestreloaded_text_color_featured_content' );
        $link_color_main 			= get_theme_mod( 'bestreloaded_link_color_main' );
        $link_color_hover_main 		= get_theme_mod( 'bestreloaded_link_hover_color_main' );
        $link_color_footer 			= get_theme_mod( 'bestreloaded_link_color_footer' );
        $link_color_hover_footer	= get_theme_mod( 'bestreloaded_link_hover_color_footer' );
        $link_color_featured    	= get_theme_mod( 'bestreloaded_link_color_featured_content' );
        $link_color_hover_featured 	= get_theme_mod( 'bestreloaded_link_hover_color_featured_content' ); ?>

            <style type="text/css">

			<?php
			if ( $text_color_featured ) { ?>
				.featured-bar { color: <?php echo esc_html( $text_color_featured ); ?>; }
			<?php } ?>
			<?php if ( $link_color_featured ) { ?>
				.featured-bar a { color: <?php echo esc_html( $link_color_featured ); ?>; }
			<?php } ?>
			<?php if ( $link_color_hover_featured ) { ?>
				.featured-bar a:hover { color: <?php echo esc_html( $link_color_hover_featured ); ?>; }
			<?php } ?>
			<?php if ( $link_color_main ) { ?>
				a, .comment-notes .required, .comment-form-author .required,
				.comment-form-email .required, .comment-form-url .required, .comment-form-comment .required { color: <?php echo esc_html( $link_color_main ); ?>; }
				footer .container.container-main.footer-top { border-top-color: <?php echo esc_html( $link_color_main ); ?>; }
				.flex-direction-nav li a, .flex-control-nav li a.active,
				.flex-control-nav li a:hover, .flex-control-nav li a:focus,
				.sub-menu li > a:hover, .sub-menu .active > a, .sub-menu .active > a:hover { background-color: <?php echo esc_html( $link_color_main ); ?>; }
				.wp-caption a:hover img { border-color: <?php echo esc_html( $link_color_main ); ?>; }
			<?php } ?>
			<?php if ( $link_color_hover_main ) { ?>
				a:hover { color: <?php echo esc_html( $link_color_hover_main ); ?>; }
			<?php } ?>
			<?php if ( $link_color_footer ) { ?>
				footer .container.container-main a { color: <?php echo esc_html( $link_color_footer ); ?>; }
			<?php } ?>
			<?php if ( $link_color_hover_footer ) { ?>
				footer .container.container-main a:hover { color: <?php echo esc_html( $link_color_hover_footer );  ?>; }
			<?php } ?>

            </style>

        <?php
    }
    /* ===| end bestreloaded_theme_options() |========================== */
}
/* ===| end !function_exists |================================== */

/* =============================================================
 * Remove rel attribute from the category list
 * ============================================================= */

add_filter('wp_list_categories', 'best_reloaded_remove_category_list_rel');
add_filter('the_category', 'best_reloaded_remove_category_list_rel');
if ( !function_exists( 'best_reloaded_remove_category_list_rel' ) ) {
    function best_reloaded_remove_category_list_rel($output) {
        $output = str_replace(' rel="category tag"', '', $output);
        return $output;
    }
}

/* =============================================================
 * Custom excerpt length and more etxt
 * ============================================================= */

add_filter( 'excerpt_length', 'best_reloaded_custom_excerpt_length', 999 );
if ( !function_exists( 'best_reloaded_custom_excerpt_length' ) ) {
    function best_reloaded_custom_excerpt_length() {
        return 40;
    }
}
/**
 * @link: https://github.com/WordPress/twentyseventeen/blob/master/functions.php#L222
 */
add_filter('excerpt_more', 'best_reloaded_new_excerpt_more');
if ( !function_exists( 'best_reloaded_new_excerpt_more' ) ) {
    function best_reloaded_new_excerpt_more( $more ) {
		$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
			esc_url( get_permalink( get_the_ID() ) ),
			/* translators: %s: Name of current post */
			sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'best-reloaded' ), get_the_title( get_the_ID() ) )
		);
		return ' &hellip; ' . $link;
    }
}

/* =============================================================
 * Tweak tagcloud settings
 * ============================================================= */

add_filter( 'widget_tag_cloud_args', 'best_reloaded_custom_tag_cloud_widget' );
if ( !function_exists( 'best_reloaded_custom_tag_cloud_widget' ) ) {
    function best_reloaded_custom_tag_cloud_widget( $args ) {
        $args['largest'] = 18;
        $args['smallest'] = 14;
        $args['unit'] = 'px';
        return $args;
    }
}
