<?php
/**
 * Template Name: User Profile
 */
mp_prevent_user_non_logged_in();
get_header();

$user        = wp_get_current_user();
$nickname    = get_user_meta($user->ID, 'nickname', true);
$description = get_user_meta($user->ID, 'description', true);
$mysite      = get_userdata($user->ID)->user_url;
?>

<div class="container my-3">
	<form class="form-horizontal" method="POST" role="form">
		<div class="form-group">
			<label for="user_nickname">Nickname</label>
			<input type="text" class="form-control" name="user_nickname" id="user_nickname" value="<?php echo esc_html($nickname); ?>">
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

	<?php mp_user_profile_execute(); ?>
</div>

<?php get_footer();?>
