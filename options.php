<?php
/**
 * options.php
 * Adds these settings in a theme options admin page
 *
 * @package WordPress
 * @subpackage Best_Reloaded
 * @since Best Reloaded 0.1
 */

/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

    // This gets the theme name from the stylesheet
    $themename = get_option( 'stylesheet' );
    $themename = preg_replace("/\W/", "_", strtolower($themename) );

    $optionsframework_settings = get_option( 'optionsframework' );
    $optionsframework_settings['id'] = $themename;
    update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

    // Pull all the categories into an array
    $options_categories = array();
    $options_categories_obj = get_categories();
    foreach ($options_categories_obj as $category) {
        $options_categories[$category->cat_ID] = $category->cat_name;
    }

    // Pull all the pages into an array
    $options_pages = array();
    $options_pages_obj = get_pages('sort_column=post_parent,menu_order');
    $options_pages[''] = 'Select a page:';
    foreach ($options_pages_obj as $page) {
        $options_pages[$page->ID] = $page->post_title;
    }

    // Background Defaults
    $background_defaults = array(
        'color' => '',
        'image' => '',
        'repeat' => 'repeat',
        'position' => 'top center',
        'attachment' => 'scroll'
    );

    $options = array();

    $options[] = array(
        'name' => 'Layout Options',
        'type' => 'heading'
    );

    $options[] = array(
        'name' => 'Display Header Banner Area',
        'desc' => 'Select the checkbox to display the header banner area. You can use this space to display an advertisement, or type in text if desired. This space is unstyled so you will need to write your own HTML markup for any paragraphs, headings, et cetera.\n Future plans: To enable an optional login area.',
        'id' => 'bestreloaded_display_header_banner_area',
        'std' => 0,
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => 'Header Banner Area',
        'desc' => 'Enter in your content for the header banner area.',
        'id' => 'bestreloaded_header_banner_area',
        'class' => 'hidden',
        'type' => 'textarea'
    );

    $options['bestreloaded_display_intro_text'] = array(
        'name' => 'Display Homepage Intro Text',
        'desc' => 'Select the checkbox to display the homepage intro text, which appears above the slider on the homepage.',
        'id' => 'bestreloaded_display_intro_text',
        'std' => 1,
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => 'Homepage Intro Text',
        'desc' => 'Enter a brief introduction about your site, which will display on the homepage above the slider. This section supports HTML tags if desired. This text is wrapped in a paragraph element for formatting.',
        'id' => 'bestreloaded_intro_text',
        'std' => 'Welcome to our awesome site!<br/>This space is the perfect place to say a <a href="#">little something</a> about yourself.',
        'class' => 'hidden',
        'type' => 'textarea'
    );

    $options[] = array(
        'name' => 'Display Homepage Widget Row',
        'desc' => 'Select the checkbox to display the homepage widget row, which allows you to place three widgets in line below the slider.',
        'id' => 'bestreloaded_display_homepage_widget_row',
        'std' => 1,
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => 'Display Featured Content Bar',
        'desc' => 'Select the checkbox to display the featured content bar, which appears at the top of your inner pages throughout the site. This section is perfect for marketing and promotions purposes. There is 4 of these and you can override them using custom metas. You can override these using a custom meta.',
        'id' => 'bestreloaded_display_featured_bar',
        'std' => 0,
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => 'Featured Content Bar Text',
        'desc' => 'This section supports HTML tags if desired.',
        'id' => 'bestreloaded_featured_bar',
        'std' => 'Something Important (set background color, image, text, and <a href="#">link</a>)',
        'class' => 'hidden',
        'type' => 'textarea'
    );

	$options[] = array(
        'name' => 'Featured Content Bar Text 1',
        'desc' => 'This section supports HTML tags if desired.',
        'id' => 'bestreloaded_featured_bar1',
        'std' => 'Something Important (set background color, image, text, and <a href="#">link</a>)',
        'type' => 'textarea'
    );

	$options[] = array(
        'name' => 'Featured Content Bar Text 2',
        'desc' => 'This section supports HTML tags if desired. This section also supports shortcodes - so you can add your forms and whatnot.',
        'id' => 'bestreloaded_featured_bar2',
        'std' => 'Something Important (set background color, image, text, and <a href="#">link</a>)',
        'type' => 'textarea'
    );

	$options[] = array(
        'name' => 'Featured Content Bar Text 3',
        'desc' => 'This section supports HTML tags if desired. This section also supports shortcodes - so you can add your forms and whatnot.',
        'id' => 'bestreloaded_featured_bar3',
        'std' => 'Something Important (set background color, image, text, and <a href="#">link</a>)',
        'type' => 'textarea'
    );

    $options[] = array(
        'name' => 'Blog Pagination Option',
        'desc' => 'Select the checkbox to display custom pagination with advanced features. Deselecting the checkbox will display standard WordPress pagination.',
        'id' => 'bestreloaded_pagination_option',
        'std' => 1,
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => 'Display Twitter Integration - currently inactive',
        'desc' => 'This section used to be used to display the Twitter integration above the footer but due to changes in the Twitter API it stopped functioning. Plans are to reuse as another featured slot or optin section.',
        'id' => 'bestreloaded_display_twitter',
        'std' => 0,
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => 'Twitter Username',
        'desc' => 'Enter your Twitter username to have your latest tweet displayed above the footer.',
        'id' => 'bestreloaded_twitter',
        'std' => 'will_patton_88',
        'class' => 'hidden mini',
        'type' => 'text'
    );

    $options[] = array(
        'name' => 'Display Footer Top',
        'desc' => 'Select the checkbox to display the top section of the footer, which contains widget areas.',
        'id' => 'bestreloaded_display_footer_top',
        'std' => 1,
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => 'Display Footer Bottom',
        'desc' => 'Select the checkbox to display the bottom section of the footer, which contains a space for a tagline and a menu.',
        'id' => 'bestreloaded_display_footer_bottom',
        'std' => 1,
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => 'Footer Bottom Tagline',
        'desc' => 'Enter a brief tagline about your site, which will display on the left side of the bottom section of the footer. This section supports HTML tags if desired. This text is wrapped in a paragraph element for formatting.',
        'id' => 'bestreloaded_footer_bottom_tagline',
        'std' => '&copy; 2014 <a href="http://www.pattonwebz.com/">PattonWebz',
        'class' => 'hidden',
        'type' => 'textarea'
    );

    $options[] = array(
        'name' => 'Skin',
        'type' => 'heading'
    );

    $options[] = array(
        'name' => 'Site Heading Title',
        'desc' => 'Selecting this checkbox provides an option to upload an image for your site heading. Leaving it blank will automatically display the site name and description.',
        'id' => 'bestreloaded_site_heading_img_checkbox',
        'std' => 0,
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => 'Logo Uploader',
        'id' => 'site_heading_img',
        'class' => 'hidden',
        'type' => 'upload'
    );

    $options[] = array(
        'name' => 'Site Background',
        'desc' => 'Select your background options for the theme.',
        'id' => 'bestreloaded_background',
        'std' => $background_defaults,
        'type' => 'background'
    );

    $options[] = array(
        'name' => 'Main Link Color',
        'desc' => 'Select a main link color for the theme.',
        'id' => 'bestreloaded_link_color_main',
        'std' => '',
        'type' => 'color'
    );

    $options[] = array(
        'name' => 'Main Link Hover Color',
        'desc' => 'Select a main link hover color for the theme.',
        'id' => 'bestreloaded_link_hover_color_main',
        'std' => '',
        'type' => 'color'
    );

    $options[] = array(
        'name' => 'Footer Link Color',
        'desc' => 'Select a footer link color for the theme.',
        'id' => 'bestreloaded_link_color_footer',
        'std' => '',
        'type' => 'color'
    );

    $options[] = array(
        'name' => 'Footer Link Hover Color',
        'desc' => 'Select a footer link hover color for the theme.',
        'id' => 'bestreloaded_link_hover_color_footer',
        'std' => '',
        'type' => 'color'
    );

    $options[] = array(
        'name' => 'Featured Content Bar Background',
        'desc' => 'Select the background color and/or image for the featured content bar.',
        'id' => 'bestreloaded_background_featured_content',
        'std' => $background_defaults,
        'type' => 'background'
    );

    $options[] = array(
        'name' => 'Featured Content Bar Text Color',
        'desc' => 'Select the text color for the featured content bar.',
        'id' => 'bestreloaded_text_color_featured_content',
        'std' => '',
        'type' => 'color'
    );

    $options[] = array(
        'name' => 'Featured Content Bar Link Color',
        'desc' => 'Select the link color for the featured content bar.',
        'id' => 'bestreloaded_link_color_featured_content',
        'std' => '',
        'type' => 'color'
    );

    $options[] = array(
        'name' => 'Featured Content Bar Link Hover Color',
        'desc' => 'Select the link hover color for the featured content bar.',
        'id' => 'bestreloaded_link_hover_color_featured_content',
        'std' => '',
        'type' => 'color'
    );

    return $options;
}

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function($) {

    if ($('#bestreloaded_display_header_banner_area:checked').val() !== undefined) {
        $('#section-bestreloaded_header_banner_area').show();
    }

    $('#bestreloaded_display_header_banner_area').click(function() {
          $('#section-bestreloaded_header_banner_area').fadeToggle(400);
    });

    if ($('#bestreloaded_site_heading:checked').val() !== undefined) {
        $('#section-bestreloaded_site_heading_img').show();
    }

    $('#bestrealoaded_site_heading').click(function() {
          $('#section-bestreloaded_site_heading_img').fadeToggle(400);
    });

    if ($('#bestreloaded_display_intro_text:checked').val() !== undefined) {
        $('#section-bestreloaded_intro_text').show();
    }

    $('#bestreloaded_display_intro_text').click(function() {
          $('#section-bestreloaded_intro_text').fadeToggle(400);
    });

    if ($('#bestreloaded_display_twitter:checked').val() !== undefined) {
        $('#section-bestreloaded_twitter').show();
    }

    $('#bestreloaded_display_twitter').click(function() {
          $('#section-bestreloaded_twitter').fadeToggle(400);
    });

    if ($('#bestreloaded_display_footer_bottom:checked').val() !== undefined) {
        $('#section-bestreloaded_footer_bottom_tagline').show();
    }

    $('#bestreloaded_display_footer_bottom').click(function() {
          $('#section-bestreloaded_footer_bottom_tagline').fadeToggle(400);
    });

    if ($('#bestreloaded_display_featured_bar:checked').val() !== undefined) {
        $('#section-bestreloaded_featured_bar').show();
    }

    $('#bestreloaded_display_featured_bar').click(function() {
          $('#section-bestreloaded_featured_bar').fadeToggle(400);
    });

});
</script>

<?php } ?>
