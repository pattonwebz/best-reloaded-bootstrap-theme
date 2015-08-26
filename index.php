<?php
/**
 * The main template file
 *
 * @package WordPress
 * @subpackage Best_Reloaded
 * @since Best Reloaded 0.1
 */
?>

<?php get_header(); ?>
        <?php get_template_part( 'featured', 'bar' ); ?>

        <div class="row">
            <div class="col-md-8">
                <div id="main_content" role="main">

                    <?php get_template_part( 'loop', 'main' ); ?>
                    <?php if ( function_exists( 'pagenavi' ) ) {
                        pagenavi();
                        echo '<hr class="hr-row-divider">'; 
                    } else {
                            echo '<p class="hero-p">';
                            posts_nav_link(' &#183; ', 'previous page', 'next page');
                            echo '</p><hr class="hr-row-divider">';
                    } ?>

                </div><!-- end #main_content -->
            </div><!-- end .col-md-8 -->

            <?php get_sidebar( 'main' ); ?>

        </div><!-- end .row -->

<?php get_footer(); ?>
