<?php
function mp_get_user_form()
{
	if (!is_user_logged_in()) :
		?>
		<a href="/login" class="btn btn-light btn-sm mx-1" role="button">Login</a>
		<a href="/registration" class="btn btn-light btn-sm mx-1" role="button">Register</a>
		<?php
	else :
		?>
		<a href="<?php echo wp_logout_url( get_permalink() ); ?>" class="btn btn-light btn-sm mx-1" role="button">Logout</a>
		<a href="/profile" class="btn btn-light btn-sm mx-1" role="button">Profile</a>
		<?php
	endif;
}
