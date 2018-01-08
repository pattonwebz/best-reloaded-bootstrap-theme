<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Best_Reloaded_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'panels' ) );
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
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
		$wp_customize->add_panel( 'best_reloaded_theme_settings_panel', array(
			'title'		=> apply_filters( 'best_reloaded_filter_theme_settings_panel_title', __( 'Best Reloaded Theme Settings', 'best-reloaded' ) ),
			'priority' 	=> 20,
		) );
	}
	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $wp_customize
	 * @return void
	 */
	public function sections( $wp_customize ) {

		// Load custom sections.
		require_once( trailingslashit( get_template_directory() ) . 'inc/customizer/upsell/class-best-reloaded-upsell-section.php' );

		// Register custom section types.
		$wp_customize->register_section_type( 'Best_Reloaded_Upsell_Section' );

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
			'title'    => esc_html__( 'Best Reloaded', 'best-reloaded' ),
			'pro_text' => esc_html__( 'Help and Support',         'best-reloaded' ),
			'pro_url'  => esc_url( 'https://www.pattonwebz.com/best-reloaded-bootstrap-theme/' ),
			'pro_description' => $description,
			'priority'   => 1,
		);
		$upsell_values = apply_filters( 'best_reloaded_filter_upsell_values', $upsell_values );

		// Register sections.
		$wp_customize->add_section( new Best_Reloaded_Upsell_Section( $wp_customize,
			'best-reloaded-upsell',
			$upsell_values
		) );
		$wp_customize->add_section( 'best_reloaded_navbar', array(
			'title' 	=> __( 'Main Navbar', 'best-reloaded' ),
			'panel'		=> 'best_reloaded_theme_settings_panel',
			'priority' 	=> 94,
		) );
		$wp_customize->add_section( 'best_reloaded_header', array(
			'title' 	=> __( 'Site Title Row', 'best-reloaded' ),
			'panel'		=> 'best_reloaded_theme_settings_panel',
			'priority' 	=> 95,
		) );
		$wp_customize->add_section( 'best_reloaded_other', array(
			'title' 	=> __( 'Sitewide Options', 'best-reloaded' ),
			'panel'		=> 'best_reloaded_theme_settings_panel',
			'priority' 	=> 96,
		) );

		$wp_customize->add_section( 'best_reloaded_frontpage', array(
			'title' 	=> __( 'FrontPage Specific Options', 'best-reloaded' ),
			'panel'		=> 'best_reloaded_theme_settings_panel',
			'priority' 	=> 96,
		) );

		$wp_customize->add_section( 'best_reloaded_slider', array(
			'title'		=> __( 'Slider Settings', 'best-reloaded' ),
			'panel'		=> 'best_reloaded_theme_settings_panel',
			'priority' 	=> 98,
		) );
		$wp_customize->add_section( 'best_reloaded_footer', array(
			'title' 	=> __( 'Footer Options', 'best-reloaded' ),
			'panel'		=> 'best_reloaded_theme_settings_panel',
			'priority' 	=> 100,
		) );
		$wp_customize->add_section( 'best_reloaded_misc', array(
			'title'		=> __( 'Misc Options', 'best-reloaded' ),
			'panel'		=> 'best_reloaded_theme_settings_panel',
			'priority'	=> 100,
		) );
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'best-reloaded-customize-controls', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/upsell/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'best-reloaded-customize-controls', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/upsell/customize-controls.css' );
	}
}

Best_Reloaded_Customize::get_instance();
