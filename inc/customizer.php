<?php
 /**
  * The customizer.php file.
  *
  * Adds the themes options to the customizer. Contains all the panels, options,
  * and sanitization functions used by our customizer settings.
  *
  * @package Best_Reloaded
  * @since Best Reloaded v0.7
  */

add_action( 'customize_register', 'best_reloaded_customizer' );

/**
 * Function to add customizer panels, settings, controls.
 *
 * @param  object $wp_customize	Customizer object to update.
 */
function best_reloaded_customizer( $wp_customize ) {

	$wp_customize->add_section( 'header', array(
		'title' => __( 'Header', 'best-reloaded' ),
		'priority' => 100,
	) );
	$wp_customize->add_section( 'best_reloaded_navbar', array(
		'title' => __( 'Header Navbar', 'best-reloaded' ),
		'priority' => 100,
	) );
	$wp_customize->add_section( 'best_reloaded_footer', array(
		'title' => __( 'Footer', 'best-reloaded' ),
		'priority' => 100,
	) );
	$wp_customize->add_section( 'best_reloaded_home', array(
		'title' => __( 'Homepage', 'best-reloaded' ),
		'priority' => 100,
	) );
	$wp_customize->add_section( 'best_reloaded_other', array(
		'title' => __( 'Other', 'best-reloaded' ),
		'priority' => 100,
	) );
	$wp_customize->add_section( 'best_reloaded_basic', array(
		'title' => __( 'Basic', 'best-reloaded' ),
		'priority' => 100,
	) );

	$wp_customize->add_setting( 'display_header_banner_area', array(
		'default' => 0,
		'sanitize_callback' => 'best_reloaded_sanitize_checkbox',

	) );
	$wp_customize->add_control( 'display_header_banner_area', array(
		'label' => __( 'Display Header Banner Area', 'best-reloaded' ),
		'description' => __( 'Toggle on/off the the header slot.', 'best-reloaded' ),
		'section' => 'header',
		'settings' => 'display_header_banner_area',
		'type' => 'checkbox',
	) );

	$wp_customize->add_setting( 'header_banner_area', array(
		'default' => '<!-- html accepted -->',
		'sanitize_callback' => 'best_reloaded_sanitize_textarea',

	) );
	$wp_customize->add_control( 'header_banner_area', array(
		'label' => __( 'Header Banner Area', 'best-reloaded' ),
		'description'	=> __( 'Enter the text you want to show in the header slot. Accepts some basic html.', 'best-reloaded' ),
		'section' => 'header',
		'settings' => 'header_banner_area',
		'type' => 'textarea',
	) );

	$wp_customize->add_setting( 'display_navbar_search', array(
		'default' => 1,
		'sanitize_callback' => 'best_reloaded_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'display_navbar_search', array(
		'label' => __( 'Toggle on/off the navbar search form. Checked = on', 'best-reloaded' ),
		'section' => 'best_reloaded_navbar',
		'settings' => 'display_navbar_search',
		'type' => 'checkbox',
	) );
	$wp_customize->add_setting( 'display_navbar_brand', array(
		'default' => 0,
		'sanitize_callback' => 'best_reloaded_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'display_navbar_brand', array(
		'label' => __( 'Enable the navbar branding options which can be a small image and the site-title.', 'best-reloaded' ),
		'section' => 'best_reloaded_navbar',
		'settings' => 'display_navbar_brand',
		'type' => 'checkbox',
	) );
	$wp_customize->add_setting( 'brand_image', array(
		'default' => '',
		'sanitize_callback' => 'best_reloaded_sanitize_image',
	) );
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'brand_image',
			array(
				'label'      => __( 'Add a brand image to the navbar.', 'best-reloaded' ),
				'section'    => 'best_reloaded_navbar',
				'settings'   => 'brand_image',
				'description' => __( 'Choose an image to use for brand image in navbar. It should be 30px X 30px. Leave empty for no image.', 'best-reloaded' ),
			)
		)
	);
	$wp_customize->add_setting( 'display_brand_text', array(
		'default' => 0,
		'sanitize_callback' => 'best_reloaded_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'display_brand_text', array(
		'label' => __( 'Select the checkbox to display the site title in the navbar as brand text.', 'best-reloaded' ),
		'section' => 'best_reloaded_navbar',
		'settings' => 'display_brand_text',
		'type' => 'checkbox',
	) );
	$wp_customize->add_setting( 'allow_long_brand', array(
		'default' => 0,
		'sanitize_callback' => 'best_reloaded_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'allow_long_brand', array(
		'label' => __( 'Very long titles break the default navbar layout, if you want to allow very long titles here then check this box. NOTE: You can also turn off the search form for more space.', 'best-reloaded' ),
		'section' => 'best_reloaded_navbar',
		'settings' => 'allow_long_brand',
		'type' => 'checkbox',
	) );

	$wp_customize->add_setting( 'display_intro_text', array(
		'default' => 1,
		'sanitize_callback' => 'best_reloaded_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'display_intro_text', array(
		'label' => __( 'Select the checkbox to display the homepage intro text, which appears above the slider on the homepage.', 'best-reloaded' ),
		'section' => 'best_reloaded_home',
		'settings' => 'display_intro_text',
		'type' => 'checkbox',
	) );

	$wp_customize->add_setting( 'intro_text', array(
		'default' => __( 'Welcome to our awesome site!<br/>This space is the perfect place to say a <a href="#">little something</a> about yourself.', 'best-reloaded' ),
		'sanitize_callback' => 'best_reloaded_sanitize_textarea',
	) );
	$wp_customize->add_control( 'intro_text', array(
		'label' => __( 'Homepage Intro Text', 'best-reloaded' ),
		'section' => 'best_reloaded_home',
		'settings' => 'intro_text',
		'type' => 'textarea',
	) );

	$wp_customize->add_setting( 'slider_limit', array(
		'default' => 3,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'slider_limit', array(
		'label' => __( 'Homepage Slider', 'best-reloaded' ),
		'section' => 'best_reloaded_home',
		'settings' => 'slider_limit',
		'type' => 'text',
	) );

	$wp_customize->add_setting( 'slider_category', array(
		'default' => '',
		'sanitize_callback' => 'theme_slug_sanitize_select',
	) );

	$wp_customize->add_control( 'slider_category', array(
		'label' => __( 'Category For Slider (leave empty for all)', 'best-reloaded' ),
		'section' => 'best_reloaded_home',
		'type' => 'select',
		'choices' => best_reloaded_get_categories(),
	) );

	$wp_customize->add_setting( 'display_homepage_widget_row', array(
		'default' => 1,
		'sanitize_callback' => 'best_reloaded_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'display_homepage_widget_row', array(
		'label' => __( 'Display Homepage Widget Row', 'best-reloaded' ),
		'section' => 'best_reloaded_home',
		'settings' => 'display_homepage_widget_row',
		'type' => 'checkbox',
	) );

	$wp_customize->add_setting( 'display_featured_bar', array(
		'default' => 0,
		'sanitize_callback' => 'best_reloaded_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'display_featured_bar', array(
		'label' => __( 'Display Featured Content Bar', 'best-reloaded' ),
		'section' => 'best_reloaded_other',
		'settings' => 'display_featured_bar',
		'type' => 'checkbox',
	) );

	$wp_customize->add_setting( 'featured_bar', array(
		'default' => __( 'Something Important (set background color, image, text, and <a href="#">link</a>)', 'best-reloaded' ),
		'sanitize_callback' => 'best_reloaded_sanitize_textarea',
	) );
	$wp_customize->add_control( 'featured_bar', array(
		'label' => __( 'Feature Bar Content', 'best-reloaded' ),
		'section' => 'best_reloaded_other',
		'settings' => 'featured_bar',
		'type' => 'textarea',
	) );

	$wp_customize->add_setting( 'display_footer_top', array(
		'default' => 1,
		'sanitize_callback' => 'best_reloaded_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'display_footer_top', array(
		'label' => __( 'Display Footer Top', 'best-reloaded' ),
		'section' => 'best_reloaded_footer',
		'settings' => 'display_footer_top',
		'type' => 'checkbox',
	) );

	$wp_customize->add_setting( 'display_footer_bottom', array(
		'default' => 1,
		'sanitize_callback' => 'best_reloaded_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'display_footer_bottom', array(
		'label' => __( 'Display Footer Bottom', 'best-reloaded' ),
		'section' => 'best_reloaded_footer',
		'settings' => 'display_footer_bottom',
		'type' => 'checkbox',
	) );

	$wp_customize->add_setting( 'footer_bottom_tagline', array(
		'sanitize_callback' => 'best_reloaded_sanitize_textarea',
		// translators: 1 is current year, 2 is site name.
		'default' => sprintf( __( '&copy; %1$s %2$s', 'best-reloaded' ), date_i18n( __( 'Y', 'best-reloaded' ) ), get_bloginfo( 'name' ) ),
	) );
	$wp_customize->add_control( 'footer_bottom_tagline', array(
		'label' => __( 'Footer Bottom Tagline', 'best-reloaded' ),
		'section' => 'best_reloaded_footer',
		'settings' => 'footer_bottom_tagline',
		'type' => 'textarea',
	) );

}

/**
 * Build an array of categories.
 *
 * @return array of site categories as a `term_id` => `name` array.
 */
function best_reloaded_get_categories() {
	// get all the categories.
	$categories = get_categories();
	$categories_array = [];
	// loop though categories and store key as `term_id` and value as `name`.
	foreach ( $categories as $category ) {
		$categories_array[ $category->term_id ] = $category->name;
	}
	// return an array of categories, otherwise empty array.
	return $categories_array;
}

/**
 * Sanitization for textarea field against list of allwed tags in posts.
 *
 * @param string $input 	text area string to sanitize.
 *
 * @return string $output 	sanitized string.
 */
function best_reloaded_sanitize_textarea( $input ) {
	global $allowedposttags;
	$output = wp_kses( $input, $allowedposttags );
	return $output;
}

/**
 * Sanitization for checkbox input
 *
 * @param booleen $input	we either have a value or it's empty to depeict
 *                       	a checkbox state.
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
 * @param  string $input	This should be a direct url to an image file.
 *
 * @return string          	Return an excaped url to a file.
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
