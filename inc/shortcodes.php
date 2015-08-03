<?php


/* =============================================================
 * Shortcode for regular buttons
 * ============================================================= */

add_shortcode( 'button', 'button' );

function button($atts) {
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



/* =============================================================
 * Shortcode for social buttons
 * ============================================================= */

add_shortcode( 'social', 'social' );

function social($atts) {
    extract( shortcode_atts(
        array(
            'link'    => '#',
            'text'    => 'I\'m a social network link!',
            'title'   => '',
            'network' => '',
            'notext'  => ''
        ), $atts)
    );
    $output = '<a href="' . $link . '" class="zocial';
    if ( $network ) { $output .= ' ' . $network; }
    if ( $notext === 'yes' )  { $output .= ' icon'; }
    $output .= '" ';
    if ( $title ) { $output .= 'title="' . $title . '"'; }
    $output .= '>' . $text . '</a>';
    return $output;
}



/* =============================================================
 * Shortcode for rows and columns
 * ============================================================= */

add_shortcode( 'row', 'row' );

function row( $atts, $content = null ) {
    return '<div class="row">' . do_shortcode( $content ) . '</div>';
}


add_shortcode( 'column', 'column' );

function column( $atts, $content = null ) {
    extract( shortcode_atts(
        array(
            'span' => ''
        ), $atts)
    );
    return '<div class="span' . $span . '">' . do_shortcode( $content ) . '</div>';
}



/* =============================================================
 * Shortcode for alerts
 * ============================================================= */

add_shortcode( 'alert', 'alert' );

function alert( $atts, $content = null ) {
    extract( shortcode_atts(
        array(
            'type' => ''
        ), $atts)
    );
    $output = '<div class="alert';
    if ( $type === 'danger' )  { $output .= ' alert-error'; }
    if ( $type === 'success' ) { $output .= ' alert-success'; }
    if ( $type === 'info' )    { $output .= ' alert-info'; }
    $output .= '">' . do_shortcode( $content ) . '</div>';
    return $output;
}

?>