<?php

namespace Moorph\Inc\Theme\Endpoints\User;

defined( 'ABSPATH' ) || exit;

use Moorph\Inc\Config;

class StudentRegistration {

    /**
     * Single instance of this class.
     */
    protected static $instance = null;

    /**
     * Properties.
     */
    private array $errors = [];

    private array $response = [
        'status'    => '',
        'messages'  => []
    ];

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
        add_action( 'rest_api_init', [$this, 'student_registration_route'] );
    }

    /**
     * Register route for user supervisor endpoint.
     */
    public function student_registration_route() {
        register_rest_route(
            Config::RAPI_EP_NAMESPACE,
            'user/register',
            [
                'methods' => 'POST',
                'callback' => [$this, 'register_user']
            ]
        );
    }

    /**
     * Calling this route, we can know if the user is logged in or not.
     */
    public function register_user(\WP_REST_Request $request) {
        if (is_user_logged_in()) wp_send_json( [
            'status' => 'error',
            'messages' => ['general' => 'Hai già eseguito il login!']
        ], 403 );

        // If not logged in proceed.
        $headers = $request->get_headers();
        $body = $request->get_params();

        $nonce = $headers['x_wp_nonce'][0];

        if ( !wp_verify_nonce( $nonce, 'wp_rest' ) ) {
            return new \WP_REST_Response('Errore! Non hai i permessi per eseguire questa azione.', 403);
        }

        // Validate fields.
        foreach($body as $f => $v) {
            // Sanitize.
            switch($f) {
                case 'email': $body[$f] = sanitize_email( $v ); break;
                case 'login': $body[$f] = sanitize_user( $v ); break;
                default     : $body[$f] = sanitize_text_field( $v ); break;
            }

            // Check if empty.
            if ( empty($v) ) $this->errors[$f] = ['Questo campo obbligatorio è vuoto!'];
        }

        // Specific validation
        if (!is_email( $body['email'] ) && $body['email']) {
            $this->errors['email'] = ['Indirizzo mail non valido.'];
        }

        if (email_exists( $body['email'] ) && $body['email']) {
            $this->errors['email'] = ['Esiste già un utente registrato con questa mail!'];
        }

        if ( ctype_upper($body['login']) && $body['login'] ) {
            $this->errors['login'] = ['Il tuo username non può avere lettere maiuscole'];
        }

        if (username_exists( $body['login'] ) && $body['login']) {
            $this->errors['login'] = ['Esiste già un utente registrato con questo username!'];
        }

        if ($body['pwd'] !== $body['rpwd'] && $body['pwd'] && $body['rpwd']) {
            $this->errors['rpwd'] = ['Le password non coincidono. Per favore ricontrolla!'];
        }

        // Return any error.
        if ($this->errors) wp_send_json( [
            'status'    => 'error',
            'messages'  => $this->errors
        ], 400 );

        // Inser user.
        $user_id = wp_insert_user([
            'user_pass'     => $body['pwd'],
            'user_login'    => $body['login'],
            'user_email'    => $body['email'],
            'role'          => 'student'
        ]);

        wp_send_json( [
            'status'    => 'success',
            'redirect'  => esc_url( get_site_url() ) . '/studente'
        ], 200 );
    }
}
