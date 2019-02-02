<?php
/**
 * The theme-setup.php file.
 *
 * All of the required theme setup functions, actions and hooks.
 *
 * @package Best_Reloaded
 * @since Best Reloaded v0.1
 */

/*
 * Theme Setup Function
 */
add_action( 'after_setup_theme', 'best_reloaded_setup' );
if ( ! function_exists( 'best_reloaded_setup' ) ) {
	/**
	 * Main theme setup functiion.
	 *
	 * This adds navigations, nav fallbacks various theme support items.
	 */
	function best_reloaded_setup() {

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'best_reloaded_nav_topbar' => __( 'Topbar Navigation', 'best-reloaded' ),
				'best_reloaded_nav_footer' => __( 'Footer Navigation', 'best-reloaded' ),
			)
		);

		/**
		 * Fallback function for Topbar Navigation.
		 *
		 * Echos out an entry in the location. If logged out adds a home link,
		 * when logged in it shows link to edit.
		 *
		 * Used only when a menu isn't set to the location.
		 */
		function best_reloaded_topbar_nav_fallback() {
			if ( is_user_logged_in() ) {
				echo '<ul class="navbar-nav mr-auto"><li class="nav-item"><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '" class="nav-link">' . esc_html__( 'Add a menu', 'best-reloaded' ) . '</a></li></ul>';
			} else {
				echo '<ul class="navbar-nav mr-auto"><li class="nav-item"><a href="' . esc_url( home_url() ) . '" title="' . esc_attr__( 'Home', 'best-reloaded' ) . '" class="nav-link">' . esc_html__( 'Home', 'best-reloaded' ) . '</a></li></ul>';
			}
		}

		/**
		 * Fallback function for Footer Navigation.
		 *
		 * Echos out an entry in the location. If logged out adds a home link,
		 * when logged in it shows link to edit.
		 *
		 * Used only when a menu isn't set to the location.
		 */
		function best_reloaded_footer_nav_fallback() {
			if ( is_user_logged_in() ) {
				echo '<ul class="nav"><li class="nav-item"><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '" class="nav-link">' . esc_html__( 'Add a menu', 'best-reloaded' ) . '</a></li></ul>';
			} else {
				echo '<ul class="nav"><li class="nav-item"><a href="' . esc_url( home_url() ) . '" title="' . esc_attr__( 'Home', 'best-reloaded' ) . '" class="nav-link">' . esc_html__( 'Home', 'best-reloaded' ) . '</a></li></ul>';
			}
		}

		// This theme uses Featured Images (also known as post thumbnails).
		add_theme_support( 'post-thumbnails' );

		// Adds the image sizes we use.
		add_image_size( 'best-reloaded-featured-img', '865', '370', true );

		// This feature enables post and comment RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// This enables WP 4.1+ title-tag support.
		add_theme_support( 'title-tag' );

		// custom logo and background support via customizer.
		$custom_logo_args = array(
			'height'      => 100,
			'width'       => 760,
			'flex-height' => true,
			'flex-width'  => true,
		);
		add_theme_support( 'custom-logo', $custom_logo_args );
		$custom_bg_args = array(
			'default-color' => 'dddddd',
		);
		add_theme_support( 'custom-background', $custom_bg_args );

		add_theme_support(
			'gutenberg',
			array(
				'wide-images' => true,
				'colors'      => array(
					'#e5450f',
					'#f26535',
					'#f58a65',
					'#2f2f2f',
				),
			)
		);

		// we'll want to use these over built in breadcrumbs.
		add_theme_support( 'yoast-seo-breadcrumbs' );

	}
}// End if().

/**
 * Sets the content width
 */
function best_reloaded_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'best_reloaded_content_width', 763 );
}
add_action( 'after_setup_theme', 'best_reloaded_content_width', 0 );


if ( ! function_exists( 'best_reloaded_load_styles' ) ) {
	/**
	 * Enqueue theme stylesheets
	 */
	function best_reloaded_load_styles() {
		if ( ! is_admin() ) {
			// we can either have full bootstrap or a slim version. For ease
			// keep handle the same but change src and tag the slim version.
			if ( ! get_theme_mod( 'enable_slim_mode', best_reloaded_setting_defaults( 'enable_slim_mode' ) ) ) {
				wp_register_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '4.0.0' );
			} else {
				wp_register_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap-slim.min.css', array(), '4.0.0-slim' );
			}

			wp_register_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.7.0' );
			wp_enqueue_style( 'best-reloaded', get_template_directory_uri() . '/assets/css/style.min.css', array( 'bootstrap' ), '2.0.0' );

			if ( get_theme_mod( 'enable_font-awesome', best_reloaded_setting_defaults( 'enable_font-awesome' ) ) ) {
				wp_enqueue_style( 'font-awesome' );
			}

			// we want to add some additional styles based on navbar style.
			$nav_style = get_theme_mod( 'navbar_style', best_reloaded_setting_defaults( 'navbar_style' ) );
			switch ( $nav_style ) {
				case 'fixed-top':
					$css = '
					body { padding-top: 60px; }
					@media( min-width: 768px ) {
						body { padding-top: 90px; }
					}
					';
					break;
				case 'fixed-bottom':
					$css = '
					body { padding: 60px 0; }
					';
					break;
				case 'sticky-top':
					$css = '
					#main_navbar { margin-bottom: 40px; }
					';
					break;
			}
			wp_add_inline_style( 'best-reloaded', $css, 20 );

		} // End if().
	}
} // End if().
add_action( 'wp_enqueue_scripts', 'best_reloaded_load_styles' );

