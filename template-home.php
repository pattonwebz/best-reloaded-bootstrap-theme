<?php
 /**
  * Template Name: Home
  *
  * home.php
  * Page template used for setting the front page
  *
  * @package WordPress
  * @subpackage Best_Reloaded
  * @since Best Reloaded 1.0
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
			<div class="row">
					<div class="col-xs-6">
						<?php
						// THE FOLLOWING BLOCK IS USED TO RETRIEVE AND DISPLAY LINK INFORMATION.
						// PLACE THIS ENTIRE BLOCK IN THE AREA YOU WANT THE DATA TO BE DISPLAYED.

						// MODIFY THE VARIABLES BELOW:
						// The following variable defines whether links are opened in a new window
						// (1 = Yes, 0 = No)
						$OpenInNewWindow = "1";

						// # DO NOT MODIFY ANYTHING ELSE BELOW THIS LINE!
						// ----------------------------------------------
						$BLKey = "O5K6-NQ6P-5Y0F";

						if(isset($_SERVER['SCRIPT_URI']) && strlen($_SERVER['SCRIPT_URI'])){
							$_SERVER['REQUEST_URI'] = $_SERVER['SCRIPT_URI'].((strlen($_SERVER['QUERY_STRING']))?'?'.$_SERVER['QUERY_STRING']:'');
						}

						if(!isset($_SERVER['REQUEST_URI']) || !strlen($_SERVER['REQUEST_URI'])){
							$_SERVER['REQUEST_URI'] = $_SERVER['SCRIPT_NAME'].((isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']))?'?'.$_SERVER['QUERY_STRING']:'');
						}

						$QueryString  = "LinkUrl=".urlencode(((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on')?'https://':'http://').$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
						$QueryString .= "&Key=" .urlencode($BLKey);
						$QueryString .= "&OpenInNewWindow=" .urlencode($OpenInNewWindow);


						if(intval(get_cfg_var('allow_url_fopen')) && function_exists('readfile')) {
							@readfile("http://www.backlinks.com/engine.php?".$QueryString);
						}
						elseif(intval(get_cfg_var('allow_url_fopen')) && function_exists('file')) {
							if($content = @file("http://www.backlinks.com/engine.php?".$QueryString))
								print @join('', $content);
						}
						elseif(function_exists('curl_init')) {
							$ch = curl_init ("http://www.backlinks.com/engine.php?".$QueryString);
							curl_setopt ($ch, CURLOPT_HEADER, 0);
							curl_exec ($ch);

							if(curl_error($ch))
								print "Error processing request";

							curl_close ($ch);
						}
						else {
							print "It appears that your web host has disabled all functions for handling remote pages and as a result the BackLinks software will not function on your web page. Please contact your web host for more information.";
						}
						?>
						<?php
						// THE FOLLOWING BLOCK IS USED TO RETRIEVE AND DISPLAY LINK INFORMATION.
						// PLACE THIS ENTIRE BLOCK IN THE AREA YOU WANT THE DATA TO BE DISPLAYED.

						// MODIFY THE VARIABLES BELOW:
						// The following variable defines whether links are opened in a new window
						// (1 = Yes, 0 = No)
						$OpenInNewWindow = "1";

						// # DO NOT MODIFY ANYTHING ELSE BELOW THIS LINE!
						// ----------------------------------------------
						$BLKey = "HX27-R92D-0EJ2";

						if(isset($_SERVER['SCRIPT_URI']) && strlen($_SERVER['SCRIPT_URI'])){
							$_SERVER['REQUEST_URI'] = $_SERVER['SCRIPT_URI'].((strlen($_SERVER['QUERY_STRING']))?'?'.$_SERVER['QUERY_STRING']:'');
						}

						if(!isset($_SERVER['REQUEST_URI']) || !strlen($_SERVER['REQUEST_URI'])){
							$_SERVER['REQUEST_URI'] = $_SERVER['SCRIPT_NAME'].((isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']))?'?'.$_SERVER['QUERY_STRING']:'');
						}

						$QueryString  = "LinkUrl=".urlencode(((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on')?'https://':'http://').$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
						$QueryString .= "&Key=" .urlencode($BLKey);
						$QueryString .= "&OpenInNewWindow=" .urlencode($OpenInNewWindow);


						if(intval(get_cfg_var('allow_url_fopen')) && function_exists('readfile')) {
							@readfile("http://www.backlinks.com/enginec.php?".$QueryString);
						}
						elseif(intval(get_cfg_var('allow_url_fopen')) && function_exists('file')) {
							if($content = @file("http://www.backlinks.com/enginec.php?".$QueryString))
								print @join('', $content);
						}
						elseif(function_exists('curl_init')) {
							$ch = curl_init ("http://www.backlinks.com/enginec.php?".$QueryString);
							curl_setopt ($ch, CURLOPT_HEADER, 0);
							curl_exec ($ch);

							if(curl_error($ch))
								print "Error processing request";

							curl_close ($ch);
						}
						else {
							print "It appears that your web host has disabled all functions for handling remote pages and as a result the BackLinks software will not function on your web page. Please contact your web host for more information.";
						}
						?>
					</div>
					<div class="col-xs-6">

					</div>
				</div>
            </div><!-- end .row -->
        </div><!-- end #main_content -->
<?php get_footer(); ?>
