<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Theme_Standard
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
<main class="app_container container-fluid">
    <div class="row">
        <div class="col col-md-2">
            <?php get_sidebar(); ?>
        </div>
        <div class="col col-md-8">
            <?php
            get_search_form();

            if ( have_posts() ) :

                while ( have_posts() ) : the_post();

                    get_template_part( 'template-parts/content' );

                endwhile;
                wp_reset_postdata();

                the_bootstrap_paginate_links();
                the_loadmore();

            else :

                get_template_part( 'template-parts/content', 'none' );

            endif;
            ?>
        </div>
        <div class="col col-md-2">
            <?php mp_get_template_user(); ?>
        </div>
    </div>
</main>
<?php get_footer();
