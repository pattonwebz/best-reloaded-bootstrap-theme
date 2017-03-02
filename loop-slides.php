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
    $args = array(
		'post_type' => 'post',
		'posts_per_page' => 3
	);
    $loop = new WP_Query( $args );
	$i = 0;
	global $best_doNotGetDuplicates;
	if( !is_array( $best_doNotGetDuplicates ) ){
		$best_doNotGetDuplicates = array();
	}
    if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();
	$best_doNotGetDuplicates[] = $post->ID;
    $meta = get_post_custom( $post->ID );
?>

    <div class="carousel-item <?php if ($i==0) { echo esc_attr( 'active' ); $i++; } ?>">

        <?php


                // Else, display image without being wrapped in anchor element
                get_template_part( 'featured', 'image' );

        ?>

        <div class="carousel-caption d-none d-md-block">



                <h2><?php the_title(); ?></h2>



            <?php the_excerpt(); ?>
        </div>
    </div>

<?php endwhile; else : ?>

    <div>
        <p class="hero-p" style="padding: 40px;">Setup your slides in the admin area by using the "Slide" custom post type, we'll take care of the rest!</p>
    </div>

<?php endif; ?>
