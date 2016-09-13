<?php
/*
Plugin Name: Jugger
Plugin URI: http://kevinw.de/jugger/
Description: Jugger Events
Version: 1.0
Author: Kevin Weber
Author URI: http://kevinw.de/
License: MIT
Text Domain: jugger
*/

if ( !defined( 'JUGGER_PLUGIN_PATH' ) )
	define( 'JUGGER_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

if ( !defined( 'JUGGER_PLUGIN_FILE' ) ) {
	define( 'JUGGER_PLUGIN_FILE', __FILE__ );
}

// Automatically load all PHP classes
spl_autoload_register(function ($class_name) {
    $filteredClassName = str_replace("JuggerEvents", "", $class_name);
  
    include JUGGER_PLUGIN_PATH . 'class/' . $filteredClassName . '.php';
});

new JuggerEventsLogin();
new JuggerEventsAdmin();
new JuggerEventsFrontend();