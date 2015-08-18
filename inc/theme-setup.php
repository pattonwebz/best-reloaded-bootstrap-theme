<?php

/* =============================================================
 * Theme Setup Function
 * ============================================================= */

add_action( 'after_setup_theme', 'pw_bestreloaded_setup' );

if ( !function_exists( 'pw_bestreloaded_setup' ) ) {
    function pw_bestreloaded_setup() {

        // Set the content width
        if ( ! isset( $content_width ) ) $content_width = 690;

        // This theme uses wp_nav_menu() in two locations
        register_nav_menus( array(
            'nav_topbar' => 'Topbar Navigation',
            'nav_footer' => 'Footer Navigation'
        ) );

        // Fallback function for Topbar Navigation if it isn't set
        function topbar_nav_fallback() {
            echo '<ul class="nav navbar-nav"><li><a href="' . home_url() . '" title="Home">Home</a></li></ul>';
        }


        // Fallback function for Footer Navigation if it isn't set
        function footer_nav_fallback() {
            echo '<ul><li><a href="' . home_url() . '" title="Home">Home</a></li></ul>';
        }

        // This theme uses Featured Images (also known as post thumbnails)
        add_theme_support( 'post-thumbnails' );

        // This feature enables post and comment RSS feed links to head
        add_theme_support( 'automatic-feed-links' );

        /* =============================================================
         * Author: Boutros AbiChedid
         * Date: March 20, 2011
         * Websites: http://bacsoftwareconsulting.com/, http://blueoliveonline.com/
         * Description: Numbered Page Navigation (Pagination) Code.
         * Tested: Up to WordPress version 3.1.2 (also works on WP 3.3.1)
         * ============================================================= */

        /* Function that Rounds To The Nearest Value.
           Needed for the pagenavi() function */
        function round_num($num, $to_nearest) {
           /*Round fractions down (http://php.net/manual/en/function.floor.php)*/
           return floor($num/$to_nearest)*$to_nearest;
        }

        /* Function that performs a Boxed Style Numbered Pagination (also called Page Navigation).
           Function is largely based on Version 2.4 of the WP-PageNavi plugin */
        function pagenavi($before = '', $after = '') {
            global $wpdb, $wp_query;
            $pagenavi_options = array();
            $pagenavi_options['pages_text'] = ('Page %CURRENT_PAGE% of %TOTAL_PAGES%');
            $pagenavi_options['current_text'] = '%PAGE_NUMBER%';
            $pagenavi_options['page_text'] = '%PAGE_NUMBER%';
            $pagenavi_options['first_text'] = ('First Page');
            $pagenavi_options['last_text'] = ('Last Page');
            $pagenavi_options['next_text'] = 'Next &raquo;';
            $pagenavi_options['prev_text'] = '&laquo; Previous';
            $pagenavi_options['dotright_text'] = '...';
            $pagenavi_options['dotleft_text'] = '...';
            $pagenavi_options['num_pages'] = 3; //continuous block of page numbers
            $pagenavi_options['always_show'] = 0;
            $pagenavi_options['num_larger_page_numbers'] = 0;
            $pagenavi_options['larger_page_numbers_multiple'] = 3;

            //If NOT a single Post is being displayed
            /*http://codex.wordpress.org/Function_Reference/is_single)*/
            if (!is_single()) {
                $request = $wp_query->request;
                //intval — Get the integer value of a variable
                /*http://php.net/manual/en/function.intval.php*/
                $posts_per_page = intval(get_query_var('posts_per_page'));
                //Retrieve variable in the WP_Query class.
                /*http://codex.wordpress.org/Function_Reference/get_query_var*/
                $paged = intval(get_query_var('paged'));
                $numposts = $wp_query->found_posts;
                $max_page = $wp_query->max_num_pages;

                //empty — Determine whether a variable is empty
                /*http://php.net/manual/en/function.empty.php*/
                if(empty($paged) || $paged == 0) {
                    $paged = 1;
                }

                $pages_to_show = intval($pagenavi_options['num_pages']);
                $larger_page_to_show = intval($pagenavi_options['num_larger_page_numbers']);
                $larger_page_multiple = intval($pagenavi_options['larger_page_numbers_multiple']);
                $pages_to_show_minus_1 = $pages_to_show - 1;
                $half_page_start = floor($pages_to_show_minus_1/2);
                //ceil — Round fractions up (http://us2.php.net/manual/en/function.ceil.php)
                $half_page_end = ceil($pages_to_show_minus_1/2);
                $start_page = $paged - $half_page_start;

                if($start_page <= 0) {
                    $start_page = 1;
                }

                $end_page = $paged + $half_page_end;
                if(($end_page - $start_page) != $pages_to_show_minus_1) {
                    $end_page = $start_page + $pages_to_show_minus_1;
                }
                if($end_page > $max_page) {
                    $start_page = $max_page - $pages_to_show_minus_1;
                    $end_page = $max_page;
                }
                if($start_page <= 0) {
                    $start_page = 1;
                }

                $larger_per_page = $larger_page_to_show*$larger_page_multiple;
                //round_num() custom function - Rounds To The Nearest Value.
                $larger_start_page_start = (round_num($start_page, 10) + $larger_page_multiple) - $larger_per_page;
                $larger_start_page_end = round_num($start_page, 10) + $larger_page_multiple;
                $larger_end_page_start = round_num($end_page, 10) + $larger_page_multiple;
                $larger_end_page_end = round_num($end_page, 10) + ($larger_per_page);

                if($larger_start_page_end - $larger_page_multiple == $start_page) {
                    $larger_start_page_start = $larger_start_page_start - $larger_page_multiple;
                    $larger_start_page_end = $larger_start_page_end - $larger_page_multiple;
                }
                if($larger_start_page_start <= 0) {
                    $larger_start_page_start = $larger_page_multiple;
                }
                if($larger_start_page_end > $max_page) {
                    $larger_start_page_end = $max_page;
                }
                if($larger_end_page_end > $max_page) {
                    $larger_end_page_end = $max_page;
                }
                if($max_page > 1 || intval($pagenavi_options['always_show']) == 1) {
                    /*http://php.net/manual/en/function.str-replace.php */
                    /*number_format_i18n(): Converts integer number to format based on locale (wp-includes/functions.php*/
                    $pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), $pagenavi_options['pages_text']);
                    $pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);
                    echo $before.'<div class="pagination"><ul>'."\n";

                    if(!empty($pages_text)) {
                        echo '<li><span class="pages">'.$pages_text.'</span></li>';
                    }
                    //Displays a link to the previous post which exists in chronological order from the current post.
                    /*http://codex.wordpress.org/Function_Reference/previous_post_link*/
                    echo '<li>'; previous_posts_link($pagenavi_options['prev_text']); echo '</li>';

                    if ($start_page >= 2 && $pages_to_show < $max_page) {
                        $first_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['first_text']);
                        //esc_url(): Encodes < > & " ' (less than, greater than, ampersand, double quote, single quote).
                        /*http://codex.wordpress.org/Data_Validation*/
                        //get_pagenum_link():(wp-includes/link-template.php)-Retrieve get links for page numbers.
                        echo '<li><a href="'.esc_url(get_pagenum_link()).'" class="first" title="'.$first_page_text.'">1</a></li>';
                        if(!empty($pagenavi_options['dotleft_text'])) {
                            echo '<li><span class="expand">'.$pagenavi_options['dotleft_text'].'</span></li>';
                        }
                    }

                    if($larger_page_to_show > 0 && $larger_start_page_start > 0 && $larger_start_page_end <= $max_page) {
                        for($i = $larger_start_page_start; $i < $larger_start_page_end; $i+=$larger_page_multiple) {
                            $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
                            echo '<li><a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a></li>';
                        }
                    }

                    for($i = $start_page; $i  <= $end_page; $i++) {
                        if($i == $paged) {
                            $current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
                            echo '<li><span class="current">'.$current_page_text.'</span></li>';
                        } else {
                            $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
                            echo '<li><a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a></li>';
                        }
                    }

                    if ($end_page < $max_page) {
                        if(!empty($pagenavi_options['dotright_text'])) {
                            echo '<li><span class="expand">'.$pagenavi_options['dotright_text'].'</span></li>';
                        }
                        $last_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['last_text']);
                        echo '<li><a href="'.esc_url(get_pagenum_link($max_page)).'" class="last" title="'.$last_page_text.'">'.$max_page.'</a></li>';
                    }
                    echo '<li>'; next_posts_link($pagenavi_options['next_text'], $max_page); echo '</li>';

                    if($larger_page_to_show > 0 && $larger_end_page_start < $max_page) {
                        for($i = $larger_end_page_start; $i <= $larger_end_page_end; $i+=$larger_page_multiple) {
                            $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
                            echo '<li><a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a></li>';
                        }
                    }
                    echo '</ul></div><hr class="hr-row-divider">'.$after."\n"; // added <hr class="hr-row-divider"> if there are posts for responsive layout
                }
            }
        }
        // Adds classes to "Previous" and "Next" buttons in pagination
        add_filter('next_posts_link_attributes', 'posts_link_attributes');
        add_filter('previous_posts_link_attributes', 'posts_link_attributes');
        function posts_link_attributes() {
            return 'class="prev-next"';
        }
        /* ===| end pagination |================================ */
    }
    /* ===| end bestreloaded_setup() |================================== */
}
/* ===| end !function_exists |================================== */



