<?php
 /**
  * The page.php template.
  *
  * Displays content for single pages
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
			<div class="col-md-8">
				<div id="main_content" role="main">
				<?php
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post(); ?>
						<h2 class="page-title"><?php the_title(); ?></h2>
						<?php the_content(); ?>
						<?php
						wp_link_pages( array(
							'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'best-reloaded' ) . '</span>',
							'after'       => '</div>',
							'link_before' => '<span>',
							'link_after'  => '</span>',
						) );
					}
				} else {
					// We don't have a post, return error notice. ?>
					<p class="hero-p no-content-message"><?php esc_html_e( 'There is currently nothing to display.', 'best-reloaded' ); ?></p>
				<?php } ?>

				</div><!-- end #main_content -->
				<hr class="hr-row-divider">

				<?php comments_template(); ?>

			</div><!-- end .col-md-8 -->

			<?php get_sidebar( 'main' ); ?>

		</div><!-- end .row -->

<?php get_footer(); ?>
