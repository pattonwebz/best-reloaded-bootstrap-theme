<?php
/**
 * shortcodes.php
 * Register sidebars and widgetized areas
 *
 * @package WordPress
 * @subpackage Best_Reloaded
 * @since Best Reloaded 0.1
 */

/* =============================================================
 * Shortcode for regular buttons
 * ============================================================= */

add_shortcode( 'button', 'pwwp_bsbutton' );
function pwwp_bsbutton($atts) {
    extract( shortcode_atts(
        array(
            'link'  => '#',
            'text'  => 'Use the "text" attribute to change me!',
            'title' => '',
            'type' 	=> 'default',
            'size'  => ''
        ), $atts)
    );
    $output = '<a href="' . $link . '" class="btn ';
    if ( $color ) { $output .= ' btn-' . $type; }
    if ( $size )  { $output .= ' btn-' . $size; }
    $output .= '" ';
    if ( $title ) { $output .= 'title="' . $title . '"'; }
    $output .= '>' . $text . '</a>';
    return $output;
}

?>
