<?php
/**
 * 404.php
 * Displays a page when a link is broken or mistyped
 *
 * @package WordPress
 * @subpackage Best_Reloaded
 * @since Best Reloaded 0.1
 */
?>

<?php get_header(); ?>
        <?php get_template_part( 'featured', 'bar' ); ?>

        <div id="main_content" role="main">
            <div class="row">
                <div class="col-sm-12">
                    <h2 style="font-size: 3em; text-align: center; margin: -5px auto 33px;">page not found</h2>
                    <p class="hero-p">Sorry, but the page you were trying to view does not exist.<br/>It looks like this was the result of either:</p>
                    <ul style="display: table; margin: 30px auto 35px; font-size: 1.5em; list-style: none; text-align: center;">
                        <li>a mistyped address</li>
                        <li>an out-of-date link</li>
                    </ul>
                    <p class="hero-p">You can try to search in the navigation above,<br/>or check out some of our latest posts below.</p>
                    <hr class="hr-row-divider">
                </div><!-- end .span12 -->
            </div><!-- end .row -->
            <div class="row blog-three-up">

                <?php
                    global $postcount;

                    $args = array( 'posts_per_page' => 3 );
                    $loop = new WP_Query( $args );
                    if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); if ( ++$postcount > 3 ) continue;
                ?>

                <div class="col-sm-4">
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
                            <span class="meta"><?php the_time('F j, Y'); ?> &#8226; <a href="<?php comments_link(); ?>" title="<?php comments_number( 'no comments', 'one comment', '% comments' ); ?>"><?php comments_number( 'no comments', 'one Comment', '% comments' ); ?></a></span>
                        </footer>
                    </article>
                    <hr class="hr-row-divider">
                </div><!-- end .col-sm-4 -->

                <?php endwhile; else: ?>

                <div class="col-sm-9">
                    <p class="hero-p" style="font-size: 2em; padding: 25px 0;">there are currently no posts to display :(</p>
                </div>

                <?php endif; ?>

            </div><!-- end .row -->
        </div><!-- end #main_content -->
<?php get_footer(); ?>
