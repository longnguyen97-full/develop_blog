<?php
function sf_load_scripts( $hook )
{
	wp_enqueue_style(TEXT_DOMAIN . '-searchform-theme', getAssets() . '/css/searchform.css', array(), wp_get_theme()->get('Version'));
	wp_enqueue_script(TEXT_DOMAIN . '-searchform-script', getAssets() . '/js/searchform.js', array('jquery'), wp_get_theme()->get('Version'), true);
}
add_action('wp_enqueue_scripts', 'sf_load_scripts');
