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
require_once( trailingslashit( get_template_directory() ) . 'inc/customizer/upsell/class-customize.php' );

add_action( 'customize_register', 'best_reloaded_customizer' );

/**
 * Function to add customizer panels, settings, controls.
 *
 * @param  object $wp_customize	Customizer object to update.
 */
function best_reloaded_customizer( $wp_customize ) {

	// get the defaults from a function that returns a maybe filtered array.
	$defaults = best_reloaded_setting_defaults();

	// Navbar options.
	$wp_customize->add_setting( 'navbar_style', array(
		'default' 			=> $defaults['navbar_style'],
		'sanitize_callback' => 'best_reloaded_sanitize_navbar_style',
	) );
	$wp_customize->add_control( 'navbar_style', array(
		'label' 		=> __( 'Navbar Style', 'best-reloaded' ),
		'description' 	=> __( 'Select the style of navbar you want.', 'best-reloaded' ),
		'section' 		=> 'best_reloaded_navbar',
		'type' 			=> 'select',
		'choices' 		=> best_reloaded_get_navbar_styles(),
	) );
	$wp_customize->add_setting( 'navbar-color', array(
		'default' 			=> $defaults['navbar-color'],
		'sanitize_callback' => 'best_reloaded_sanitize_select',
	) );
	$wp_customize->add_control( 'navbar-color', array(
		'label' 		=> __( 'Navbar Text Color', 'best-reloaded' ),
		'description' 	=> __( 'Select the color items in the navbar.', 'best-reloaded' ),
		'section' 		=> 'best_reloaded_navbar',
		'type' 			=> 'select',
		'choices' 		=> best_reloaded_get_navbar_colors(),
	) );
	$wp_customize->add_setting( 'navbar-bg', array(
		'default' 			=> $defaults['navbar-bg'],
		'sanitize_callback' => 'best_reloaded_sanitize_select',
	) );
	$wp_customize->add_control( 'navbar-bg', array(
		'label' 		=> __( 'Navbar Color', 'best-reloaded' ),
		'description' 	=> __( 'Select the color of navbar you want.', 'best-reloaded' ),
		'section' 		=> 'best_reloaded_navbar',
		'type' 			=> 'select',
		'choices' 		=> best_reloaded_get_navbar_bgs(),
	) );

	$wp_customize->add_setting( 'display_navbar_search', array(
		'default' 			=> $defaults['display_navbar_search'],
		'sanitize_callback' => 'best_reloaded_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'display_navbar_search', array(
		'label' 		=> __( 'Toggle on/off the navbar search form.', 'best-reloaded' ),
		'description' 	=> __( 'Search form appears on right side of navbar.', 'best-reloaded' ),
		'section' 		=> 'best_reloaded_navbar',
		'settings' 		=> 'display_navbar_search',
		'type' 			=> 'checkbox',
	) );

	$wp_customize->add_setting( 'search_color', array(
		'default' 			=> $defaults['search_color'],
		'sanitize_callback' => 'best_reloaded_sanitize_select',
	) );
	$wp_customize->add_control( 'search_color', array(
		'label' 		=> __( 'Search Color', 'best-reloaded' ),
		'description' 	=> __( 'Select the color of search you want.', 'best-reloaded' ),
		'section' 		=> 'best_reloaded_navbar',
		'type' 			=> 'select',
		'choices' 		=> best_reloaded_get_search_colors(),
	) );

	$wp_customize->add_setting( 'display_navbar_brand', array(
		'default' 			=> $defaults['display_navbar_brand'],
		'sanitize_callback' => 'best_reloaded_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'display_navbar_brand', array(
		'label' 		=> __( 'Enable the navbar brand.', 'best-reloaded' ),
		'description' 	=> __( 'Branding options can be a small image and the site-title', 'best-reloaded' ),
		'section' 		=> 'best_reloaded_navbar',
		'settings' 		=> 'display_navbar_brand',
		'type' 			=> 'checkbox',
	) );

	$wp_customize->add_setting( 'brand_image', array(
		'default' 			=> $defaults['brand_image'],
		'sanitize_callback' => 'best_reloaded_sanitize_image',
	) );
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'brand_image',
			array(
				'label'			=> __( 'Add a brand image to the navbar.', 'best-reloaded' ),
				'section' 		=> 'best_reloaded_navbar',
				'settings' 		=> 'brand_image',
				'description' 	=> __( 'Choose an image to use for brand image in navbar. It should be 30px X 30px. Leave empty for no image.', 'best-reloaded' ),
			)
		)
	);

	$wp_customize->add_setting( 'display_brand_text', array(
		'default' 			=> $defaults['display_brand_text'],
		'sanitize_callback' => 'best_reloaded_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'display_brand_text', array(
		'label' 	=> __( 'Display the site title in the navbar as brand text.', 'best-reloaded' ),
		'section' 	=> 'best_reloaded_navbar',
		'settings' 	=> 'display_brand_text',
		'type' 		=> 'checkbox',
	) );

	$wp_customize->add_setting( 'allow_long_brand', array(
		'default' 			=> $defaults['allow_long_brand'],
		'sanitize_callback' => 'best_reloaded_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'allow_long_brand', array(
		'label'			=> __( 'Allow Long Titles', 'best-reloaded' ),
		'description' 	=> __( 'Very long titles break the default navbar layout, if you want to allow very long titles here then check this box. NOTE: You can also turn off the search form for more space.', 'best-reloaded' ),
		'section' 		=> 'best_reloaded_navbar',
		'settings' 		=> 'allow_long_brand',
		'type' 			=> 'checkbox',
	) );

	// site title section options.
	$wp_customize->add_setting( 'small_site_title', array(
		'default' 			=> $defaults['small_site_title'],
		'sanitize_callback' => 'best_reloaded_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'small_site_title', array(
		'label' 		=> __( 'Use smaller font-size for site title.', 'best-reloaded' ),
		'description' 	=> __( 'Note: this is already applied automattically for titles that are too large for the bigger font-size.', 'best-reloaded' ),
		'section' 		=> 'best_reloaded_header',
		'settings' 		=> 'small_site_title',
		'type' 			=> 'checkbox',
	) );

	$wp_customize->add_setting( 'display_header_banner_area', array(
		'default' 			=> $defaults['display_header_banner_area'],
		'sanitize_callback' => 'best_reloaded_sanitize_checkbox',

	) );
	$wp_customize->add_control( 'display_header_banner_area', array(
		'label' 		=> __( 'Display Header Banner Area', 'best-reloaded' ),
		'description' 	=> __( 'Toggle on/off the the header banner slot.', 'best-reloaded' ),
		'section' 		=> 'best_reloaded_header',
		'settings' 		=> 'display_header_banner_area',
		'type' 			=> 'checkbox',
	) );

	$wp_customize->add_setting( 'header_banner_area', array(
		'default' 			=> $defaults['header_banner_area'],
		'sanitize_callback' => 'best_reloaded_sanitize_textarea',

	) );
	$wp_customize->add_control( 'header_banner_area', array(
		'label' 		=> __( 'Header Banner Area', 'best-reloaded' ),
		'description' 	=> __( 'Enter the text you want to show in the header slot. Accepts some basic html.', 'best-reloaded' ),
		'section' 		=> 'best_reloaded_header',
		'settings' 		=> 'header_banner_area',
		'type' 			=> 'textarea',
	) );

	// Frontpage specific options.
	$wp_customize->add_setting( 'display_intro_text', array(
		'default' 			=> $defaults['display_intro_text'],
		'sanitize_callback' => 'best_reloaded_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'display_intro_text', array(
		'label' 		=> __( 'Display the frontpage intro text.', 'best-reloaded' ),
		'description' 	=> __( 'This intro text is unique to the frontpage.', 'best-reloaded' ),
		'section' 		=> 'best_reloaded_frontpage',
		'settings' 		=> 'display_intro_text',
		'type' 			=> 'checkbox',
	) );

	$wp_customize->add_setting( 'intro_text', array(
		'default' 			=> $defaults['intro_text'],
		'sanitize_callback' => 'best_reloaded_sanitize_textarea',
	) );
	$wp_customize->add_control( 'intro_text', array(
		'label' 	=> __( 'Frontpage Intro Text', 'best-reloaded' ),
		'section' 	=> 'best_reloaded_frontpage',
		'settings' 	=> 'intro_text',
		'type' 		=> 'textarea',
	) );

	$wp_customize->add_setting( 'display_homepage_widget_row', array(
		'default' 			=> $defaults['display_homepage_widget_row'],
		'sanitize_callback' => 'best_reloaded_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'display_homepage_widget_row', array(
		'label' 		=> __( 'Display Frontpage Widget Row', 'best-reloaded' ),
		'description' 	=> __( 'A additional row of widgets can be output on the frontapge.', 'best-reloaded' ),
		'section' 		=> 'best_reloaded_frontpage',
		'settings' 		=> 'display_homepage_widget_row',
		'type' 			=> 'checkbox',
	) );

	// Slider options.
	$wp_customize->add_setting( 'slider_limit', array(
		'default' 			=> $defaults['slider_limit'],
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'slider_limit', array(
		'label' 		=> __( 'Number of Slides', 'best-reloaded' ),
		'description' 	=> __( 'Set the number of slides you want to appear in the slider.', 'best-reloaded' ),
		'section' 		=> 'best_reloaded_slider',
		'settings' 		=> 'slider_limit',
		'type' 			=> 'text',
	) );

	$wp_customize->add_setting( 'slider_category', array(
		'default' 			=> $defaults['slider_category'],
		'sanitize_callback' => 'best_reloaded_sanitize_cetegory_select',
	) );

	$wp_customize->add_control( 'slider_category', array(
		'label' 		=> __( 'Category For Slider', 'best-reloaded' ),
		'description' 	=> __( 'Choose the category to output for the slider.', 'best-reloaded' ),
		'section' 		=> 'best_reloaded_slider',
		'type' 			=> 'select',
		'choices' 		=> best_reloaded_get_categories(),
	) );

	// Other sitewide options.
	$wp_customize->add_setting( 'display_featured_bar', array(
		'default' 			=> $defaults['display_featured_bar'],
		'sanitize_callback' => 'best_reloaded_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'display_featured_bar', array(
		'label' 	=> __( 'Display Featured Content Bar', 'best-reloaded' ),
		'section' 	=> 'best_reloaded_other',
		'settings' 	=> 'display_featured_bar',
		'type' 		=> 'checkbox',
	) );

	$wp_customize->add_setting( 'featured_bar', array(
		'default' 			=> $defaults['featured_bar'],
		'sanitize_callback' => 'best_reloaded_sanitize_textarea',
	) );
	$wp_customize->add_control( 'featured_bar', array(
		'label' 	=> __( 'Feature Bar Content', 'best-reloaded' ),
		'section' 	=> 'best_reloaded_other',
		'settings' 	=> 'featured_bar',
		'type' 		=> 'textarea',
	) );

	// Footer section options.
	$wp_customize->add_setting( 'display_footer_top', array(
		'default' 			=> $defaults['display_footer_top'],
		'sanitize_callback' => 'best_reloaded_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'display_footer_top', array(
		'label' 		=> __( 'Display Footer Top', 'best-reloaded' ),
		'description' 	=> __( 'Display the footer widget row.', 'best-reloaded' ),
		'section' 		=> 'best_reloaded_footer',
		'settings' 		=> 'display_footer_top',
		'type' 			=> 'checkbox',
	) );

	$wp_customize->add_setting( 'display_footer_bottom', array(
		'default' 			=> $defaults['display_footer_bottom'],
		'sanitize_callback' => 'best_reloaded_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'display_footer_bottom', array(
		'label' 		=> __( 'Display Footer Bottom', 'best-reloaded' ),
		'description' 	=> __( 'Displays the footer bottom row with the tagline or copyrights and the footer nav.', 'best-reloaded' ),
		'section' 		=> 'best_reloaded_footer',
		'settings' 		=> 'display_footer_bottom',
		'type' 			=> 'checkbox',
	) );

	$wp_customize->add_setting( 'footer_bottom_tagline', array(
		'default' 			=> $defaults['footer_bottom_tagline'],
		'sanitize_callback' => 'best_reloaded_sanitize_textarea',
	) );
	$wp_customize->add_control( 'footer_bottom_tagline', array(
		'label' 	=> __( 'Footer Text', 'best-reloaded' ),
		'section' 	=> 'best_reloaded_footer',
		'settings' 	=> 'footer_bottom_tagline',
		'type' 		=> 'textarea',
	) );

	$wp_customize->add_setting( 'layout_selection', array(
		'default' 			=> $defaults['layout_selection'],
		'sanitize_callback' => 'best_reloaded_sanitize_layout_selection',
	) );

	$wp_customize->add_control( 'layout_selection', array(
		'label' 		=> __( 'Layout Selection', 'best-reloaded' ),
		'description' 	=> __( 'Choose the layout you want the site to follow.', 'best-reloaded' ),
		'section' 		=> 'best_reloaded_other',
		'type' 			=> 'radio',
		'choices' 		=> best_reloaded_get_layout_styles(),
	) );

	$wp_customize->add_setting( 'enable_font-awesome', array(
		'default' 			=> $defaults['enable_font-awesome'],
		'sanitize_callback' => 'best_reloaded_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'enable_font-awesome', array(
		'label' 		=> __( 'Enable Font-Awesome.', 'best-reloaded' ),
		'description' 	=> __( 'Includes the Font-Awesome css and fonts.', 'best-reloaded' ),
		'section' 		=> 'best_reloaded_misc',
		'settings' 		=> 'enable_font-awesome',
		'type' 			=> 'checkbox',
	) );

	$wp_customize->add_setting( 'enable_slim_mode', array(
		'default' 			=> $defaults['enable_slim_mode'],
		'sanitize_callback' => 'best_reloaded_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'enable_slim_mode', array(
		'label' 		=> __( 'Enable Slim Mode.', 'best-reloaded' ),
		'description' 	=> __( 'Slim mode uses css and js files that have some features not used in the theme removed. By default the full Bootstrap is included.', 'best-reloaded' ),
		'section' 		=> 'best_reloaded_misc',
		'settings' 		=> 'enable_slim_mode',
		'type' 			=> 'checkbox',
	) );

}
