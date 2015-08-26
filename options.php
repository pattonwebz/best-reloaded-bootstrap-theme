<?php
/**
 * options.php
 * Adds these settings in a theme options admin page
 *
 * @package WordPress
 * @subpackage Best_Reloaded
 * @since Best Reloaded 0.1
 */

 /**
  * A unique identifier is defined to store the options in the database and reference them from the theme.
  */
 function optionsframework_option_name() {
 	// Change this to use your theme slug
 	return 'best_reloaded';
 }

 /**
  * Defines an array of options that will be used to generate the settings page and be saved in the database.
  * When creating the 'id' fields, make sure to use all lowercase and no spaces.
  */
function optionsframework_options() {

    // Pull all the categories into an array
    $options_categories = array();
    $options_categories_obj = get_categories();
    foreach ($options_categories_obj as $category) {
        $options_categories[$category->cat_ID] = $category->cat_name;
    }

    // Pull all the pages into an array
    $options_pages = array();
    $options_pages_obj = get_pages('sort_column=post_parent,menu_order');
    $options_pages[''] = 'Select a page:';
    foreach ($options_pages_obj as $page) {
        $options_pages[$page->ID] = $page->post_title;
    }

    // Background Defaults
    $background_defaults = array(
        'color' => '',
        'image' => '',
        'repeat' => 'repeat',
        'position' => 'top center',
        'attachment' => 'scroll'
    );

    $options = array();

    $options[] = array(
        'name' => 'Layout Options',
        'type' => 'heading'
    );

    $options['bestreloaded_display_header_banner_area'] = array(
        'name' => 'Display Header Banner Area',
        'desc' => 'Select the checkbox to display the header banner area. You can use this space to display an advertisement, or type in text if desired. This space is unstyled so you will need to write your own HTML markup for any paragraphs, headings, et cetera.\n Future plans: To enable an optional login area.',
        'id' => 'bestreloaded_display_header_banner_area',
        'std' => 0,
        'type' => 'checkbox'
    );

    $options['bestreloaded_header_banner_area'] = array(
        'name' => 'Header Banner Area',
        'desc' => 'Enter in your content for the header banner area.',
        'id' => 'bestreloaded_header_banner_area',
        'std' => '<!-- html accepted -->',
        'class' => 'hidden',
        'type' => 'textarea'
    );

    $options['bestreloaded_display_intro_text'] = array(
        'name' => 'Display Homepage Intro Text',
        'desc' => 'Select the checkbox to display the homepage intro text, which appears above the slider on the homepage.',
        'id' => 'bestreloaded_display_intro_text',
        'std' => 1,
        'type' => 'checkbox'
    );

    $options['bestreloaded_intro_text'] = array(
        'name' => 'Homepage Intro Text',
        'desc' => 'Enter a brief introduction about your site, which will display on the homepage above the slider. This section supports HTML tags if desired. This text is wrapped in a paragraph element for formatting.',
        'id' => 'bestreloaded_intro_text',
        'std' => 'Welcome to our awesome site!<br/>This space is the perfect place to say a <a href="#">little something</a> about yourself.',
        'class' => 'hidden',
        'type' => 'textarea'
    );

    $options['bestreloaded_display_homepage_widget_row'] = array(
        'name' => 'Display Homepage Widget Row',
        'desc' => 'Select the checkbox to display the homepage widget row, which allows you to place three widgets in line below the slider.',
        'id' => 'bestreloaded_display_homepage_widget_row',
        'std' => 1,
        'type' => 'checkbox'
    );

    $options['bestreloaded_display_featured_bar'] = array(
        'name' => 'Display Featured Content Bar',
        'desc' => 'Select the checkbox to display the featured content bar, which appears at the top of your inner pages throughout the site. This section is perfect for marketing and promotions purposes. There is 4 of these and you can override them using custom metas. You can override these using a custom meta.',
        'id' => 'bestreloaded_display_featured_bar',
        'std' => 0,
        'type' => 'checkbox'
    );

    $options['bestreloaded_featured_bar'] = array(
        'name' => 'Featured Content Bar Text',
        'desc' => 'This section supports HTML tags if desired.',
        'id' => 'bestreloaded_featured_bar',
        'std' => 'Something Important (set background color, image, text, and <a href="#">link</a>)',
        'class' => 'hidden',
        'type' => 'textarea'
    );

    $options['bestreloaded_display_twitter'] = array(
        'name' => 'Display Twitter Integration - currently inactive',
        'desc' => 'This section used to be used to display the Twitter integration above the footer but due to changes in the Twitter API it stopped functioning. Plans are to reuse as another featured slot or optin section.',
        'id' => 'bestreloaded_display_twitter',
        'std' => 0,
        'type' => 'checkbox'
    );

    $options['bestreloaded_twitter'] = array(
        'name' => 'Twitter Username',
        'desc' => 'Enter your Twitter username to have your latest tweet displayed above the footer.',
        'id' => 'bestreloaded_twitter',
        'std' => 'will_patton_88',
        'class' => 'hidden mini',
        'type' => 'text'
    );

    $options['bestreloaded_display_footer_top'] = array(
        'name' => 'Display Footer Top',
        'desc' => 'Select the checkbox to display the top section of the footer, which contains widget areas.',
        'id' => 'bestreloaded_display_footer_top',
        'std' => 1,
        'type' => 'checkbox'
    );

    $options['bestreloaded_display_footer_bottom'] = array(
        'name' => 'Display Footer Bottom',
        'desc' => 'Select the checkbox to display the bottom section of the footer, which contains a space for a tagline and a menu.',
        'id' => 'bestreloaded_display_footer_bottom',
        'std' => 1,
        'type' => 'checkbox'
    );

    $options['bestreloaded_footer_bottom_tagline'] = array(
        'name' => 'Footer Bottom Tagline',
        'desc' => 'Enter a brief tagline about your site, which will display on the left side of the bottom section of the footer. This section supports HTML tags if desired. This text is wrapped in a paragraph element for formatting.',
        'id' => 'bestreloaded_footer_bottom_tagline',
        'std' => '&copy; 2014-2015 <a href="http://www.pattonwebz.com/">PattonWebz</a>',
        'class' => 'hidden',
        'type' => 'textarea'
    );

    $options[] = array(
        'name' => 'Skin',
        'type' => 'heading'
    );

    $options['bestreloaded_site_heading_img_checkbox'] = array(
        'name' => 'Site Heading Title',
        'desc' => 'Selecting this checkbox provides an option to upload an image for your site heading. Leaving it blank will automatically display the site name and description.',
        'id' => 'bestreloaded_site_heading_img_checkbox',
        'std' => 0,
        'type' => 'checkbox'
    );

    $options['site_heading_img'] = array(
        'name' => 'Logo Uploader',
        'id' => 'site_heading_img',
        'class' => 'hidden',
        'type' => 'upload'
    );

    $options['bestreloaded_background'] = array(
        'name' => 'Site Background',
        'desc' => 'Select your background options for the theme.',
        'id' => 'bestreloaded_background',
        'std' => $background_defaults,
        'type' => 'background'
    );

    $options['bestreloaded_link_color_main'] = array(
        'name' => 'Main Link Color',
        'desc' => 'Select a main link color for the theme.',
        'id' => 'bestreloaded_link_color_main',
        'std' => '',
        'type' => 'color'
    );

    $options['bestreloaded_link_hover_color_main'] = array(
        'name' => 'Main Link Hover Color',
        'desc' => 'Select a main link hover color for the theme.',
        'id' => 'bestreloaded_link_hover_color_main',
        'std' => '',
        'type' => 'color'
    );

    $options['bestreloaded_link_color_footer'] = array(
        'name' => 'Footer Link Color',
        'desc' => 'Select a footer link color for the theme.',
        'id' => 'bestreloaded_link_color_footer',
        'std' => '',
        'type' => 'color'
    );

    $options['bestreloaded_link_hover_color_footer'] = array(
        'name' => 'Footer Link Hover Color',
        'desc' => 'Select a footer link hover color for the theme.',
        'id' => 'bestreloaded_link_hover_color_footer',
        'std' => '',
        'type' => 'color'
    );

    $options['bestreloaded_background_featured_content'] = array(
        'name' => 'Featured Content Bar Background',
        'desc' => 'Select the background color and/or image for the featured content bar.',
        'id' => 'bestreloaded_background_featured_content',
        'std' => $background_defaults,
        'type' => 'background'
    );

    $options['bestreloaded_text_color_featured_content'] = array(
        'name' => 'Featured Content Bar Text Color',
        'desc' => 'Select the text color for the featured content bar.',
        'id' => 'bestreloaded_text_color_featured_content',
        'std' => '',
        'type' => 'color'
    );

    $options['bestreloaded_link_color_featured_content'] = array(
        'name' => 'Featured Content Bar Link Color',
        'desc' => 'Select the link color for the featured content bar.',
        'id' => 'bestreloaded_link_color_featured_content',
        'std' => '',
        'type' => 'color'
    );

    $options['bestreloaded_link_hover_color_featured_content'] = array(
        'name' => 'Featured Content Bar Link Hover Color',
        'desc' => 'Select the link hover color for the featured content bar.',
        'id' => 'bestreloaded_link_hover_color_featured_content',
        'std' => '',
        'type' => 'color'
    );

    return $options;
}

