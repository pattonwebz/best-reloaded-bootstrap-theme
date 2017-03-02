<?php
 /**
  * loop-home.php
  * Outputs the main homepage posts loop
  *
  * @package WordPress
  * @subpackage Best_Reloaded
  * @since Best Reloaded 0.1
  */
?>

<?php
    global $postcount;
	global $best_doNotGetDuplicates;
	if( !is_array( $best_doNotGetDuplicates ) ){
		$best_doNotGetDuplicates = array();
	}
    $args = array(
		'posts_per_page' 	=> 3,
 		'post__not_in' 		=> $best_doNotGetDuplicates
	);
    $loop = new WP_Query( $args );
	var_dump($best_doNotGetDuplicates);
    if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); if ( ++$postcount > 3 ) continue;
?>

<div class="col-sm-3">
    <article  <?php post_class(); ?> >
        <header>
            <a href="<?php the_permalink(); ?>" class="post-thumb">
                <span>
                    <?php get_template_part( 'featured', 'image' ); ?>
                </span>
            </a>
            <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
        </header>
        <?php the_excerpt(); ?>
        <footer>
			<span class="meta"><?php the_time('F j, Y'); ?> &#8226; <a href="<?php comments_link(); ?>" title="<?php comments_number( 'No Comments', 'One Comment', '% Comments' ); ?>"><?php comments_number( 'No Comments', 'One Comment', '% Comments' ); ?></a></span>
        </footer>
    </article>
    <hr class="hr-row-divider">
</div><!-- end col-sm-3 -->

<?php endwhile; else: ?>

<div class="col-sm-9">
    <p class="hero-p" style="font-size: 2em; padding: 25px 0 35px;">there are currently no posts to display :(</p>
</div>

<?php endif; ?>
