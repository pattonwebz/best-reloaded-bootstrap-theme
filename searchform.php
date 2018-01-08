<?php
 /**
  * The searchform.php file.
  *
  * This is the markup that is used whenever the default wordpress seach is called front-end
  *
  * @package Best_Reloaded
  * @since Best Reloaded v0.1
  */

?>
<form role="search" method="get" class="form-inline my2 my-lg-0" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="visually-hidden sr-only" for="s"><?php esc_html_e( 'Search:', 'best-reloaded' ); ?></label>
	<input type="text" class="form-control mr-sm-2" placeholder="<?php esc_attr_e( 'type and hit "enter" to search', 'best-reloaded' ); ?>" name="s" id="s" />
	<button type="submit" class="btn <?php echo esc_attr( get_theme_mod( 'search_color', best_reloaded_setting_defaults( 'search_color' ) ) ); ?> my-2 my-sm-0" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'best-reloaded' ); ?>" /><?php esc_html_e( 'Search', 'best-reloaded' ); ?></button>
</form>
