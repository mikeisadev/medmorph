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

        // Redirect to maintenance page if the site is on maintenance mode.
        if (MP_IS_ON_MAINTENANCE) {
            if (is_admin() || is_super_admin() || current_user_can('manage_options')) {
                return;
            }

            $redirect_url = home_url('/');
            $current_url = home_url( $_SERVER['REQUEST_URI'] );

            if ( $current_url !== $redirect_url ) {
                wp_redirect($redirect_url);
                exit;
            }
        }
    }

}