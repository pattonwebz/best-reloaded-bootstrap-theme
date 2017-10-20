<?php
 /**
  * The loop-main.php file.
  *
  * The main loop used primarily by index.php and search.php
  *
  * @package Best_Reloaded
  * @since Best Reloaded v0.1
  */

?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<?php if ( 'page' === $post->post_type ) : ?>

		<article <?php post_class(); ?> >
			<header>
				<a href="<?php the_permalink(); ?>" class="post-thumb" title="<?php esc_attr( get_the_title ) ?>">
					<span>
						<?php get_template_part( 'inc/parts/featured', 'image' ); ?>
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
					<div class="hoverspan">
						<?php get_template_part( 'inc/parts/featured', 'image' ); ?>
					</div>
				</a>
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			</header>
			<div class="row">
				<div class="col-sm-8">
					<?php the_excerpt(); ?>
				</div>
				<div class="col-sm-4">
					<?php best_reloaded_do_post_meta(); ?>
				</div>
			</div><!-- end .row -->
		</article>
		<hr class="hr-row-divider">

	<?php endif; ?>

<?php endwhile; else :

	if ( is_search() ) {
		echo '<p class="hero-p no-content-message in-loop">' . esc_html( 'Sorry, nothing matches that criteria', 'best-reloaded' ) . '</p><hr class="hr-row-divider">';
	} else {
		echo '<p class="hero-p no-content-message in-loop">' . esc_html( 'There are currently no posts to display.', 'best-reloaded' ) . '</p><hr class="hr-row-divider">';
	}

endif; ?>
