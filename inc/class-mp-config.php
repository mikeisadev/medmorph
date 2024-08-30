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


}