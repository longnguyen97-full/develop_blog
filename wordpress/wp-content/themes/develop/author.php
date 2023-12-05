<?php get_header(); ?>

<!-- Home -->

<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="<?php assets(); ?>/images/category.jpg" data-speed="0.8"></div>
</div>

<!-- Page Content -->

<div class="page_content">
    <div class="container my-5 py-5">

        <div class="author-profile">
            <div class="row bg-light bg-gradient rounded py-2">
                <div class="col-2">
                    <?php echo get_avatar(get_the_author_meta('ID'), '', '', '', ['class' => ['rounded-circle', 'author-avatar']]); ?>
                </div>
                <div class="col-10">
                    <p>
                    <h2><?php the_author_meta('display_name'); ?> (<?php the_author_nickname(); ?>)</h2>
                    </p>
                    <p>
                    <h6>My site: <a href="<?php the_author_meta('user_url'); ?>"><?php the_author_meta('user_url'); ?></a></h6>
                    </p>
                    <p>
                    <h6>Biographic Info: <span class="text-dark"><?php the_author_meta('user_description'); ?></span></h6>
                    </p>
                    <p><?php echo get_the_author_posts() ?> posts published</p>
                    <p><?php echo get_the_author_comments() ?> comments written</p>
                    <p><?php echo get_the_author_liked_posts() ?> posts liked</p>
                </div>
            </div>
        </div>
        <hr>
        <div class="author-posts">
            <div class="main_content">

                <!-- Category -->

                <div class="category">
                    <div class="section_content loadmore_hook">
                        <div class="grid clearfix">

                            <?php
                            $key = 0;
                            if (have_posts()) :
                                while (have_posts()) : the_post();
                                    $key++;
                                    $post_id      = get_the_ID();
                                    $post_link    = get_permalink($post_id);
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
                                wp_reset_postdata();
                            else :

                                get_template_part('template-parts/content', 'none');

                            endif; ?>

                        </div>
                    </div>
                </div>

            </div>
            <?php
            global $wp_query;
            $total_posts = $wp_query->post_count;
            Loadmore::button($total_posts);
            ?>
        </div>

    </div>
</div>

<?php get_footer(); ?>