<?php

function wpapi_json_basic_auth() {
    $user = wp_get_current_user();
    if (!$user->ID) {
        if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_USER'])) {
            $username = $_SERVER['PHP_AUTH_USER'];
            $password = $_SERVER['PHP_AUTH_PW'];
            $user     = wp_authenticate($username, $password);
            if (!is_wp_error($user)) {
                wp_set_current_user($user);
                return;
            }
        }
        wp_send_json(new stdClass());
        exit;
    }
}
add_action('rest_api_init', 'wpapi_json_basic_auth', 1);

?>