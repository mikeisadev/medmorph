<?php

defined( 'ABSPATH' ) || exit;

/**
 * Get template part on /inc/templates base folder.
 */
function mmorph_get_template(string $name, string $prefix = 'site'): string|false {
    ob_start();
    include MMORPH_DIR . "inc/templates/{$prefix}-{$name}.php";
    return ob_get_clean();
}

/**
 * Get post id by UUID
 */
function get_post_id_by_uuid(string $uuid): int|bool {
    // if ( !wp_is_uuid( $uuid, 4 ) ) throw new Exception('Error! This is not a valid UUID.');

    global $wpdb;

    $res = $wpdb->get_row(
        $wpdb->prepare(
            "SELECT post_id FROM {$wpdb->prefix}postmeta WHERE `meta_value` = %s",
            [
                $uuid
            ]
        ),
        ARRAY_A
    );

    return $res ? $res['post_id'] : false;
}