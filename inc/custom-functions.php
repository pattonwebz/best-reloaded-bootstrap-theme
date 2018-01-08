<?php
/**
 * The custom-functions.php file.
 *
 * Contains any custom functions that are invoked by the theme.
 *
 * @package Best_Reloaded
 * @since Best Reloaded v1.2.0
 */

/**
 * Builds out a .navbar-brand based on options set in the theme.
 *
 * @since v1.2.0
 *
 * @return string containing html markup for brand
 */
function best_reloaded_bootstrap_navbar_branding() {
	// initial value for the output is false.
	$brand_output = false;
	// check for image set in theme options theme options.
	$brand_image = get_theme_mod( 'brand_image', best_reloaded_setting_defaults( 'brand_image' ) );
	// Did we get an image or is the brand text turned on?
	if ( $brand_image || get_theme_mod( 'display_brand_text', best_reloaded_setting_defaults( 'display_brand_text' ) ) ) {
		// since we have at least 1 of the items then start the output.
		$brand_output = '<span class="h1 navbar-brand mb-0">';
		if ( $brand_image ) {
			// we have an image.
			$brand_output .= '<img id="brand-img" class="d-inline-block align-top mr-2" src="' . esc_url( $brand_image ) . '" >';
		}
		if ( get_theme_mod( 'display_brand_text', best_reloaded_setting_defaults( 'display_brand_text' ) ) ) {
			// text is toggled on, get site title.
			$site_title = get_bloginfo( 'name', 'display' );
			// very long site titles break the navbar so cap it at a generous 50 chars.
			if ( strlen( $site_title ) <= 50 || get_theme_mod( 'allow_long_brand', best_reloaded_setting_defaults( 'allow_long_brand' ) ) ) {
				$brand_output .= esc_html( $site_title );
			}
		}
		$brand_output .= '</span>';
	}
	// this will return the markup if we have any or it will return false.
	return $brand_output;
}

/**
 * Helper function to return the values used as the default settings throughout
 * the theme.
 *
 * @param  string $field a single field being requested.
 *
 * @return mixed         either a mixed type value or an array of values.
 */
function best_reloaded_setting_defaults( $field = '' ) {
	// translators: 1 is current year, 2 is site name.
	$default_tagline = sprintf( __( '&copy; %1$s %2$s', 'best-reloaded' ), date_i18n( __( 'Y', 'best-reloaded' ) ), get_bloginfo( 'name' ) );
	$defaults = array(
		'navbar_style'                => 'fixed-top',
		'navbar-color'                => 'navbar-light',
		'navbar-bg'                   => 'bg-light',
		'display_navbar_search'       => 1,
		'search_color'                => 'btn-theme',
		'display_navbar_brand'        => 0,
		'brand_image'                 => '',
		'display_brand_text'          => 0,
		'allow_long_brand'            => 0,
		'small_site_title'            => 0,
		'display_header_banner_area'  => 0,
		'header_banner_area'          => '<!-- html accepted -->',
		'display_intro_text'          => 1,
		'intro_text'                  => __( 'Welcome to our awesome site!<br/>This space is the perfect place to say a <a href="#">little something</a> about yourself.', 'best-reloaded' ),
		'display_homepage_widget_row' => 1,
		'slider_limit'                => 3,
		'slider_category'             => 0,
		'display_featured_bar'        => 0,
		'featured_bar'                => __( 'Something Important (set background color, image, text, and <a href="#">link</a>)', 'best-reloaded' ),
		'display_footer_top'          => 1,
		'display_footer_bottom'       => 1,
		'footer_bottom_tagline'       => $default_tagline,
		'layout_selection'            => '',
		'enable_font-awesome'         => 1,
		'enable_slim_mode'            => 0,
	);
	// filter the defaults so they can be edited by child theme or plugin.
	$defaults = apply_filters( 'best_reloaded_filter_setting_defaults', $defaults );
	// if we got a specific field request...
	if ( '' !== $field ) {
		// check it exists in the defaults array.
		if ( array_key_exists( $field, $defaults ) ) {
			// requested field exists, return it's value.
			return $defaults[ $field ];
		}
	}
	// in all other cases we'll return the full array.
	return $defaults;
}
