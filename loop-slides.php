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
// sticky posts being included but not counted by posts_per_page
$sticky = count(get_option('sticky_posts'));
$args = array(
	'post_type' => 'post',
	'posts_per_page' => 3 - $sticky
);
$loop = new WP_Query( $args );
$i = 0;
// set a global to track post IDs we don't want output in other loops on this page
global $best_doNotGetDuplicates;
// set the variable to an array - if it's not already
if( !is_array( $best_doNotGetDuplicates ) ){
	$best_doNotGetDuplicates = array();
}
if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();
// store the post ID in global array for use in other loops in home template
$best_doNotGetDuplicates[] = get_the_ID();
?>

<div class="carousel-item <?php if ($i==0) { echo esc_attr( 'active' ); $i++; } ?>">

    <?php
            // display image without being wrapped in anchor element - should link this
            get_template_part( 'featured', 'image' );
    ?>

    <div class="carousel-caption d-none d-md-block">

            <h2><?php // should wrap a link around the title
			the_title(); ?></h2>

        <?php the_excerpt(); ?>
    </div>
</div>

<?php endwhile; else : ?>

    <div>
        <p class="hero-p no-content-message"><?php esc_html_e("Sorry, couldn't get any slides.", 'best-reloaded' ); ?></p>
    </div>

<?php endif; ?>
