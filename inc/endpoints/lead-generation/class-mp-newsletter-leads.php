<?php

namespace Moorph\Inc\Theme\Endpoints\LeadGeneration;

defined( 'ABSPATH' ) || exit;

use Moorph\Inc\Config;
use Moorph\Inc\Models\NewsletterSubModel;

class NewsletterLeads {

    /**
     * Single instance of this class.
     */
    protected static $instance = null;

    /**
     * Errors
     */
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
        add_action( 'rest_api_init', [$this, 'register_newsletter_leads_route'] );
    }

    /**
     * Register route for app settings endpoint.
     */
    public function register_newsletter_leads_route() {
        register_rest_route(
            Config::RAPI_EP_NAMESPACE,
            'lead-generation/newsletter',
            [
                'methods' => 'POST',
                'callback' => [$this, 'submit_newsletter_lead'],
            ]
        );
    }

    /**
     * Return all the paragraphs for a given chapter.
     */
    public function submit_newsletter_lead(\WP_REST_Request $request) {
        $headers = $request->get_headers();
        $body = $request->get_params();

        $nonce = $headers['x_wp_nonce'][0];

        if ( !wp_verify_nonce( $nonce, 'wp_rest' ) ) {
            return new \WP_REST_Response('Errore! Non hai i permessi per eseguire questa azione.', 403);
        }

        if ( NewsletterSubModel::subscriber_exists($body['email']) ) {
            $this->errors['email'] = 'Errore! Questa email risulta già iscritta alla newsletter!';
        }

        if ( empty($body['email']) ) {
            $this->errors['email'] = 'Errore! Email non fornita.';
        }

        if ( !is_email($body['email']) ) {
            $this->errors['email'] = 'Errore! Email non valida.';
        }

        if ( empty($body['user']) ) {
            $this->errors['user'] = 'Errore! Nome e cognome non forniti.';
        }

        if ( !isset($body['gdpr-acceptance-1']) || $body['gdpr-acceptance-1'] !== 'on' ) {
            $this->errors['gdpr-acceptance-1'] = 'Errore! Devi accettare la privacy policy.';
        }
        
        if ( !empty($this->errors) ) {
            return new \WP_REST_Response($this->errors, 400);
        }

        // Save the lead.
        $sub_id = NewsletterSubModel::save_newsletter_subscriber(
            $body['email'], 
            $body['user'], 
            'Questo utente si è iscritto dalla pagina di manutenzione.'
        );

        if ( !is_wp_error($sub_id) ) {
            return new \WP_REST_Response('Errore! Non è stato possibile salvare l\'iscrizione. Riprova più tardi.', 500);
        }
        
        // Send email to the user user
        $to = sanitize_email($body['email']);
        $subject = 'Grazie per esserti iscritto a Moorph';
        $message = 'Appena saremo pronti sarai notificato via mail che la piattaforma è pronta.' . "\n\n";
        $headers = ['Content-Type: text/plain; charset=UTF-8'];

        wp_mail($to, $subject, $message, $headers);

        // Send response if everything is ok.
        wp_send_json([
            'message'   => 'Iscrizione avvenuta con successo!',
            'status'    => 'success',
            'data'      => $body,
        ], 200);

    }
}
