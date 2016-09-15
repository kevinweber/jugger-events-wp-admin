<?php
/*
Plugin Name: Jugger Events - Admin
Plugin URI: http://kevinw.de/jugger/
Description: Administration Interface for jugger.events
Version: 1.0
Author: Kevin Weber
Author URI: http://kevinw.de/
License: MIT
Text Domain: jugger-events-wp-admin
*/

if ( !defined( 'JUGGER_EVENTS_ADMIN_PATH' ) )
	define( 'JUGGER_EVENTS_ADMIN_PATH', plugin_dir_path( __FILE__ ) );

if ( !defined( 'JUGGER_EVENTS_ADMIN_FILE' ) ) {
	define( 'JUGGER_EVENTS_ADMIN_FILE', __FILE__ );
}

// Automatically load all PHP classes
spl_autoload_register(function ($class_name) {
    $filteredClassName = str_replace("JuggerEvents", "", $class_name);
  
    include JUGGER_EVENTS_ADMIN_PATH . 'class/' . $filteredClassName . '.php';
});

new JuggerEventsLogin();
new JuggerEventsAdmin();
new JuggerEventsFrontend();