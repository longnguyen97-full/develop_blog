<?php
function mp_prevent_user_logged_in()
{
    if (is_user_logged_in()) {
        wp_redirect(home_url());
        exit;
    }
}

function mp_prevent_user_non_logged_in($url = '')
{
    $url = !empty($url) ? $url : home_url();
    if (!is_user_logged_in()) {
        wp_redirect($url);
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
    mp_multi_form($message, 'success', 'Updated successfully. Please refresh page to see changes.');
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

function mp_key_to_field($key = '')
{
    $fields = array(
        'nickname'    => 'nickname',
        'description' => 'bio',
        'user_url'    => 'site',
    );

    return $fields[$key];
}

function mp_freeup_memory($variable = '')
{
    unset($variable);
}