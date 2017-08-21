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
	<div class="col-sm-3 widget-area">
		<?php
		if ( is_active_sidebar( 'sidebar-4' ) ) {
			dynamic_sidebar( 'sidebar-4' );
		} else {
			the_widget( 'WP_Widget_Tag_Cloud' );
		} ?>
	</div><!-- end .col-sm-3 -->
	<?php
	global $best_do_not_get_duplicates;
	if ( ! is_array( $best_do_not_get_duplicates ) ) {
		$best_do_not_get_duplicates = array();
	}
	$args = array(
		'posts_per_page' 	=> 3,
		'post__not_in' 		=> $best_do_not_get_duplicates,
	);
	$loop = new WP_Query( $args );
	if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();	?>
	<div class="col-sm-3">
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
