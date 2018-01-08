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

<?php // intentially setting default of 'featured_bar' to FALSE instead of using the read default.
if ( get_theme_mod( 'display_featured_bar', best_reloaded_setting_defaults( 'display_featured_bar' ) ) && get_theme_mod( 'featured_bar', false ) ) { ?>
	<section class="featured-bar text-center">
		<p class="lead">
			<?php echo do_shortcode( get_theme_mod( 'featured_bar', best_reloaded_setting_defaults( 'featured_bar' ) ) ); ?>
		</p>
	</section>
<?php } ?>
