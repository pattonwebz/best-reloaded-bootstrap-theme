<?php
/**
 * The custom-functions.php file.
 *
 * Contains any custom functions that are invoked by the theme.
 *
 * @package Best_Reloaded
 * @since Best Reloaded v1.2.0
 */

if ( ! function_exists( 'best_reloaded_bootstrap_navbar_branding' ) ) {

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
} // End if().

if ( ! function_exists( 'best_reloaded_setting_defaults' ) ) {

	/**
	 * Helper function to return the values used as the default settings throughout
	 * the theme.
	 *
	 * @since 1.7.0
	 *
	 * @param  string $field a single field being requested.
	 *
	 * @return mixed         either a mixed type value or an array of values.
	 */
	function best_reloaded_setting_defaults( $field = '' ) {
		// translators: 1 is current year, 2 is site name.
		$default_tagline = sprintf( __( '&copy; %1$s %2$s', 'best-reloaded' ), date_i18n( __( 'Y', 'best-reloaded' ) ), get_bloginfo( 'name' ) );
		$defaults        = array(
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
			'display_homepage_slider_row' => 1,
			'display_homepage_widget_row' => 1,
			'display_homepage_posts_row'  => 1,
			'homepage_posts_output_num'   => '3',
			'homepage_posts_category'     => 0,
			'slider_limit'                => 3,
			'slider_category'             => 0,
			'slider_max_cap'              => 0,
			'display_featured_bar'        => 0,
			'featured_bar'                => __( 'Something Important (set background color, image, text, and <a href="#">link</a>)', 'best-reloaded' ),
			'display_footer_top'          => 1,
			'display_footer_bottom'       => 1,
			'footer_bottom_tagline'       => $default_tagline,
			'layout_selection'            => '',
			'enable_font-awesome'         => 1,
			'enable_slim_mode'            => 0,
			'use_custom_slider'           => 0,
			'custom_slider_shortcode'     => '',
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
} // End if().

/**
 * Build an array of categories.
 *
 * @return array of site categories as a `term_id` => `name` array.
 */
function best_reloaded_get_categories() {
	// get all the categories.
	$categories       = get_categories();
	$categories_array = array();

	// Add entry for all posts.
	$categories_array[0] = 'All Categories';
	// loop though categories and store key as `term_id` and value as `name`.
	foreach ( $categories as $category ) {
		$categories_array[ $category->term_id ] = $category->name;
	}
	// return an array of categories, otherwise empty array.
	return $categories_array;
}

/**
 * Returns an array of possible classnames for use with the navbar.
 *
 * @return array
 */
function best_reloaded_get_navbar_styles() {
	$options = array(
		'fixed-top'    => 'Fixed Top',
		'fixed-bottom' => 'Fixed Bottom',
		'sticky-top'   => 'Sticky Top',
	);
	return apply_filters( 'best_reloaded_filter_get_navbar_styles', $options );
}

/**
 * Returns an array of possible classnames for use with the navbar.
 *
 * @return array
 */
function best_reloaded_get_navbar_colors() {
	// note that these classes indicate bg color and modfy color to the oposite.
	$options = array(
		'navbar-light' => 'Dark',
		'navbar-dark'  => 'Light',
	);
	return apply_filters( 'best_reloaded_filter_get_navbar_colors', $options );
}

/**
 * Returns an array of possible classnames for use with the navbar.
 *
 * @return array
 */
function best_reloaded_get_navbar_bgs() {
	$options = array(
		'bg-light'     => 'Light',
		'bg-dark'      => 'Dark',
		'bg-secondary' => 'Light Grey',
		'bg-primary'   => 'Blue',
		'bg-info'      => 'Light Blue',
		'bg-success'   => 'Green',
		'bg-danger'    => 'Red',
		'bg-warning'   => 'Yellow',
	);
	return apply_filters( 'best_reloaded_filter_get_navbar_bgs', $options );
}

/**
 * Returns an array of possible classnames for use with the search box.
 *
 * @return array
 */
function best_reloaded_get_search_colors() {
	$options = array(
		'btn-theme'           => 'Orange',
		'btn-info'            => 'Blue',
		'btn-warning'         => 'Yellow',
		'btn-danger'          => 'Red',
		'btn-success'         => 'Green',
		'btn-light'           => 'Light',
		'btn-dark'            => 'Dark',
		'btn-outline-theme'   => 'Outline Orange',
		'btn-outline-info'    => 'Outline Blue',
		'btn-outline-warning' => 'Outline Yellow',
		'btn-outline-danger'  => 'Outline Red',
		'btn-outline-success' => 'Outline Green',
		'btn-outline-light'   => 'Outline Light',
		'btn-outline-dark'    => 'Outline Dark',
	);
	return apply_filters( 'best_reloaded_filter_get_search_colors', $options );
}

/**
 * Returns an array of radio buttons for selecting a site layout.
 *
 * @return array
 */
function best_reloaded_get_layout_styles() {
	$options = array(
		''                 => 'Right Sidebar',
		'flex-row-reverse' => 'Left Sidebar',
	);
	return apply_filters( 'best_reloaded_filter_get_layout_styles', $options );
}

/**
 * START SANITIZATION FILTERS.
 */

/**
 * Sanitization for textarea field against list of allwed tags in posts.
 *
 * @param string $input     text area string to sanitize.
 *
 * @return string $output   sanitized string.
 */
function best_reloaded_sanitize_textarea( $input ) {
	global $allowedposttags;
	$output = wp_kses( $input, $allowedposttags );
	return $output;
}

/**
 * Sanitization for checkbox input
 *
 * @param booleen $input    we either have a value or it's empty to depeict
 *                          a checkbox state.
 * @return booleen $output
 */
function best_reloaded_sanitize_checkbox( $input ) {
	// Checkbox is booleen, it can only be in 2 states, if we have any input
	// consider it as true otherwise it's false.
	if ( $input ) {
		$output = true;
	} else {
		$output = false;
	}
	return $output;
}

/**
 * Santization for image uploads.
 *
 * @param  string $input    This should be a direct url to an image file.
 *
 * @return string           Return an excaped url to a file.
 */
function best_reloaded_sanitize_image( $input ) {

	// allowed file types.
	$mimes = array(
		'jpg|jpeg|jpe' => 'image/jpeg',
		'gif'          => 'image/gif',
		'png'          => 'image/png',
	);

	// check file type from file name.
	$file_ext = wp_check_filetype( $input, $mimes );

	// if filetype matches the allowed types set above then cast to output,
	// otherwise pass empty string.
	$output = ( $file_ext['ext'] ? $input : '' );

	// if file has a valid mime type return it as raw url.
	return esc_url_raw( $output );
}

/**
 * Sanitize term ids for select box customizer setting.
 *
 * @param  integer $input   A number representing category id.
 * @param  mixed   $setting Object containeing the info about the
 *                          settings/control that is being sanitized.
 *
 * @return integer
 */
function best_reloaded_sanitize_cetegory_select( $input, $setting ) {

	// input must be a integer.
	$input = absint( $input );
	// get the list of possible select options from setting being sanitized.
	$choices = $setting->manager->get_control( $setting->id )->choices;

	// return input if integer and matching an item in the choices array
	// otherwise return default option.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

}

/**
 * Sanitize navbar classnames for select box customizer setting.
 *
 * @param  string $input   String containing a classname.
 * @param  mixed  $setting Object containeing the info about the
 *                         settings/control that is being sanitized.
 *
 * @return string containing a classname.
 */
function best_reloaded_sanitize_navbar_style( $input, $setting ) {

	// get the list of possible select options from setting being sanitized.
	$choices = $setting->manager->get_control( $setting->id )->choices;

	// return input if matching an item in the choices array
	// otherwise return default option.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

}

/**
 * Sanitize strings against postible layout selections.
 *
 * @param  string $input   String containing a layout string.
 * @param  mixed  $setting Object containeing the info about the
 *                         settings/control that is being sanitized.
 *
 * @return string
 */
function best_reloaded_sanitize_layout_selection( $input, $setting ) {

	// get the list of possible select options from setting being sanitized.
	$choices = $setting->manager->get_control( $setting->id )->choices;

	// return input if matching an item in the choices array
	// otherwise return default option.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

}

/**
 * Sanitize navbar classnames for select box customizer setting.
 *
 * @param  string $input   String containing a classname.
 * @param  mixed  $setting Object containeing the info about the
 *                         settings/control that is being sanitized.
 *
 * @return string containing a classname.
 */
function best_reloaded_sanitize_select( $input, $setting ) {

	// get the list of possible select options from setting being sanitized.
	$choices = $setting->manager->get_control( $setting->id )->choices;

	// return input if matching an item in the choices array
	// otherwise return default option.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

}

/**
 * END SANITIZATION FILTERS.
 */
