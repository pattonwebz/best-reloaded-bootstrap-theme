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
	// need to subtract any sticky posts from the posts per page number due to
	// sticky posts being included but not being counted correctly
	$sticky = count(get_option('sticky_posts'));
    $args = array(
		'post_type' => 'post',
		'posts_per_page' => 3 - $sticky
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
        <p class="hero-p" style="padding: 40px;"><?php esc_html_e("Sorry, couldn't get any slides."); ?></p>
    </div>

<?php endif; ?>
