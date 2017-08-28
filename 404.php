<?php
/**
 * The 404.php file.
 *
 * Displays a page when a link is broken or mistyped
 *
 * @package Best_Reloaded
 * @since      Best Reloaded 0.1
 */

?>

<?php get_header(); ?>
	<?php // This is the hook used to add featurebar content.
	best_reloaded_do_featurebar();
	best_reloaded_do_before_main_content_row(); ?>
		<div id="main_content" role="main">
			<div class="row">
				<div class="col-sm-12 not-found-404">
					<h2 class="title"><?php esc_html_e( 'Page Not Found', 'best-reloaded' ); ?></h2>
					<p class="hero-p"><?php esc_html_e( 'Sorry, but the page you were trying to view does not exist.', 'best-reloaded' ); ?><br/><?php esc_html_e( 'It looks like this was the result of either:', 'best-reloaded' ); ?></p>
					<ul>
						<li><?php esc_html_e( 'a mistyped address', 'best-reloaded' ); ?></li>
						<li><?php esc_html_e( 'an out-of-date link', 'best-reloaded' ); ?></li>
					</ul>
					<p class="hero-p"><?php esc_html_e( 'You can try to search in the navigation above,', 'best-reloaded' ); ?><br/><?php esc_html_e( 'or check out some of our latest posts below.', 'best-reloaded' ); ?></p>
					<hr class="hr-row-divider">
				</div><!-- end .span12 -->
			</div><!-- end .row -->
			<div class="row blog-three-up">

				<?php
					global $postcount;
					$args = array(
						'posts_per_page' => 3,
					);
					// query for 3 latest posts.
					$loop = new WP_Query( $args );
					if ( $loop->have_posts() ) {
						while ( $loop->have_posts() ) {
							$loop->the_post();
							if ( ++$postcount > 3 ) {
								continue;
							}
							wp_reset_postdata();
					?>

					<div class="col-sm-4">
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
							<footer>
								<span class="meta"><?php the_time( get_option( 'date_format' ) ); ?> &#8226; <a href="<?php comments_link(); ?>" title="<?php comments_number( 'no comments', 'one comment', '% comments' ); ?>"><?php comments_number( 'no comments', 'one Comment', '% comments' ); ?></a></span>
							</footer>
						</article>
						<hr class="hr-row-divider">
					</div><!-- end .col-sm-4 -->

						<?php }
					} else { ?>

					<div class="col-sm-9">
						<p class="hero-p no-content-message"><?php esc_html_e( 'There is currently nothing to display.', 'best-reloaded' ); ?></p>
					</div>

					<?php } ?>

			</div><!-- end .row -->
		</div><!-- end #main_content -->
<?php get_footer(); ?>
