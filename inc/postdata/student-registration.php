<?php

function add_new_customer() {
    if (isset( $_POST['customer_reg'] ) && wp_verify_nonce( $_POST['customer_reg_csrf'], 'customer-reg-csrf' )) {   

        // Get data and sanitize
        $first_name = sanitize_text_field( $_POST['fname'] );
        $last_name = sanitize_text_field( $_POST['lname'] );
        $username = sanitize_user( $_POST['username'] );
        $email_addr = sanitize_email( $_POST['email_addr'] );
        $password = sanitize_text_field( $_POST['password'] );
        $passwordr = sanitize_text_field( $_POST['passwordr'] );
        $gdpr_acceptance = ( isset( $_POST['gdpr_acceptance'] ) ) ? sanitize_text_field( $_POST['gdpr_acceptance'] ) : 'off';

        // Get useful functions for user validation
        require_once(ABSPATH . WPINC . "/registration.php");

        // Validate data
        if ( empty($first_name) ) {
            registration_errors()->add('nome_vuoto', __('Il campo "nome" non può essere vuoto!'));
        }

        if ( empty($last_name) ) {
            registration_errors()->add('nome_vuoto', __('Il campo "cognome" non può essere vuoto!'));
        }

        // Validate username
        if ( empty($username) ) {
            registration_errors()->add('nome_vuoto', __('Il campo "nome utente" non può essere vuoto!'));
        }

        if ( username_exists($username) ) {
            registration_errors()->add('nome_vuoto', __('Questo nome utente esiste già, scegline uno diverso!'));
        }

        if ( !validate_username($username) ) {
            registration_errors()->add('nome_vuoto', __('Il tuo nome utente non è valido'));
        }

        // Validate email
        if ( empty($email_addr) ) {
            registration_errors()->add('nome_vuoto', __('Il campo "email" non può essere vuoto!'));
        }

        if ( !is_email($email_addr) ) {
            registration_errors()->add('nome_vuoto', __('Il tuo indirizzo email non è valido'));
        }

        if ( email_exists($email_addr) ) {
            registration_errors()->add('nome_vuoto', __('Questa email esiste già, scegline una diversa!'));
        }

        // Validate password
        if ( empty($password) ) {
            registration_errors()->add('nome_vuoto', __('Il campo "password" non può essere vuoto!'));
        }

        if ( empty($passwordr) ) {
            registration_errors()->add('nome_vuoto', __('Il campo "ripeti password" non può essere vuoto!'));
        }

        if ( $password != $passwordr ) {
            registration_errors()->add('nome_vuoto', __('Le password non coincidono! Per favore, ricontrolla.'));
        }

        // Validate GDPR
        if ( strtolower( $gdpr_acceptance ) != 'on' ) {
            registration_errors()->add('nome_vuoto', __('Devi accettare la privacy policy per poterti registrare'));
        }

        $errors = registration_errors()->get_error_messages();

        if ( empty($errors) ) {

            // Insert new user
            $new_user_id = wp_insert_user([
                'user_pass'     => $password,
                'user_login'    => $username,
                'user_email'    => $email_addr,
                'first_name'    => $first_name,
                'last_name'     => $last_name,
                'role'          => 'cliente'
            ]);

            if ( $new_user_id ) {
                //wp_new_user_notification($new_user_id); // remove comment when live

                add_user_meta($new_user_id, 'phone_number', ''); // Init user meta for later

                // Send email
                $headers = [
                    'Content-Type: text/html; charset=UTF-8',
                    'From: ' . sanitize_text_field( get_option('blogname') ) . ' <' . sanitize_email( get_option('admin_email') ) . '>'
                ];
    
                // Send welcome email
                wp_mail(
                    $email_addr,
                    'Benvenuto su animalissimo!',
                    '
                        <div class="">
                            <p>Grazie per esserti registrato su Animalissimo</p>

                            <p>Ti ricordiamo che ti sei registrato come cliente, quindi avrai la tua pagina "Mio account" per gestire:</p>

                            <ul>
                                <li>i tuoi dati personali</li>
                                <li>la password del tuo account</li>
                                <li>Le richieste di trasporto inviate</li>
                            </ul>
    
                            <a href="' . esc_attr( get_site_url() . '/account-cliente' ) . '">Clicca qui per vedere il tuo account</a>

                            <p>Utilizza le credenziali che hai inserito per poter eseguire l\'accesso.</p>

                            <p>Puoi recuperare la password <a href="' . esc_attr( get_site_url() . '/recupera-password-cliente' ) . '">cliccando qui</a> se l\'hai persa.</p>
                        </div>
                    ',
                    $headers
                );

                // Redirect
                wp_redirect( home_url() . '/accesso-clienti' );
                exit;
            }

        } else {
            return;
        }

    }
}
add_action('init', 'add_new_customer');