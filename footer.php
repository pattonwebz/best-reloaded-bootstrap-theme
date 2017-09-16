<?php
/**
 * The footer.php file.
 *
 * Outputs the site footer and closes any remaining opened tags
 *
 * @package Best_Reloaded
 * @since Best Reloaded v0.1
 */

?>

	</div><!-- end .container.container-main -->

	<footer id="site-footer" class="container" role="contentinfo">
		<?php
		if ( get_theme_mod( 'display_footer_top', true ) ) {
			if ( is_active_sidebar( 'footer-col' ) ) { ?>
				<div class="footer-top">
					<div class="widget-area row">
						<?php dynamic_sidebar( 'footer-col' ); ?>
					</div><!-- end .widget-area -->
				</div><!-- end .footer-top -->
			<?php
			}
		}
		if ( get_theme_mod( 'display_footer_bottom', true ) ) { ?>
		<div class="footer-bottom" role="contentinfo">
			<div class="row">
				<div class="col-sm-5">
					<p id="footer-site-title"><?php echo wp_kses_post( get_theme_mod( 'footer_bottom_tagline',
						// translators: 1 is current year, 2 is site name.
						sprintf( __( '&copy; %1$s %2$s', 'best-reloaded' ), date_i18n( __( 'Y', 'best-reloaded' ) ), get_bloginfo( 'name' ) )
					) ); ?></p>
				</div>
				<div class="col-sm-7 align-self-center">
					<nav role="navigation" aria-label="Footer Menu">
						<span class="sr-only">Footer Menu</span>
						<?php
							wp_nav_menu( array(
								'theme_location' => 'best_reloaded_nav_footer',
								'depth'      => 1,
								'container'  => false,
								'menu_class' => 'nav justify-content-end',
								'fallback_cb' => 'best_reloaded_footer_nav_fallback',
								'walker' => new wp_bootstrap_navwalker(),
								)
							);
						?>

					</nav>
				</div>
			</div><!-- end .row -->
		</div><!-- end .footer-bottom -->

		<?php }; ?>

	</footer>

<?php wp_footer(); ?>

</body>
</html>
