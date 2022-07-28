<?php
function mp_detect_errors()
{
	$params = array();
	if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
		$params = array(
			'login_status' => $_GET['login'] ?: '',
			'register_status' => $_POST['register_submit'] ?: '',
		);
	}

	return $params;
}

function mp_load_scripts( $hook )
{
	$params = mp_detect_errors();
	wp_enqueue_script(TEXT_DOMAIN . '-loginform-script', getAssets() . '/js/loginform.js', array('jquery'), wp_get_theme()->get('Version'), true);
	wp_add_inline_script(TEXT_DOMAIN . '-loginform-script', 'var params = ' . wp_json_encode( $params ), 'before');
}
add_action('wp_enqueue_scripts', 'mp_load_scripts');
