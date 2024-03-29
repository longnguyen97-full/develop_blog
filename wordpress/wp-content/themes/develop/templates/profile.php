<?php

/**
 * Template Name: User Profile
 * Main file: profile.php
 * Support file: /mypage/user-profile.php
 */
if (!is_user_logged_in()) {
    redirect_404();
}
get_header();

$user         = wp_get_current_user();
$user_id      = $user->ID;
$first_name   = $_POST['first_name'] ?? get_user_meta($user_id, 'first_name', true);
$last_name    = $_POST['last_name'] ?? get_user_meta($user_id, 'last_name', true);
$fullname     = trim($first_name . ' ' . $last_name);
$nickname     = $_POST['nickname'] ?? get_user_meta($user_id, 'nickname', true);
$display_name = $_POST['display_name'] ?? $user->display_name;
$bio          = $_POST['bio'] ?? get_user_meta($user_id, 'description', true);
$mysite       = $_POST['mysite'] ?? get_userdata($user_id)->user_url;

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
?>

<!-- Page Content -->

<div class="page_content">
    <div class="container">
        <div class="row row-lg-eq-height">

            <!-- Main Content -->

            <div class="main_content">

                <!-- Form Profile -->

                <div class="profile_form_container">
                    <h3>Edit Your Profile</h3>
                    <form class="form-horizontal" method="POST" role="form">
                        <div class="form-group row">
                            <div class="col">
                                <label for="first_name">First Name: </label>
                                <input type="text" class="profile_input profile_input_name" name="first_name" id="first_name" value="<?php echo esc_html($first_name); ?>">
                            </div>
                            <div class="col">
                                <label for="last_name">Last Name: </label>
                                <input type="text" class="profile_input profile_input_name" name="last_name" id="last_name" value="<?php echo esc_html($last_name); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nickname">Nickname: </label>
                            <input type="text" class="profile_input" name="nickname" id="nickname" value="<?php echo esc_html($nickname); ?>">
                        </div>

                        <div class="form-group">
                            <label for="display_name">Display Name: </label>
                            <select class="custom-select" name="display_name">
                                <option value="display_name" selected><?php echo $display_name; ?></option>
                                <?php if (!empty($fullname)) : ?>
                                    <option value="<?php echo esc_html($fullname); ?>"><?php echo esc_html($fullname); ?></option>
                                <?php endif; ?>
                                <?php if (!empty($nickname)) : ?>
                                    <option value="<?php echo esc_html($nickname); ?>"><?php echo esc_html($nickname); ?></option>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="bio">Bio: </label>
                            <textarea class="contact_text" name="bio" id="bio" rows="3"><?php echo $bio; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="mysite">My Site: </label>
                            <input type="url" class="profile_input profile_input_email" name="mysite" id="mysite" value="<?php echo esc_html($mysite); ?>" pattern="https?://.+" size="30">
                        </div>

                        <button type="submit" name="profile_submit" id="profile_submit" class="profile_button">Save</button>
                    </form>

                    <?php
                    $response = mp_user_profile_submit();
                    if (!empty($response)) : ?>
                        <div id="result" class="alert alert-<?php echo $response['alert']; ?> mt-3" role="alert">
                            <ul style="margin-bottom: 0px; padding: 0px;">
                                <span class='text-<?php echo $response['alert']; ?>'>
                                    <?php echo $response['message']; ?>
                                </span>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>

            </div>

        </div>
    </div>
</div>

<?php get_footer(); ?>