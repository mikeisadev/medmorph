<?php

namespace Moorph\Inc\Theme;

defined( 'ABSPATH' ) || exit;

class Redirects {

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
        add_action('template_redirect', [$this, 'redirects']);
    }

    public function redirects() {
        wp_safe_redirect();
    }

}