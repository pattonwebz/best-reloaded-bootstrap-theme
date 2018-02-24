<?php
/**
 * The main customizer class for the theme used to add all panels, sections,
 * settings and controlls used in the theme.
 *
 * @package Best_Reloaded
 * @since Best Reloaded v2.1.0
 */

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  2.1.0
 * @access public
 */
final class Best_Reloaded_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  2.1.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self();
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  2.1.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  2.1.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'panels' ) );
		add_action( 'customize_register', array( $this, 'sections' ) );
		add_action( 'customize_register', array( $this, 'settings' ) );
		add_action( 'customize_register', array( $this, 'controlls' ) );

		// Register scripts and styles for the controlls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Adds any panels to the customizer.
	 *
	 * @param object $wp_customize the cusomizer manager object.
	 *
	 * @return void
	 */
	public function panels( $wp_customize ) {

		// Add some panels.
		$wp_customize->add_panel(
			'best_reloaded_theme_settings_panel', array(
				'title'    => apply_filters( 'best_reloaded_filter_theme_settings_panel_title', __( 'Best Reloaded Theme Settings', 'best-reloaded' ) ),
				'priority' => 20,
			)
		);
	}
	/**
	 * Sets up the customizer sections.
	 *
	 * @since  2.1.0
	 * @access public
	 * @param  object $wp_customize the WordPress custmizer object.
	 * @return void
	 */
	public function sections( $wp_customize ) {

		// Load custom sections.
		require_once trailingslashit( get_template_directory() ) . 'inc/customizer/class-best-reloaded-help-section.php';

		// Register custom section types.
		$wp_customize->register_section_type( 'Best_Reloaded_Help_Section' );

		// Start a buffer to hold some html content.
		ob_start(); ?>
<p><?php esc_html_e( 'I hate crippleware and lite versions. This is the full theme.', 'best-reloaded' ); ?></p>
<p><?php esc_html_e( 'You can contact me for support or customizations.', 'best-reloaded' ); ?></p>
<hr>
<p><?php esc_html_e( 'If you like this theme consider giving it a ', 'best-reloaded' ); ?><a href="<?php echo esc_url( 'https://wordpress.org/support/theme/best-reloaded/reviews/ ' ); ?>" target="_blank"><?php esc_html_e( '5 star rating', 'best-reloaded' ); ?></a>.</p>
		<?php
		// get the buffered content.
		$description = ob_get_clean();
		// start a holder array.
		$upsell_values = array(
			'title'           => esc_html__( 'Best Reloaded', 'best-reloaded' ),
			'pro_text'        => esc_html__( 'Help and Support', 'best-reloaded' ),
			'pro_url'         => esc_url( 'https://www.pattonwebz.com/best-reloaded-bootstrap-theme/' ),
			'pro_description' => $description,
			'priority'        => 1,
		);
		$upsell_values = apply_filters( 'best_reloaded_filter_upsell_values', $upsell_values );

		// Register sections.
		$wp_customize->add_section(
			new Best_Reloaded_Help_Section(
				$wp_customize,
				'best-reloaded-upsell',
				$upsell_values
			)
		);
		$wp_customize->add_section(
			'best_reloaded_navbar', array(
				'title'    => __( 'Main Navbar', 'best-reloaded' ),
				'panel'    => 'best_reloaded_theme_settings_panel',
				'priority' => 94,
			)
		);
		$wp_customize->add_section(
			'best_reloaded_header', array(
				'title'    => __( 'Site Title Row', 'best-reloaded' ),
				'panel'    => 'best_reloaded_theme_settings_panel',
				'priority' => 95,
			)
		);
		$wp_customize->add_section(
			'best_reloaded_other', array(
				'title'    => __( 'Sitewide Options', 'best-reloaded' ),
				'panel'    => 'best_reloaded_theme_settings_panel',
				'priority' => 96,
			)
		);

		$wp_customize->add_section(
			'best_reloaded_frontpage', array(
				'title'    => __( 'FrontPage Specific Options', 'best-reloaded' ),
				'panel'    => 'best_reloaded_theme_settings_panel',
				'priority' => 96,
			)
		);

		$wp_customize->add_section(
			'best_reloaded_slider', array(
				'title'    => __( 'Slider Settings', 'best-reloaded' ),
				'panel'    => 'best_reloaded_theme_settings_panel',
				'priority' => 98,
			)
		);
		$wp_customize->add_section(
			'best_reloaded_footer', array(
				'title'    => __( 'Footer Options', 'best-reloaded' ),
				'panel'    => 'best_reloaded_theme_settings_panel',
				'priority' => 100,
			)
		);
		$wp_customize->add_section(
			'best_reloaded_misc', array(
				'title'    => __( 'Misc Options', 'best-reloaded' ),
				'panel'    => 'best_reloaded_theme_settings_panel',
				'priority' => 100,
			)
		);
	}

	/**
	 * Adds the settings, sets their defaults and sanitization callbacks.
	 *
	 * @param object $wp_customize the WordPress customizer object.
	 */
	public function settings( $wp_customize ) {
		// get the defaults from a function that returns a maybe filtered array.
		$defaults = best_reloaded_setting_defaults();

		// Navbar options.
		$wp_customize->add_setting(
			'navbar_style', array(
				'default'           => $defaults['navbar_style'],
				'sanitize_callback' => 'best_reloaded_sanitize_navbar_style',
			)
		);

		$wp_customize->add_setting(
			'navbar-color', array(
				'default'           => $defaults['navbar-color'],
				'sanitize_callback' => 'best_reloaded_sanitize_select',
			)
		);

		$wp_customize->add_setting(
			'navbar-bg', array(
				'default'           => $defaults['navbar-bg'],
				'sanitize_callback' => 'best_reloaded_sanitize_select',
			)
		);

		$wp_customize->add_setting(
			'display_navbar_search', array(
				'default'           => $defaults['display_navbar_search'],
				'sanitize_callback' => 'best_reloaded_sanitize_checkbox',
			)
		);

		$wp_customize->add_setting(
			'search_color', array(
				'default'           => $defaults['search_color'],
				'sanitize_callback' => 'best_reloaded_sanitize_select',
			)
		);

		$wp_customize->add_setting(
			'display_navbar_brand', array(
				'default'           => $defaults['display_navbar_brand'],
				'sanitize_callback' => 'best_reloaded_sanitize_checkbox',
			)
		);

		$wp_customize->add_setting(
			'display_brand_text', array(
				'default'           => $defaults['display_brand_text'],
				'sanitize_callback' => 'best_reloaded_sanitize_checkbox',
			)
		);

		$wp_customize->add_setting(
			'allow_long_brand', array(
				'default'           => $defaults['allow_long_brand'],
				'sanitize_callback' => 'best_reloaded_sanitize_checkbox',
			)
		);

		$wp_customize->add_setting(
			'brand_image', array(
				'default'           => $defaults['brand_image'],
				'sanitize_callback' => 'best_reloaded_sanitize_image',
			)
		);

		// site title section options.
		$wp_customize->add_setting(
			'small_site_title', array(
				'default'           => $defaults['small_site_title'],
				'sanitize_callback' => 'best_reloaded_sanitize_checkbox',
			)
		);

		$wp_customize->add_setting(
			'display_header_banner_area', array(
				'default'           => $defaults['display_header_banner_area'],
				'sanitize_callback' => 'best_reloaded_sanitize_checkbox',

			)
		);

		$wp_customize->add_setting(
			'header_banner_area', array(
				'default'           => $defaults['header_banner_area'],
				'sanitize_callback' => 'best_reloaded_sanitize_textarea',

			)
		);

		// Frontpage specific options.
		$wp_customize->add_setting(
			'display_intro_text', array(
				'default'           => $defaults['display_intro_text'],
				'sanitize_callback' => 'best_reloaded_sanitize_checkbox',
			)
		);

		$wp_customize->add_setting(
			'intro_text', array(
				'default'           => $defaults['intro_text'],
				'sanitize_callback' => 'best_reloaded_sanitize_textarea',
			)
		);

		$wp_customize->add_setting(
			'display_homepage_slider_row', array(
				'default'           => $defaults['display_homepage_slider_row'],
				'sanitize_callback' => 'best_reloaded_sanitize_checkbox',
			)
		);

		$wp_customize->add_setting(
			'display_homepage_widget_row', array(
				'default'           => $defaults['display_homepage_widget_row'],
				'sanitize_callback' => 'best_reloaded_sanitize_checkbox',
			)
		);

		$wp_customize->add_setting(
			'display_homepage_posts_row', array(
				'default'           => $defaults['display_homepage_posts_row'],
				'sanitize_callback' => 'best_reloaded_sanitize_checkbox',
			)
		);

		$wp_customize->add_setting(
			'homepage_posts_output_num', array(
				'default'           => '3',
				'sanitize_callback' => 'absint',
			)
		);

		$wp_customize->add_setting(
			'homepage_posts_category', array(
				'default'           => $defaults['homepage_posts_category'],
				'sanitize_callback' => 'best_reloaded_sanitize_cetegory_select',
			)
		);

		// Slider options.
		$wp_customize->add_setting(
			'slider_limit', array(
				'default'           => $defaults['slider_limit'],
				'sanitize_callback' => 'absint',
			)
		);

		$wp_customize->add_setting(
			'slider_category', array(
				'default'           => $defaults['slider_category'],
				'sanitize_callback' => 'best_reloaded_sanitize_cetegory_select',
			)
		);

		$wp_customize->add_setting(
			'slider_max_cap', array(
				'default'           => $defaults['slider_max_cap'],
				'sanitize_callback' => 'best_reloaded_sanitize_checkbox',
			)
		);

		// Other sitewide options.
		$wp_customize->add_setting(
			'display_featured_bar', array(
				'default'           => $defaults['display_featured_bar'],
				'sanitize_callback' => 'best_reloaded_sanitize_checkbox',
			)
		);

		$wp_customize->add_setting(
			'featured_bar', array(
				'default'           => $defaults['featured_bar'],
				'sanitize_callback' => 'best_reloaded_sanitize_textarea',
			)
		);

		// Footer section options.
		$wp_customize->add_setting(
			'display_footer_top', array(
				'default'           => $defaults['display_footer_top'],
				'sanitize_callback' => 'best_reloaded_sanitize_checkbox',
			)
		);

		$wp_customize->add_setting(
			'display_footer_bottom', array(
				'default'           => $defaults['display_footer_bottom'],
				'sanitize_callback' => 'best_reloaded_sanitize_checkbox',
			)
		);

		$wp_customize->add_setting(
			'footer_bottom_tagline', array(
				'default'           => $defaults['footer_bottom_tagline'],
				'sanitize_callback' => 'best_reloaded_sanitize_textarea',
			)
		);

		$wp_customize->add_setting(
			'layout_selection', array(
				'default'           => $defaults['layout_selection'],
				'sanitize_callback' => 'best_reloaded_sanitize_layout_selection',
			)
		);

		$wp_customize->add_setting(
			'enable_font-awesome', array(
				'default'           => $defaults['enable_font-awesome'],
				'sanitize_callback' => 'best_reloaded_sanitize_checkbox',
			)
		);

		$wp_customize->add_setting(
			'enable_slim_mode', array(
				'default'           => $defaults['enable_slim_mode'],
				'sanitize_callback' => 'best_reloaded_sanitize_checkbox',
			)
		);

	}

	/**
	 * Adds the controlls for all the settings.
	 *
	 * @param object $wp_customize the WordPress customizer object.
	 */
	public function controlls( $wp_customize ) {

		$wp_customize->add_control(
			'navbar_style', array(
				'label'       => __( 'Navbar Style', 'best-reloaded' ),
				'description' => __( 'Select the style of navbar you want.', 'best-reloaded' ),
				'section'     => 'best_reloaded_navbar',
				'type'        => 'select',
				'choices'     => best_reloaded_get_navbar_styles(),
			)
		);

		$wp_customize->add_control(
			'navbar-color', array(
				'label'       => __( 'Navbar Text Color', 'best-reloaded' ),
				'description' => __( 'Select the color items in the navbar.', 'best-reloaded' ),
				'section'     => 'best_reloaded_navbar',
				'type'        => 'select',
				'choices'     => best_reloaded_get_navbar_colors(),
			)
		);

		$wp_customize->add_control(
			'navbar-bg', array(
				'label'       => __( 'Navbar Color', 'best-reloaded' ),
				'description' => __( 'Select the color of navbar you want.', 'best-reloaded' ),
				'section'     => 'best_reloaded_navbar',
				'type'        => 'select',
				'choices'     => best_reloaded_get_navbar_bgs(),
			)
		);

		$wp_customize->add_control(
			'display_navbar_search', array(
				'label'       => __( 'Toggle on/off the navbar search form.', 'best-reloaded' ),
				'description' => __( 'Search form appears on right side of navbar.', 'best-reloaded' ),
				'section'     => 'best_reloaded_navbar',
				'settings'    => 'display_navbar_search',
				'type'        => 'checkbox',
			)
		);

		$wp_customize->add_control(
			'search_color', array(
				'label'       => __( 'Search Color', 'best-reloaded' ),
				'description' => __( 'Select the color of search button (NOTE: this also is applied to any search widget used in the sidebar).', 'best-reloaded' ),
				'section'     => 'best_reloaded_navbar',
				'type'        => 'select',
				'choices'     => best_reloaded_get_search_colors(),
			)
		);

		$wp_customize->add_control(
			'display_navbar_brand', array(
				'label'       => __( 'Enable the navbar brand.', 'best-reloaded' ),
				'description' => __( 'Branding options can be a small image, the site-title text or both.', 'best-reloaded' ),
				'section'     => 'best_reloaded_navbar',
				'settings'    => 'display_navbar_brand',
				'type'        => 'checkbox',
			)
		);

		$wp_customize->add_control(
			'display_brand_text', array(
				'label'    => __( 'Display the site title in the navbar as brand text.', 'best-reloaded' ),
				'section'  => 'best_reloaded_navbar',
				'settings' => 'display_brand_text',
				'type'     => 'checkbox',
			)
		);

		$wp_customize->add_control(
			'allow_long_brand', array(
				'label'       => __( 'Allow Long Titles', 'best-reloaded' ),
				'description' => __( 'Very long titles break the default navbar layout, if you want to allow very long titles here then check this box. NOTE: You can also turn off the search form for more space.', 'best-reloaded' ),
				'section'     => 'best_reloaded_navbar',
				'settings'    => 'allow_long_brand',
				'type'        => 'checkbox',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'brand_image',
				array(
					'label'       => __( 'Add a brand image to the navbar.', 'best-reloaded' ),
					'section'     => 'best_reloaded_navbar',
					'settings'    => 'brand_image',
					'description' => __( 'Choose an image to use for brand image in navbar. It should be 30px X 30px. Leave empty for no image.', 'best-reloaded' ),
				)
			)
		);

		// site title section options.
		$wp_customize->add_control(
			'small_site_title', array(
				'label'       => __( 'Use smaller font-size for site title.', 'best-reloaded' ),
				'description' => __( 'Note: this is already applied automattically for titles that are too large for the bigger font-size.', 'best-reloaded' ),
				'section'     => 'best_reloaded_header',
				'settings'    => 'small_site_title',
				'type'        => 'checkbox',
			)
		);

		$wp_customize->add_control(
			'display_header_banner_area', array(
				'label'       => __( 'Display Header Banner Area', 'best-reloaded' ),
				'description' => __( 'Toggle on/off the the header banner slot. This appears to the right of the site title.', 'best-reloaded' ),
				'section'     => 'best_reloaded_header',
				'settings'    => 'display_header_banner_area',
				'type'        => 'checkbox',
			)
		);

		$wp_customize->add_control(
			'header_banner_area', array(
				'label'       => __( 'Header Banner Area', 'best-reloaded' ),
				'description' => __( 'Enter the text you want to show in the header slot. Accepts some basic html.', 'best-reloaded' ),
				'section'     => 'best_reloaded_header',
				'settings'    => 'header_banner_area',
				'type'        => 'textarea',
			)
		);

		// Frontpage specific options.
		$wp_customize->add_control(
			'display_intro_text', array(
				'label'       => __( 'Display the frontpage intro section.', 'best-reloaded' ),
				'description' => __( 'This intro section is unique to the frontpage (there is a sitewide option that is used on all other pages).', 'best-reloaded' ),
				'section'     => 'best_reloaded_frontpage',
				'settings'    => 'display_intro_text',
				'type'        => 'checkbox',
			)
		);

		$wp_customize->add_control(
			'intro_text', array(
				'label'    => __( 'Frontpage Intro Text', 'best-reloaded' ),
				'section'  => 'best_reloaded_frontpage',
				'settings' => 'intro_text',
				'type'     => 'textarea',
			)
		);

		$wp_customize->add_control(
			'display_homepage_slider_row', array(
				'label'       => __( 'Display Frontpage Slider Row', 'best-reloaded' ),
				'description' => __( 'Toggle on/off the slider row on the frontpage. This row contais the slider and a right side widget area.', 'best-reloaded' ),
				'section'     => 'best_reloaded_frontpage',
				'settings'    => 'display_homepage_slider_row',
				'type'        => 'checkbox',
			)
		);

		$wp_customize->add_control(
			'display_homepage_widget_row', array(
				'label'       => __( 'Display Frontpage Widget Row', 'best-reloaded' ),
				'description' => __( 'An additional row of widgets can be output on the frontpage.', 'best-reloaded' ),
				'section'     => 'best_reloaded_frontpage',
				'settings'    => 'display_homepage_widget_row',
				'type'        => 'checkbox',
			)
		);

		$wp_customize->add_control(
			'display_homepage_posts_row', array(
				'label'       => __( 'Display Frontpage Slider Row', 'best-reloaded' ),
				'description' => __( 'Toggle on/off the posts row on the frontpage. This row contais the a left side widget area and outputs excerpts of the selected number of posts.', 'best-reloaded' ),
				'section'     => 'best_reloaded_frontpage',
				'settings'    => 'display_homepage_posts_row',
				'type'        => 'checkbox',
			)
		);

		$wp_customize->add_control(
			'homepage_posts_output_num', array(
				'label'       => __( 'Number of Posts', 'best-reloaded' ),
				'description' => __( 'How many posts to output (in addition to the number of slider posts) on the frontpage.', 'best-reloaded' ),
				'section'     => 'best_reloaded_frontpage',
				'type'        => 'select',
				'choices'     => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
				),
			)
		);

		$wp_customize->add_control(
			'homepage_posts_category', array(
				'label'       => __( 'Category For Frontpage Posts', 'best-reloaded' ),
				'description' => __( 'Choose the category to output post excerpts of on the frontpage..', 'best-reloaded' ),
				'section'     => 'best_reloaded_frontpage',
				'type'        => 'select',
				'choices'     => best_reloaded_get_categories(),
			)
		);

		// Slider options.
		$wp_customize->add_control(
			'slider_limit', array(
				'label'       => __( 'Number of Slides', 'best-reloaded' ),
				'description' => __( 'Set the number of slides you want to appear in the slider.', 'best-reloaded' ),
				'section'     => 'best_reloaded_slider',
				'settings'    => 'slider_limit',
				'type'        => 'text',
			)
		);

		$wp_customize->add_control(
			'slider_category', array(
				'label'       => __( 'Category For Slider', 'best-reloaded' ),
				'description' => __( 'Choose the category to output for the slider.', 'best-reloaded' ),
				'section'     => 'best_reloaded_slider',
				'type'        => 'select',
				'choices'     => best_reloaded_get_categories(),
			)
		);

		$wp_customize->add_control(
			'slider_max_cap', array(
				'label'       => __( 'Slider Capped Height.', 'best-reloaded' ),
				'description' => __( 'Set a height limit on the slider so that image sizes all match the size of the first image it contains (prevents content below the slider from changing positions if images are different sizes, may cause some distorted images in certain cases)', 'best-reloaded' ),
				'section'     => 'best_reloaded_slider',
				'settings'    => 'slider_max_cap',
				'type'        => 'checkbox',
			)
		);

		// Other sitewide options.
		$wp_customize->add_control(
			'display_featured_bar', array(
				'label'    => __( 'Display Featured Content Bar', 'best-reloaded' ),
				'section'  => 'best_reloaded_other',
				'settings' => 'display_featured_bar',
				'type'     => 'checkbox',
			)
		);

		$wp_customize->add_control(
			'featured_bar', array(
				'label'    => __( 'Feature Bar Content', 'best-reloaded' ),
				'section'  => 'best_reloaded_other',
				'settings' => 'featured_bar',
				'type'     => 'textarea',
			)
		);

		// Footer section options.
		$wp_customize->add_control(
			'display_footer_top', array(
				'label'       => __( 'Display Footer Top', 'best-reloaded' ),
				'description' => __( 'Display the footer widget row.', 'best-reloaded' ),
				'section'     => 'best_reloaded_footer',
				'settings'    => 'display_footer_top',
				'type'        => 'checkbox',
			)
		);

		$wp_customize->add_control(
			'display_footer_bottom', array(
				'label'       => __( 'Display Footer Bottom', 'best-reloaded' ),
				'description' => __( 'Displays the bottom footer row with space for your footer text and the footer nav.', 'best-reloaded' ),
				'section'     => 'best_reloaded_footer',
				'settings'    => 'display_footer_bottom',
				'type'        => 'checkbox',
			)
		);

		$wp_customize->add_control(
			'footer_bottom_tagline', array(
				'label'    => __( 'Footer Text', 'best-reloaded' ),
				'section'  => 'best_reloaded_footer',
				'settings' => 'footer_bottom_tagline',
				'type'     => 'textarea',
			)
		);

		$wp_customize->add_control(
			'layout_selection', array(
				'label'       => __( 'Sidebar Location', 'best-reloaded' ),
				'description' => __( 'Choose the the default layout for the sidebar location.', 'best-reloaded' ),
				'section'     => 'best_reloaded_other',
				'type'        => 'radio',
				'choices'     => best_reloaded_get_layout_styles(),
			)
		);

		$wp_customize->add_control(
			'enable_font-awesome', array(
				'label'       => __( 'Enable Font-Awesome.', 'best-reloaded' ),
				'description' => __( 'Includes Font-Awesome in the page to use in your content (and in the navbar).', 'best-reloaded' ),
				'section'     => 'best_reloaded_misc',
				'settings'    => 'enable_font-awesome',
				'type'        => 'checkbox',
			)
		);

		$wp_customize->add_control(
			'enable_slim_mode', array(
				'label'       => __( 'Enable Slim Mode.', 'best-reloaded' ),
				'description' => __( 'Slim mode uses css and js files that have some features that are not used in the theme removed to reduce their size and impact on render time. By default the full-size Bootstrap styles and scripts are included.', 'best-reloaded' ),
				'section'     => 'best_reloaded_misc',
				'settings'    => 'enable_slim_mode',
				'type'        => 'checkbox',
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  2.1.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {
		wp_enqueue_script( 'best-reloaded-customize-controls', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/js/customize-controls.js', array( 'customize-controls' ) );
		wp_enqueue_style( 'best-reloaded-customize-controls', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/css/customize-controls.css' );
	}
}

Best_Reloaded_Customize::get_instance();
