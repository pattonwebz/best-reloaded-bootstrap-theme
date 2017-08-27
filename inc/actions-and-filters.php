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

/**
 * Returns or echos some entry meta based on conditionals.
 * NOTE: Will fail silently.
 *
 * @param  boolean $echo flag to indicate echo or return.
 * @param  string  $type string indicating type of meta we want, can be FALSE.
 *
 * @return string/void	 Can return either a string or nothing if echoing.
 */
function best_reloaded_output_post_meta( $echo = true, $type = false ) {
	// if no specific type was requested, figure it out.
	if ( is_home() ) {
		$type = 'home';
	} elseif ( is_front_page() ) {
		$type = 'front-page';
	} elseif ( is_single() && ! is_singular( 'page' ) ) {
		$type = 'single';
	}
	$output = '';
	// if $type is single OR no type is passed and it is single but not a page...
	if ( 'single' === $type ) {
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
	} elseif ( 'front-page' === $type ) {
		ob_start(); ?>
		<footer class="meta">
			<span class="entry-meta">
				<?php the_time( get_option( 'date_format' ) ); ?> &#8226;
				<a href="<?php comments_link(); ?>" title="<?php comments_number( 'No Comments', 'One Comment', '% Comments' ); ?>">
					<?php comments_number( 'No Comments', 'One Comment', '% Comments' ); ?>
				</a>
			</span>
		</footer>
		<?php
		$output = ob_get_clean();
	} else {
		ob_start(); ?>
		<footer class="meta">
			<span class="entry-meta">
				<?php esc_html_e( 'Written by', 'best-reloaded' ); ?> <?php the_author_link(); ?>
				<?php esc_html_e( 'on', 'best-reloaded' ); ?> <?php the_time( get_option( 'date_format' ) ); ?>
				<?php esc_html_e( 'in', 'best-reloaded' ); ?> <?php the_category( ' and ' ); ?>
				<?php esc_html_e( 'with', 'best-reloaded' ); ?> <a href="<?php comments_link(); ?>" title="<?php comments_number( 'no comments', 'one comment', '% comments' ); ?>"><?php comments_number( 'no comments', 'one Comment', '% comments' ); ?></a>
			</span>
		</footer>
		<?php
		$output = ob_get_clean();
	} // End if().

	// either return or echo the output.
	if ( $echo ) {
		echo wp_kses_post( apply_filters( 'best_reloaded_post_meta_output', $output ) );
	} else {
		return apply_filters( 'best_reloaded_post_meta_output', $output );
	}
}

add_action( 'best_reloaded_do_post_meta', 'best_reloaded_output_post_meta', 10, 2 );

/**
 * Returns or echos a classname string for use defining theme layouts.
 *
 * @param  string  $classname_string any classnames to be output.
 * @param  boolean $echo             flag to decide when to echo or return.
 *
 * @return string
 */
function best_reloaded_layout_output_classnames( $classname_string, $echo = true ) {
	// either echo or return any passed classnames.
	if ( $echo ) {
		// echo classnames inside a `class=""` attribute`.
		echo 'class="' . esc_attr( apply_filters( 'best_reloaded_filter_layout_classnames', $classname_string ) ) . '"';
	} else {
		// return just the classnames.
		return apply_filters( 'best_reloaded_filter_layout_classnames', $classname_string );
	}
}
add_action( 'best_reloaded_do_layout_selection', 'best_reloaded_layout_output_classnames', 10, 2 );

/**
 * Filter for layout classnames to add any specific classes wanted.
 *
 * @param  string $classname_string a string of classnames to output.
 *
 * @return string
 */
function best_reloaded_filter_layout_classnames_output( $classname_string ) {
	// get the layout selection string.
	$layout = get_theme_mod( 'layout_selection', '' );
	// if we got a layout selection then append a space then it to the string.
	if ( $layout ) {
		$classname_string .= ' ' . $layout;
	}
	// return the string with any modifications applied.
	return $classname_string;
}
add_filter( 'best_reloaded_filter_layout_classnames', 'best_reloaded_filter_layout_classnames_output' );

/**
 * Accepts a string of classes and adds any addition ones to it based on user
 * option settings before echoing it.
 *
 * @param  string $classnames string of classnames to start with.
 */
function best_reloaded_output_navbar_classes( $classnames ) {
	$classes = $classnames;
	// add the navbar_style class to the classes string.
	$classes .= ' ' . get_theme_mod( 'navbar_style', 'fixed-top' );
	/**
	 * TODO: Selection for navbar color shemes like .bg-* and .text-*.
	 *
	 * @var string
	 */
	echo esc_attr( $classes );
}
add_action( 'best_reloaded_do_navbar_classes', 'best_reloaded_output_navbar_classes', 10, 1 );
