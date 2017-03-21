<?php
 /**
  * single.php
  * Displays content for a single blog post
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

                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                        <h2 class="page-title"><?php the_title(); ?></h2>
                        <span class="meta text-muted">
							<span class="glyphicon glyphicon-pencil"></span>
							<?php
							esc_html_e( ' Written by ', 'best-reloaded' );
							the_author_link();
							esc_html_e( ' on ', 'best-reloaded' );
							the_time( get_option( 'date_format' ) );
							esc_html_e( ' and posted in ', 'best-reloaded' );
							the_category( ' and ' ); ?>.
						</span>
                        <ul class="prev-next-single pager clearfix">
                            <li class="previous"><?php previous_post_link( '%link', '&larr; ' . esc_html__( 'Previous Post', 'best-reloaded' ) ); ?></li>
                            <li class="next"><?php next_post_link( '%link', esc_html__( 'Next Post', 'best-reloaded' ) . '&rarr;' ); ?></li>
                        </ul>

						<div id="social">
							<div id="social-block">
								<?php if ( function_exists( 'sharing_display' ) ) {
									sharing_display( '', true );
								}
								if ( class_exists( 'Jetpack_Likes' ) ) {
									$jp_likes = new Jetpack_Likes;
									// all user input escaped by jetpack in the class
									echo $jp_likes->post_likes( '' ); //xss ok
								} ?>
							</div>
						</div>

						<?php if( is_active_sidebar('sidebar-9') || ( true == get_post_meta($post->ID, 'ofo', true) && true == get_post_meta($post->ID, 'ofo-text', true) ) ) { ?>
                            <div class="featured-bar featured-bar-post">
            						<?php get_template_part( 'featured', 'post-open' ); ?>
            				</div>
                        <?php } ?>
                        <?php the_content(); ?>
                        <?php the_tags( '<span class="post-tags"><span class="meta">'. esc_html__('Tags: ', 'best-reloaded' ) .'</span> ', ' ', '</span>' ); /* &#8226; */ ?>
                        <?php wp_link_pages( array(
                            'before' => '<hr class="hr-row-divider"><p class="wp-link-pages hero-p">' . esc_html__('Continue Reading: ', 'best-reloaded' ),
                            'after' => '</p>'
                        )); ?>

                    <?php endwhile; else: ?>

                        <p class="hero-p no-content-message"><?php esc_html_e( 'There is currently nothing to display.', 'best-reloaded' ); ?></p>

                    <?php endif; ?>

                </div><!-- end #main_content -->
                <hr class="hr-row-divider">

                    <?php comments_template(); ?>

                <hr class="hr-row-divider">
            </div><!-- end .col-md-8 -->

            <?php get_sidebar( 'main' ); ?>

        </div><!-- end .row -->

<?php get_footer(); ?>
