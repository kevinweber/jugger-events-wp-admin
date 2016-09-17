<?php
class JuggerEventsLogin {

	function __construct() {
        // "load-index.php" is the hook used for the admin dashboard
        add_action( 'load-index.php', array( $this, 'redirect_after_login') );
	}

    function redirect_after_login() {
        wp_redirect( admin_url( 'edit.php?post_type=jugger-event' ) );
        exit;
    }
}