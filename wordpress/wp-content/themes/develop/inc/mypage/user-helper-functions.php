<?php
function mp_prevent_user_logged_in()
{
    if (is_user_logged_in()) {
        wp_redirect(home_url());
        exit;
    }
}

function mp_prevent_user_non_logged_in()
{
    if (!is_user_logged_in()) {
        wp_redirect(home_url());
        exit;
    }
}

function mp_is_logout_page()
{
    return $_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['login'] == 'false' ? true : false;
}

/**
 * Message ↓↓↓
 */
function mp_multi_form($message = '', $alert = '', $subject = '')
{
    if (!empty($message)): ?>
    <div id="result" class="alert alert-<?php echo $alert; ?> mt-3" role="alert">
        <?php echo $subject; ?>
        <ul style="margin-bottom: 0px;">
            <?php echo "<span class='text-{$alert}'>{$message}</span>"; ?>
        </ul>
    </div>
    <?php endif;
}

function mp_single_form($message = '', $alert = '')
{
    if (!empty($message)): ?>
    <div id="result" class="alert alert-<?php echo $alert; ?> mt-3" role="alert">
        <?php echo "<span class='text-{$alert}'>$message</span>"; ?>
    </div>
    <?php endif;
}

function mp_multi_failed_form($message = '')
{
    mp_multi_form($message, 'danger', 'Please check input fields and try again.');
}

function mp_multi_success_form($message = '')
{
    mp_multi_form($message, 'success', 'Updated successfully.');
}

function mp_failed_form($message = '')
{
    mp_single_form($message, 'danger');
}

function mp_success_form($message = '')
{
    mp_single_form($message, 'success');
}
/**
 * Message ↑↑↑
 */

function mp_update_user_profile($user_data = array())
{
    if (empty($user_data)) {
        return;
    }

    extract($user_data);
    $user_id = wp_get_current_user()->ID;
    $message = '';

    // Table usermeta
    $metas = array(
        'nickname'    => $nickname,
        'description' => $description,
    );

    foreach ($metas as $meta_key => $meta_value) {
        $updated = update_user_meta($user_id, $meta_key, $meta_value);

        if ($updated === false) {
            $failed .= '<li>Your ' . mp_key_to_field($meta_key) . ' can\'t update.</li>';
        } else {
            $success .= '<li>Your ' . mp_key_to_field($meta_key) . ' is updated.</li>';
        }
    }

    // Table users
    $users = array(
        'user_email' => $user_email,
        'user_url'   => $user_url,
    );

    foreach ($users as $user_key => $user_value) {
        $updated = mp_update_user($user_id, $user_key, $user_value);

        if ($updated === false) {
            $failed .= '<li>Your ' . mp_key_to_field($user_key) . ' can\'t update.</li>';
        } else {
            $success .= '<li>Your ' . mp_key_to_field($user_key) . ' is updated.</li>';
        }
    }

    if (!empty($success)) {
        $message .= mp_multi_success_form($success);
    }

    if (!empty($failed)) {
        $message .= mp_multi_failed_form($failed);
    }

    // Free up memory
    unset($success);
    unset($failed);
    unset($message);
}

function mp_update_user($user_id = 0, $user_key = '', $user_value = '')
{
    global $wpdb;
    $table = $wpdb->prefix . 'users';

    $data = array(
        $user_key => $user_value,
    );

    $where = array(
        'ID' => $user_id,
    );

    return $wpdb->update($table, $data, $where);
}

function mp_key_to_field($key = '')
{
    $fields = array(
        'nickname'    => 'nickname',
        'description' => 'bio',
        'user_email'  => 'email',
        'user_url'    => 'site',
    );

    return $fields[$key];
}
