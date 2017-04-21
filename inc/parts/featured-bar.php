<?php
 /**
  * The featured-bar.php file.
  *
  * Displays a notification bar on certain pages when activated
  *
  * @package Best_Reloaded
  * @since Best Reloaded v0.1
  */

?>

<?php if ( get_theme_mod( 'bestreloaded_display_featured_bar' ) && get_theme_mod( 'bestreloaded_featured_bar' ) ) { ?>
	<div class="row">
		<div class="col-sm-12 text-center">
			<div class="featured-bar">
				<p class="lead">
						<?php echo do_shortcode( wp_kses_post( get_theme_mod( 'bestreloaded_featured_bar' ) ) ); ?>
				</p>
			</div>
			<hr class="hr-row-divider"">
		</div>
	</div><!-- end .row -->
<?php } ?>
