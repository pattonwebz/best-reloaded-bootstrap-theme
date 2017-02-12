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

add_action( 'after_setup_theme', 'pwwp_bestreloaded_setup' );
if ( !function_exists( 'pwwp_bestreloaded_setup' ) ) {
    function pwwp_bestreloaded_setup() {

        // Set the content width
        if ( ! isset( $content_width ) ) $content_width = 690;

        // This theme uses wp_nav_menu() in two locations
        register_nav_menus( array(
            'nav_topbar' => 'Topbar Navigation',
            'nav_footer' => 'Footer Navigation'
        ) );

        // Fallback function for Topbar Navigation if it isn't set
        function topbar_nav_fallback() {
            echo '<ul class="navbar-nav mr-auto"><li class="nav-item"><a href="' . esc_url(home_url()) . '" title="Home" class="nav-link">Home</a></li></ul>';
        }


        // Fallback function for Footer Navigation if it isn't set
        function footer_nav_fallback() {
            echo '<ul><li><a href="' . home_url() . '" title="Home">Home</a></li></ul>';
        }

        // This theme uses Featured Images (also known as post thumbnails)
        add_theme_support( 'post-thumbnails' );

		// Adds the image sizes we use
		add_image_size('featured-slide', '865', '400', true);

        // This feature enables post and comment RSS feed links to head
        add_theme_support( 'automatic-feed-links' );

        // This enables WP 4.1+ title-tag support. Fallback in place for
        // old versions
        add_theme_support( 'title-tag' );

		$args = array(
			'default-color' => 'dddddd',
		);
		add_theme_support( 'custom-background', $args );

    }
    /* ===| end bestreloaded_setup() |================================== */
}
/* ===| end !function_exists |================================== */

/* =============================================================
 * Enqueue Styles
 * ============================================================= */

add_action( 'wp_enqueue_scripts', 'pwwp_load_bestreloaded_styles' );
if ( !function_exists( 'pwwp_load_bestreloaded_styles' ) ) {
    function pwwp_load_bestreloaded_styles() {
        if ( !is_admin() ) {
			wp_register_style( 'bootstrap-styles', get_template_directory_uri() . '/assets/css/bootstrap.min.css', "4.0.0-alpha.6" );
			wp_enqueue_style ( 'bootstrap-styles' );
            wp_register_style( 'best-reloaded-styles', get_template_directory_uri() . '/assets/css/style.min.css', array(), 0.4 );
            wp_enqueue_style ( 'best-reloaded-styles' );
        }
    }
}

/* =============================================================
 * Enqueue Javascript
 * ============================================================= */

add_action( 'wp_enqueue_scripts', 'pwwp_load_bestreloaded_scripts' );
if ( !function_exists( 'pwwp_load_bestreloaded_scripts' ) ) {
    function pwwp_load_bestreloaded_scripts() {
        if ( !is_admin() ) {
            wp_register_script( 'modernizr', get_template_directory_uri() . '/js/libs/modernizr-2.5.3.min.js' );
            wp_enqueue_script( 'modernizr' );
            wp_enqueue_script( 'jquery' );
            wp_register_script( 'best-reloaded-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery', 'bootstrap'), 0.4, true );
            wp_enqueue_script( 'best-reloaded-scripts' );
			wp_register_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery', 'tether'), '4.0.0-alpha.6', true );
            wp_enqueue_script( 'bootstrap' );
			wp_register_script( 'tether', get_template_directory_uri() . '/assets/js/tether.min.js', array('jquery'), '1.4.0', true );
            wp_enqueue_script( 'tether' );
            if ( is_single() ) wp_enqueue_script( 'comment-reply' );
        }
    }
}



/* =============================================================
 * Echo out color options from admin panel
 * ============================================================= */

//add_action( 'wp_head', 'pwwp_bestreloaded_theme_options' );

