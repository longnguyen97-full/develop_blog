<!-- Sidebar -->

<div class="col-lg-3">
    <div class="sidebar">
        <div class="sidebar_background"></div>

        <!-- Top Stories -->

        <div class="sidebar_section">
            <div class="sidebar_title_container">
                <div class="sidebar_title">Top Stories</div>
                <div class="sidebar_slider_nav">
                    <div class="custom_nav_container sidebar_slider_nav_container">
                        <div class="custom_prev custom_prev_top">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="7px"
                                height="12px" viewBox="0 0 7 12" enable-background="new 0 0 7 12"
                                xml:space="preserve">
                                <polyline fill="#bebebe"
                                    points="0,5.61 5.609,0 7,0 7,1.438 2.438,6 7,10.563 7,12 5.609,12 -0.002,6.39 " />
                            </svg>
                        </div>
                        <ul id="custom_dots" class="custom_dots custom_dots_top">
                            <li class="custom_dot custom_dot_top active"><span></span></li>
                            <li class="custom_dot custom_dot_top"><span></span></li>
                            <li class="custom_dot custom_dot_top"><span></span></li>
                        </ul>
                        <div class="custom_next custom_next_top">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="7px"
                                height="12px" viewBox="0 0 7 12" enable-background="new 0 0 7 12"
                                xml:space="preserve">
                                <polyline fill="#bebebe"
                                    points="6.998,6.39 1.389,12 -0.002,12 -0.002,10.562 4.561,6 -0.002,1.438 -0.002,0 1.389,0 7,5.61 " />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sidebar_section_content">

                <!-- Top Stories Slider -->
                <div class="sidebar_slider_container">
                    <div class="owl-carousel owl-theme sidebar_slider_top">

                        <!-- Top Stories Slider Item -->
                        <div class="owl-item">

                            <?php
                            $args = [
                                'numberposts' => 4
                            ];
                            $sidebar_posts = get_posts($args);
                            ?>

                            <?php foreach ($sidebar_posts as $post) : ?>
                            <?php
                            $post_id = $post->ID;
                            $author_id = get_post_field ('post_author', $post_id);
                            ?>
                            <!-- Sidebar Post -->
                            <div class="side_post">
                                <a href="<?php echo get_permalink( $post_id ); ?>">
                                    <div
                                        class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                                        <div class="side_post_image">
                                            <div><img src="<?php assets(); ?>/images/top_1.jpg" alt="">
                                            </div>
                                        </div>
                                        <div class="side_post_content">
                                            <div class="side_post_title"><?php echo $post->post_title; ?></div>
                                            <small class="post_meta"><?php the_author_meta( 'user_nicename', $author_id ); ?></a><span><?php echo get_the_date('F j', $post_id); ?></small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php endforeach; ?>

                        </div>

                        <!-- Top Stories Slider Item -->
                        <div class="owl-item">

                            <!-- Sidebar Post -->
                            <div class="side_post">
                                <a href="post.html">
                                    <div
                                        class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                                        <div class="side_post_image">
                                            <div><img src="<?php assets(); ?>/images/top_1.jpg" alt="">
                                            </div>
                                        </div>
                                        <div class="side_post_content">
                                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind
                                            </div>
                                            <small class="post_meta">Katy Liu<span>Sep 29</span></small>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <!-- Sidebar Post -->
                            <div class="side_post">
                                <a href="post.html">
                                    <div
                                        class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                                        <div class="side_post_image">
                                            <div><img src="<?php assets(); ?>/images/top_2.jpg" alt="">
                                            </div>
                                        </div>
                                        <div class="side_post_content">
                                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind
                                            </div>
                                            <small class="post_meta">Katy Liu<span>Sep 29</span></small>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <!-- Sidebar Post -->
                            <div class="side_post">
                                <a href="post.html">
                                    <div
                                        class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                                        <div class="side_post_image">
                                            <div><img src="<?php assets(); ?>/images/top_3.jpg" alt="">
                                            </div>
                                        </div>
                                        <div class="side_post_content">
                                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind
                                            </div>
                                            <small class="post_meta">Katy Liu<span>Sep 29</span></small>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <!-- Sidebar Post -->
                            <div class="side_post">
                                <a href="post.html">
                                    <div
                                        class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                                        <div class="side_post_image">
                                            <div><img src="<?php assets(); ?>/images/top_4.jpg" alt="">
                                            </div>
                                        </div>
                                        <div class="side_post_content">
                                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind
                                            </div>
                                            <small class="post_meta">Katy Liu<span>Sep 29</span></small>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        </div>

                        <!-- Top Stories Slider Item -->
                        <div class="owl-item">

                            <!-- Sidebar Post -->
                            <div class="side_post">
                                <a href="post.html">
                                    <div
                                        class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                                        <div class="side_post_image">
                                            <div><img src="<?php assets(); ?>/images/top_1.jpg" alt="">
                                            </div>
                                        </div>
                                        <div class="side_post_content">
                                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind
                                            </div>
                                            <small class="post_meta">Katy Liu<span>Sep 29</span></small>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <!-- Sidebar Post -->
                            <div class="side_post">
                                <a href="post.html">
                                    <div
                                        class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                                        <div class="side_post_image">
                                            <div><img src="<?php assets(); ?>/images/top_2.jpg" alt="">
                                            </div>
                                        </div>
                                        <div class="side_post_content">
                                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind
                                            </div>
                                            <small class="post_meta">Katy Liu<span>Sep 29</span></small>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <!-- Sidebar Post -->
                            <div class="side_post">
                                <a href="post.html">
                                    <div
                                        class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                                        <div class="side_post_image">
                                            <div><img src="<?php assets(); ?>/images/top_3.jpg" alt="">
                                            </div>
                                        </div>
                                        <div class="side_post_content">
                                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind
                                            </div>
                                            <small class="post_meta">Katy Liu<span>Sep 29</span></small>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <!-- Sidebar Post -->
                            <div class="side_post">
                                <a href="post.html">
                                    <div
                                        class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                                        <div class="side_post_image">
                                            <div><img src="<?php assets(); ?>/images/top_4.jpg" alt="">
                                            </div>
                                        </div>
                                        <div class="side_post_content">
                                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind
                                            </div>
                                            <small class="post_meta">Katy Liu<span>Sep 29</span></small>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Ranking List -->
        <?php
        $daily_posts   = CountPostView::getViewsByDate('day');
        $weekly_posts  = CountPostView::getViewsByDate('week');
        $monthly_posts = CountPostView::getViewsByDate('month');
        ?>

        <div class="sidebar_section future_events">
            <div class="sidebar_title_container">
                <div class="sidebar_title">Ranking List</div>
                <div id="tabs">
                    <ul class="nav nav-pills nav-fill">
                    <li class="nav-item">
                            <a class="nav-link tabs-1 most-viewed-post active" data-tab="tabs-1" aria-current="page">Daily</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link tabs-2 most-viewed-post" data-tab="tabs-2">Weekly</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link tabs-3 most-viewed-post" data-tab="tabs-3">Monthly</a>
                        </li>
                    </ul>
                    <div id="tabs-1" class="tabs-item active">
                        <?php foreach ( $daily_posts as $post ) : ?>
                            <div><a href="<?php echo get_permalink($post->ID); ?>"><?php echo mb_strimwidth($post->post_title, 0, 35, "..."); ?></a></div>
                        <?php endforeach; ?>
                    </div>
                    <div id="tabs-2" class="tabs-item">
                        <?php foreach ( $weekly_posts as $post ) : ?>
                            <div><a href="<?php echo get_permalink($post->ID); ?>"><?php echo mb_strimwidth($post->post_title, 0, 35, "..."); ?></a></div>
                        <?php endforeach; ?>
                    </div>
                    <div id="tabs-3" class="tabs-item">
                        <?php foreach ( $monthly_posts as $post ) : ?>
                            <div><a href="<?php echo get_permalink($post->ID); ?>"><?php echo mb_strimwidth($post->post_title, 0, 35, "..."); ?></a></div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <style>
            #tabs a.nav-link {
                cursor: pointer;
            }
            .tabs-item {
                display: none;
            }
            .tabs-item ol {
                list-style-type: none;
                padding: 0;
                margin: 0;
            }
            .active {
                display: inline-block;
            }
        </style>
        <script>
        jQuery( document ).ready(function($) {
            $('#tabs a.nav-link').click(function(e) {
                // toggle tab button
                $('#tabs a.nav-link').removeClass('active');
                $(this).addClass('active');
                // hide all tabs-item
                $('.tabs-item').removeClass('active');
                // extract tab-item id from tab button
                let tabItemId = $(this).attr('class').split(/\s+/)[1];
                // show tab-item of current tab button
                $(`#${tabItemId}`).addClass('active');
            });
        });
        </script>

    </div>
</div>