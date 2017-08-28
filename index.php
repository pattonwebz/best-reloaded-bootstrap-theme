<?php
/**
 * The main template file used when no others better match
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

					<?php get_template_part( 'inc/parts/loop', 'main' ); ?>

					<?php
							echo '<p class="hero-p">';
								$args = array(
									'prev_text'          => '<i class="fa fa-arrow-left"></i> ' . esc_html__( 'Previous Page', 'best-reloaded' ),
									'next_text'          => esc_html__( 'Next Page', 'best-reloaded' ) . ' <i class="fa fa-arrow-right"></i>',
									'screen_reader_text' => esc_html__( 'Posts Navigation', 'best-reloaded' ),
								);
								the_posts_navigation( $args );
								echo '</p><hr class="hr-row-divider">';
					?>

				</div><!-- end #main_content -->
			</div><!-- end .col-md-8 -->

			<?php get_sidebar( 'main' ); ?>

		</div><!-- end .row -->

<?php get_footer(); ?>
