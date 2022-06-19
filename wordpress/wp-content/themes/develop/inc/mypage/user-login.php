<?php
function mp_user_login_failed()
{
    if (!empty(mp_is_user_screen())) {
        mp_redirect_user('failed');
        exit;
    }
}
add_action('wp_login_failed', 'mp_user_login_failed');

function mp_user_login_empty($user, $username, $password)
{
    if (($username == "" || $password == "") && !empty(mp_is_user_screen())) {
        mp_redirect_user('empty');
        exit;
    }
}
add_filter('authenticate', 'mp_user_login_empty', 1, 3);

function mp_user_logout()
{
    if (!empty(mp_is_user_screen())) {
        mp_redirect_user('false');
        exit;
    }
}
add_action('wp_logout', 'mp_user_logout');

function mp_redirect_user($status = '')
{
    $with_status = !empty($status) ? "?login={$status}" : '';
    wp_redirect(home_url() . $with_status);
    exit;
}

function mp_is_user_screen()
{
    $referrer = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : $_SERVER['PHP_SELF'];
    $referrer = add_query_arg('result', 'failed', $referrer);
    $referrer = add_query_arg('username', $username, $referrer);

    if (!empty($referrer) && !strstr($referrer, 'wp-login') && !strstr($referrer, 'wp-admin')) {
        return true;
    }

    return false;
}
