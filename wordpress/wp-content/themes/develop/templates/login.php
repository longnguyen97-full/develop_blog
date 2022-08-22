<?php
/**
 * Template Name: Login
 */
get_header();
?>

<div class="container my-3 mt-5">
	<h3>Login</h3>
	<form class="form-horizontal" method="POST" role="form">
		<div class="form-group">
			<label for="user_name">Username</label>
			<input type="text" class="form-control" name="user_name" id="user_name" placeholder="Type your username">
		</div>

		<div class="form-group">
			<label for="user_pass">Password</label>
			<input type="password" class="form-control" id="user_pass" placeholder="Type your password">
		</div>

		<button type="submit" name="profile_submit" id="profile_submit" class="btn btn-primary btn-sm">Login</button>
		<button type="button" class="btn btn-primary btn-sm" onclick="history.back()">Back</button>
	</form>

	<?php mp_user_profile_execute(); ?>
</div>

<?php get_footer(); ?>