<?php
namespace MMorph\Inc;

defined( 'ABSPATH' ) || exit;

use Carbon_Fields\Carbon_Fields;
use MMorph\Inc\Theme\ThemeSupports;
use MMorph\Inc\Theme\LoadAssets;
use MMorph\Inc\Theme\PostTypes;
use MMorph\Inc\Theme\BodyClasses;
use MMorph\Inc\Theme\Endpoints\Exams;
use MMorph\Inc\Theme\Endpoints\Chapters;

final class MMorph {

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
     * Init.
     */
    public function init() {
        $this->composerAutoload();
        add_action('after_setup_theme', [$this, 'loadCarbonFields']);
        $this->includes();
        $this->getInstances();
    }

    /**
     * Autoload composer packages.
     */
    private function composerAutoload() {
        require_once MMORPH_DIR . 'vendor/autoload.php';
    }

    /**
     * Load carbon fields.
     */
    public function loadCarbonFields() {
        Carbon_Fields::boot();
    }

    /**
     * Includes.
     */
    private function includes() {
        // Theme supports.
        require_once MMORPH_DIR . 'inc/class-mmorph-theme-supports.php';

        // Load assets.
        require_once MMORPH_DIR . 'inc/class-mmorph-load-assets.php';

        // Register post types.
        require_once MMORPH_DIR . 'inc/class-mmorph-post-types.php';

        // Others.
        require_once MMORPH_DIR . 'inc/class-mmorph-body-classes.php';

        // Functions.
        require_once MMORPH_DIR . 'inc/functions/functions.php';

        // Rest API endpoints.
        require_once MMORPH_DIR . 'inc/endpoints/class-mmorph-exams.php';
        require_once MMORPH_DIR . 'inc/endpoints/class-mmorph-chapters.php';
    }

    /**
     * Get instances of imported classes.
     */
    private function getInstances() {
        ThemeSupports::getInstance();
        LoadAssets::getInstance();
        PostTypes::getInstance();
        BodyClasses::getInstance();

        Exams::getInstance();
        Chapters::getInstance();
    }

}