<?php
function mp_get_template_user()
{
    if (is_admin()) {
        return;
    }

    return is_user_logged_in() ? mp_get_template_profile() : '';
    // not related to profile page
}

/* function mp_get_template_profile()
{
    $user_id = wp_get_current_user()->ID;

    $disable_1 = is_page( 'liked-posts' ) ? 'disabled' : '';
    $disable_2 = is_page( 'bookmark' ) ? 'disabled' : '';
    ?>
	<div class="card">
		<div class="card-body">
			<h6 class="card-subtitle mb-3 text-muted"><?php echo get_user_meta($user_id, 'nickname', true); ?></h6>
			<p class="card-text"><?php echo nl2br(get_the_author_meta('description', $user_id)); ?></p>
			<p class="card-text">Website: <a href="<?php echo get_userdata($user_id)->user_url; ?>" class="card-link" target="blank"><?php echo get_userdata($user_id)->user_url; ?></a></p>
            <a href="/liked-posts/" class="btn btn-primary <?php echo $disable_1 ?>" role="button" aria-disabled="true">Liked Posts</a>
            <a href="/bookmark/" class="btn btn-primary <?php echo $disable_2 ?>" role="button" aria-disabled="true">Bookmark</a>
		</div>
	</div>
	<?php
} */

function mp_user_profile_submit()
{
    if (!isset($_POST['profile_submit'])) {
        return false;
    }

    // setup data
    $user_nickname = isset($_POST['user_nickname']) ? $_POST['user_nickname'] : '';
    $user_bio      = isset($_POST['user_bio'])      ? $_POST['user_bio']      : '';
    $user_site     = isset($_POST['user_site'])     ? $_POST['user_site']     : '';

    // validate data
    $user_id = wp_get_current_user()->ID;
    $user_data = array(
        'ID'          => $user_id,
        'nickname'    => $user_nickname,
        'description' => $user_bio,
        'user_url'    => $user_site,
    );

    arr_dump($user_data);
    // exit();

    // update data
    $update_id = wp_update_user($user_data);
    if (is_wp_error($update_id)) {
        $response['message'] = 'Updated failed. Please check again.';
        $response['alert'] = 'danger';
    } else {
        $response['message'] = 'Updated successfully.';
        $response['alert'] = 'success';
    }

    return $response;

    // foreach ($user_data as $meta_key => $meta_value) {
    //     $update_id = wp_update_user(['ID' => $user_id, $meta_key => $meta_value]);

    //     // response
    //     $response['alert'] = 'success';
    //     if (is_wp_error($update_id) == true) {
    //         $response['data'][$meta_key]['alert']   = 'danger';
    //         $response['data'][$meta_key]['message'] = 'Updated '.mp_user_profile_get_field_name($meta_key).' failed. Please check again.';
    //         $response['alert']                      = 'danger';
    //     } else {
    //         $response['data'][$meta_key]['alert']   = 'success';
    //         $response['data'][$meta_key]['message'] = 'Updated '.mp_user_profile_get_field_name($meta_key).' successfully.';
    //     }
    // }
}

function mp_user_profile_get_field_name($key)
{
    $field_names = [
        'nickname' => 'Nickname',
        'description' => 'Bio',
        'user_url' => 'My Site',
    ];
    return $field_names[$key];
}

// function mp_user_profile_throw_except()
// {
//     try {
//         $error = new WP_Error( 'update-profile-error', 'Update profile is failed. Please check again.' );
//         if (is_wp_error( $error )) {
//             $error_code = $error->get_error_code();
//             throw new Exception( $error_code );
//         }
//     } catch ( Exception $e) {
//         // $e will hold the error object.
//     }
// }

/* function user_profile_request()
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
} */

// function mp_update_user_profile($user_data = array())
// {
//     if (empty($user_data)) {
//         return;
//     }

//     // Prepare data
//     extract($user_data);
//     $user_id = wp_get_current_user()->ID;
//     $message = '';

//     $data = array(
//         'nickname'    => $nickname,
//         'description' => $description,
//         'user_url'    => $user_url,
//     );

//     // Update data
//     foreach ($data as $key => $value) {
//         $updated = update_user_meta($user_id, $key, $value);

//         if ($updated === false) {
//             $failed .= '<li>Your ' . mp_key_to_field($key) . ' can\'t update.</li>';
//         } else {
//             $success .= '<li>Your ' . mp_key_to_field($key) . ' is updated.</li>';
//         }
//     }

//     if (!empty($success)) {
//         $message .= mp_multi_success_form($success);
//     }

//     if (!empty($failed)) {
//         $message .= mp_multi_failed_form($failed);
//     }

//     // Free up memory
//     array_map('mp_freeup_memory', array($user_id, $message, $data, $success, $failed));
// }

/* function mp_update_user($user_id = 0, $user_key = '', $user_value = '')
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
} */
