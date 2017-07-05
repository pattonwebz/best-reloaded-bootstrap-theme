<?php
 /**
  * The sidebar-home.php file.
  *
  * Displays the set of widget areas available for editing in the
  * #main_content section of template-home.php
  *
  * @package Best_Reloaded
  * @since Best Reloaded v0.1
  */

?>

<?php if ( get_theme_mod( 'display_homepage_widget_row' ) ) : ?>

	<div class="row widget-area">

		<?php dynamic_sidebar( 'sidebar-3' ); ?>

	</div><!-- end .row -->

<?php endif; ?>

<div class="row blog-three-up">
	<div class="col-sm-3 widget-area">

		<?php dynamic_sidebar( 'sidebar-4' ); ?>

	</div><!-- end .col-sm-3 -->
