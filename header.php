<?php
 /**
  * header.php
  * Outputs the <head> section, opens any wrappers and displays the main site nav
  *
  * @package WordPress
  * @subpackage Best_Reloaded
  * @since Best Reloaded 0.1
  */
?>
<!doctype html>
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>>    <!--<![endif]-->
<head>
    <?php
    if ( ! function_exists( '_wp_render_title_tag' ) ) {
    	function theme_slug_render_title() {
    ?>
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php
    	}
    	add_action( 'wp_head', 'theme_slug_render_title' );
    }
    ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
    <header>
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		  <!-- Brand and toggle get grouped for better mobile display -->
		  <div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-top-collapse">
			  <span class="sr-only">Toggle navigation</span>
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			</button>
			<span class="navbar-brand assistive visible-xs">Navigation:</span>
		  </div>

		  <!-- Collect the nav links, forms, and other content for toggling -->
		  <div class="collapse navbar-collapse navbar-top-collapse">
			<?php
				wp_nav_menu( array(
					'menu'       => 'nav_topbar',
					'theme_location' => 'nav_topbar',
					'depth'      => 2,
					'container'  => false,
					'menu_class' => 'nav navbar-nav',
					'fallback_cb' => 'topbar_nav_fallback',
					'walker' => new wp_bootstrap_navwalker())
				);
			?>
		  </div><!-- /.navbar-collapse -->
		</nav>
    </header>
    <div class="container container-main container-wrapper">
        <div class="row">
            <div class="col-sm-8 site-header">

				<?php if ( of_get_option( 'bestreloaded_site_heading_img_checkbox', 'no entry' ) && of_get_option( 'site_heading_img', 'no entry' ) ) :
                    // if this checkbox is ticked AND an image is set THEN output the image
                    ?>
					<div class="name-logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
							<img src="<?php echo ( of_get_option( 'site_heading_img', 'no entry' ) ) ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
						</a>
					</div>
				<?php else :
                    // if the header image is not set or checkbox is off then output text site-title
                    ?>
					<div class="name-text">
						<?php if( is_home() || is_front_page() ) {
							// for SEO reasons site title as h1 is only on home and blog page, otherwise it's a styled span
                            ?>
							<h1 class="site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
							</h1>
						<?php } else { ?>
							<span class="h1 site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
							</span>
						<?php }
						// end site-title check
						?>
					</div>
				<?php endif; ?>
            </div><!-- end .col-md-8 -->
            <?php if ( of_get_option( 'bestreloaded_display_header_banner_area', 'no entry' ) ) : ?>
                <div class="col-sm-4 header-banner-area">
                    <?php echo do_shortcode( of_get_option( 'bestreloaded_header_banner_area', 'no entry' ) ); ?>
                </div>
            <?php endif; ?>
        </div><!-- end .row -->
        <hr class="hr-row-divider" style="clear: both;">
