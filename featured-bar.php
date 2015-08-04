<?php
 /**
  * featured-bar.pjp
  * Displays a notification bar on certain pages when activated
  *
  * @package WordPress
  * @subpackage Best_Reloaded
  * @since Best Reloaded 1.0
  */
?>

<?php if ( of_get_option( 'bestreloaded_display_featured_bar' ) ) : ?>
<?php $chance = rand(0, 19); ?>
<div class="row">
    <div class="col-xs-12 text-center">
        <div class="featured-bar">
            <p class="lead">
				<?php if ($chance < 5 ) {
					echo of_get_option( 'bestreloaded_featured_bar1' );
				} else if ($chance >= 5 and $chance < 10) {
					echo do_shortcode(of_get_option( 'bestreloaded_featured_bar2' ));
				} else if ($chance >= 10 and $chance < 15 ) {
					echo do_shortcode(of_get_option( 'bestreloaded_featured_bar3' ));
				} else {
					echo of_get_option( 'bestreloaded_featured_bar' );
				}?>
			</p>
        </div>
		<hr class="hr-row-divider" style="clear: both;">
    </div>
</div><!-- end .row -->
<?php endif; ?>
