<?php
class JuggerEventsCleanUp {
    static $not_needed_menus = array('index.php', 'edit.php', 'edit.php?post_type=page', 'upload.php', 'edit-comments.php');
    static $not_needed_adminbar_menus = array('comments', 'new-content');
    static $not_needed_post_types = array('post', 'page');
    static $not_needed_pages = array('upload', 'media-new', 'edit-comments');


	function __construct() {
        add_action( 'admin_menu', array( $this, 'remove_menus') );
        add_action( 'wp_before_admin_bar_render', array( $this, 'remove_adminbar_menus') );
        add_action( 'current_screen', array( $this, 'block_pages') );
//        add_filter( 'screen_options_show_screen', array( $this, 'remove_screen_options'), 10, 2 );
        $this->exit_on_load();
	}
  
    function remove_menus() {
        foreach ($this::$not_needed_menus as $menu) {
            remove_menu_page($menu);
        }
    }

    function remove_adminbar_menus() {
        global $wp_admin_bar;
        
        foreach ($this::$not_needed_adminbar_menus as $menu) {
            $wp_admin_bar->remove_menu($menu);
        }
    }

//    function remove_screen_options($display_boolean, $wp_screen_object){
//      $blacklist = array('jugger-event');
//        
//      if (in_array(get_post_type(), $blacklist)) {
//        $wp_screen_object->render_screen_layout();
//        $wp_screen_object->render_per_page_options();
//        return false;
//      } else {
//        return true;
//      }
//    }

    // Prevent direct access to those pages
    function block_pages () {
        $screen = get_current_screen();

        foreach ($this::$not_needed_post_types as $type) {
            if ($type == $screen->post_type) {
                $this->exit_page();
            }
        }
    }
    
    // Prevent direct access to those pages
    function exit_on_load() {
        foreach ($this::$not_needed_pages as $page) {
            add_action( 'load-' . $page . '.php', array( $this, 'exit_page') );
        }
    }
    
    function exit_page() {
        wp_die("Sorry, this page doesn't exist.");
        exit();
    }
}