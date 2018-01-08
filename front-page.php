<?php
 /**
  *
  * The home.php file.
  *
  * Page template used for setting the front page
  *
  * @package Best_Reloaded
  * @since Best Reloaded v0.1
  */

?>

<?php get_header(); ?>
	<?php
	// Having the default value of 'intro_text' be FALSE is intentional as to
	// not output the example text on the front-end until in customizer.
	if ( get_theme_mod( 'display_intro_text', best_reloaded_setting_defaults( 'display_intro_text' ) ) && get_theme_mod( 'intro_text', false ) ) { ?>
		<div class="row">
			<div class="col-sm-12 text-center">
				<p class="hero-p"><?php echo wp_kses_post( get_theme_mod( 'intro_text', best_reloaded_setting_defaults( 'intro_text' ) ) ); ?></p>
				<hr class="hr-row-divider">
			</div><!-- end .col-xs-12 -->
		</div><!-- end .row -->
	<?php } ?>
	<div id="main_content" role="main">
		<div class="row">
			<div class="col-md-9">
				<div id="carousel-home" class="carousel slide" data-ride="carousel">
					<!-- Indicators -->
					<ol class="carousel-indicators">
						<?php $slides_max = get_theme_mod( 'slider_limit', best_reloaded_setting_defaults( 'slider_limit' ) );
						for ( $i = 0; $i < $slides_max ; $i++ ) { ?>
							<li data-target="#carousel-home" data-slide-to="<?php echo esc_attr( $i ); ?>" class="<?php if ( 0 === $i ) { echo esc_attr( 'active' ); } ?>"></li>
						<?php } ?>
					</ol>

					<!-- Wrapper for slides -->
					<div class="carousel-inner" role="listbox">
						<?php get_template_part( 'inc/parts/loop', 'slides' ); ?>
					</div>

					<!-- Controls -->
					<a class="carousel-control-prev" href="#carousel-home" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only"><?php esc_html_e( 'Previous', 'best-reloaded' ); ?></span>
					</a>
					<a class="carousel-control-next" href="#carousel-home" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only"><?php esc_html_e( 'Next', 'best-reloaded' );?></span>
					</a>
				</div>
				<hr class="hr-row-divider">
			</div><!-- end .col-sm-9 -->

			<div class="col-md-3 widget-area">
				<?php
				if ( is_active_sidebar( 'slider-row-sidebar' ) ) {
					dynamic_sidebar( 'slider-row-sidebar' );
				} else {
					the_widget( 'WP_Widget_Recent_Comments' );
				} ?>
			</div><!-- end .col-md-3 -->
		</div><!-- end .row -->

		<?php get_sidebar( 'home' ); ?>

		<?php get_template_part( 'inc/parts/loop', 'home' ); ?>


	</div><!-- end #main_content -->
<?php get_footer(); ?>
