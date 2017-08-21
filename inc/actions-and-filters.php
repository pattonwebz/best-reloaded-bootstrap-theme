<?php
/**
 * The actions.php file.
 *
 * Contains the actions to be used throughout the theme.
 *
 * @package Best_Reloaded
 * @since Best Reloaded v1
 */

 /**
  * The default feature-bar content.
  *
  * @since 1.0.0
  */
function best_reloaded_featurebar() {
	/**
	 * Used to output whatever featured content is desired in the opening bar.
	 */

	// Start an output buffer to hold the markup.
	ob_start();

	// The default feature bar content comes from this template part.
	get_template_part( 'inc/parts/featured', 'bar' );

	$bar_content = ob_get_clean();

	// Here we filter/echo out the html content for the featured bar.
	echo wp_kses_post( apply_filters( 'best_reloaded_filter_featurebar', $bar_content ) );
}

 // Hook to the cloud_one_do_featurebar action hook.
add_action( 'best_reloaded_do_featurebar', 'best_reloaded_featurebar' );

 /**
  * A callback to filter featurebar html content
  *
  * @since 1.0.0
  *
  * @param  string $html		An html string containing featurebar content.
  * @return $html			An html string contianing updated content for featurebar.
  */
function best_reloaded_featuredbar_value_filter( $html ) {
	// Maybe modify $html in some way.
	if ( is_single() ) {
		// On single pages we can replace the content inside the featured-bar
		// section if we have updated content stored in post_meta.
		if ( get_post_meta( get_the_ID(), 'best_reloaded_featurebar_text', true ) ) {
			$html = preg_replace( '/<p class="lead">(.|\n)*?<\/p>/', '<p class="lead">' . get_post_meta( get_the_ID(), 'best_reloaded_featurebar_text', true ) . '</p>', $html );
		}
	}
	// return the passed value or updated value.
	return $html;
}
add_filter( 'best_realoaded_filter_featurebar', 'best_realoaded_featuredbar_value_filter' );

/**
 * Removes some inline styles that WP adds alongside the Recent Comments Widget.
 *
 * @link Fix from here: https://core.trac.wordpress.org/changeset/16522
 * @link Details here: https://core.trac.wordpress.org/ticket/11928
 */
function best_reloaded_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'best_reloaded_remove_recent_comments_style' );

/**
 * Adds some classes to tags in the wordcloud.
 *
 * @param string $html html string to be modified and add the label class_exists.
 *
 * @return $html modified string with the label classnames.
 */
function best_reloaded_add_class_the_tags( $html ) {
	$postid = get_the_ID();
	$html = str_replace( '<a','<a class="label label-default"', $html );
	return $html;
}
add_filter( 'the_tags','best_reloaded_add_class_the_tags',10,1 );

/**
 * Filter to add some bootstrap specific classes to gravity forms if installed.
 *
 * @param [type] $field_container [description].
 * @param object $field           [description].
 * @param array  $form            [description].
 * @param string $css_class       [description].
 * @param [type] $style           [description].
 * @param mixed  $field_content   [description].
 */
function best_reloaded_add_bootstrap_container_class_to_gf( $field_container, $field, $form, $css_class, $style, $field_content ) {
	$id = $field->id;
	$field_id = is_admin() || empty( $form ) ? "field_{$id}" : 'field_' . $form['id'] . "_$id";
	return '<li id="' . $field_id . '" class="' . $css_class . ' form-group">{FIELD_CONTENT}</li>';
}
add_filter( 'gform_field_container', 'best_reloaded_add_bootstrap_container_class_to_gf', 10, 6 );

/**
 * Removes the filters that jetpack uses to add the share box to end of posts.
 */
function best_reloaded_jptweak_remove_share() {
	remove_filter( 'the_content', 'sharing_display',19 );
	remove_filter( 'the_excerpt', 'sharing_display',19 );
	remove_filter( 'the_content', array( 'Jetpack_Likes', 'post_likes' ), 30, 1 );
}
add_action( 'loop_end', 'best_reloaded_jptweak_remove_share' );

/**
 * Echos the markup output by navbar branding function.
 *
 * @since v1.2.0
 *
 * @return void
 */
function best_reloaded_output_navbar_brand() {
	// try get the branding markup.
	$output = best_reloaded_bootstrap_navbar_branding();
	// if we have output to use then echo it.
	if ( $output ) {
		$allowed_brand_tags = array(
			'span' => array(
				'class' => array(),
			),
			'img' => array(
				'id'	=> array(),
				'class'	=> array(),
				'src' => array(),
				'alt' => array(),
			),
		);
		echo wp_kses( apply_filters( 'best_reloaded_filter_navbar_brand', $output ), $allowed_brand_tags );
	}
}
add_action( 'best_reloaded_do_navbar_brand', 'best_reloaded_output_navbar_brand' );

function best_reloaded_output_post_meta( $echo = true ) {
	// single posts/CPTS but not pages.
	error_log( is_single(), 0 );
	error_log( is_singular( 'page' ), 0 );
	if ( is_single() && ! is_singular( 'page' ) ) {
		ob_start(); ?>
		<div class="meta">
			<span class="entry-meta text-muted">
				<i class="fa fa-pencil"></i>
				<?php
				esc_html_e( ' Written by ', 'best-reloaded' );
				the_author_link();
				esc_html_e( ' on ', 'best-reloaded' );
				the_time( get_option( 'date_format' ) );
				esc_html_e( ' and posted in ', 'best-reloaded' );
				the_category( ' and ' ); ?>.
			</span>
		</div>
	<?php
	$output = ob_get_clean();
	}
	if ( $echo ) {
		error_log( 'echo', 0 );
		echo wp_kses_post( $output );
	} else {
		error_log( 'return', 0 );
		return $output;
	}
}
add_action( 'best_reloaded_do_after_the_title', 'best_reloaded_output_post_meta', 10, 1 );
