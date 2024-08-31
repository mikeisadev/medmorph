<?php

namespace Moorph\Inc\Theme;

defined( 'ABSPATH' ) || exit;

class UserInterfaceMods {

    /**
     * Main instance.
     */
    private static $instance = null;

    /**
     * Get instance.
     */
    public static function getInstance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct() {
        add_filter( 'show_admin_bar', [$this, 'user_interface_mods'] );
    }

    public function user_interface_mods() {
        if ( current_user_can('student') ) {
            return false;
        }
    }

}