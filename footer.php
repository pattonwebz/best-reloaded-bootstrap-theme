<?php
/**
 * footer.php
 * Outputs the site footer and closes any remaining opened tags
 *
 * @package WordPress
 * @subpackage Best_Reloaded
 * @since Best Reloaded 0.1
 */
?>

    </div><!-- end .container.container-main -->

    <?php if ( of_get_option( 'bestreloaded_display_twitter' ) ) : ?>

    <div class="container container-main twitter-feed">
        <div class="row">
            <div class="col-sm-12">

                <?php
                    $twitter_user = of_get_option( 'bestreloaded_twitter' );
                    wp_echo_twitter( $twitter_user );
                ?>

            </div>
        </div>
    </div>

    <?php endif; ?>

    <footer id="site-footer" class="container" role="contentinfo">

        <?php if ( of_get_option( 'bestreloaded_display_footer_top' ) ) : ?>

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
        <?php if ( of_get_option( 'bestreloaded_display_footer_bottom' ) ) : ?>

        <div class="footer-bottom">
            <div class="row">
                <div class="col-sm-5">
                    <p id="footer-site-title"><?php echo ( of_get_option( 'bestreloaded_footer_bottom_tagline' ) ); ?></p>
                </div>
                <div class="col-sm-7">
                    <nav role="navigation">

                        <?php
							wp_nav_menu( array(
								'menu'       => 'nav_footer',
								'theme_location' => 'nav_footer',
								'depth'      => 0,
								'container'  => false,
								'menu_class' => 'nav nav-pills nav-justified',
								'fallback_cb' => 'topbar_nav_fallback',
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
