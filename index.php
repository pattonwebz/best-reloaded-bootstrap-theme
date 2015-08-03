<?php
/* =============================================================
 * index.php
 * =============================================================
 * Default page template for the theme
 * ============================================================= */
?>

<?php get_header(); ?>
        <?php get_template_part( 'featured', 'bar' ); ?>

        <div class="row">
            <div class="col-md-8">
                <div id="main_content" role="main">

                    <?php get_template_part( 'loop', 'main' ); ?>

                    <?php
                        if ( of_get_option( 'bestreloaded_pagination_option' ) ) :
                            // Add custom pagination
                            if ( function_exists( 'pagenavi' ) ) { pagenavi(); };
                        else :
                            echo '<p class="hero-p">';
                            posts_nav_link(' &#183; ', 'previous page', 'next page');
                            echo '</p><hr class="hr-row-divider">';
                        endif;
                    ?>

                </div><!-- end #main_content -->
            </div><!-- end .col-md-8 -->

            <?php get_sidebar( 'main' ); ?>

        </div><!-- end .row -->

<?php get_footer(); ?>
