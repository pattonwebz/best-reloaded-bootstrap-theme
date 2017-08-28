<?php
/**
 * The featured-image.php file.
 *
 * Snippet for displaying featured image in the loop
 *
 * @package Best_Reloaded
 * @since Best Reloaded v0.1
 */

?>

<?php

if ( has_post_thumbnail() ) {
	the_post_thumbnail( 'best-reloaded-featured-img', array(
		'class' => 'd-block img-fluid',
	) );
} else {
	$featured_image_url = get_template_directory_uri() . '/assets/img/default-post.jpg';
	if ( $featured_image_url ) {
		echo '<img src="' . esc_url( $featured_image_url ) . '" class="d-block img-fluid" alt="' . esc_attr( get_the_title() ) . '"/>';
	}
}
