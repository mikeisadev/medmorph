<?php
defined( 'ABSPATH' ) || exit;

use MMorph\Inc\MMorph;

// Define main constants.
define( 'MMORPH_DIR', trailingslashit( get_template_directory() ) );
define( 'MMORPH_URL', trailingslashit( esc_url( get_template_directory_uri() ) ) );

// Require the final class and get an instance.
require_once MMORPH_DIR . 'inc/class-mmorph.php';
MMorph::getInstance()->init();