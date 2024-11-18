<?php

namespace Moorph\Inc\Theme;

defined( 'ABSPATH' ) || exit;

use Moorph\Inc\Config;

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
        $requested_page = basename( $_SERVER['REQUEST_URI'] );

        add_action('template_redirect', [$this, 'redirects']);
    }

    public function redirects() {

        // Redirect to maintenance page if the site is on maintenance mode.
        if (MP_IS_ON_MAINTENANCE) {
            $redirect_url = home_url('/');
            $current_url = home_url( $_SERVER['REQUEST_URI'] );
            $requested_page = basename( $_SERVER['REQUEST_URI'] );

            if (is_admin() || is_super_admin() || current_user_can('manage_options')) {
                return;
            }

            // Do not redirect on these pages.
            if ( Config::is_page_not_redirectable() ) {
                return;
            }

            if ( $current_url !== $redirect_url ) {
                wp_redirect($redirect_url);
                exit;
            }
        }
    }

}