<?php
class JuggerEventsAdmin {

	function __construct() {
        register_activation_hook( JUGGER_EVENTS_ADMIN_FILE, array( $this, 'plugin_activation' ) );
        register_deactivation_hook( JUGGER_EVENTS_ADMIN_FILE, array( $this, 'plugin_deactivation' ) );

		$this->clean_up();
        $this->post_type_event();
        $this->meta_boxes();
        $this->customize_editor();
//        $this->rename_texts();
        
        add_action( 'admin_footer', array( $this, 'admin_footer') );
	}

    function plugin_activation() {
        $this->add_role();
    }
    
    function plugin_deactivation() {
        $this->remove_role();
    }
    
    function remove_role() {
        if (get_role('event_organizer')){
              remove_role( 'event_organizer' );
        }
    }
    
    function add_role() {
        if (!get_role('event_organizer')) {
            add_role(
                'event_organizer',
                __('Event Organizer'),
                array(
                    'read'         => true,  // true allows this capability
                    'edit_posts'   => true,
                    'delete_posts' => false, // Use false to explicitly deny
                )
            );
        }
    }

    function clean_up() {
        include dirname(__FILE__) . '/admin/clean-up.php';
        new JuggerEventsCleanUp();
    }
  
    function post_type_event() {
        include dirname(__FILE__) . '/admin/post-type-event.php';
        new JuggerEventsPostTypeEvent();
    }
    
    function meta_boxes() {
        include dirname(__FILE__) . '/admin/meta-boxes.php';
        new JuggerEventsMetaBoxes();
    }

    function customize_editor() {
        include dirname(__FILE__) . '/admin/slick-editor.php';
        new JuggerEventsEditor();
    }

//    function rename_texts() {
//        include dirname(__FILE__) . '/admin/rename-texts.php';
//
//        $options = array (
//            'replacements' => array (
////                'Save Draft' => 'Another text',
//                'Publish' => 'Announce Event'
//            ),
//            'post_type' => array ()
//        );
//
//        new JuggerEventsRenaming($options);
//    }

	function admin_footer() { ?>
<script>
  // Google Analytics
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-11373643-13', 'kevinw.de');
  ga('require', 'displayfeatures');
  ga('set', 'anonymizeIp', true);
  ga('send', 'pageview');
</script>
	<?php }
}