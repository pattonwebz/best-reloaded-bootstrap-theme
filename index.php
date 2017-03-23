<?php
/**
 * The main template file
 *
 * @subpackage Best_Reloaded
 * @since Best Reloaded 0.1
 */
?>

<?php get_header(); ?>
        <?php get_template_part( 'inc/parts/featured', 'bar' ); ?>

        <div class="row">
            <div class="col-md-8">
                <div id="main_content" role="main">

                    <?php get_template_part( 'inc/parts/loop', 'main' ); ?>

                    <?php
                            echo '<p class="hero-p">';
								$args = array(
									'prev_text'          => esc_html__('previous page', 'best-reloaded' ),
									'next_text'          => esc_html__('next page', 'best-reloaded' ),
									'screen_reader_text' => esc_html__('Posts Navigation', 'best-reloaded' )
								);
								the_posts_navigation( $args );
                            echo '</p><hr class="hr-row-divider">';
                    ?>

                </div><!-- end #main_content -->
            </div><!-- end .col-md-8 -->

            <?php get_sidebar( 'main' ); ?>

        </div><!-- end .row -->

<?php get_footer(); ?>
