<?php

namespace Moorph\Inc\Admin;

defined( 'ABSPATH' ) || exit;

class PostData {

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
        add_action('save_post', [$this, 'handle_post_data']);
    }

    public function handle_post_data( ) {

    }

}