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
	$brand_image = get_theme_mod( 'brand_image', '' );
	// Did we get an image or is the brand text turned on?
	if ( $brand_image || get_theme_mod( 'display_brand_text', false ) ) {
		// since we have at least 1 of the items then start the output.
		$brand_output = '<span class="h1 navbar-brand mb-0">';
		if ( $brand_image ) {
			// we have an image.
			$brand_output .= '<img id="brand-img" class="d-inline-block align-top mr-2" src="' . esc_url( $brand_image ) . '" >';
		}
		if ( get_theme_mod( 'display_brand_text' ) ) {
			// text is toggled on, get site title.
			$site_title = get_bloginfo( 'name', 'display' );
			// very long site titles break the navbar so cap it at a generous 50 chars.
			if ( strlen( $site_title ) <= 50 || get_theme_mod( 'allow_long_brand', false ) ) {
				$brand_output .= esc_html( $site_title );
			}
		}
		$brand_output .= '</span>';
	}
	// this will return the markup if we have any or it will return false.
	return $brand_output;
}
