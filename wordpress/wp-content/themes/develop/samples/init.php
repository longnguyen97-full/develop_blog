<?php
/**
 * Register Sample code
 */
function register_sample_code(){
	// Page Options
	require_once get_template_directory() . '/samples/admin-setting.php';
	require_once get_template_directory() . '/samples/admin-setting-child.php';
	// Register Post Type
	require_once get_template_directory() . '/samples/register-post-type.php';
	// Register Metaboxes
	require_once get_template_directory() . '/samples/admin-metaboxes-edit-template.php'; // Editor code for template page
	// Register Widgets
	require_once get_template_directory() . '/samples/admin-widget.php';
	// Pagination functions
	require_once get_template_directory() . '/samples/QNP_Pagination.php';
	// Change default feature in wordpress
	require_once get_template_directory() . '/samples/disable-feature.php';

}
add_action( 'after_setup_theme', 'register_sample_code' );
