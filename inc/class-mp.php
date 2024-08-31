<?php
namespace Moorph\Inc;

defined( 'ABSPATH' ) || exit;

use Carbon_Fields\Carbon_Fields;
use Moorph\Inc\Config;
use Moorph\Inc\Theme\ThemeSupports;
use Moorph\Inc\Theme\LoadAssets;
use Moorph\Inc\Theme\PostTypes;
use Moorph\Inc\Theme\BodyClasses;
use Moorph\Inc\Theme\Endpoints\Exams;
use Moorph\Inc\Theme\Endpoints\Chapters;
use Moorph\Inc\Theme\Endpoints\User\UserSupervisor;
use Moorph\Inc\Theme\Endpoints\User\UserLogin;
use Moorph\Inc\Theme\Endpoints\User\StudentRegistration;
use Moorph\Inc\Admin\PostData;
use Moorph\Inc\Theme\UserInterfaceMods;

final class Moorph {

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
        $this->initSession();
        
        $this->composerAutoload();
        add_action('after_setup_theme', [$this, 'loadCarbonFields']);

        $this->loadAppConfigClass();

        $this->includes();

        $this->getInstances();
    }

    /**
     * Autoload composer packages.
     */
    private function composerAutoload() {
        require_once MP_DIR . 'vendor/autoload.php';
    }

    /**
     * Start session.
     */
    private function initSession() {
        session_start();
    }

    /**
     * Load the class to config this application.
     */
    private function loadAppConfigClass() {
        require_once MP_DIR . 'inc/class-mp-config.php';

        // Instantiate class.
        Config::getInstance();
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
        require_once MP_DIR . 'inc/class-mp-theme-supports.php';

        // Load assets.
        require_once MP_DIR . 'inc/class-mp-load-assets.php';

        // Register post types.
        require_once MP_DIR . 'inc/class-mp-post-types.php';

        // User mods
        require_once MP_DIR . 'inc/class-mp-user-interface-mods.php';

        // Others.
        require_once MP_DIR . 'inc/class-mp-body-classes.php';

        // Functions.
        require_once MP_DIR . 'inc/functions/functions.php';

        // Admin.
        require_once MP_DIR . 'inc/class-mp-admin-post-data.php';

        // Rest API endpoints.
        require_once MP_DIR . 'inc/endpoints/class-mp-exams.php';
        require_once MP_DIR . 'inc/endpoints/class-mp-chapters.php';
    
        // USER Rest API endpoints.
        require_once MP_DIR . 'inc/endpoints/user/class-mp-user-supervisor.php';
        require_once MP_DIR . 'inc/endpoints/user/class-mp-user-login.php';
        require_once MP_DIR . 'inc/endpoints/user/class-mp-student-registration.php';
    }

    /**
     * Get instances of imported classes.
     */
    private function getInstances() {
        // Theme
        ThemeSupports::getInstance();
        LoadAssets::getInstance();
        PostTypes::getInstance();
        BodyClasses::getInstance();
        UserInterfaceMods::getInstance();

        // Admin post data.
        PostData::getInstance();

        // REST API endpoints.
        Exams::getInstance();
        Chapters::getInstance();
        UserSupervisor::getInstance();
        UserLogin::getInstance();
        StudentRegistration::getInstance();
    }

}