/* =============================================================
 * Enqueue Styles
 * ============================================================= */

add_action( 'wp_enqueue_scripts', 'load_bestreloaded_styles' );

if ( !function_exists( 'load_bestreloaded_styles' ) ) {
    function load_bestreloaded_styles() {
        if ( !is_admin() ) {
			wp_register_style( 'bootstrap-styles', get_template_directory_uri() . '/css/bootstrap.min.css', 3.0 );
			wp_enqueue_style ( 'bootstrap-styles' );
            wp_register_style( 'bestreloaded-styles', get_template_directory_uri() . '/style.css', array(), 1.0 );
            wp_enqueue_style ( 'bestreloaded-styles' );
        }
    }
}



/* =============================================================
 * Enqueue Javascript
 * ============================================================= */

add_action( 'wp_enqueue_scripts', 'load_bestreloaded_scripts' );

if ( !function_exists( 'load_bestreloaded_scripts' ) ) {
    function load_bestreloaded_scripts() {
        if ( !is_admin() ) {
            wp_register_script( 'modernizr', get_template_directory_uri() . '/js/libs/modernizr-2.5.3.min.js' );
            wp_enqueue_script( 'modernizr' );
            wp_enqueue_script( 'jquery' );
            wp_register_script( 'bestreloaded-plugins', get_template_directory_uri() . '/js/scripts.js', array('jquery', 'bootstrap'), 1.0, true );
            wp_enqueue_script( 'bestreloaded-plugins' );
			wp_register_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), 1.0, true );
            wp_enqueue_script( 'bootstrap' );
            if ( is_single() ) wp_enqueue_script( 'comment-reply' );
        }
    }
}



