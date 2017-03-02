<?php
 /**
  * customizer.php
  * Adds the themes options to the customizer
  *
  * @package WordPress
  * @subpackage Best_Reloaded
  * @since Best Reloaded 0.7
  */
add_action( 'customize_register', 'best_reloaded_customizer' );
function best_reloaded_customizer($wp_customize){

	$wp_customize->add_section( 'best_reloaded_header', array(
        'title' => __( 'Header', 'best-reloaded' ),
        'priority' => 100
    ) );
    $wp_customize->add_section( 'best_reloaded_footer', array(
        'title' => __( 'Footer', 'best-reloaded' ),
        'priority' => 100
    ) );
    $wp_customize->add_section( 'best_reloaded_home', array(
        'title' => __( 'Homepage', 'best-reloaded' ),
        'priority' => 100
    ) );
    $wp_customize->add_section( 'best_reloaded_other', array(
        'title' => __( 'Other', 'best-reloaded' ),
        'priority' => 100
    ) );
 	$wp_customize->add_section( 'best_reloaded_basic', array(
 		'title' => __( 'Basic', 'best-reloaded' ),
 		'priority' => 100
 	) );

	$wp_customize->add_setting( 'bestreloaded_display_header_banner_area', array(
        'default' => 0,
        'sanitize_callback' => 'bestreloaded_sanitize_checkbox',
        'type' => 'theme_mod'
    ) );
    $wp_customize->add_control( 'bestreloaded_display_header_banner_area', array(
        'label' => __('Display Header Banner Area', 'best-reloaded'),
		'description' => __('Toggle on/off the the header slot.'),
        'section' => 'best_reloaded_header',
        'settings' => 'bestreloaded_display_header_banner_area',
        'type' => 'checkbox'
    ) );

   $wp_customize->add_setting( 'bestreloaded_header_banner_area', array(
       'default' => '<!-- html accepted -->',
       'sanitize_callback' => 'bestreloaded_sanitize_textarea',
       'type' => 'theme_mod'
   ) );
   $wp_customize->add_control( 'bestreloaded_header_banner_area', array(
       'label' => __('Header Banner Area', 'best-reloaded'),
	   'description'	=> __('Enter the text you want to show in the header slot. Accepts some basic html.'),
       'section' => 'best_reloaded_header',
       'settings' => 'bestreloaded_header_banner_area',
       'type' => 'textarea'
   ) );

   $wp_customize->add_setting( 'bestreloaded_display_intro_text', array(
       'default' => 1,
       'sanitize_callback' => 'bestreloaded_sanitize_checkbox',
       'type' => 'theme_mod'
   ) );
   $wp_customize->add_control( 'bestreloaded_display_intro_text', array(
       'label' => __('Select the checkbox to display the homepage intro text, which appears above the slider on the homepage.', 'best-reloaded'),
       'section' => 'best_reloaded_home',
       'settings' => 'bestreloaded_display_intro_text',
       'type' => 'checkbox'
   ) );

   $wp_customize->add_setting( 'bestreloaded_intro_text', array(
       'default' => __('Welcome to our awesome site!<br/>This space is the perfect place to say a <a href="#">little something</a> about yourself.', 'best-reloaded' ),
       'sanitize_callback' => 'bestreloaded_sanitize_textarea',
       'type' => 'theme_mod'
   ) );
   $wp_customize->add_control( 'bestreloaded_intro_text', array(
       'label' => __('Homepage Intro Text', 'best-reloaded'),
       'section' => 'best_reloaded_home',
       'settings' => 'bestreloaded_intro_text',
       'type' => 'textarea'
   ) );

   $wp_customize->add_setting( 'bestreloaded_display_homepage_widget_row', array(
       'default' => 1,
       'sanitize_callback' => 'bestreloaded_sanitize_checkbox',
       'type' => 'theme_mod'
   ) );
   $wp_customize->add_control( 'bestreloaded_display_homepage_widget_row', array(
       'label' => __('Display Homepage Widget Row', 'best-reloaded'),
       'section' => 'best_reloaded_home',
       'settings' => 'bestreloaded_display_homepage_widget_row',
       'type' => 'checkbox'
   ) );

   $wp_customize->add_setting( 'bestreloaded_display_featured_bar', array(
       'default' => 0,
       'sanitize_callback' => 'bestreloaded_sanitize_checkbox',
       'type' => 'theme_mod'
   ) );
   $wp_customize->add_control( 'bestreloaded_display_featured_bar', array(
       'label' => __('Display Featured Content Bar', 'best-reloaded'),
       'section' => 'best_reloaded_other',
       'settings' => 'bestreloaded_display_featured_bar',
       'type' => 'checkbox'
   ) );

   $wp_customize->add_setting( 'bestreloaded_featured_bar', array(
       'default' => __('Something Important (set background color, image, text, and <a href="#">link</a>)', 'best-reloaded' ),
       'sanitize_callback' => 'bestreloaded_sanitize_textarea',
       'type' => 'theme_mod'
   ) );
   $wp_customize->add_control( 'bestreloaded_featured_bar', array(
       'label' => __('Feature Bar Content', 'best-reloaded'),
       'section' => 'best_reloaded_other',
       'settings' => 'bestreloaded_featured_bar',
       'type' => 'textarea'
   ) );

   $wp_customize->add_setting( 'bestreloaded_display_footer_top', array(
       'default' => 1,
       'sanitize_callback' => 'bestreloaded_sanitize_checkbox',
       'type' => 'theme_mod'
   ) );
   $wp_customize->add_control( 'bestreloaded_display_footer_top', array(
       'label' => __('Display Footer Top', 'best-reloaded'),
       'section' => 'best_reloaded_footer',
       'settings' => 'bestreloaded_display_footer_top',
       'type' => 'checkbox'
   ) );

   $wp_customize->add_setting( 'bestreloaded_display_footer_bottom', array(
       'default' => 1,
       'sanitize_callback' => 'bestreloaded_sanitize_checkbox',
       'type' => 'theme_mod'
   ) );
   $wp_customize->add_control( 'bestreloaded_display_footer_bottom', array(
       'label' => __('Display Footer Bottom', 'best-reloaded'),
       'section' => 'best_reloaded_footer',
       'settings' => 'bestreloaded_display_footer_bottom',
       'type' => 'checkbox'
   ) );

   $wp_customize->add_setting( 'bestreloaded_footer_bottom_tagline', array(
	   'sanitize_callback' => 'bestreloaded_sanitize_textarea',
       'default' => __('&copy; 2017 <a href="#">Site Title</a>', 'best-reloaded'),
       'type' => 'theme_mod'
   ) );
   $wp_customize->add_control( 'bestreloaded_footer_bottom_tagline', array(
       'label' => __('Footer Bottom Tagline', 'best-reloaded'),
       'section' => 'best_reloaded_footer',
       'settings' => 'bestreloaded_footer_bottom_tagline',
       'type' => 'textarea'
   ) );

}

// Sanitization functions

/**
 * Sanitization for textarea field
 *
 * @param $input string
 * @return $output sanitized string
 */
function bestreloaded_sanitize_textarea( $input ) {
	global $allowedposttags;
	$output = wp_kses( $input, $allowedposttags );
	return $output;
}
add_filter( 'bestreloaded_sanitize_textarea', 'bestreloaded_sanitize_textarea' );

/**
 * Sanitization for checkbox input
 *
 * @param $input string (1 or empty) checkbox state
 * @return $output '1' or false
 */
function bestreloaded_sanitize_checkbox( $input ) {
	if ( $input ) {
		$output = '1';
	} else {
		$output = false;
	}
	return $output;
}
add_filter( 'bestreloaded_sanitize_checkbox', 'bestreloaded_sanitize_checkbox' );
