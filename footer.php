<?php
/**
 * footer.php
 * Outputs the site footer and closes any remaining opened tags
 *
 * @subpackage Best_Reloaded
 * @since Best Reloaded 0.1
 */
?>

    </div><!-- end .container.container-main -->

    <footer id="site-footer" class="container" role="contentinfo">

        <?php if ( get_theme_mod( 'bestreloaded_display_footer_top' ) ) : ?>

        <div class="footer-top">
            <div class="widget-area row">
                <div class="footer-widget-col col-md-3">
                    <?php if ( !dynamic_sidebar( 'sidebar-5' ) ) : echo '&nbsp;'; endif; ?>
                </div>
                <div class="footer-widget-col col-md-3">
                    <?php if ( !dynamic_sidebar( 'sidebar-6' ) ) : echo '&nbsp;'; endif; ?>
                </div>
                <div class="footer-widget-col col-md-3">
                    <?php if ( !dynamic_sidebar( 'sidebar-7' ) ) : echo '&nbsp;'; endif; ?>
                </div>
                <div class="footer-widget-col col-md-3">
                    <?php if ( !dynamic_sidebar( 'sidebar-8' ) ) : echo '&nbsp;'; endif; ?>
                </div>
            </div><!-- end .widget-area -->
        </div><!-- end .footer-top -->

        <?php endif; ?>
        <?php if ( get_theme_mod( 'bestreloaded_display_footer_bottom' ) ) : ?>

        <div class="footer-bottom">
            <div class="row">
                <div class="col-sm-5">
                    <p id="footer-site-title"><?php echo wp_kses_post( get_theme_mod( 'bestreloaded_footer_bottom_tagline', sprintf( __( '&copy; %1$s %2$s', 'best-reloaded' ), date_i18n( __( 'Y', 'best-reloaded' ) ), get_bloginfo( 'name' ) ) ) ); ?></p>
                </div>
                <div class="col-sm-7">
                    <nav role="navigation">

                        <?php
							wp_nav_menu( array(
								'theme_location' => 'best_reloaded_nav_footer',
								'depth'      => 1,
								'container'  => false,
								'menu_class' => 'nav justify-content-end',
								'fallback_cb' => 'best_reloaded_footer_nav_fallback',
								'walker' => new wp_bootstrap_navwalker())
							);
						?>

                    </nav>
                </div>
            </div><!-- end .row -->
        </div><!-- end .footer-bottom -->

        <?php endif; ?>

    </footer>

<?php wp_footer(); ?>

</body>
</html>
