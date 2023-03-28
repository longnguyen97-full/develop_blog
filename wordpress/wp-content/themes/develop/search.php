<?php
add_filter('body_class', function ($classes) {
    if ($classes[0] == 'search') {
        unset($classes[0]);
    }
    return $classes;
});

get_header(); ?>

<!-- Home -->

<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="<?php assets(); ?>/images/category.jpg" data-speed="0.8"></div>
</div>

<!-- Page Content -->

<div class="page_content">
    <div class="container">
        <div class="row row-lg-eq-height">

            <div class="main_content my-3">
                <?php
                if (have_posts()) :
                    echo '<h1 class="page-title">';
                    printf(__('Search Results for: %s', 'themestandard'), '<span>' . get_search_query() . '</span>');
                    echo '</h1>';

                    while (have_posts()) :
                        the_post();

                        get_template_part('template-parts/content', get_post_format());

                        // count_loaded_posts();

                    endwhile;
                    wp_reset_postdata();

                    // the_loadmore();

                else :
                    echo '<h1>' . __('Nothing Found', 'themestandard') . '</h1>';

                    get_template_part('template-parts/content', 'none');

                endif;
                ?>
            </div>

        </div>
    </div>
</div>

<?php get_footer(); ?>