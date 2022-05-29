<?php
function mp_user_login_page()
{
    // redirect user from wp-login to home page
    if (basename($_SERVER['REQUEST_URI']) == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
        mp_redirect_user();
    }
}
add_action('init', 'mp_user_login_page');

function mp_user_login_failed()
{
    mp_redirect_user('failed');
}
add_action('wp_login_failed', 'mp_user_login_failed');

function mp_verify_username_password($user, $username, $password)
{
    if ($username == "" || $password == "") {
        mp_redirect_user('empty');
    }
}
add_filter('authenticate', 'mp_verify_username_password', 1, 3);

function mp_user_logout()
{
    mp_redirect_user('false');
}
add_action('wp_logout', 'mp_user_logout');

function mp_redirect_user($status = '')
{
    $with_status = !empty($status) ? "?login={$status}" : '';
    wp_redirect(home_url('/login/') . $with_status);
    exit;
}