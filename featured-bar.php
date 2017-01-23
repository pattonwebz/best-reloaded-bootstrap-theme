<?php
 /**
  * featured-bar.php
  * Displays a notification bar on certain pages when activated
  *
  * @package WordPress
  * @subpackage Best_Reloaded
  * @since Best Reloaded 0.1
  */
?>

<?php if ( get_theme_mod( 'bestreloaded_display_featured_bar' ) ) : ?>
<div class="row">
    <div class="col-sm-12 text-center">
        <div class="featured-bar">
            <p class="lead">
				<?php if ( get_theme_mod( 'bestreloaded_featured_bar' ) ) {
					echo do_shortcode( get_theme_mod( 'bestreloaded_featured_bar' ) );
				} ?>
			</p>
        </div>
		<hr class="hr-row-divider" style="clear: both;">
    </div>
</div><!-- end .row -->
<?php endif; ?>
