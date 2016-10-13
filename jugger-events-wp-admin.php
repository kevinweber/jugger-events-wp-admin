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

if ( !defined( 'JUGGER_EVENTS_ADMIN_TD' ) ) {
	define( 'JUGGER_EVENTS_ADMIN_TD', 'jugger-events' ); // = text domain (used for translations)
}

class JuggerEventsWpAdmin {
    function __construct() {
        $this->autoloader();

        new JuggerEventsLogin();
        new JuggerEventsAdmin();
        new JuggerEventsFrontend();
    }

    function autoloader() {
        // Automatically load all PHP classes
        spl_autoload_register(function ($class_name) {
            $filteredClassName = str_replace("JuggerEvents", "", $class_name);
            $path = JUGGER_EVENTS_ADMIN_PATH . 'class/' . strtolower($filteredClassName) . '.php';

            if (file_exists($path)) {
                include $path;
            }
        });
    }
}

new JuggerEventsWpAdmin();
