<?php

namespace MMorph\Inc\Theme;

defined( 'ABSPATH' ) || exit;

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
        wp_enqueue_style('main', MMORPH_URL . 'build/index.css');

        // Main script
        wp_enqueue_script('main', MMORPH_URL . 'build/index.js', ['react-dom'], '1.0', $this->script_conf);

        // Localize main script.
        wp_localize_script( 'main', 'mmorphMeta', [
            'restNonce'     => wp_create_nonce('wp_rest'),
            'restBaseUrl'   => esc_url( rest_url() )
        ] );

        // Page viewer script.
        if ( is_page('view') ) {

            wp_enqueue_script('viewer', MMORPH_URL . 'build/viewer.js', ['react-dom'], '1.0', $this->script_conf);

        }
    }

}