<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Theme_Standard
 * @since 1.0
 * @version 1.0
 */

$located = locate_template('template-pages/page-' . get_post_field( 'post_name') . '.php');

if ( !empty($located) ) {
    // Include the page content template.
    get_template_part( 'template-pages/page', get_post_field( 'post_name') );
} else {
    get_header();
    ?>
    <main class="app_container container">
        <div class="row">
            <div class="col col-md-12">
            <?php
            get_template_part( 'template-parts/global', 'breadcrumbs' );

            while ( have_posts() ) { the_post();
                get_template_part( 'template-parts/content', 'post');
            }
            ?>
            </div>
        </div>
    </main>
    <?php
    get_footer();
}
