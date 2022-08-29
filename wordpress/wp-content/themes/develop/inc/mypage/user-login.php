<?php
function mp_user_login_success( $url, $request, $user )
{
    if (!empty(mp_is_user_screen())) {
        mp_redirect_user('success');
        exit;
    }

    return $url;
}
add_filter( 'login_redirect', 'mp_user_login_success', 10, 3 );

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
        mp_redirect_user('logout');
        exit;
    }
}
add_action('wp_logout', 'mp_user_logout');

function mp_redirect_user($status = '')
{
    $with_status = !empty($status) ? "?login={$status}" : '';
    $url_ref     = $_SERVER['HTTP_REFERER'];
    $url         = strpos($url_ref, '?login=') !== false ? strstr($url_ref, '?login=', true) : $url_ref;
    $url         = $status == 'success' ? str_replace('/login', '/', $url) : $url;
    $url         = $status == 'logout' ? home_url('/login') : $url;
    wp_redirect($url . '/' . $with_status);
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
