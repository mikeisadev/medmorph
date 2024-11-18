<?php

namespace Moorph\Inc;

defined( 'ABSPATH' ) || exit;

class Config {

    /**
     * Properties.
     */

    /**
     * Constants.
     */
    // REST API ENDPOINT NAMESPACE
    public const RAPI_EP_NAMESPACE = 'moorph/v1/';
    
    // CHAT GPT KEYS
    public const CHAT_GPT_SECRET_KEY = 'jfjfj';
    public const CHAT_GPT_PUBLIC_KEY = '';

    /**
     * Not redirectable pages.
     */
    private static array $do_not_redirect = [
        'privacy-policy', 'cookie-policy', 'termini-e-condizioni'
    ];

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

    private function __construct() {}

    /**
     * Check if the page is not redirectable.
     */
    public static function is_page_not_redirectable() {
        $requested_page = basename( $_SERVER['REQUEST_URI'] );

        if ( in_array($requested_page, self::$do_not_redirect) ) {
            return true;
        }

        return false;
    }
}