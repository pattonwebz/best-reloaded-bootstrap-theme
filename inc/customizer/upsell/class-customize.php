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
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		require_once( trailingslashit( get_template_directory() ) . 'inc/customizer/upsell/class-best-reloaded-upsell-section.php' );

		// Register custom section types.
		$manager->register_section_type( 'Best_Reloaded_Upsell_Section' );
		ob_start(); ?>
<p><?php esc_html_e( 'I hate crippleware and lite versions. This is the full theme.', 'best-reloaded' ); ?></p>
<p><?php esc_html_e( 'You can contact me for support or customizations.', 'best-reloaded' ); ?></p>
<hr>
<p><?php esc_html_e( 'If you like this theme consider giving it a ', 'best-reloaded' ); ?><a href="<?php echo esc_url( 'https://wordpress.org/support/theme/best-reloaded/reviews/ ' ); ?>" target="_blank"><?php esc_html_e( '5 star rating', 'best-reloaded' ); ?></a>.</p>
		<?php
		$description = ob_get_clean();

		// Register sections.
		$manager->add_section(
			new Best_Reloaded_Upsell_Section(
				$manager,
				'best-reloaded-upsell',
				array(
					'title'    => esc_html__( 'Best Reloaded', 'best-reloaded' ),
					'pro_text' => esc_html__( 'Help and Support',         'best-reloaded' ),
					'pro_url'  => esc_url( 'https://www.pattonwebz.com/best-reloaded-bootstrap-theme/' ),
					'pro_description' => $description,
					'priority'   => 1,
				)
			)
		);
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