/* =============================================================
 * Echo out color options from admin panel
 * ============================================================= */

add_action( 'wp_head', 'bestreloaded_theme_options' );

if ( !function_exists( 'bestreloaded_theme_options' ) ) {
    function bestreloaded_theme_options() {

        $background                = of_get_option( 'bestreloaded_background', 'no entry' );
        $link_color_main           = of_get_option( 'bestreloaded_link_color_main', 'no entry' );
        $link_color_hover_main     = of_get_option( 'bestreloaded_link_hover_color_main', 'no entry' );
        $link_color_footer         = of_get_option( 'bestreloaded_link_color_footer' );
        $link_color_hover_footer   = of_get_option( 'bestreloaded_link_hover_color_footer' );
        $background_featured       = of_get_option( 'bestreloaded_background_featured_content' );
        $text_color_featured       = of_get_option( 'bestreloaded_text_color_featured_content' );
        $link_color_featured       = of_get_option( 'bestreloaded_link_color_featured_content' );
        $link_color_hover_featured = of_get_option( 'bestreloaded_link_hover_color_featured_content' ); ?>

            <style type="text/css">

                <?php if ( $background ) {
                          if ( $background['color'] && $background['image'] ) { ?>
                              body { background-color: <?php echo $background['color']; ?>;
                                     background-image: url(<?php echo $background['image']; ?>);
                                     background-repeat: <?php echo $background['repeat']; ?>;
                                     background-position: <?php echo $background['position']; ?>;
                                     background-attachment: <?php echo $background['attachment']; ?>; } <?php
                          } elseif ( $background['image'] ) { ?>
                              body { background-image: url(<?php echo $background['image']; ?>);
                                     background-repeat: <?php echo $background['repeat']; ?>;
                                     background-position: <?php echo $background['position']; ?>;
                                     background-attachment: <?php echo $background['attachment']; ?>; } <?php
                          } else { ?>
                              body { background-color: <?php echo $background['color']; ?>; } <?php
                          }
                      } else {
                          echo 'no entry';
                      };
                ?>
                <?php if ( $background_featured ) {
                          if ( $background_featured['color'] && $background_featured['image'] ) { ?>
                              .featured-bar { background-color: <?php echo $background_featured['color']; ?>;
                                              background-image: url(<?php echo $background_featured['image']; ?>);
                                              background-repeat: <?php echo $background_featured['repeat']; ?>;
                                              background-position: <?php echo $background_featured['position']; ?>;
                                              background-attachment: <?php echo $background_featured['attachment']; ?>; } <?php
                          } elseif ( $background_featured['image'] ) { ?>
                              .featured-bar { background-image: url(<?php echo $background_featured['image']; ?>);
                                              background-repeat: <?php echo $background_featured['repeat']; ?>;
                                              background-position: <?php echo $background_featured['position']; ?>;
                                              background-attachment: <?php echo $background_featured['attachment']; ?>; } <?php
                          } else { ?>
                              .featured-bar { background-color: <?php echo $background_featured['color']; ?>; } <?php
                          }
                      } else {
                          echo 'no entry';
                      };
                ?>
                <?php if ( $text_color_featured ) : ?>
                    .featured-bar { color: <?php echo $text_color_featured ?>; }
                <?php endif; ?>
                <?php if ( $link_color_featured ) : ?>
                    .featured-bar a { color: <?php echo $link_color_featured ?>; }
                <?php endif; ?>
                <?php if ( $link_color_hover_featured ) : ?>
                    .featured-bar a:hover { color: <?php echo $link_color_hover_featured ?>; }
                <?php endif; ?>
                <?php if ( $link_color_main ) : ?>
                    a, .comment-notes .required, .comment-form-author .required,
                    .comment-form-email .required, .comment-form-url .required, .comment-form-comment .required { color: <?php echo $link_color_main; ?>; }
                    footer .container.container-main.footer-top { border-top-color: <?php echo $link_color_main; ?>; }
                    .flex-direction-nav li a, .flex-control-nav li a.active,
                    .flex-control-nav li a:hover, .flex-control-nav li a:focus,
                    .sub-menu li > a:hover, .sub-menu .active > a, .sub-menu .active > a:hover { background-color: <?php echo $link_color_main; ?>; }
                    .wp-caption a:hover img { border-color: <?php echo $link_color_main; ?>; }
                <?php endif; ?>
                <?php if ( $link_color_hover_main ) : ?>
                    a:hover { color: <?php echo $link_color_hover_main; ?>; }
                <?php endif; ?>
                <?php if ( $link_color_footer ) : ?>
                    footer .container.container-main a { color: <?php echo $link_color_footer; ?>; }
                <?php endif; ?>
                <?php if ( $link_color_hover_footer ) : ?>
                    footer .container.container-main a:hover { color: <?php echo $link_color_hover_footer; ?>; }
                <?php endif; ?>

            </style>

        <?php
    }
    /* ===| end bestreloaded_theme_options() |========================== */
}
/* ===| end !function_exists |================================== */



