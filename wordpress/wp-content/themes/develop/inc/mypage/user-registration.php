<?php
function mp_user_registration_execute()
{
    if (!isset($_POST['register_submit'])) {
        return false;
    }

    $data = user_registration_request();
    $data = !empty($data) ? mp_user_registration_validate($data) : array();
    $data = !empty($data) ? mp_user_registration_process($data) : array();
}

function user_registration_request()
{
    $data['user_login']        = isset($_POST['user_login']) ? $_POST['user_login'] : '';
    $data['user_mail']         = isset($_POST['user_mail']) ? $_POST['user_mail'] : '';
    $data['user_pass']         = isset($_POST['user_pass']) ? $_POST['user_pass'] : '';
    $data['user_confirm_pass'] = isset($_POST['user_confirm_pass']) ? $_POST['user_confirm_pass'] : '';

    return $data;
}

function mp_user_registration_validate($data)
{
    extract($data);

    $err_message = '';

    // whether string is empty
    if ($user_mail == "" || $user_pass == "" || $user_confirm_pass == "" || $user_login == "") {
        $err_message .= '<li>Require fields are not empty.</li>';
    }

    // limit size of string
    if (strlen($user_pass) < 8 || strlen($user_login) < 8) {
        $err_message .= '<li>Username or password are too short, minimum is 8 characters (20 max).</li>';
    } elseif (strlen($user_pass) > 20 || strlen($user_login) > 20) {
        $err_message .= '<li>Username or password is too long, maximum is 20 characters.</li>';
    }

    // whether email was valid or exists
    if (!filter_var($user_mail, FILTER_VALIDATE_EMAIL)) {
        $err_message .= '<li>Email address is unvalid.</li>';
    } elseif (email_exists($user_mail)) {
        $err_message .= '<li>Email address is exists.</li>';
    }

    // whether password and confirm password are the same
    if ($user_pass != $user_confirm_pass) {
        $err_message .= '<li>Password and confirm password does not match.';
    }

    if (!empty($err_message)) {
        mp_multi_failed_form($err_message);
        return false;
    }

    return $data;
}

function mp_user_registration_process($data)
{
    extract($data);

    $user_data = array(
        'user_pass'  => apply_filters('pre_user_user_pass', $user_pass),
        'user_login' => apply_filters('pre_user_user_login', $user_login),
        'user_email' => apply_filters('pre_user_user_email', $user_mail),
        'role'       => 'subscriber',
    );
    $user_id = wp_insert_user($user_data);

    if (is_wp_error($user_id)) {
        mp_multi_failed_form('Error on user creation.');
        return false;
    }

    do_action('user_register', $user_id);
    mp_success_form('Welcome to Develop Blog ! You can now login.');
}
