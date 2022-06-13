<?php
function mp_get_template_user()
{
    if (is_admin()) {
        return;
    }

    return is_user_logged_in() ? mp_get_template_profile() : mp_get_template_login_out();
}

function mp_get_template_profile()
{
    $user_id = wp_get_current_user()->ID;
    ?>
	<div class="card">
		<div class="card-body">
			<h6 class="card-subtitle mb-3 text-muted"><?php echo get_user_meta($user_id, 'nickname', true); ?></h6>
			<p class="card-text"><?php echo nl2br(get_the_author_meta('description')); ?></p>
			<p class="card-text">Website: <a href="<?php echo get_userdata($user_id)->user_url; ?>" class="card-link" target="blank"><?php echo get_userdata($user_id)->user_url; ?></a></p>
		</div>
	</div>
	<?php
}

function mp_get_template_login_out()
{
    ?>
	<div class="card">
		<div class="card-body">
			You need to <?php mp_get_login_button_modal(); ?> to view this content.
		</div>
	</div>
	<?php
}

function mp_user_profile_execute()
{
    if (!isset($_POST['profile_submit'])) {
        return false;
    }

    $data = user_profile_request();
    $data = !empty($data) ? mp_user_profile_validate($data) : array();
    $data = !empty($data) ? mp_user_profile_process($data)  : array();
}

function user_profile_request()
{
    $data['user_nickname'] = isset($_POST['user_nickname']) ? $_POST['user_nickname'] : '';
    $data['user_bio']      = isset($_POST['user_bio'])      ? $_POST['user_bio']      : '';
    $data['user_site']     = isset($_POST['user_site'])     ? $_POST['user_site']     : '';

    return $data;
}

function mp_user_profile_validate($data)
{
    extract($data);

    $user_data = array(
        'nickname'    => $user_nickname,
        'description' => $user_bio,
        'user_url'    => $user_site,
    );

    mp_update_user_profile($user_data);

    return $data;
}

function mp_update_user_profile($user_data = array())
{
    if (empty($user_data)) {
        return;
    }

    // Prepare data
    extract($user_data);
    $user_id = wp_get_current_user()->ID;
    $message = '';

    $data = array(
        'nickname'    => $nickname,
        'description' => $description,
        'user_url'    => $user_url,
    );

    // Update data
    foreach ($data as $key => $value) {
        $updated = update_user_meta($user_id, $key, $value);

        if ($updated === false) {
            $failed .= '<li>Your ' . mp_key_to_field($key) . ' can\'t update.</li>';
        } else {
            $success .= '<li>Your ' . mp_key_to_field($key) . ' is updated.</li>';
        }
    }

    if (!empty($success)) {
        $message .= mp_multi_success_form($success);
    }

    if (!empty($failed)) {
        $message .= mp_multi_failed_form($failed);
    }

    // Free up memory
    array_map('mp_freeup_memory', array($user_id, $message, $data, $success, $failed));
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