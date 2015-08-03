<?php

/* =============================================================
 * header.php
 * =============================================================
 * Displays all of the <head> section and everything up to the 
 * end of the <div class="row"> containing the site title and 
 * <hr> below for responsive spacing
 * ============================================================= */
 
?>
<!doctype html>
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>>    <!--<![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title><?php wp_title(''); ?></title>
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
				<?php if ( of_get_option( 'site_heading', 'no entry' ) ) : ?>
					<div class="name-logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
							<img src="<?php echo ( of_get_option( 'site_heading_img', 'no entry' ) ) ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
						</a>
					</div>
				<?php else : ?>
					<div class="name-text">
						<?php if( is_home() || is_front_page() ) { 
							// for SEO reasons site title as h1 is only on home and blog page, otherwise it's a styled span
							?>
							<hgroup>
								<h1 class="site-title">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
								</h1>
							</hgroup>
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