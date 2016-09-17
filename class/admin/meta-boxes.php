<?php
class JuggerEventsMetaBoxes {
    static private $prefix = 'jugger_event_';
    
    function __construct() {
        add_filter( 'rwmb_meta_boxes', array( $this, 'register_meta_boxes' ) );
        add_action( 'admin_menu', array( $this, 'remove_meta_boxes' ) );
        add_filter( 'get_sample_permalink_html', array( $this, 'customize_permalink' ) );
	}

    function register_meta_boxes( $meta_boxes ) {
        // Add one meta box with several fields
        // Documentation/examples:
        // https://github.com/rilwis/meta-box/blob/master/demo/demo.php
        // https://github.com/rilwis/meta-box/tree/master/demo
        $meta_boxes[] = array(
            'id'         => 'event-meta',
            'title'      => __( 'Event Infos', JUGGER_EVENTS_ADMIN_TD ),
            'post_types' => array( 'jugger-event' ),
            'context'    => 'normal',
            'priority'   => 'high',
            // Register fields
            // Documentation: https://metabox.io/docs/define-fields/
            'fields' => array(
                $this->meta_box__select_event_type(),
                $this->meta_box__event_url(),
                $this->meta_box__datetime_start(),
                $this->meta_box__datetime_end(),
                $this->meta_box__location_address(),
                $this->meta_box__location_map()
            ),
            // Validate fields
            // Documentation: https://metabox.io/docs/validation/
            'validation' => array(
                'rules'    => array(
                    "{$this::$prefix}type" => array(
                        'required'  => true
                    ),
                    "{$this::$prefix}address" => array(
                        'required'  => true
                    ),
                    "{$this::$prefix}datetime_start" => array(
                        'required'  => true
                    ),
                    "{$this::$prefix}event_link" => array(
                        'url'  => true
                    )
                )
            )
        );
        
        return $meta_boxes;
    }
    
    function meta_box__select_event_type() {
        return array(
            'name'        => esc_html__( 'Event Type', JUGGER_EVENTS_ADMIN_TD ),
            'id'          => "{$this::$prefix}type",
            'type'        => 'select',
            'options'     => array(
                'practice' => esc_html__( 'Practice/Training', JUGGER_EVENTS_ADMIN_TD ),
                'tournament' => esc_html__( 'Tournament', JUGGER_EVENTS_ADMIN_TD ),
                'other' => esc_html__( 'Other', JUGGER_EVENTS_ADMIN_TD ),
            ),

            'multiple'    => false,
            'std'         => 'practice',
            'placeholder' => esc_html__( 'Select a type', JUGGER_EVENTS_ADMIN_TD ),
        );
    }

    function meta_box__event_url() {
        return array(
            'name' => esc_html__( 'Event Link', JUGGER_EVENTS_ADMIN_TD ),
            'id'   => "{$this::$prefix}event_link",
            'desc' => esc_html__( 'Link to page with more information regarding your event', JUGGER_EVENTS_ADMIN_TD ),
            'type' => 'url',
            'placeholder' => "http://..."
        );
    }

    function meta_box__location_address() {
        return array(
            'id'   => $this::$prefix . 'address',
            'name' => __( 'Address', JUGGER_EVENTS_ADMIN_TD ),
            'type' => 'text',
            'std'  => __( 'Berkley, California', JUGGER_EVENTS_ADMIN_TD )
        );
    }
    
    function meta_box__location_map() {
        return array(
            'id'            => 'map',
            'name'          => __( 'Location', JUGGER_EVENTS_ADMIN_TD ),
            'type'          => 'map',
            // Default location: 'latitude,longitude[,zoom]' (zoom is optional)
            'std'           => '37.8730593,-122.25944709999999',
            // ID of text field where address is entered. They MUST match otherwise they won't play together!
            // Can be list of text fields, separated by commas (for ex. city, state)
            'address_field' => $this::$prefix . 'address',
            
            // Define this key in wp-config.php
            // Example:
            // define('GOOGLE_MAPS_API_KEY', 'your-api-key');
            'api_key'       => GOOGLE_MAPS_API_KEY
        );
    }
    
    function meta_box__datetime_start() {
        return array(
            'name'       => esc_html__( 'Start Time', JUGGER_EVENTS_ADMIN_TD ),
            'id'         => $this::$prefix . 'datetime_start',
            'type'       => 'datetime',
            // jQuery datetime picker options.
            // For date options, see: http://api.jqueryui.com/datepicker
            // For time options, see: http://trentrichardson.com/examples/timepicker/
            'js_options' => array(
                'stepMinute'     => 15,
                'showTimepicker' => true,
            )
        );
    }

    function meta_box__datetime_end() {
        return array(
            'name'       => esc_html__( 'End Time', JUGGER_EVENTS_ADMIN_TD ),
            'id'         => $this::$prefix . 'datetime_end',
            'type'       => 'datetime',
            'js_options' => array(
                'stepMinute'     => 15,
                'showTimepicker' => true,
            )
        );
    }
    
    function remove_meta_boxes() {
        remove_meta_box('slugdiv', 'jugger-event', 'normal');
    }
    
    // TODO: Customize permalink
    // $html, $postId, $new_title, $new_slug, $post
    function customize_permalink($html) {
        return $html;
    }
}