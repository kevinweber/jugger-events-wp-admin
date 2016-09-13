<?php
class JuggerEventsFrontend {
	function __construct() {
        // Disable admin bar on front end
        add_filter('show_admin_bar', '__return_false');
	}
}