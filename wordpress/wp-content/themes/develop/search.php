<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Theme_Standard
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
<main class="app_container container">
    <div class="row">
        <div class="col col-md-8">
            <?php
            get_template_part( 'template-parts/global', 'breadcrumbs' );

            if ( have_posts() ) :
                echo '<h1 class="page-title">';
                printf( __( 'Search Results for: %s', 'themestandard' ), '<span>' . get_search_query() . '</span>' );
                echo '</h1>';

                while ( have_posts() ) :
                    the_post();

                    get_template_part( 'template-parts/content', get_post_format() );

                    count_loaded_posts();

                endwhile;
                wp_reset_postdata();

                the_loadmore();

            else :
                echo '<h1>' . __( 'Nothing Found', 'themestandard' ) . '</h1>';

                get_template_part( 'template-parts/content', 'none' );

            endif;
            ?>
        </div>
        <div class="col col-md-4">
            <?php get_sidebar(); ?>
        </div>
    </div>
</main>
<?php get_footer();
