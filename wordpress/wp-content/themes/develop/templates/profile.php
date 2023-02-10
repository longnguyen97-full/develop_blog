<?php
/**
 * Template Name: User Profile
 * Main file: profile.php
 * Support file: /mypage/user-profile.php
 */
mp_prevent_user_non_logged_in();
get_header();

$user        = wp_get_current_user();
$user_id     = $user->ID;
$first_name  = get_user_meta($user_id, 'first_name', true);
$last_name   = get_user_meta($user_id, 'last_name', true);
$fullname    = trim($first_name . ' ' . $last_name);
$nickname    = get_user_meta($user_id, 'nickname', true);
$description = get_user_meta($user_id, 'description', true);
$mysite      = get_userdata($user_id)->user_url;
?>

<!-- Home -->

<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="<?php assets(); ?>/images/category.jpg" data-speed="0.8"></div>
</div>

<!-- Page Content -->

<div class="page_content">
    <div class="container">
        <div class="row row-lg-eq-height">

            <!-- Main Content -->

                <div class="main_content">

                    <!-- Form Profile -->

					<div class="container my-3 mt-5" style="z-index: 0">
						<h3>Edit Your Profile</h3>
						<form class="form-horizontal" method="POST" role="form">
							<div class="form-group row">
								<div class="col">
									<label for="user_fname">First Name</label>
									<input type="text" class="form-control" name="user_fname" id="user_fname" value="<?php echo esc_html($first_name); ?>">
								</div>
								<div class="col">
									<label for="user_lname">Last Name</label>
									<input type="text" class="form-control" name="user_lname" id="user_lname" value="<?php echo esc_html($last_name); ?>">
								</div>
							</div>

							<div class="form-group">
								<label for="user_nickname">Nickname</label>
								<input type="text" class="form-control" name="user_nickname" id="user_nickname" value="<?php echo esc_html($nickname); ?>">
							</div>

							<div class="form-group">
								<label for="user_displayname">Display Name</label>
								<select class="custom-select" name="user_displayname">
									<option value="user_displayname" selected><?php echo $user->display_name; ?></option>
									<?php if (!empty($fullname)) : ?>
									<option value="user_fullname"><?php echo esc_html($fullname); ?></option>
									<?php endif; ?>
									<?php if (!empty($nickname)) : ?>
									<option value="user_nickname"><?php echo esc_html($nickname); ?></option>
									<?php endif; ?>
								</select>
							</div>

							<div class="form-group">
								<label for="user_bio">Bio</label>
								<textarea class="form-control" name="user_bio" id="user_bio" rows="3"><?php echo $description; ?></textarea>
							</div>

							<div class="form-group">
								<label for="user_site">My Site</label>
								<input type="url" class="form-control" name="user_site" id="user_site" value="<?php echo esc_html($mysite); ?>" pattern="https://.*" size="30">
							</div>

							<button type="submit" name="profile_submit" id="profile_submit" class="btn btn-primary btn-sm">Save</button>
							<button type="button" class="btn btn-primary btn-sm" onclick="history.back()">Back</button>
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
