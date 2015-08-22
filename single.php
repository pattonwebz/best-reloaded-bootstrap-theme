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
                        <span class="meta text-muted"><span class="glyphicon glyphicon-pencil"></span> Written by <?php the_author_link(); ?> on <?php the_time('F j, Y'); ?> and posted in <?php the_category( ' and ' ); ?>.</span>
                        <ul class="prev-next-single pager clearfix">
                            <li class="previous"><?php previous_post_link( '%link', '<span class="glyphicon glyphicon-chevron-left"></span> Older Posts' ); ?></li>
                            <li class="next"><?php next_post_link( '%link', 'Newer Posts <span class="glyphicon glyphicon-chevron-right"></span>' ); ?></li>
                        </ul>

						<div id="social">
							<div id="social-block">
								<?php if ( function_exists( 'sharing_display' ) ) {
									sharing_display( '', true );
								}
								if ( class_exists( 'Jetpack_Likes' ) ) {
									$custom_likes = new Jetpack_Likes;
									echo $custom_likes->post_likes( '' );
								} ?>
							</div>
						</div>

						<?php if( is_active_sidebar('sidebar-9') || ( true == get_post_meta($post->ID, 'ofo', true) && true == get_post_meta($post->ID, 'ofo-text', true) ) ) { ?>
                            <div class="featured-bar featured-bar-post">
            						<?php get_template_part( 'featured', 'post-open' ); ?>
            				</div>
                        <?php } ?>
                        <?php the_content(); ?>
                        <?php the_tags( '<span class="post-tags"><span class="meta">Tags:</span> ', ' ', '</span>' ); /* &#8226; */ ?>
                        <?php wp_link_pages( array(
                            'before' => '<hr class="hr-row-divider"><p class="wp-link-pages hero-p">Continue Reading: ',
                            'after' => '</p>'
                        )); ?>
                        <?php get_template_part( 'ads', 'posts' ); ?>

                    <?php endwhile; else: ?>

                        <p class="hero-p" style="padding: 30px 0;">there is currently nothing to display :(</p>

                    <?php endif; ?>

                </div><!-- end #main_content -->
                <hr class="hr-row-divider">

                    <?php comments_template(); ?>

                <hr class="hr-row-divider">
            </div><!-- end .col-md-8 -->

            <?php get_sidebar( 'main' ); ?>

        </div><!-- end .row -->

<?php get_footer(); ?>
