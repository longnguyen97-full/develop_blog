<?php
/**
 * Template Name: Bookmark
 */
mp_prevent_user_non_logged_in( 'login' );
get_header();

$the_query = get_data_from_table('post_id', 'bookmarks', array('user_id' => get_current_user_id()));
?>

<main class="app_container container-fluid">
    <div class="row">
        <div class="col col-md-2">
            <?php get_sidebar(); ?>
        </div>
        <div class="col col-md-8">
            <?php
            get_search_form();

            if ( !empty( $the_query ) && $the_query->have_posts() ) :

                while ( $the_query->have_posts() ) : $the_query->the_post();

                    get_template_part( 'template-parts/content' );

                    count_loaded_posts();

                endwhile;
                wp_reset_postdata();

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

<?php get_footer();?>
