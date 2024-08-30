<?php
defined( 'ABSPATH' ) || exit;

use Moorph\Inc\Moorph;

// Define main constants.
define( 'MP_DIR', trailingslashit( get_template_directory() ) );
define( 'MP_URL', trailingslashit( esc_url( get_template_directory_uri() ) ) );

// Require the final class and get an instance.
require_once MP_DIR . 'inc/class-mp.php';
Moorph::getInstance()->init();