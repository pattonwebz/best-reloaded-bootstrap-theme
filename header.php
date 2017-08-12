<?php
 /**
  * The header.php file
  * Outputs the <head> section, opens any wrappers and displays the main site nav
  *
  * @package Best_Reloaded
  * @since Best Reloaded v0.1
  */

?>
<!doctype html>
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>>    <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<header>

		<nav class="navbar navbar-expand-md fixed-top navbar-light bg-light">

			<div class="container">

					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#headerNav" aria-controls="headerNav" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'best-reloaded' ); ?>">
						<span class="navbar-toggler-icon"></span>
					</button>

					<div class="collapse navbar-collapse" id="headerNav">
						<?php
						wp_nav_menu( array(
							'theme_location' 	=> 'best_reloaded_nav_topbar',
							'depth'      		=> 2,
							'container'  		=> false,
							'menu_class' 		=> 'navbar-nav mr-auto',
							'fallback_cb' 		=> 'best_reloaded_topbar_nav_fallback',
							'walker'            => new wp_bootstrap_navwalker(),
						) );

						get_search_form();
						?>
					</div>

			</div>
		</nav>

	</header>
	<div class="container container-main container-wrapper">
		<div class="row">
			<div class="col-sm-8 site-header">

				<?php
				$custom_logo_id = get_theme_mod( 'custom_logo' );
				if ( $custom_logo_id ) {
					// Since we have a custom logo get the url of it.
					$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
					?>
					<div class="name-logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
							<img src="<?php echo esc_url( $image[0] ) ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
						</a>
					</div>
				<?php } else {
					// If the header image is not set output text site-title.
					?>
					<div class="name-text">
						<?php if ( is_home() || is_front_page() ) {
							// For SEO reasons site title as h1 is only on home and blog page, otherwise it's a styled span.
							?>
							<h1 class="site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
							</h1>
						<?php } else { ?>
							<span class="h1 site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
							</span>
						<?php }
						// end site-title check.
						?>
					</div>
				<?php } ?>
			</div><!-- end .col-md-8 -->
			<?php if ( get_theme_mod( 'display_header_banner_area' ) ) { ?>
				<div class="col-sm-4 header-banner-area">
					<?php echo do_shortcode( wp_kses_post( get_theme_mod( 'header_banner_area' ) ) ); ?>
				</div>
			<?php } ?>
		</div><!-- end .row -->
		<hr class="hr-row-divider">
