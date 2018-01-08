<?php
 /**
  * The loop-slides.php file.
  *
  * Loop used to generate the slider
  *
  * @package Best_Reloaded
  * @since Best Reloaded v0.1
  */

?>

<?php
// 3 posts, exclude stickies.
$args = array(
	'post_type' => 'post',
	'posts_per_page' => get_theme_mod( 'slider_limit', best_reloaded_setting_defaults( 'slider_limit' ) ),
	'post__not_in' => get_option( 'sticky_posts' ),
);
if ( get_theme_mod( 'slider_category', best_reloaded_setting_defaults( 'slider_category' ) ) ) {
	$args['category__in'] = get_theme_mod( 'slider_category', best_reloaded_setting_defaults( 'slider_category' ) );
}
$loop = new WP_Query( $args );
$i = 0;
// set a global to track post IDs we don't want output in other loops on this page.
global $best_do_not_get_duplicates;
// set the variable to an array - if it's not already.
if ( ! is_array( $best_do_not_get_duplicates ) ) {
	$best_do_not_get_duplicates = array();
}
if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();
		// store the post ID in global array for use in other loops in home template.
		$best_do_not_get_duplicates[] = get_the_ID();
?>

<div class="carousel-item <?php if ( 0 === $i ) {
	echo esc_attr( 'active' );
	$i++;
} ?>" role="option">

	<?php
			// display image without being wrapped in anchor element - should link this.
			get_template_part( 'inc/parts/featured', 'image' );
	?>

	<div class="carousel-caption d-none d-md-block">

			<h2><a href="<?php echo esc_html( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></a></h2>

		<?php the_excerpt(); ?>
	</div>
</div>

<?php endwhile; else : ?>

	<div>
		<p class="hero-p no-content-message"><?php esc_html_e( "Sorry, couldn't get any slides.", 'best-reloaded' ); ?></p>
	</div>

<?php endif;
wp_reset_postdata();
