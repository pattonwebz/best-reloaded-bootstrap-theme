<?php
/**
 * featured-image.php
 * Snippet for displaying featured image in the loop
 *
 * @package WordPress
 * @subpackage Best_Reloaded
 * @since Best Reloaded 0.1
 */
?>

<?php

if ( has_post_thumbnail() ) {
    the_post_thumbnail( null, array( 'class' => 'd-block img-fluid' ));
} else {
    if ( $post->post_type === 'page' ) {
        $featured_image = '<img src="'
                        . get_template_directory_uri()
                        . '/img/default-page.png" />';
		// no user input here
        echo $featured_image;
    } else {
        $featured_image = '<img src="'
                        . get_template_directory_uri()
                        . '/img/default-post.png" />';
		// no user input here
        echo $featured_image;
    }
}

?>
