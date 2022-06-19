<?php
function mp_get_user_buttons()
{
	if (!is_user_logged_in()) :
		?>
		<button type="button" class="btn btn-light btn-sm ml-2" data-toggle="modal" data-target="#loginModalCenter">Login</button>
		<button type="button" class="btn btn-light btn-sm ml-2" data-toggle="modal" data-target="#registerModalCenter">Register</button>
		<?php
	else :
		?>
		<a href="<?php echo wp_logout_url( get_permalink() ); ?>" class="btn btn-light btn-sm ml-2" role="button">Logout</a>
		<a href="/profile" class="btn btn-light btn-sm ml-2" role="button"><i class="fa-regular fa-user text-gray"></i></a>
		<?php
	endif;
}
