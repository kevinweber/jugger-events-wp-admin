<?php
class JuggerEventsPostTypeEvent {

	function __construct() {
        add_action( 'init', array( $this, 'custom_post_type'), 0 );
	}
    
    // Register Custom Post Type
    function custom_post_type() {

        $labels = array(
            'name'                  => 'Events',
            'singular_name'         => 'Event',
            'menu_name'             => 'Events',
            'name_admin_bar'        => 'Events',
            'archives'              => 'Event Archive',
            'parent_item_colon'     => '',
            'all_items'             => 'All Events',
            'add_new_item'          => 'Add New Event',
            'add_new'               => 'Add New',
            'new_item'              => 'New Event',
            'edit_item'             => 'Edit Event',
            'update_item'           => 'Update Event',
            'view_item'             => 'View Event',
            'search_items'          => 'Search Event',
            'not_found'             => 'Not found',
            'not_found_in_trash'    => 'Not found in Trash',
            'featured_image'        => 'Featured Image',
            'set_featured_image'    => 'Set featured image',
            'remove_featured_image' => 'Remove featured image',
            'use_featured_image'    => 'Use as featured image',
            'insert_into_item'      => 'Insert into event',
            'uploaded_to_this_item' => 'Uploaded to this event',
            'items_list'            => 'Event list',
            'items_list_navigation' => 'Event list navigation',
            'filter_items_list'     => 'Filter events',
        );
        $args = array(
            'label'                 => 'Event',
            'description'           => 'Jugger Events',
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', ),
            'taxonomies'            => array( 'category', 'post_format' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-calendar',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,		
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'query_var'             => 'event',
            'capability_type'       => 'page',
        );
        register_post_type( 'jugger_event', $args );
    }
}