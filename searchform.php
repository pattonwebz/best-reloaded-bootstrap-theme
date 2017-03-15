<?php
 /**
  * searchform.php
  * This is the markup that is used whenever the default wordpress seach is called front-end
  *
  * @package WordPress
  * @subpackage Best_Reloaded
  * @since Best Reloaded 0.1
  */
?>
<form role="search" method="get" class="form-inline my2 my-lg-0" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label class="visually-hidden sr-only" for="s"><?php esc_html_e( 'Search:', 'best-reloaded' ); ?></label>
    <input type="text" class="form-control mr-sm-2" placeholder="<?php echo esc_attr_e('type and hit "enter" to search'); ?>" name="s" id="s" />
    <button type="submit" class="btn btn-outline-success my-2 my-sm-0" id="searchsubmit" value="Search" /><?php esc_html_e( 'Search', 'best-reloaded' ); ?></button>
</form>
