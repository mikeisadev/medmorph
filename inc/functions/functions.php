<?php

defined( 'ABSPATH' ) || exit;

/**
 * Get template part on /inc/templates base folder.
 */
function mp_get_template(string $name, string $prefix = 'site'): string|false {
    ob_start();
    include MP_DIR . "inc/templates/{$prefix}-{$name}.php";
    return ob_get_clean();
}

/**
 * Get post id by UUID
 */
function get_post_id_by_uuid(string $uuid): int|bool {
    if ( !wp_is_uuid( $uuid, 4 ) ) throw new Exception('Error! This is not a valid UUID.');

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

/**
 * Common medmorph functions.
 * 
 * Get the count of chapter paragraphs.
 */
function mp_count_chapter_paragraphs(string $chapter_uuid, bool $label = true) {
    $chapter_id = get_post_id_by_uuid( $chapter_uuid );

    $count = 0;

    if ($chapters = carbon_get_post_meta($chapter_id, 'chapter_paragraphs')) {
        $count = count($chapters);
    }

    return $count . (($count === 0 || $count > 0) && $label ? ' paragrafi' : ' paragrafo');
}

/**
 * Start the session.
 */
function mp_start_session() {
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();
}

/**
 * Clean the session superglobal.
 */
function mp_clean_session_arr() {
    mp_start_session();
    session_unset();
}

/**
 * Flash session message.
 */
function mp_show_session_msg(string $key): mixed {
    if ( !array_key_exists( $_SESSION['messages'][$key] ) ) return '';

    $msg = $_SESSION['messages'][$key];
    unset($_SESSION['messages'][$key]);

    return $msg;
}

/**
 * Insert a session message
 */
function mp_insert_session_msg(string $key, string $msg) {
    $_SESSION['messages'][$key] = $msg;
}