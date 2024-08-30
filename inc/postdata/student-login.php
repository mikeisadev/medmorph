<?php 

function student_login() {
    if (isset( $_POST['customer_login'] )) { 

        // Get and sanitize data
        $user_login = sanitize_text_field( $_POST['user_login'] );
        $password = sanitize_text_field( $_POST['password'] );
        $remember = array_key_exists('remember_me', $_POST) ? sanitize_text_field( $_POST['remember_me'] ) : 'off';
        
        // Authenticate user
        $user = wp_authenticate($user_login, $password);

        // Check for errors, if there aren't log in the user
        if ( is_wp_error($user) ) {
            get_auth_errors($user->errors);
        } else {
            $user_id = $user->data->ID;
            $user_username = $user->data->user_login;

            $remember_user = strtolower($remember) === 'on' ? true : false;

            wp_set_auth_cookie($user_id, $remember_user, true);
            wp_set_current_user($user_id, $user_username);

            if (is_user_logged_in() && current_user_can('cliente')) {
                wp_redirect( get_site_url() . '/account-cliente' );
                exit;
            }
        }

    }
}
add_action('init', 'student_login');