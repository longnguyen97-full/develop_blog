<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Theme_Standard
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
<main class="app_container container mb-5">
<?php get_template_part( 'template-parts/global', 'breadcrumbs' ); ?>
    <div class="row">
        <div class="col col-md-4">
            <div class="number404">404</div>
        </div>
        <div class="col col-md-8">
            <h1><?php _e( 'Oops! That page can&rsquo;t be found.', 'themestandard' ); ?></h1>
            <p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'themestandard' ); ?> </p>
            <?php get_search_form(); ?>
        </div>
    </div>
</main>
<?php get_footer();
