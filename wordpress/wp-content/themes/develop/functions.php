<?php
/**
 * Theme standard functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Theme_Standard
 * @since 1.0
 * @version 1.0
 */

define('TEXT_DOMAIN', 'themestandard');
define('HOME_URL', esc_url(home_url()));
define('THEME_URL', esc_url(get_template_directory_uri()));
define('THEME_ASSETS', THEME_URL . '/assets');

/**
 * Include common
 */
require get_parent_theme_file_path( '/inc/init.php' );
