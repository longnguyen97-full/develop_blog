<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Theme_Standard
 * @since 1.0
 * @version 1.0
 */
?><!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> id="<?php do_action('cba_body_id') ?>">
<?php wp_body_open(); ?>
<div id="app">
    <?php get_template_part( 'template-parts/global', 'header' ); ?>
    <?php mp_hook_modals(); ?>
    <br><br>
