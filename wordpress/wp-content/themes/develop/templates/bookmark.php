<?php

/**
 * Template Name: Bookmark
 */
if (!is_user_logged_in()) {
    return;
}
get_header();

$the_query = get_data_from_table('post_id', 'bookmarks', array('user_id' => get_current_user_id())); ?>

<!-- Home -->

<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="<?php assets(); ?>/images/category.jpg" data-speed="0.8"></div>
</div>

<!-- Page Content -->

<div class="page_content">
    <div class="container my-5 py-5">
        <div class="row row-lg-eq-height">

            <?php
            if (!empty($the_query) && $the_query->have_posts()) :

                while ($the_query->have_posts()) : $the_query->the_post();

                    get_template_part('template-parts/content');

                    count_loaded_posts();

                endwhile;
                wp_reset_postdata();

            else :

                get_template_part('template-parts/content', 'none');

            endif;
            ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>