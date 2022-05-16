<?php
/**
 * Template Name: Full Width Template
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Theme_Standard
 * @since 1.0
 */

get_header();

echo '<main class="app_container container-fluid">';

get_template_part( 'template-parts/global', 'breadcrumbs' );

while ( have_posts() ) { the_post();
    get_template_part( 'template-parts/content', 'post');
}

echo '</main>';

get_footer();
