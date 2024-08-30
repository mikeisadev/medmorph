<?php

namespace Moorph\Inc\Theme\Endpoints\User;

defined( 'ABSPATH' ) || exit;

use Moorph\Inc\Config;

class UserLogin {

    /**
     * Single instance of this class.
     */
    protected static $instance = null;

    private array $errors = [];

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
        add_action( 'rest_api_init', [$this, 'user_login_route'] );
    }

    /**
     * Register route for user login endpoint.
     */
    public function user_login_route() {
        register_rest_route(
            Config::RAPI_EP_NAMESPACE,
            'user/login',
            [
                'methods' => 'POST',
                'callback' => [$this, 'user_login']
            ]
        );
    }

    /**
     * Calling this route, we can know if the user is logged in or not.
     */
    public function user_login(\WP_REST_Request $request) {
        $headers = $request->get_headers();
        $body = $request->get_params();

        $nonce = $headers['x_wp_nonce'][0];

        if ( !wp_verify_nonce( $nonce, 'wp_rest' ) ) {
            return new \WP_REST_Response('Errore! Non hai i permessi per eseguire questa azione.', 403);
        }

        if ( is_user_logged_in() ) {

            wp_send_json( 
                [
                    'status'        => 'error',
                    'user'          => 'logged-in',
                    'user_status'   => 'already-logged-in',
                    'messages'      => 'L\'utente ha già effettuato l\'accesso'
                ], 
                400
            );

        }

        // Login
        $login = sanitize_text_field( $body['login'] );
        $pwd = sanitize_text_field( $body['pwd'] );

        $user = wp_authenticate( $login, $pwd );
        $key = '';

        if ( is_wp_error($user) ) {
            foreach ($user->errors as $k => $e) {
                if ( str_contains($k, 'password') ) $key = 'pwd';
                if ( str_contains($k, 'username') || str_contains($k, 'email') ) $key = 'login';

                $this->errors[$key] = array_map(
                    fn($_e) => \ucfirst(\trim(\preg_replace('/([<>\/]+[A-z:]*)+/', '', $_e))), 
                    $e
                );
            }

            wp_send_json(
                [
                    'status'    => 'error',
                    'messages'  => $this->errors
                ],
                400
            );
        }

        wp_set_auth_cookie( $user->data->ID, False, True );

        wp_set_current_user( 
            $user->data->ID, 
            $user->data->user_login 
        );

        $redirect = match(true) {
            current_user_can('student') => 'studente',
            current_user_can('author')  => 'autore'
        };

        wp_send_json([
            'status'        => 'success',
            'user'          => $user,
            'user_status'   => 'logged-in',
            'redirect'      => esc_url( get_site_url() . '/' . $redirect )
        ], 200);

    }
}
