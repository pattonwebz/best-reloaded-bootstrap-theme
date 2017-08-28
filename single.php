<?php
 /**
  * The single.php file.
  *
  * Displays content for a single blog post
  *
  * @package Best_Reloaded
  * @since Best Reloaded v0.1
  */

?>

<?php get_header(); ?>
		<?php // This is the hook used to add featurebar content.
		best_reloaded_do_featurebar();
		best_reloaded_do_before_main_content_row()
		// open he main row div and do the laout selection actions.	?>
		<div <?php best_reloaded_do_layout_selection(); ?>>
			<?php best_reloaded_do_breadcrumbs(); ?>
			<div class="col-md-8">
				<div id="main_content" role="main">

					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

						<h2 class="page-title"><?php the_title(); ?></h2>
						<?php best_reloaded_do_post_meta(); ?>
						<ul class="prev-next-single pager clearfix">
							<li class="previous"><?php previous_post_link( '%link', '&larr; ' . esc_html__( 'Previous Post', 'best-reloaded' ) ); ?></li>
							<li class="next"><?php next_post_link( '%link', esc_html__( 'Next Post', 'best-reloaded' ) . ' &rarr;' ); ?></li>
						</ul>

						<div id="social">
							<div id="social-block">
								<?php
								if ( function_exists( 'sharing_display' ) ) {
									sharing_display( '', true );
								}
								if ( class_exists( 'Jetpack_Likes' ) ) {
									$jp_likes = new Jetpack_Likes;
									// all user input escaped by jetpack in the class
									echo $jp_likes->post_likes( '' ); // xss ok.
								} ?>
							</div>
						</div>

						<?php if ( is_active_sidebar( 'before-post-widgets' ) || ( true === get_post_meta( $post->ID, 'ofo', true ) && true === get_post_meta( $post->ID, 'ofo-text', true ) ) ) { ?>
							<div class="featured-bar featured-bar-post">
									<?php get_template_part( 'inc/parts/featured', 'post-open' ); ?>
							</div>
						<?php } ?>
						<?php the_content(); ?>
						<?php the_tags( '<span class="post-tags"><span class="meta">' . esc_html__( 'Tags: ', 'best-reloaded' ) . '</span> ', ' ', '</span>' ); ?>
						<?php wp_link_pages( array(
							'before' => '<hr class="hr-row-divider"><p class="wp-link-pages hero-p">' . esc_html__( 'Continue Reading: ', 'best-reloaded' ),
							'after' => '</p>',
						)); ?>

					<?php endwhile; else : ?>

						<p class="hero-p no-content-message"><?php esc_html_e( 'There is currently nothing to display.', 'best-reloaded' ); ?></p>

					<?php endif; ?>

				</div><!-- end #main_content -->
				<hr class="hr-row-divider">

				<?php comments_template(); ?>

			</div><!-- end .col-md-8 -->

			<?php get_sidebar( 'main' ); ?>

		</div><!-- end .row -->

<?php get_footer(); ?>
