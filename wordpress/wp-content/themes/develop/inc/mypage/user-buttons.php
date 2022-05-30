<?php
function mp_get_login_button_modal()
{
	?>
	<!-- Button trigger modal -->
	<button type="button" class="btn btn-link btn-sm btn-disable-outline btn-fit-text" data-toggle="modal" data-target="#loginModalCenter">
		login
	</button>
	<style>
	.btn-disable-outline:focus {
		outline: none;
		box-shadow: none;
		text-decoration: none;
	}
	.btn-fit-text {
		position: relative;
		bottom: 2px;
		padding: 0.15rem 0.15rem;
	}
	</style>
	<?php
}

function mp_get_user_buttons()
{
	if (!is_user_logged_in()) :
		?>
		<a href="/login" class="btn btn-light btn-sm ml-2" role="button">Login</a>
		<a href="/registration" class="btn btn-light btn-sm ml-2" role="button">Register</a>
		<?php
	else :
		?>
		<a href="<?php echo wp_logout_url( get_permalink() ); ?>" class="btn btn-light btn-sm ml-2" role="button">Logout</a>
		<a href="/profile" class="btn btn-light btn-sm ml-2" role="button"><i class="fa-regular fa-user text-gray"></i></a>
		<?php
	endif;
}