/**
 * Front End Customizer
 *
 * WordPress 3.4 Required
 * @package WordPress
 * @subpackage Best_Reloaded
 * @since Best Reloaded 0.5
 */

add_action( 'customize_register', 'best_reloaded_register' );
function best_reloaded_register($wp_customize) {

    // Loads file that contains sanitization functions
    require_once dirname( __FILE__ ) . '/inc/includes/class-options-sanitization.php';

    class PWWP_Customize_Textarea_Control extends WP_Customize_Control {
        public $type = 'textarea';

        public function render_content() {
        ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
            </label>
        <?php
        }
    }
 	/**
 	 * This is optional, but if you want to reuse some of the defaults
 	 * or values you already have built in the options panel, you
 	 * can load them into $options for easy reference
 	 */

 	$options = optionsframework_options();

    $wp_customize->add_section( 'best_reloaded_header', array(
        'title' => __( 'Header', 'best_reloaded' ),
        'priority' => 100
    ) );
    $wp_customize->add_section( 'best_reloaded_footer', array(
        'title' => __( 'Footer', 'best_reloaded' ),
        'priority' => 100
    ) );
    $wp_customize->add_section( 'best_reloaded_home', array(
        'title' => __( 'Homepage', 'best_reloaded' ),
        'priority' => 100
    ) );
    $wp_customize->add_section( 'best_reloaded_other', array(
        'title' => __( 'Other', 'best_reloaded' ),
        'priority' => 100
    ) );
 	$wp_customize->add_section( 'best_reloaded_basic', array(
 		'title' => __( 'Basic', 'best_reloaded' ),
 		'priority' => 100
 	) );

    $wp_customize->add_setting( 'best_reloaded[bestreloaded_display_header_banner_area]', array(
        'default' => $options['bestreloaded_display_header_banner_area']['std'],
        'sanitize_callback' => 'of_sanitize_checkbox',
        'type' => 'option'
    ) );
    $wp_customize->add_control( 'best_reloaded_bestreloaded_display_header_banner_area', array(
        'label' => $options['bestreloaded_display_header_banner_area']['name'],
        'section' => 'best_reloaded_header',
        'settings' => 'best_reloaded[bestreloaded_display_header_banner_area]',
        'type' => $options['bestreloaded_display_header_banner_area']['type']
    ) );

   $wp_customize->add_setting( 'best_reloaded[bestreloaded_header_banner_area]', array(
       'default' => $options['bestreloaded_header_banner_area']['std'],
       'sanitize_callback' => 'of_sanitize_text',
       'type' => 'option'
   ) );
   $wp_customize->add_control( new PWWP_Customize_Textarea_Control( $wp_customize, 'best_reloaded_bestreloaded_header_banner_area', array(
       'label' => $options['bestreloaded_header_banner_area']['name'],
       'section' => 'best_reloaded_header',
       'settings' => 'best_reloaded[bestreloaded_header_banner_area]',
       'type' => $options['bestreloaded_header_banner_area']['type']
   ) ) );

   $wp_customize->add_setting( 'best_reloaded[bestreloaded_display_intro_text]', array(
       'default' => $options['bestreloaded_display_intro_text']['std'],
       'sanitize_callback' => 'of_sanitize_checkbox',
       'type' => 'option'
   ) );
   $wp_customize->add_control( 'best_reloaded_bestreloaded_display_intro_text', array(
       'label' => $options['bestreloaded_display_intro_text']['name'],
       'section' => 'best_reloaded_home',
       'settings' => 'best_reloaded[bestreloaded_display_intro_text]',
       'type' => $options['bestreloaded_display_intro_text']['type']
   ) );

   $wp_customize->add_setting( 'best_reloaded[bestreloaded_intro_text]', array(
       'default' => $options['bestreloaded_intro_text']['std'],
       'sanitize_callback' => 'of_sanitize_textarea',
       'type' => 'option'
   ) );
   $wp_customize->add_control( new PWWP_Customize_Textarea_Control( $wp_customize, 'best_reloaded_bestreloaded_intro_text', array(
       'label' => $options['bestreloaded_intro_text']['name'],
       'section' => 'best_reloaded_home',
       'settings' => 'best_reloaded[bestreloaded_intro_text]',
       'type' => $options['bestreloaded_intro_text']['type']
   ) ) );

   $wp_customize->add_setting( 'best_reloaded[bestreloaded_display_homepage_widget_row]', array(
       'default' => $options['bestreloaded_display_homepage_widget_row']['std'],
       'sanitize_callback' => 'of_sanitize_checkbox',
       'type' => 'option'
   ) );
   $wp_customize->add_control( 'best_reloaded_bestreloaded_display_homepage_widget_row', array(
       'label' => $options['bestreloaded_display_homepage_widget_row']['name'],
       'section' => 'best_reloaded_home',
       'settings' => 'best_reloaded[bestreloaded_display_homepage_widget_row]',
       'type' => $options['bestreloaded_display_homepage_widget_row']['type']
   ) );

   $wp_customize->add_setting( 'best_reloaded[bestreloaded_display_featured_bar]', array(
       'default' => $options['bestreloaded_display_featured_bar']['std'],
       'sanitize_callback' => 'of_sanitize_checkbox',
       'type' => 'option'
   ) );
   $wp_customize->add_control( 'bestreloaded_display_featured_bar', array(
       'label' => $options['bestreloaded_display_featured_bar']['name'],
       'section' => 'best_reloaded_other',
       'settings' => 'best_reloaded[bestreloaded_display_featured_bar]',
       'type' => $options['bestreloaded_display_featured_bar']['type']
   ) );

   $wp_customize->add_setting( 'best_reloaded[bestreloaded_featured_bar]', array(
       'default' => $options['bestreloaded_featured_bar']['std'],
       'sanitize_callback' => 'of_sanitize_textarea',
       'type' => 'option'
   ) );
   $wp_customize->add_control( new PWWP_Customize_Textarea_Control( $wp_customize, 'best_reloaded_bestreloaded_featured_bar', array(
       'label' => $options['bestreloaded_featured_bar']['name'],
       'section' => 'best_reloaded_other',
       'settings' => 'best_reloaded[bestreloaded_featured_bar]',
       'type' => $options['bestreloaded_featured_bar']['type']
   ) ) );

   $wp_customize->add_setting( 'best_reloaded[bestreloaded_display_footer_top]', array(
       'default' => $options['bestreloaded_display_footer_top']['std'],
       'sanitize_callback' => 'of_sanitize_checkbox',
       'type' => 'option'
   ) );
   $wp_customize->add_control( 'bestreloaded_display_footer_top', array(
       'label' => $options['bestreloaded_display_footer_top']['name'],
       'section' => 'best_reloaded_footer',
       'settings' => 'best_reloaded[bestreloaded_display_footer_top]',
       'type' => $options['bestreloaded_display_footer_top']['type']
   ) );

   $wp_customize->add_setting( 'best_reloaded[bestreloaded_display_footer_bottom]', array(
       'default' => $options['bestreloaded_display_footer_bottom']['std'],
       'sanitize_callback' => 'of_sanitize_checkbox',
       'type' => 'option'
   ) );
   $wp_customize->add_control( 'bestreloaded_display_footer_bottom', array(
       'label' => $options['bestreloaded_display_footer_bottom']['name'],
       'section' => 'best_reloaded_footer',
       'settings' => 'best_reloaded[bestreloaded_display_footer_bottom]',
       'type' => $options['bestreloaded_display_footer_bottom']['type']
   ) );

   $wp_customize->add_setting( 'best_reloaded[bestreloaded_footer_bottom_tagline]', array(
       'default' => $options['bestreloaded_footer_bottom_tagline']['std'],
       'sanitize_callback' => 'of_sanitize_textarea',
       'type' => 'option'
   ) );
   $wp_customize->add_control( new PWWP_Customize_Textarea_Control( $wp_customize, 'best_reloaded_bestreloaded_footer_bottom_tagline', array(
       'label' => $options['bestreloaded_footer_bottom_tagline']['name'],
       'section' => 'best_reloaded_footer',
       'settings' => 'best_reloaded[bestreloaded_footer_bottom_tagline]',
       'type' => $options['bestreloaded_footer_bottom_tagline']['type']
   ) ) );

 }
