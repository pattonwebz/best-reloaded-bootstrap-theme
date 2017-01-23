<?php
 /**
  * sidebar-home.php
  * Displays the set of widget areas available for editing in the
  * #main_content section of template-home.php
  *
  * @package WordPress
  * @subpackage Best_Reloaded
  * @since Best Reloaded 0.1
  */
?>

    <div class="col-md-3 widget-area">

        <?php dynamic_sidebar( 'sidebar-2' ); ?>

    </div><!-- end .col-md-3 -->
</div><!-- end .row -->

<?php if ( get_theme_mod( 'bestreloaded_display_homepage_widget_row' ) ) : ?>

    <div class="row widget-area">

        <?php dynamic_sidebar( 'sidebar-3' ); ?>

    </div><!-- end .row -->

<?php endif; ?>

<div class="row blog-three-up">
    <div class="col-sm-3 widget-area">

        <?php dynamic_sidebar( 'sidebar-4' ); ?>

    </div><!-- end .col-sm-3 -->
