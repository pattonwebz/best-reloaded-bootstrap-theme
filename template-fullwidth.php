<?php
/**
 * Template Name: Full Width
 *
 * The template-fullwidth.php file.
 *
 * Page template used for full width pages
 *
 * @package Best_Reloaded
 * @since Best Reloaded v0.1
 */

?>

<?php get_header(); ?>
	<?php
	// This is the hook used to add featurebar content.
	best_reloaded_do_featurebar();
	best_reloaded_do_before_main_content_row()
	?>
	<div class="row">
		<div class="col-12">
			<div id="main_content" role="main">

				<?php
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();
						?>

						<h2 class="page-title"><?php the_title(); ?></h2>
						<?php the_content(); ?>
						<?php
						wp_link_pages(
							array(
								'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'best-reloaded' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
							)
						);
						?>
					<?php
					}
				} else {
					?>

					<p class="hero-p no-content-message"><?php esc_html_e( 'There is currently nothing to display.', 'best-reloaded' ); ?></p>

				<?php
				}
				?>

			</div><!-- end #main_content -->
		</div><!-- end .col-xs-12 -->
	</div><!-- end .row -->

<?php get_footer(); ?>
