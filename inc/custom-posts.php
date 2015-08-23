<?php
/**
 * custom-posts.php
 * Register Custom Post Type for Slides
 *
 * @package WordPress
 * @subpackage Best_Reloaded
 * @since Best Reloaded 0.1
 */

add_action( 'init', 'pwwp_bestreloaded_slide_init' );
function pwwp_bestreloaded_slide_init() {

    $labels = array(
        'name'               => 'Slides', 'post type general name',
        'singular_name'      => 'Slide', 'post type singular name',
        'add_new'            => 'Add New', 'slide',
        'add_new_item'       => 'Add New Slide',
        'edit_item'          => 'Edit Slide',
        'new_item'           => 'New Slide',
        'view_item'          => 'View Slide',
        'search_items'       => 'Search Slides',
        'not_found'          => 'No slides found',
        'not_found_in_trash' => 'No slides found in Trash',
        'parent_item_colon'  => '',
        'menu_name'          => 'Slides'
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'exclude_from_search' => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => true,
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => null,
        'supports'            => array('title', 'editor', 'thumbnail')
    );

    // Workaround for themes not being allowed to use CPT found here:
    // https://github.com/valendesigns/option-tree/issues/427#issuecomment-70421732
    $register_post_type = 'register_' . 'post_type';
    $register_post_type( 'slide', $args );

}

/* =============================================================
 * Add meta boxes for custom post types
 * ============================================================= */

add_action( 'add_meta_boxes', 'pwwp_slide_meta_boxes' );
function pwwp_slide_meta_boxes() {
    add_meta_box(
        'response_slide_url', // ID
        'Link', // Title
        'pwwp_slide_url_cb', // Callback
        'slide', // Post type
        'normal', // Context
        'high' // Priority
    );
}

function pwwp_slide_url_cb() {
    global $post;
    $url = get_post_meta($post->ID, 'response_slide_url', true);
    ?>

    <label for="response_slide_url">Associated URL: </label>
    <input type="text" name="response_slide_url" id="response_slide_url" class="widefat" value="<?php echo $url ?>">

    <?php
}

/* =============================================================
 * Save post meta info
 * ============================================================= */

add_action( 'save_post', 'pwwp_slide_save_meta' );
function pwwp_slide_save_meta() {
    global $post;
    // If save or publish is selected, allow updating of post meta information
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    // If a value for 'response_slide_url' is set, update the post
    if ( isset($_POST['response_slide_url']) ) {
        update_post_meta($post->ID, 'response_slide_url', $_POST['response_slide_url']);
    }
}

/* =============================================================
 * Update Slide Messages
 * ============================================================= */

add_filter( 'post_updated_messages', 'pwwp_slide_updated_messages' );
function pwwp_slide_updated_messages( $messages ) {

    global $post, $post_ID;

    $messages['slide'] = array(
        0  => '',
        1  => sprintf('Slide updated.', esc_url( get_permalink( $post_ID ) ) ),
        2  => 'Custom field updated.',
        3  => 'Custom field deleted.',
        4  => 'Slide updated.',
        5  => isset( $_GET['revision'] ) ? sprintf( 'Slide restored to revision from %s' , wp_post_revision_title((int) $_GET['revision'] , false ) ) : false,
        6  => sprintf( 'Slide published.', esc_url( get_permalink( $post_ID ) ) ),
        7  => 'Slide saved.',
        8  => sprintf( 'Slide submitted.', esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID) ) ) ),
        9  => sprintf( 'Slide scheduled for: <strong>%1$s</strong>. ', date_i18n( 'M j, Y @ G:i', strtotime( $post->post_date) ), esc_url( get_permalink( $post_ID) ) ),
        10 => sprintf( 'Slide draft updated.', esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID) ) ) ),
    );

    return $messages;
}

/* =============================================================
 * Update Slide Help
 * ============================================================= */

add_action( 'contextual_help', 'pwwp_slide_help_text', 10, 3 );
function pwwp_slide_help_text($contextual_help, $screen_id, $screen) {
    if ( 'slide' == $screen->id ) {
        $contextual_help =
        '<p>' . 'Things to remember when adding a slide:' . '</p>' .
        '<ul>' .
        '<li>' . 'Give the slide a title. The title will be used as the slide\'s headline.' . '</li>' .
        '<li>' . 'Attach a Featured Image to give the slide its background.' . '</li>' .
        '<li>' . 'Enter text into the Visual or HTML area. The text will appear within each slide during transitions.' . '</li>' .
        '</ul>';
    }
    elseif ( 'edit-slide' == $screen->id ) {
        $contextual_help = '<p>' . 'A list of all slides appears below. To edit a slide, click on the slide\'s title.' . '</p>';
    }
    return $contextual_help;
}

?>