if ( !function_exists( 'pwwp_bestreloaded_theme_options' ) ) {
    function pwwp_bestreloaded_theme_options() {

		// arrays of values
        $background					= get_theme_mod( 'bestreloaded_background' );
        $background_featured    	= get_theme_mod( 'bestreloaded_background_featured_content' );

		// these are all hex values
        $link_color_main 			= sanitize_hex_color( get_theme_mod( 'bestreloaded_link_color_main' ) );
        $link_color_hover_main 		= sanitize_hex_color( get_theme_mod( 'bestreloaded_link_hover_color_main' ) );
        $link_color_footer 			= sanitize_hex_color( get_theme_mod( 'bestreloaded_link_color_footer' ) );
        $link_color_hover_footer	= sanitize_hex_color( get_theme_mod( 'bestreloaded_link_hover_color_footer' ) );
        $text_color_featured    	= sanitize_hex_color( get_theme_mod( 'bestreloaded_text_color_featured_content' ) );
        $link_color_featured    	= sanitize_hex_color( get_theme_mod( 'bestreloaded_link_color_featured_content' ) );
        $link_color_hover_featured 	= sanitize_hex_color( get_theme_mod( 'bestreloaded_link_hover_color_featured_content' ) ); ?>

            <style type="text/css">

                <?php if ( $background ) {
                          if ( $background['color'] && $background['image'] ) { ?>
                              body { background-color: <?php echo $background['color']; ?>;
                                     background-image: url(<?php echo $background['image']; ?>);
                                     background-repeat: <?php echo $background['repeat']; ?>;
                                     background-position: <?php echo $background['position']; ?>;
                                     background-attachment: <?php echo $background['attachment']; ?>; } <?php
                          } elseif ( $background['image'] ) { ?>
                              body { background-image: url(<?php echo $background['image']; ?>);
                                     background-repeat: <?php echo $background['repeat']; ?>;
                                     background-position: <?php echo $background['position']; ?>;
                                     background-attachment: <?php echo $background['attachment']; ?>; } <?php
                          } else { ?>
                              body { background-color: <?php echo $background['color']; ?>; } <?php
                          }
                      } else {
                          echo 'no entry';
                      };
                ?>
                <?php if ( $background_featured ) {
                          if ( $background_featured['color'] && $background_featured['image'] ) { ?>
                              .featured-bar { background-color: <?php echo $background_featured['color']; ?>;
                                              background-image: url(<?php echo $background_featured['image']; ?>);
                                              background-repeat: <?php echo $background_featured['repeat']; ?>;
                                              background-position: <?php echo $background_featured['position']; ?>;
                                              background-attachment: <?php echo $background_featured['attachment']; ?>; } <?php
                          } elseif ( $background_featured['image'] ) { ?>
                              .featured-bar { background-image: url(<?php echo $background_featured['image']; ?>);
                                              background-repeat: <?php echo $background_featured['repeat']; ?>;
                                              background-position: <?php echo $background_featured['position']; ?>;
                                              background-attachment: <?php echo $background_featured['attachment']; ?>; } <?php
                          } else { ?>
                              .featured-bar { background-color: <?php echo $background_featured['color']; ?>; } <?php
                          }
                      } else {
                          echo 'no entry';
                      };
                ?>
                <?php if ( $text_color_featured ) : ?>
                    .featured-bar { color: <?php echo $text_color_featured ?>; }
                <?php endif; ?>
                <?php if ( $link_color_featured ) : ?>
                    .featured-bar a { color: <?php echo $link_color_featured ?>; }
                <?php endif; ?>
                <?php if ( $link_color_hover_featured ) : ?>
                    .featured-bar a:hover { color: <?php echo $link_color_hover_featured ?>; }
                <?php endif; ?>
                <?php if ( $link_color_main ) : ?>
                    a, .comment-notes .required, .comment-form-author .required,
                    .comment-form-email .required, .comment-form-url .required, .comment-form-comment .required { color: <?php echo $link_color_main; ?>; }
                    footer .container.container-main.footer-top { border-top-color: <?php echo $link_color_main; ?>; }
                    .flex-direction-nav li a, .flex-control-nav li a.active,
                    .flex-control-nav li a:hover, .flex-control-nav li a:focus,
                    .sub-menu li > a:hover, .sub-menu .active > a, .sub-menu .active > a:hover { background-color: <?php echo $link_color_main; ?>; }
                    .wp-caption a:hover img { border-color: <?php echo $link_color_main; ?>; }
                <?php endif; ?>
                <?php if ( $link_color_hover_main ) : ?>
                    a:hover { color: <?php echo $link_color_hover_main; ?>; }
                <?php endif; ?>
                <?php if ( $link_color_footer ) : ?>
                    footer .container.container-main a { color: <?php echo $link_color_footer; ?>; }
                <?php endif; ?>
                <?php if ( $link_color_hover_footer ) : ?>
                    footer .container.container-main a:hover { color: <?php echo $link_color_hover_footer; ?>; }
                <?php endif; ?>

            </style>

        <?php
    }
    /* ===| end bestreloaded_theme_options() |========================== */
}
/* ===| end !function_exists |================================== */

/* =============================================================
 * Remove rel attribute from the category list
 * ============================================================= */

add_filter('wp_list_categories', 'pwwp_remove_category_list_rel');
add_filter('the_category', 'pwwp_remove_category_list_rel');
if ( !function_exists( 'pwwp_remove_category_list_rel' ) ) {
    function pwwp_remove_category_list_rel($output) {
        $output = str_replace(' rel="category tag"', '', $output);
        return $output;
    }
}

/* =============================================================
 * Custom excerpt length and styling
 * ============================================================= */

add_filter( 'excerpt_length', 'pwwp_custom_excerpt_length', 999 );
if ( !function_exists( 'pwwp_custom_excerpt_length' ) ) {
    function pwwp_custom_excerpt_length() {
        return 40;
    }
}
add_filter('excerpt_more', 'pwwp_new_excerpt_more');
if ( !function_exists( 'pwwp_new_excerpt_more' ) ) {
    function pwwp_new_excerpt_more( $more ) {
        return ' ...';
    }
}

/* =============================================================
 * Tweak tagcloud settings
 * ============================================================= */

add_filter( 'widget_tag_cloud_args', 'pwwp_custom_tag_cloud_widget' );
if ( !function_exists( 'pwwp_custom_tag_cloud_widget' ) ) {
    function pwwp_custom_tag_cloud_widget( $args ) {
        $args['largest'] = 18;
        $args['smallest'] = 14;
        $args['unit'] = 'px';
        return $args;
    }
}
