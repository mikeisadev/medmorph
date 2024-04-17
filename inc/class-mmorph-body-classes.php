<?php

namespace MMorph\Inc\Theme;

defined( 'ABSPATH' ) || exit;

class BodyClasses {

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
        add_filter('body_class', [$this, 'add_body_classes']);
    }

    /**
     * Add custom classes to body HTML tag.
     */
    public function add_body_classes(array $classes): array {
        $classes[] = get_query_var('pagename');
        return $classes;
    }

}