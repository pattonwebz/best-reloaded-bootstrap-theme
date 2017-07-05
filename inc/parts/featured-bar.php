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

<?php if ( get_theme_mod( 'display_featured_bar' ) && get_theme_mod( 'featured_bar' ) ) { ?>
	<section class="featured-bar text-center">
		<p class="lead">
				<?php echo do_shortcode( get_theme_mod( 'featured_bar' ) ); ?>
		</p>
	</section>
<?php } ?>
