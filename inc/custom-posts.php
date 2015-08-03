<?php

/* =============================================================
 * Register Custom Post Type for Slides
 * ============================================================= */
 
add_action( 'init', 'response_slide_init' );

function response_slide_init() {

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

add_action( 'init', 'questions_init' );

function questions_init() {

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
add_action( 'init', 'create_question_taxonomies', 0 );

//create two taxonomies, genres and writers for the post type "book"
function create_question_taxonomies() 
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name'                => _x( 'Group', 'taxonomy general name' ),
    'singular_name'       => _x( 'Groups', 'taxonomy singular name' ),
    'search_items'        => __( 'Search Groups' ),
    'all_items'           => __( 'All Groups' ),
    'parent_item'         => __( 'Parent Group' ),
    'parent_item_colon'   => __( 'Parent Group:' ),
    'edit_item'           => __( 'Edit Group' ), 
    'update_item'         => __( 'Update Group' ),
    'add_new_item'        => __( 'Add New Group' ),
    'new_item_name'       => __( 'New Group Name' ),
    'menu_name'           => __( 'Groups' )
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
    'name'                         => _x( 'Topics', 'taxonomy general name' ),
    'singular_name'                => _x( 'Topic', 'taxonomy singular name' ),
    'search_items'                 => __( 'Search Topic' ),
    'popular_items'                => __( 'Popular Topics' ),
    'all_items'                    => __( 'All Topics' ),
    'parent_item'                  => null,
    'parent_item_colon'            => null,
    'edit_item'                    => __( 'Edit Topic' ), 
    'update_item'                  => __( 'Update Topic' ),
    'add_new_item'                 => __( 'Add New Topic' ),
    'new_item_name'                => __( 'New Topic' ),
    'separate_items_with_commas'   => __( 'Separate topics with commas' ),
    'add_or_remove_items'          => __( 'Add or remove topics' ),
    'choose_from_most_used'        => __( 'Choose from the most used topics' ),
    'not_found'                    => __( 'No tag found.' ),
    'menu_name'                    => __( 'Topics' )
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

add_action( 'add_meta_boxes', 'response_meta_boxes' );

function response_meta_boxes() {
    add_meta_box(
        'response_slide_url', // ID
        'Link', // Title
        'response_slide_url_cb', // Callback
        'slide', // Post type
        'normal', // Context
        'high' // Priority
    );
}

function response_slide_url_cb() {
    global $post;
    $url = get_post_meta($post->ID, 'response_slide_url', true);
    ?>
    
    <label for="response_slide_url">Associated URL: </label>
    <input type="text" name="response_slide_url" id="response_slide_url" class="widefat" value="<?php echo $url ?>">
    
    <?php
}

add_action( 'add_meta_boxes', 'portfolio_meta_boxes' );

function portfolio_meta_boxes() {
    add_meta_box(
        'portfolio_site_url', // ID
        'Details', // Title
        'portfolio_cb', // Callback
        'portfolio', // Post type
        'normal', // Context
        'high' // Priority
    );
}

function portfolio_cb() {
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

add_action( 'save_post', 'response_save_meta' );

function response_save_meta() {
    global $post;
    // If save or publish is selected, allow updating of post meta information
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    // If a value for 'response_slide_url' is set, update the post
    if ( isset($_POST['response_slide_url']) ) {
        update_post_meta($post->ID, 'response_slide_url', $_POST['response_slide_url']);
    }
}

add_action( 'save_post', 'portfolio_save_meta' );

function portfolio_save_meta() {
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
 
add_filter( 'post_updated_messages', 'slide_updated_messages' );

function slide_updated_messages( $messages ) {

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
 
add_action( 'contextual_help', 'slide_help_text', 10, 3 );
function slide_help_text($contextual_help, $screen_id, $screen) {
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