<?php
 /**
  * loop-main.php
  * The main loop used primarily by index.php and search.php
  *
  * @package WordPress
  * @subpackage Best_Reloaded
  * @since Best Reloaded 0.1
  */
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <?php if ( $post->post_type === 'page' ) : ?>

        <article <?php post_class(); ?> >
            <header>
                <a href="<?php the_permalink(); ?>" class="post-thumb">
                    <span>
                        <?php get_template_part( 'featured', 'image' ); ?>
                    </span>
                </a>
                <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            </header>
            <?php the_excerpt(); ?>
        </article>
        <hr class="hr-row-divider">

    <?php else : ?>

        <article <?php post_class(); ?> >
            <header>
                <a href="<?php the_permalink(); ?>" class="post-thumb">
                    <span>
                        <?php get_template_part( 'featured', 'image' ); ?>
                    </span>
                </a>
                <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            </header>
            <div class="row">
                <div class="col-sm-8">
                    <?php the_excerpt(); ?>
                </div>
                <div class="col-sm-4">
                    <footer>
                        <span class="meta">Written by <?php the_author_link(); ?></span>
                        <span class="meta">on <?php the_time('F j, Y'); ?></span>
                        <span class="meta">in <?php the_category( ' and ' ); ?></span>
                        <span class="meta">with <a href="<?php comments_link(); ?>" title="<?php comments_number( 'no comments', 'one comment', '% comments' ); ?>"><?php comments_number( 'no comments', 'one Comment', '% comments' ); ?></a></span>
                    </footer>
                </div>
            </div><!-- end .row -->
        </article>
        <hr class="hr-row-divider">

    <?php endif; ?>

<?php endwhile; else:

    if ( is_search() ) {
        echo '<p class="hero-p" style="padding: 25px 0 35px;">sorry, nothing matches that criteria</p><hr class="hr-row-divider">';
    } else {
        echo '<p class="hero-p" style="padding: 25px 0 35px;">there are currently no posts to display :(</p><hr class="hr-row-divider">';
    }

endif; ?>
