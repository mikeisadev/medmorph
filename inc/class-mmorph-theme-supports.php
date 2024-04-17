<?php

namespace MMorph\Inc\Theme;

defined( 'ABSPATH' ) || exit;

class ThemeSupports {

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
        add_action('after_setup_theme', [$this, 'add_theme_supports']);
    }

    /**
     * Add theme supports.
     */
    public function add_theme_supports() {
        add_theme_support('menus');
        add_theme_support('title-tag');
    }

}