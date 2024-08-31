<?php

namespace Moorph\Inc\Theme\Endpoints;

defined( 'ABSPATH' ) || exit;

use Moorph\Inc\Config;

class Exams {

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
        add_action( 'rest_api_init', [$this, 'register_exams_route'] );
    }

    /**
     * Register route for app settings endpoint.
     */
    public function register_exams_route() {
        register_rest_route(
            Config::RAPI_EP_NAMESPACE,
            'exam/chapters',
            [
                'methods' => 'GET',
                'callback' => [$this, 'get_exam_chapters']
            ]
        );
    }

    /**
     * Return all the chapters for a specific exam.
     */
    public function get_exam_chapters(\WP_REST_Request $request) {
        $headers = $request->get_headers();
        $body = $request->get_params();

        $nonce = $headers['x_wp_nonce'][0];

        if ( !wp_verify_nonce( $nonce, 'wp_rest' ) ) {
            return new \WP_REST_Response('Errore! Non hai i permessi per eseguire questa azione.', 403);
        }

        /**
         * Get the exam from which we want to take chapters.
         * 
         * First sanitize and process the exam slug
         */
        $slug = sanitize_text_field( trim( $body['exam-slug'] ) );
        $slug = $slug[0] === '/' ? substr($slug, 1, strlen($slug) - 1) : $slug;
        $slug = $slug[-1] === '/' ? substr($slug, 0, strlen($slug) - 1) : $slug;
        $slug = explode('/', $slug);

        // Get the exam ID.
        $examId = get_page_by_path(end($slug), ARRAY_A, 'mp_exams')['ID'];

        // Get exam chapters.
        $chapters = carbon_get_post_meta($examId, 'exam_chapters');

        if ( $chapters ) {
            $chaps = (array) [];

            foreach($chapters as $chapter) {
                $chapterId = $chapter['id'];
                $chapterUUID = carbon_get_post_meta( $chapterId, 'chapter_uuid' );

                $paragraphs = carbon_get_post_meta( $chapterId, 'chapter_paragraphs' );
    
                $chaps[] = [
                    'chapter_title'         => get_the_title( $chapterId ),
                    'chapter_brief_desc'    => carbon_get_post_meta( $chapterId, 'chapter_brief_desc' ),
                    'has_paragraphs'        => $paragraphs ? ['count' => count($paragraphs)] : false,
                    'has_3d_models'         => carbon_get_post_meta( $chapterId, 'chapter_3d_models' ) ? true : false,
                    'has_mind_maps'         => carbon_get_post_meta( $chapterId, 'chapter_mind_maps' ) ? true : false,
                    'uuid'                  => $chapterUUID,
                    'urls'                  => [
                        'chapter' => esc_url( get_site_url() ) . '/view?type=chapter&src_id=' . $chapterUUID
                    ]
                ];
            }

            wp_send_json([
                'status'        => 'success',
                'status-code'   => 'read-available-exams',
                'response'      => [
                    'exam' => $chaps
                ]
            ], 200);
        } else {
            wp_send_json([
                'status'        => 'error',
                'status-code'   => 'no-exam-available',
                'message'       => '<p>Questo esame non ha capitoli e deve essere completato. <br/> Iscriviti alla newsletter se vuoi essere notificato.</p>'
            ]);
        }

    }
}
