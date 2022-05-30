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
			<h6 class="card-subtitle mb-2 text-muted"><?php echo get_user_meta($user_id, 'nickname', true); ?></h6>
			<p class="card-text"><?php echo nl2br(get_the_author_meta('description')); ?></p>
			<p class="card-text"><a href="mailto: <?php echo get_userdata($user_id)->user_email; ?>?subject = Contact Me&body = Message" class="card-link"><?php echo get_userdata($user_id)->user_email; ?></a></p>
			<p class="card-text"><a href="<?php echo get_userdata($user_id)->user_url; ?>" class="card-link" target="blank">My site</a></p>
		</div>
	</div>
	<?php
}

function mp_get_template_login_out()
{
    ?>
	<div class="card">
		<div class="card-body">
			You need to <?php mp_get_login_button(); ?> to view this content.
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
    $data = !empty($data) ? mp_user_profile_process($data) : array();
}

function user_profile_request()
{
    $data['user_nickname'] = isset($_POST['user_nickname']) ? $_POST['user_nickname'] : '';
    $data['user_bio']      = isset($_POST['user_bio']) ? $_POST['user_bio'] : '';
    $data['user_mail']     = isset($_POST['user_mail']) ? $_POST['user_mail'] : '';
    $data['user_site']     = isset($_POST['user_site']) ? $_POST['user_site'] : '';

    return $data;
}

function mp_user_profile_validate($data)
{
    extract($data);

    $user_data = array(
        'nickname'    => $user_nickname,
        'description' => $user_bio,
        'user_email'  => $user_mail,
        'user_url'    => $user_site,
    );

    mp_update_user_profile($user_data);

    return $data;
}
