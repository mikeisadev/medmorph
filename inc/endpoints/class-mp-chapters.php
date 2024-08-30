<?php

namespace Moorph\Inc\Theme\Endpoints;

defined( 'ABSPATH' ) || exit;

use Moorph\Inc\Config;

class Chapters {

    /**
     * Single instance of this class.
     */
    protected static $instance = null;

    /**
     * Get instance.
     */
    public static function getInstance() {
        if ( is_null(self::$instance) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor.
     */
    public function __construct() {
        add_action( 'rest_api_init', [$this, 'register_chapters_route'] );
    }

    /**
     * Register route for app settings endpoint.
     */
    public function register_chapters_route() {
        register_rest_route(
            Config::RAPI_EP_NAMESPACE,
            'exam/chapter',
            [
                'methods' => 'GET',
                'callback' => [$this, 'get_chapter_paragraphs']
            ]
        );
    }

    /**
     * Return all the paragraphs for a given chapter.
     */
    public function get_chapter_paragraphs(\WP_REST_Request $request) {
        $headers = $request->get_headers();
        $body = $request->get_params();

        $nonce = $headers['x_wp_nonce'][0];

        if ( !wp_verify_nonce( $nonce, 'wp_rest' ) ) {
            return new \WP_REST_Response('Errore! Non hai i permessi per eseguire questa azione.', 403);
        }

        $chap_uuid = sanitize_text_field( $body['src_id'] );

        $chap_id = get_post_id_by_uuid( $chap_uuid );

        // Validation. Chapter not found.
        if ( !$chap_id ) wp_send_json('Capitolo non trovato', 404);

        // Get paragraphs of current chapter.
        $paragraph_arr = carbon_get_post_meta( $chap_id, 'chapter_paragraphs' );

        // Store paragraphs data here.
        $paragraphs = (array) [];

        foreach ($paragraph_arr as $paragraph) {
            $p_id = $paragraph['id'];

            $paragraphs[] = [
                'title'     => get_the_title( $p_id ),
                'content'   => apply_filters('the_content', get_post_field('post_content', $p_id))
            ];
        }

        wp_send_json($paragraphs, 200);
    }
}
