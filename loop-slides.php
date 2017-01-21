<?php
 /**
  * loop-slides.php
  * Loop used to generate the slider
  *
  * @package WordPress
  * @subpackage Best_Reloaded
  * @since Best Reloaded 0.1
  */
?>

<?php
    $args = array( 'post_type' => 'slide' );
    $loop = new WP_Query( $args );
	$i = 0;
    if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();

    $meta = get_post_custom( $post->ID );
?>

    <div class="carousel-item <?php if ($i==0) { echo 'active'; $i++; } ?>">

        <?php
            // If the slide has an associated URL, wrap image in an anchor element
            if ( $meta['response_slide_url'][0] ) :
        ?>

            <a href="<?php echo $meta['response_slide_url'][0]; ?>" title="<?php the_title_attribute(); ?>">
                <?php get_template_part( 'featured', 'image' ); ?>
            </a>

        <?php
            else :
                // Else, display image without being wrapped in anchor element
                get_template_part( 'featured', 'image' );
            endif;
        ?>

        <div class="carousel-caption d-none d-md-block">

            <?php
                // If the slide has an associated URL, turn heading into a link
                if ( $meta['response_slide_url'][0] ) :
            ?>

                <h2><a href="<?php echo $meta['response_slide_url'][0]; ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

            <?php else : // Else, display as normal heading ?>

                <h2><?php the_title(); ?></h2>

            <?php endif; ?>

            <?php the_content(); ?>
        </div>
    </div>

<?php endwhile; else : ?>

    <li>
        <p class="hero-p" style="padding: 40px;">Setup your slides in the admin area by using the "Slide" custom post type, we'll take care of the rest!</p>
    </li>

<?php endif; ?>
