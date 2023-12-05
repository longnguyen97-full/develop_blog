<?php
add_filter('body_class', function ($classes) {
    if ($classes[0] == 'search') {
        unset($classes[0]);
    }
    return $classes;
});

get_header(); ?>

<!-- Page Content -->

<div class="page_content">
    <div class="container">
        <div class="row row-lg-eq-height">

            <!-- Main Content -->

            <div class="col-lg-9 mb-5">
                <div class="main_content" style="margin-top: 100px">

                    <!-- Category -->

                    <div class="category">
                        <?php
                        $key = -1;
                        if (have_posts()) :
                            echo '<h1 class="page-title">';
                            printf(__('Search Results for: %s', 'themestandard'), '<span>' . get_search_query() . '</span>');
                            echo '</h1>';
                        ?>
                            <div class="section_content loadmore_hook">
                                <div class="grid clearfix">

                                    <?php
                                    while (have_posts()) :
                                        the_post();
                                        $key++;

                                        $post_id      = get_the_ID();
                                        $post_link    = get_permalink();
                                        $post_title   = get_the_title();
                                        $post_date    = date('M d, Y \a\t g:i A', strtotime(get_the_date()));
                                        $post_content = wp_trim_words(get_the_content(), 11);
                                        $post_author  = get_the_author_posts_link_outside_loop(the_post());

                                        if (in_array($key, [0, 2, 3, 6])) :
                                            $post_thumbnail = get_the_post_thumbnail_url($post_id) ?: assets(true) . '/images/post_10.jpg';
                                    ?>

                                            <!-- Small Card With Image -->
                                            <div class="card card_small_with_image grid-item">
                                                <img class="card-img-top" src="<?php echo $post_thumbnail; ?>" alt="">
                                                <div class="card-body">
                                                    <div class="card-title card-title-small"><a href="<?php echo $post_link; ?>"><?php echo $post_content; ?></a>
                                                    </div>
                                                    <small class="post_meta"><?php echo $post_author; ?><span><?php echo $post_date; ?></span></small>
                                                </div>
                                            </div>

                                        <?php
                                        elseif (in_array($key, [1, 7, 8])) :
                                        ?>
                                            <!-- Small Card Without Image -->
                                            <div class="card card_default card_small_no_image grid-item">
                                                <div class="card-body">
                                                    <div class="card-title card-title-small"><a href="<?php echo $post_link; ?>"><?php echo $post_content; ?></a>
                                                    </div>
                                                    <small class="post_meta"><?php echo $post_author; ?><span><?php echo $post_date; ?></span></small>
                                                </div>
                                            </div>
                                        <?php
                                        elseif (in_array($key, [4, 5])) :
                                            $post_thumbnail = get_the_post_thumbnail_url($post_id) ?: assets(true) . '/images/post_11.jpg';
                                        ?>
                                            <!-- Small Card With Background -->
                                            <div class="card card_default card_small_with_background grid-item">
                                                <div class="card_background" style="background-image:url(<?php echo $post_thumbnail; ?>)"></div>
                                                <div class="card-body">
                                                    <div class="card-title card-title-small"><a href="<?php echo $post_link; ?>"><?php echo $post_content; ?></a>
                                                    </div>
                                                    <small class="post_meta"><?php echo $post_author; ?><span><?php echo $post_date; ?></span></small>
                                                </div>
                                            </div>

                                        <?php
                                        elseif (in_array($key, [9, 10])) :
                                            $post_thumbnail = get_the_post_thumbnail_url($post_id) ?: assets(true) . '/images/post_12.jpg';
                                        ?>
                                            <!-- Default Card With Background -->
                                            <div class="card card_default card_default_with_background grid-item">
                                                <div class="card_background" style="background-image:url(<?php echo $post_thumbnail; ?>)"></div>
                                                <div class="card-body">
                                                    <div class="card-title card-title-small"><a href="<?php echo $post_link; ?>"><?php echo $post_content; ?></a></div>
                                                </div>
                                            </div>
                                    <?php endif;
                                    endwhile;
                                    wp_reset_postdata(); ?>

                                </div>
                            </div>
                        <?php

                        else :
                            echo '<h1>' . __('Nothing Found', 'themestandard') . '</h1>';

                            get_template_part('template-parts/content', 'none');

                        endif;
                        ?>
                    </div>

                </div>
                <?php
                global $wp_query;
                $total_posts = $wp_query->post_count;
                Loadmore::button($total_posts);
                ?>
            </div>

            <!-- Sidebar -->

            <?php get_sidebar('right'); ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>