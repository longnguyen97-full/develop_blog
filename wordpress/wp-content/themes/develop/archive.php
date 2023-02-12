<?php
/**
 * The template for displaying archive pages
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
            get_template_part( 'template-parts/global', 'breadcrumbs' );

            the_archive_title( '<h1 class="page-title">', '</h1>' );

            the_archive_description( '<div class="taxonomy-description">', '</div>' );

            if ( have_posts() ) :

                while ( have_posts() ) : the_post();

                    get_template_part( 'template-parts/content', get_post_format() );

                    count_loaded_posts();

                endwhile;
                wp_reset_postdata();

                the_loadmore();

            else :

                get_template_part( 'template-parts/content', 'none' );

            endif;
            ?>
        </div>
    </div>
</main>
<?php get_footer();
