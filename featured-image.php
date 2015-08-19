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
    the_post_thumbnail();
} else {
    if ( $post->post_type === 'page' ) {
        $featured_image = '<img src="'
                        . get_template_directory_uri()
                        . '/img/default-page.png" />';
        echo $featured_image;
    } else {
        $featured_image = '<img src="'
                        . get_template_directory_uri()
                        . '/img/default-post.png" />';
        echo $featured_image;
    }
}

?>
