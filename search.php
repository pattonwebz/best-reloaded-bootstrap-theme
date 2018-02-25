<?php
/**
 * The search.php file.
 *
 * Default template for search templates
 *
 * @package Best_Reloaded
 * @since Best Reloaded v0.1
 */

get_header();
// This is the hook used to add featurebar content.
best_reloaded_do_featurebar();
best_reloaded_do_before_main_content_row()
// open he main row div and do the laout selection actions.
?>
<div <?php best_reloaded_do_layout_selection(); ?>>
	<div class="col-md-8">
		<div id="main_content" class="blog-page" role="main">

			<?php
			get_template_part( 'inc/parts/loop', 'main' );

			// Add custom pagination if we can.
			if ( function_exists( 'pagenavi' ) ) {
				pagenavi();
			}
			?>

		</div><!-- end #main_content -->

	</div><!-- end .col-md-8 -->

	<?php get_sidebar( 'main' ); ?>

</div><!-- end .row -->

<?php
get_footer();
?>
