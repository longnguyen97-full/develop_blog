<?php
mp_detect_errors();
function mp_detect_errors()
{
	$login_status = $_GET['login'] ?: '';
	if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()):
	?>
	<input type="text" id="login_status" value="<?php echo $login_status; ?>">
	<?php

	$register_status = $_POST['register_submit'] ?: '';
	?>
	<input type="text" id="register_status" value="<?php echo $register_status; ?>">
	<?php
	endif;
}

function mp_load_scripts( $hook )
{
	wp_enqueue_script(TEXT_DOMAIN . '-loginform-script', getAssets() . '/js/loginform.js', array('jquery'), wp_get_theme()->get('Version'), true);
}
add_action('wp_enqueue_scripts', 'mp_load_scripts');
