<?php
 /**
  * is this borked???
  */
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php if(is_home()|is_front_page()) { echo bloginfo("name"); echo " | "; echo bloginfo("description"); } elseif (get_post_meta($post->ID, 'custom_text', true)) { echo get_post_meta($post->ID, 'custom_text', true).' | '; echo bloginfo("name"); } else { wp_title(); }?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
		<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
		<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
		<![endif]-->

		<?php wp_head(); ?>
  </head>
  <body <?php body_class( 'container' ); ?>>
  <div id="masthead">
          <span id="site-title" class="lead text-center"><?php echo get_bloginfo ( 'title' ); ?></span>
          <span id="site-tagline" class="muted text-center"><?php echo get_bloginfo ( 'description' ); ?></span>
		  <?php wp_nav_menu( array( 'theme_location' => 'head-nav', 'container' => 'nav', 'container_class' => 'pull-right', 'menu_class' => 'nav nav-pills' ) ); ?>
