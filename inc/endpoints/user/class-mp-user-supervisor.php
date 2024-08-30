<?php

namespace Moorph\Inc\Theme\Endpoints\User;

defined( 'ABSPATH' ) || exit;

use Moorph\Inc\Config;

class UserSupervisor {

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
        add_action( 'rest_api_init', [$this, 'user_supervisor_route'] );
    }

    /**
     * Register route for user supervisor endpoint.
     */
    public function user_supervisor_route() {
        register_rest_route(
            Config::RAPI_EP_NAMESPACE,
            'user/supervisor',
            [
                'methods' => 'GET',
                'callback' => [$this, 'user_supervisor']
            ]
        );
    }

    /**
     * Calling this route, we can know if the user is logged in or not.
     */
    public function user_supervisor(\WP_REST_Request $request) {
        $headers = $request->get_headers();
        $body = $request->get_params();

        $nonce = $headers['x_wp_nonce'][0];

        if ( !wp_verify_nonce( $nonce, 'wp_rest' ) ) {
            return new \WP_REST_Response('Errore! Non hai i permessi per eseguire questa azione.', 403);
        }

        if ( is_user_logged_in() ) {

            wp_send_json( 
                [
                    'status' => 'success',
                    'user'   => 'logged-in'
                ], 
                200 
            );

        } else {

            wp_send_json(
                [
                    'status' => 'error',
                    'user'   => 'logged-out'
                ],
                200
            );

        }

    }
}