if ( ! function_exists( 'best_reloaded_load_scripts' ) ) {
	/**
	 * Enqueue theme and other required javascript files.
	 */
	function best_reloaded_load_scripts() {
		if ( ! is_admin() ) {
			// we can either have full bootstrap or a slim version. For ease
			// keep handle the same but change src and tag the slim version.
			if ( ! get_theme_mod( 'enable_slim_mode', best_reloaded_setting_defaults( 'enable_slim_mode' ) ) ) {
				wp_register_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery', 'popper' ), '4.0.0', true );
			} else {
				wp_register_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap-slim.min.js', array( 'jquery', 'popper' ), '4.0.0-slim', true );
			}
			// register popper - needed by bootstrap affix.
			wp_register_script( 'popper', get_template_directory_uri() . '/assets/js/popper.min.js', array( 'jquery' ), '1.11.1', true );

			// enqueue the main theme scripts file - which will in turn enqueue
			// bootstrap, tether and jQuery due to dependancy chaining.
			wp_enqueue_script( 'best-reloaded', get_template_directory_uri() . '/assets/js/scripts.min.js', array( 'bootstrap', 'jquery' ), '2.0.0', true );

			// only enqueue comment-reply script on single pages.
			if ( is_single() ) {
				wp_enqueue_script( 'comment-reply' );
			}

			// Localize some data to the page for slider settings.
			$slider_max_capped = get_theme_mod( 'slider_max_cap', best_reloaded_setting_defaults( 'slider_max_cap' ) );
			if ( $slider_max_capped ) {
				$data = array(
					'slider_height_cap' => $slider_max_capped,
				);
				wp_localize_script( 'best-reloaded', 'best_reloaded_settings', $data );
			}
		}
	}
}
add_action( 'wp_enqueue_scripts', 'best_reloaded_load_scripts' );

if ( ! function_exists( 'best_reloaded_remove_category_list_rel' ) ) {
	/**
	 * Remove rel attribute from the category list
	 *
	 * @param string $output  string containing markup for category lists.
	 *
	 * @return string         returns a modified string with the 'rel' params removed.
	 */
	function best_reloaded_remove_category_list_rel( $output ) {
		$output = str_replace( ' rel="category tag"', '', $output );
		return $output;
	}
}
add_filter( 'wp_list_categories', 'best_reloaded_remove_category_list_rel' );
add_filter( 'the_category', 'best_reloaded_remove_category_list_rel' );

if ( ! function_exists( 'best_reloaded_custom_excerpt_length' ) ) {
	/**
	 * Custom excerpt length and more text
	 *
	 * @param integer $length  This is the currently set excerpt length.
	 *
	 * @return integer         New length to use for excerpts.
	 */
	function best_reloaded_custom_excerpt_length( $length ) {
		if ( is_admin() ) {
			return $length;
		}
		return 40;
	}
}
add_filter( 'excerpt_length', 'best_reloaded_custom_excerpt_length', 999 );

if ( ! function_exists( 'best_reloaded_new_excerpt_more' ) ) {
	/**
	 * Function to handle custom excerpt more link
	 *
	 * @link: refernece https://github.com/WordPress/twentyseventeen/blob/master/functions.php#L222
	 *
	 * @param  string $more [description].
	 *
	 * @return string       string containing markup for the read more link.
	 */
	function best_reloaded_new_excerpt_more( $more ) {
		$link = sprintf(
			'<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
			esc_url( get_permalink( get_the_ID() ) ),
			/* translators: %s: Name of current post */
			sprintf( __( 'Continue Reading<span class="sr-only"> "%s"</span>', 'best-reloaded' ), get_the_title( get_the_ID() ) )
		);
		return ' &hellip; ' . $link;
	}
}
add_filter( 'excerpt_more', 'best_reloaded_new_excerpt_more' );

if ( ! function_exists( 'best_reloaded_custom_tag_cloud_widget' ) ) {
	/**
	 * Custom tagcloud tweaks
	 *
	 * @param array $args  Array of args already passed to tagcloud widget.
	 *
	 * @return array       Updated array with more args appended or udpated.
	 */
	function best_reloaded_custom_tag_cloud_widget( $args ) {
		$args['largest']  = 18;
		$args['smallest'] = 14;
		$args['unit']     = 'px';
		return $args;
	}
}
add_filter( 'widget_tag_cloud_args', 'best_reloaded_custom_tag_cloud_widget' );
