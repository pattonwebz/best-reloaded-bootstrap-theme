<?php
 /**
  * Template Name: Full Width
  *
  * template-fullwidth.php
  * Page template used for full width pages
  *
  * @package WordPress
  * @subpackage Best_Reloaded
  * @since Best Reloaded 0.1
  */
?>

<?php get_header(); ?>
        <?php get_template_part( 'featured', 'bar' ); ?>

        <div class="row">
            <div class="col-xs-12">
                <div id="main_content" role="main">

                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                    <h2 class="page-title"><?php the_title(); ?></h2>
                    <?php the_content(); ?>

                <?php endwhile; else: ?>

                    <p class="hero-p" style="font-size: 2em; padding: 25px 0;">there is currently nothing to display :(</p>

                <?php endif; ?>

                </div><!-- end #main_content -->
            </div><!-- end .col-xs-12 -->
        </div><!-- end .row -->

<?php get_footer(); ?>
