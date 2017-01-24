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

		<nav class="navbar fixed-top navbar-toggleable-md navbar-light bg-faded">
		  	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    	<span class="navbar-toggler-icon"></span>
		  	</button>
		  	<a class="navbar-brand" href="#">Navbar</a>

		  	<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<?php
				wp_nav_menu( array(
					'menu'       		=> 'nav_topbar',
					'theme_location' 	=> 'nav_topbar',
					'depth'      		=> 0,
					'container'  		=> false,
					'menu_class' 		=> 'navbar-nav mr-auto',
					'fallback_cb' 		=> 'topbar_nav_fallback',
					'walker'            => new wp_bootstrap_navwalker()
				) );

				get_search_form();
				?>
		  	</div>
		</nav>

    </header>
    <div class="container container-main container-wrapper">
        <div class="row">
            <div class="col-sm-8 site-header">

				<?php if ( get_theme_mod( 'bestreloaded_site_heading_img_checkbox' ) && get_theme_mod( 'site_heading_img' ) ) :
                    // if this checkbox is ticked AND an image is set THEN output the image
                    ?>
					<div class="name-logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
							<img src="<?php echo ( get_theme_mod( 'site_heading_img' ) ) ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
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
			<?php echo '<!-- ' . get_theme_mod( 'bestreloaded_display_header_banner_area' ) . '-->'; ?>
			<?php echo '<!-- ' . get_theme_mod( 'bestreloaded_header_banner_area' ) . '-->'; ?>
            <?php if ( get_theme_mod( 'bestreloaded_display_header_banner_area' ) ) { ?>
                <div class="col-sm-4 header-banner-area">
                    <?php echo do_shortcode( get_theme_mod( 'bestreloaded_header_banner_area' ) ); ?>
                </div>
            <?php } ?>
        </div><!-- end .row -->
        <hr class="hr-row-divider" style="clear: both;">
