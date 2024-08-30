<?php

namespace Moorph\Inc\Theme;

defined( 'ABSPATH' ) || exit;

use Moorph\Inc\Config;

class LoadAssets {

    /**
     * Script configuration.
     */
    private array $script_conf = ['in_footer' => true, 'strategy' => 'defer'];

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
        add_action('wp_enqueue_scripts', [$this, 'load_assets']);
    }

    /**
     * Load assets.
     */
    public function load_assets() {
        // Main style
        wp_enqueue_style('main', MP_URL . 'build/App.css');

        // Main script
        wp_enqueue_script('main', MP_URL . 'build/App.js', ['react-dom'], '1.0', $this->script_conf);

        // Localize main script.
        wp_localize_script( 'main', 'mpMetDat', [
            'rNonce'        => wp_create_nonce('wp_rest'),
            'rbUrl'         => esc_url( rest_url() ),
            'rNamespace'    => Config::RAPI_EP_NAMESPACE
        ] );

        // Home
        if ( is_home() ) {
            wp_enqueue_script('Home', MP_URL . 'build/Home.js', ['react-dom'], '1.0', $this->script_conf);
        }

        // Page viewer script.
        if ( is_page('view') ) {
            wp_enqueue_script('Viewer', MP_URL . 'build/viewer.js', ['react-dom'], '1.0', $this->script_conf);
        }

        // Student registration page
        if ( is_page('registrazione-studente') ) {
            wp_enqueue_script('StudentRegister', MP_URL . 'build/Register.js', [], '1.0', $this->script_conf);
        }
        
        // Login page
        if ( is_page('accesso') ) {
            wp_enqueue_script('Login', MP_URL . 'build/Login.js', [], '1.0', $this->script_conf);
        }

        // Student private area
        if ( is_page('studente') ) {
            wp_enqueue_script('StudentPrivArea', MP_URL . 'build/MyAccountRenderer.js', [], '1.0', $this->script_conf);
        }

    }

}