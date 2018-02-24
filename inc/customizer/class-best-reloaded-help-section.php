<?php
/**
 * Class to add a section and it's supporting styles/scripts to output a button
 * and some text in a top level panel of the customizer.
 *
 * @package Best_Reloaded
 * @since Best Reloaded v2.1.0
 */

/**
 * Get help section.
 *
 * @access public
 */
class Best_Reloaded_Help_Section extends WP_Customize_Section {

	/**
	 * The type of customize section being rendered.
	 *
	 * @since  2.1.0
	 * @access public
	 * @var    string
	 */
	public $type = 'best-reloaded-upsell';

	/**
	 * Custom button text to output.
	 *
	 * @since  2.1.0
	 * @access public
	 * @var    string
	 */
	public $pro_text = '';

	/**
	 * Custom pro button URL.
	 *
	 * @since  2.1.0
	 * @access public
	 * @var    string
	 */
	public $pro_url = '';

	/**
	 * Custom description text.
	 *
	 * @since  2.1.0
	 * @access public
	 * @var    string
	 */
	public $pro_description = '';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  2.1.0
	 * @access public
	 */
	public function json() {
		$json = parent::json();

		$json['pro_text']        = $this->pro_text;
		$json['pro_url']         = esc_url( $this->pro_url );
		$json['pro_description'] = $this->pro_description;

		return $json;
	}

	/**
	 * Outputs the Underscore.js template.
	 *
	 * @since  2.1.0
	 * @access public
	 * @return void
	 */
	protected function render_template() {
		?>
		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }}">

			<h3 class="accordion-section-title">
				{{ data.title }}

				<# if ( data.pro_text && data.pro_url ) { #>
					<a href="{{ data.pro_url }}" class="button button-primary alignright" target="_blank">{{ data.pro_text }}</a>
				<# } #>
			</h3>
			<# if ( data.pro_description ) { #>
			<div class="info" style="display:none;">
				{{ data.pro_description }}
			</div>
			<# } #>
		</li>
		<?php
	}
}
