<?php
 /**
  * The loop-home.php file.
  *
  * Outputs the main homepage posts loop
  *
  * @package Best_Reloaded
  * @since Best Reloaded v0.1
  */

?>
<div class="row blog-three-up">
	<div class="col-md-12 col-lg widget-area">
		<?php
		if ( is_active_sidebar( 'frontpage-blog-row-sidebar' ) ) {
			dynamic_sidebar( 'frontpage-blog-row-sidebar' );
		} else {
			the_widget( 'WP_Widget_Tag_Cloud' );
		} ?>
	</div><!-- end .col-sm-3 -->
	<?php
	// get the global that stores posts we don't want duplicated here.
	global $best_do_not_get_duplicates;
	// it should exist and be an array but incase it doesn't cast it as one.
	if ( ! is_array( $best_do_not_get_duplicates ) ) {
		$best_do_not_get_duplicates = array();
	}
	// sticky posts mess with the loop counter, merge them into the array we
	// don't want to duplciate.
	$best_excluded_ids = array_merge( $best_do_not_get_duplicates, get_option( 'sticky_posts' ) );
	$args = array(
		'posts_per_page' 	=> 3,
		'post__not_in' 		=> $best_excluded_ids,
	);
	$loop = new WP_Query( $args );
	if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();	?>
	<div class="col-sm-12 col-md">
		<article  <?php post_class(); ?> >
			<header>
				<a href="<?php the_permalink(); ?>" class="post-thumb">
					<span>
						<?php get_template_part( 'inc/parts/featured', 'image' ); ?>
					</span>
				</a>
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			</header>
			<?php the_excerpt(); ?>
			<?php best_reloaded_do_post_meta(); ?>
		</article>
		<hr class="hr-row-divider">
	</div><!-- end col-sm-3 -->
	<?php endwhile; else : ?>
	<div class="col-sm-9">
		<p class="hero-p no-content-message"><?php esc_html_e( 'There is currently nothing to display.', 'best-reloaded' ); ?></p>
	</div>
	<?php endif; ?>
</div><!-- end .row -->
<?php wp_reset_postdata();
