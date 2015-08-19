<?php
 /**
  * Template Name: Home
  *
  * home.php
  * Page template used for setting the front page
  *
  * @package WordPress
  * @subpackage Best_Reloaded
  * @since Best Reloaded 0.1
  */
?>

<?php get_header(); ?>
    <?php if ( of_get_option( 'bestreloaded_display_intro_text', 'no entry' ) ) : ?>
        <div class="row">
            <div class="col-xs-12 text-center">
                <p class="hero-p"><?php echo ( of_get_option( 'bestreloaded_intro_text', 'no entry' ) ) ?></p>
                <hr class="hr-row-divider">
            </div><!-- end .col-xs-12 -->
        </div><!-- end .row -->
    <?php endif; ?>
    <div id="main_content" role="main">
        <div class="row">
            <div class="col-sm-9">
                <div id="carousel-example-generic" class="carousel slide">
                    <!-- Indicators -->
				    <ol class="carousel-indicators">
					    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
					    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
					    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
				    </ol>

				    <!-- Wrapper for slides -->
    				<div class="carousel-inner">
    				    <?php get_template_part( 'loop', 'slides' ); ?>
    				</div>

					<!-- Controls -->
					<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
						<span class="icon-prev"></span>
					</a>
					<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
						<span class="icon-next"></span>
					</a>
				</div>
	            <hr class="hr-row-divider">
	        </div><!-- end .col-sm-9 -->

            <?php // Include sidebar for static homepage, which includes widget area to the right of the slider, widget row below slider, and widget area to the left of the blog ?>
            <?php get_sidebar( 'home' ); ?>

            <?php get_template_part( 'loop', 'home' ); ?>

        </div><!-- end .row -->
    </div><!-- end #main_content -->
<?php get_footer(); ?>
