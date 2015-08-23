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

    register_post_type( 'slide', $args );

}

add_action( 'init', 'pwwp_bestreloaded_questions_init' );
function pwwp_bestreloaded_questions_init() {

    $labels = array(
        'name'               => 'Questions', 'post type general name',
        'singular_name'      => 'Question', 'post type singular name',
        'add_new'            => 'Add New', 'question',
        'add_new_item'       => 'Add New Question',
        'edit_item'          => 'Edit Question',
        'new_item'           => 'New Question',
        'view_item'          => 'View Question',
        'search_items'       => 'Search Question',
        'not_found'          => 'No questions found',
        'not_found_in_trash' => 'No questions found in Trash',
        'parent_item_colon'  => '',
        'menu_name'          => 'Q&A'
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => true,
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => null,
		'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
		'taxonomies' 		  => array( '' )
    );

    register_post_type( 'questions', $args );
}

//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'pwwp_create_question_taxonomies', 0 );
function pwwp_create_question_taxonomies() {
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name'                => _x( 'Group', 'taxonomy general name', 'best_reloaded' ),
    'singular_name'       => _x( 'Groups', 'taxonomy singular name', 'best_reloaded' ),
    'search_items'        => __( 'Search Groups', 'best_reloaded' ),
    'all_items'           => __( 'All Groups', 'best_reloaded' ),
    'parent_item'         => __( 'Parent Group', 'best_reloaded' ),
    'parent_item_colon'   => __( 'Parent Group:', 'best_reloaded' ),
    'edit_item'           => __( 'Edit Group', 'best_reloaded' ),
    'update_item'         => __( 'Update Group', 'best_reloaded' ),
    'add_new_item'        => __( 'Add New Group', 'best_reloaded' ),
    'new_item_name'       => __( 'New Group Name', 'best_reloaded' ),
    'menu_name'           => __( 'Groups', 'best_reloaded' )
  );

  $args = array(
    'hierarchical'        => true,
    'labels'              => $labels,
    'show_ui'             => true,
    'show_admin_column'   => true,
    'query_var'           => true,
    'rewrite'             => array( 'slug' => 'group' )
  );

  register_taxonomy( 'group', 'questions', $args );


  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name'                         => _x( 'Topics', 'taxonomy general name', 'best_reloaded' ),
    'singular_name'                => _x( 'Topic', 'taxonomy singular name', 'best_reloaded' ),
    'search_items'                 => __( 'Search Topic', 'best_reloaded' ),
    'popular_items'                => __( 'Popular Topics, 'best_reloaded'' ),
    'all_items'                    => __( 'All Topics', 'best_reloaded' ),
    'parent_item'                  => null,
    'parent_item_colon'            => null,
    'edit_item'                    => __( 'Edit Topic', 'best_reloaded' ),
    'update_item'                  => __( 'Update Topic', 'best_reloaded' ),
    'add_new_item'                 => __( 'Add New Topic', 'best_reloaded' ),
    'new_item_name'                => __( 'New Topic', 'best_reloaded' ),
    'separate_items_with_commas'   => __( 'Separate topics with commas', 'best_reloaded' ),
    'add_or_remove_items'          => __( 'Add or remove topics', 'best_reloaded' ),
    'choose_from_most_used'        => __( 'Choose from the most used topics', 'best_reloaded' ),
    'not_found'                    => __( 'No tag found.', 'best_reloaded' ),
    'menu_name'                    => __( 'Topics', 'best_reloaded' )
  );

  $args = array(
    'hierarchical'            => false,
    'labels'                  => $labels,
    'show_ui'                 => true,
    'show_admin_column'       => true,
    'update_count_callback'   => '_update_post_term_count',
    'query_var'               => true,
    'rewrite'                 => array( 'slug' => 'topics' )
  );

  register_taxonomy( 'tagged', 'questions', $args );

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

add_action( 'add_meta_boxes', 'pwwp_portfolio_meta_boxes' );
function pwwp_portfolio_meta_boxes() {
    add_meta_box(
        'portfolio_site_url', // ID
        'Details', // Title
        'pwwp_portfolio_cb', // Callback
        'portfolio', // Post type
        'normal', // Context
        'high' // Priority
    );
}

function pwwp_portfolio_cb() {
    global $post;
    $name = get_post_meta($post->ID, 'portfolio_site_name', true);
	$client = get_post_meta($post->ID, 'portfolio_site_clent', true);
	$url = get_post_meta($post->ID, 'portfolio_site_url', true);
	$jobtype = get_post_meta($post->ID, 'portfolio_site_jobtype', true);
    ?>

    <label for="portfolio_site_name">Site Name: </label>
    <input type="text" name="portfolio_site_name" id="portfolio_site_name" class="widefat" value="<?php echo $name ?>">

	 <label for="portfolio_site_client">Clent: </label>
    <input type="text" name="portfolio_site_client" id="portfolio_site_client" class="widefat" value="<?php echo $client ?>">

	<label for="portfolio_site_url">Site url: </label>
    <input type="text" name="portfolio_site_url" id="portfolio_site_url" class="widefat" value="<?php echo $url ?>">

	<label for="portfolio_site_jobtype">Jobtype: </label>
    <input type="text" name="portfolio_site_jobtype" id="portfolio_site_jobtype" class="widefat" value="<?php echo $jobtype ?>">

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

add_action( 'save_post', 'pwwp_portfolio_save_meta' );
function pwwp_portfolio_save_meta() {
    global $post;
    // If save or publish is selected, allow updating of post meta information
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    // If a value for the metabox is set, update the post
    if ( isset($_POST['portfolio_site_name']) ) {
        update_post_meta($post->ID, 'portfolio_site_name', $_POST['portfolio_site_name']);
    }
    if ( isset($_POST['portfolio_site_client']) ) {
        update_post_meta($post->ID, 'portfolio_site_clent', $_POST['portfolio_site_client']);
    }
    if ( isset($_POST['portfolio_site_url']) ) {
        update_post_meta($post->ID, 'portfolio_site_url', $_POST['portfolio_site_url']);
    }
	if ( isset($_POST['portfolio_site_jobtype']) ) {
        update_post_meta($post->ID, 'portfolio_site_jobtype', $_POST['portfolio_site_jobtype']);
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
