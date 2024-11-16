<?php

namespace Moorph\Inc\Models;

defined( 'ABSPATH' ) || exit;

class NewsletterSubModel {

    /**
     * Main instance.
     */
    private static $instance = null;

    /**
     * Get instance.
     */
    public static function getInstance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct() {}

    /**
     * Save newsletter subscriber.
     * 
     * This is an abstraction function to save a subscriber to the newsletter.
     * 
     * You give the data inside the parameters and then everything is managed here.
     * 
     * Error is handled with WP_Error class. If no error, the int ID of the inserted user is returned.
     */
    public static function save_newsletter_subscriber(string $email, string $user, string $origin): int|WP_Error {
        $timestamp = 'Data: ' . wp_date('Y F d') . ' - Orario: ' . wp_date('H:i:s');

        $sub_id = wp_insert_post([
            'post_title'    => sanitize_email($email) . ' - Iscritto il: ' . $timestamp,
            'post_status'   => 'publish',
            'post_type'     => 'mp_newslettersubs',
        ]);

        if ( is_wp_error($sub_id) ) {
            return new \WP_REST_Response('Errore! Non è stato possibile salvare l\'iscrizione. Riprova più tardi.', 500);
        }

        carbon_set_post_meta($sub_id, 'sub_name', sanitize_text_field($user));
        carbon_set_post_meta($sub_id, 'sub_email', sanitize_email($email));
        carbon_set_post_meta($sub_id, 'sub_origin', sanitize_text_field($origin));
        carbon_set_post_meta($sub_id, 'sub_date', $timestamp);

        return $sub_id;
    }

    /**
     * Check if subscriber exists.
     * 
     * This function checks if a subscriber exists in the database.
     * 
     * It returns a boolean value.
     */
    public static function subscriber_exists(string $email) {
        $query = new \WP_Query([
            'post_type' => 'mp_newslettersubs',
            'meta_query' => [
                [
                    'key' => 'sub_email',
                    'value' => $email,
                    'compare' => '='
                ]
            ]
        ]);

        return $query->have_posts();
    }

}