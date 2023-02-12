<?php
function mp_user_profile_submit()
{
    if (!isset($_POST['profile_submit'])) {
        return false;
    }

    // setup data
    $data = array(
        'ID'           => wp_get_current_user()->ID ?? 0,
        'first_name'   => $_POST['first_name'] ?? '',
        'last_name'    => $_POST['last_name'] ?? '',
        'nickname'     => $_POST['nickname'] ?? '',
        'display_name' => $_POST['display_name'] ?? '',
        'description'  => $_POST['bio'] ?? '',
        'user_url'     => $_POST['mysite'] ?? '',
    );

    // sanitize data
    $data = map_deep($data, 'sanitize_text_field');

    // update data
    $update_id = wp_update_user($data);
    if (is_wp_error($update_id)) {
        $response['message'] = 'Updated failed. Please check again.';
        $response['alert']   = 'danger';
    } else {
        $response['message'] = 'Updated successfully.';
        $response['alert']   = 'success';
    }

    return $response;
}