/* =============================================================
 * Remove rel attribute from the category list
 * ============================================================= */

if ( !function_exists( 'remove_category_list_rel' ) ) {
    function remove_category_list_rel($output) {
        $output = str_replace(' rel="category tag"', '', $output);
        return $output;
    }
}

add_filter('wp_list_categories', 'remove_category_list_rel');
add_filter('the_category', 'remove_category_list_rel');



/* =============================================================
 * Custom excerpt length and styling
 * ============================================================= */

if ( !function_exists( 'custom_excerpt_length' ) ) {
    function custom_excerpt_length() {
        return 40;
    }
}

if ( !function_exists( 'new_excerpt_more' ) ) {
    function new_excerpt_more( $more ) {
        return ' ...';
    }
}

add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
add_filter('excerpt_more', 'new_excerpt_more');



/* =============================================================
 * Tweak tagcloud settings
 * ============================================================= */

if ( !function_exists( 'custom_tag_cloud_widget' ) ) {
    function custom_tag_cloud_widget( $args ) {
        $args['largest'] = 11;
        $args['smallest'] = 11;
        $args['unit'] = 'px';
        return $args;
    }
}

add_filter( 'widget_tag_cloud_args', 'custom_tag_cloud_widget' );



/* =============================================================
 * Pull in latest tweet and date from Twitter
 * ============================================================= */

if ( !function_exists( 'wp_echo_twitter' ) ) {
    function wp_echo_twitter($username) {
        include_once( ABSPATH . WPINC . '/class-simplepie.php' );

        // Fetch feed, set cache locaiton, and initialize function
        $feed = new SimplePie();
        $feed->set_feed_url("http://search.twitter.com/search.atom?q=from:$username");
        $feed->set_cache_location( ABSPATH . WPINC );
        $feed->init();
        $feed->handle_content_type();

        // Output tweet
        foreach ($feed->get_items(0, 1) as $item):
            echo '<p class="hero-p" style="margin-bottom: 9px;">"' . $item->get_description() . '"</p>' . '<span><a href="' . $item->get_permalink() . '">' . $item->get_date('D, M j, Y') . '</a></span>';
        endforeach;
    }
}

?>
