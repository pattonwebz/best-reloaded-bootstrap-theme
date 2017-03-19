<?php
 /**
  * related-posts.php
  * Displays related posts based on post tags for blog entries
  *
  * @package WordPress
  * @subpackage Best_Reloaded
  * @since Best Reloaded 0.1
  */
?>

<?php
    // Grab the first tag of the post to base related articles off of that
    // If there are other posts with that tag, display that
    $tags = wp_get_post_tags( $post->ID );
    if ( $tags ) {
        $first_tag = $tags[0]->term_id;
        $args = array(
            'tag__in'          => array( $first_tag ),
            'post__not_in'     => array( $post->ID ),
            'posts_per_page'   => 2,
            'caller_get_posts' => 1
        );
        $loop = new WP_Query( $args );
        if ( $loop->have_posts() ) :
            echo '<hr class="hr-row-divider"><h3 class="related-posts-title">'. esc_html__('Related Articles', 'best-reloaded' ) .'</h3><div class="row">';
            while ( $loop->have_posts() ) : $loop->the_post(); ?>

                <div class="col-md-4">
                    <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="post-thumb">
                        <span>
                            <?php get_template_part( 'featured', 'image' ); ?>
                        </span>
                    </a>
                    <h4 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
                </div><?php
            endwhile;
            echo '</div>';
        endif;
        wp_reset_postdata();
    // Else, display two random articles
    } else {
        $args = array(
            'orderby'             => 'rand',
            'ignore_sticky_posts' => true,
            'posts_per_page'      => 2
        );
        $loop = new WP_Query( $args );
        if ( $loop->have_posts() ) :
            echo '<hr class="hr-row-divider"><h3 class="related-posts-title">'. esc_html__('Related Articles', 'best-reloaded' ) .'</h3><div class="row">';
            while ( $loop->have_posts() ) : $loop->the_post(); ?>

                <div class="col-md-4">
                    <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="post-thumb">
                        <span>
                            <?php get_template_part( 'featured', 'image' ); ?>
                        </span>
                    </a>
                    <h4 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
                </div><?php

            endwhile;
            echo '</div>';
        endif;
        wp_reset_postdata();
    }
	
