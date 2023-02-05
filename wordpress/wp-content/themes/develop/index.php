<?php get_header(); ?>

<!-- Home -->

<div class="home">
    <?php get_template_part('template-parts/home', 'slider'); ?>
</div>

<!-- Page Content -->

<div class="page_content">
    <div class="container">
        <div class="row row-lg-eq-height">

            <!-- Main Content -->

            <div class="col-lg-9">
                <div class="main_content">

                    <!-- Blog Section - Don't Miss -->

                    <div class="blog_section">
                        <div class="section_panel d-flex flex-row align-items-center justify-content-start">
                            <div class="section_title">Don't Miss</div>
                            <?php
                            $categories = get_categories(['number' => 10]);
                            $categories_default = array_slice($categories, 0, 3);
                            $categories_more = array_slice($categories, 3);
                            ?>
                            <div class="section_tags ml-auto">
                                <ul>
                                    <li class="active"><a href="">all</a></li>
                                    <?php foreach ($categories_default as $category) : ?>
                                        <li><a href="<?php echo get_category_link($category); ?>"><?php echo $category->name; ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="section_panel_more">
                                <ul>
                                    <li>more
                                        <ul>
                                            <?php foreach ($categories_more as $category) : ?>
                                                <li><a href="<?php echo get_category_link($category); ?>"><?php echo $category->name; ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="section_content">
                            <div class="grid clearfix">

                                <?php
                                $args = [
                                'numberposts' => 8
                                ];
                                $posts = get_posts($args);
                                ?>

                                <?php foreach ($posts as $key => $post) :
                                    if ($key == 0) :
                                        ?>
                                <!-- Largest Card With Image -->
                                <div class="card card_largest_with_image grid-item">
                                    <img class="card-img-top" src="<?php assets(); ?>/images/post_1.jpg"
                                        alt="https://unsplash.com/@cjtagupa">
                                    <div class="card-body">
                                        <div class="card-title"><a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo $post->post_title; ?></a></div>
                                        <p class="card-text">Pick the yellow peach that looks like a sunset with its
                                            red, orange, and pink coat skin, peel it off with your teeth. Sink them into
                                            unripened...</p>
                                        <small class="post_meta"><a href="#">Katy Liu</a><span>Sep 29, 2017 at 9:48
                                                am</span></small>
                                    </div>
                                </div>

                                        <?php
                                    elseif ($key == 1) :
                                        ?>

                                <!-- Small Card Without Image -->
                                <div class="card card_default card_small_no_image grid-item">
                                    <div class="card-body">
                                        <div class="card-title card-title-small"><a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo $post->post_title; ?></a>
                                        </div>
                                        <small class="post_meta"><a href="#">Katy Liu</a><span>Sep 29, 2017 at 9:48
                                                am</span></small>
                                    </div>
                                </div>

                                        <?php
                                    elseif ($key == 2) :
                                        ?>
                                <!-- Small Card With Background -->
                                <div class="card card_default card_small_with_background grid-item">
                                    <div class="card_background"
                                        style="background-image:url(<?php assets(); ?>/images/post_4.jpg)"></div>
                                    <div class="card-body">
                                        <div class="card-title card-title-small"><a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo $post->post_title; ?></a>
                                        </div>
                                        <small class="post_meta"><a href="#">Katy Liu</a><span>Sep 29, 2017 at 9:48
                                                am</span></small>
                                    </div>
                                </div>

                                        <?php
                                    elseif (in_array($key, [3, 4])) :
                                        ?>

                                <!-- Small Card With Image -->
                                <div class="card card_small_with_image grid-item">
                                    <img class="card-img-top" src="<?php assets(); ?>/images/post_2.jpg"
                                        alt="https://unsplash.com/@jakobowens1">
                                    <div class="card-body">
                                        <div class="card-title card-title-small"><a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo $post->post_title; ?></a>
                                        </div>
                                        <small class="post_meta"><a href="#">Katy Liu</a><span>Sep 29, 2017 at 9:48
                                                am</span></small>
                                    </div>
                                </div>

                                        <?php
                                    elseif ($key > 4) :
                                        ?>

                                <!-- Default Card No Image -->

                                <div class="card card_default card_default_no_image grid-item">
                                    <div class="card-body">
                                        <div class="card-title card-title-small"><a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo $post->post_title; ?></a></div>
                                    </div>
                                </div>

                                    <?php endif;
                                endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Blog Section - What's Trending -->

                    <div class="blog_section">
                        <div class="section_panel d-flex flex-row align-items-center justify-content-start">
                            <div class="section_title">What's Trending</div>
                            <div class="section_tags ml-auto">
                                <ul>
                                    <li class="<?php echo $class; ?>"><a href="category.html">all</a></li>
                                    <?php foreach ($categories_default as $category) : ?>
                                    <li><a
                                            href="<?php echo get_category_link($category); ?>"><?php echo $category->name; ?></a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="section_panel_more">
                                <ul>
                                    <li>more
                                        <ul>
                                            <?php foreach ($categories_more as $category) : ?>
                                            <li><a
                                                    href="<?php echo get_category_link($category); ?>"><?php echo $category->name; ?></a>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="section_content">
                            <div class="grid clearfix">

                                <?php
                                $args = [
                                'numberposts' => 8
                                ];
                                $posts = get_posts($args);
                                ?>

                                <?php foreach ($posts as $key => $post) :
                                    if ($key == 0) :
                                        ?>
                                <!-- Large Card With Background -->
                                <div class="card card_large_with_background grid-item">
                                    <div class="card_background"
                                        style="background-image:url(<?php assets(); ?>/images/post_8.jpg)"></div>
                                    <div class="card-body">
                                        <div class="card-title"><a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo $post->post_title; ?></a></div>
                                        <small class="post_meta"><a href="#">Katy Liu</a><span>Sep 29, 2017 at 9:48
                                                am</span></small>
                                    </div>
                                </div>

                                        <?php
                                    elseif ($key == 1) :
                                        ?>
                                <!-- Large Card With Image -->
                                <div class="card grid-item card_large_with_image">
                                    <img class="card-img-top" src="<?php assets(); ?>/images/post_9.jpg" alt="">
                                    <div class="card-body">
                                        <div class="card-title"><a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo $post->post_title; ?></a></div>
                                        <p class="card-text">Pick the yellow peach that looks like a sunset with its
                                            red, orange, and pink coat skin, peel it off with your teeth. Sink them into
                                            unripened...</p>
                                        <small class="post_meta"><a href="#">Katy Liu</a><span>Sep 29, 2017 at 9:48
                                                am</span></small>
                                    </div>
                                </div>

                                        <?php
                                    elseif ($key == 2) :
                                        ?>


                                <!-- Default Card With Image -->
                                <div class="card card_small_with_image grid-item">
                                    <img class="card-img-top" src="<?php assets(); ?>/images/post_5.jpg" alt="">
                                    <div class="card-body">
                                        <div class="card-title card-title-small"><a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo $post->post_title; ?></a>
                                        </div>
                                        <small class="post_meta"><a href="#">Katy Liu</a><span>Sep 29, 2017 at 9:48
                                                am</span></small>
                                    </div>
                                </div>


                                        <?php
                                    elseif (in_array($key, [4, 6])) :
                                        ?>
                                <!-- Default Card No Image -->
                                <div class="card card_default card_default_no_image grid-item">
                                    <div class="card-body">
                                        <div class="card-title card-title-small"><a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo $post->post_title; ?></a></div>
                                    </div>
                                </div>

                                        <?php
                                    elseif (in_array($key, [3, 7])) :
                                        ?>



                                <!-- Default Card With Background -->

                                <div class="card card_default card_default_with_background grid-item">
                                    <div class="card_background"
                                        style="background-image:url(<?php assets(); ?>/images/post_7.jpg)"></div>
                                    <div class="card-body">
                                        <div class="card-title card-title-small"><a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo $post->post_title; ?></a></div>
                                    </div>
                                </div>

                                    <?php endif;
                                endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Blog Section - Videos -->

                    <div class="blog_section">
                        <div class="section_panel d-flex flex-row align-items-center justify-content-start">
                            <div class="section_title">Most Popular Videos</div>
                        </div>
                        <div class="section_content">
                            <div class="row">
                                <div class="col">
                                    <div class="videos">
                                        <div class="player_container">
                                            <div id="P1" class="player"
                                                data-property="{videoURL:'2ScS5kwm7nI',containment:'self',startAt:0,mute:false,autoPlay:false,loop:false,opacity:1}">
                                            </div>
                                        </div>
                                        <div class="playlist">
                                            <div class="playlist_background"></div>

                                            <!-- Video -->
                                            <div class="video_container video_command active"
                                                onclick="jQuery('#P1').YTPChangeVideo({videoURL: '2ScS5kwm7nI', mute:false, addRaster:true})">
                                                <div
                                                    class="video d-flex flex-row align-items-center justify-content-start">
                                                    <div class="video_image">
                                                        <div><img src="<?php assets(); ?>/images/video_1.jpg" alt="">
                                                        </div><img class="play_img"
                                                            src="<?php assets(); ?>/images/play.png" alt="">
                                                    </div>
                                                    <div class="video_content">
                                                        <div class="video_title">How Did van Gogh’s Turbulent Mind</div>
                                                        <div class="video_info"><span>1.2M views</span><span>Sep
                                                                29</span></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Video -->
                                            <div class="video_container video_command"
                                                onclick="jQuery('#P1').YTPChangeVideo({videoURL: 'BzMLA8YIgG0', mute:false, addRaster:true})">
                                                <div
                                                    class="video d-flex flex-row align-items-center justify-content-start">
                                                    <div class="video_image">
                                                        <div><img src="<?php assets(); ?>/images/video_2.jpg" alt="">
                                                        </div><img class="play_img"
                                                            src="<?php assets(); ?>/images/play.png" alt="">
                                                    </div>
                                                    <div class="video_content">
                                                        <div class="video_title">How Did van Gogh’s Turbulent Mind</div>
                                                        <div class="video_info"><span>1.2M views</span><span>Sep
                                                                29</span></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Video -->
                                            <div class="video_container video_command"
                                                onclick="jQuery('#P1').YTPChangeVideo({videoURL: 'bpbcSdqvtUQ', mute:false, addRaster:true})">
                                                <div
                                                    class="video d-flex flex-row align-items-center justify-content-start">
                                                    <div class="video_image">
                                                        <div><img src="<?php assets(); ?>/images/video_3.jpg" alt="">
                                                        </div><img class="play_img"
                                                            src="<?php assets(); ?>/images/play.png" alt="">
                                                    </div>
                                                    <div class="video_content">
                                                        <div class="video_title">How Did van Gogh’s Turbulent Mind</div>
                                                        <div class="video_info"><span>1.2M views</span><span>Sep
                                                                29</span></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Video -->
                                            <div class="video_container video_command"
                                                onclick="jQuery('#P1').YTPChangeVideo({videoURL: 'UjYemgbhJF0', mute:false, addRaster:true})">
                                                <div
                                                    class="video d-flex flex-row align-items-center justify-content-start">
                                                    <div class="video_image">
                                                        <div><img src="<?php assets(); ?>/images/video_4.jpg" alt="">
                                                        </div><img class="play_img"
                                                            src="<?php assets(); ?>/images/play.png" alt="">
                                                    </div>
                                                    <div class="video_content">
                                                        <div class="video_title">How Did van Gogh’s Turbulent Mind</div>
                                                        <div class="video_info"><span>1.2M views</span><span>Sep
                                                                29</span></div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Blog Section - Latest -->

                    <div class="blog_section">
                        <div class="section_panel d-flex flex-row align-items-center justify-content-start">
                            <div class="section_title">Latest Articles</div>
                        </div>
                        <div class="section_content">
                            <div class="grid clearfix">

                                <?php
                                $args = [
                                'numberposts' => 11
                                ];
                                $posts = get_posts($args);
                                ?>

                                <?php foreach ($posts as $key => $post) :
                                    if (in_array($key, [0, 2, 3, 6])) :
                                        ?>

                                <!-- Small Card With Image -->
                                <div class="card card_small_with_image grid-item">
                                    <img class="card-img-top" src="<?php assets(); ?>/images/post_10.jpg" alt="">
                                    <div class="card-body">
                                        <div class="card-title card-title-small"><a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo $post->post_title; ?></a>
                                        </div>
                                        <small class="post_meta"><a href="#">Katy Liu</a><span>Sep 29, 2017 at 9:48
                                                am</span></small>
                                    </div>
                                </div>


                                        <?php
                                    elseif (in_array($key, [1, 7, 8])) :
                                        ?>
                                <!-- Small Card Without Image -->
                                <div class="card card_default card_small_no_image grid-item">
                                    <div class="card-body">
                                        <div class="card-title card-title-small"><a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo $post->post_title; ?></a>
                                        </div>
                                        <small class="post_meta"><a href="#">Katy Liu</a><span>Sep 29, 2017 at 9:48
                                                am</span></small>
                                    </div>
                                </div>
                                        <?php
                                    elseif (in_array($key, [4, 5])) :
                                        ?>
                                <!-- Small Card With Background -->
                                <div class="card card_default card_small_with_background grid-item">
                                    <div class="card_background"
                                        style="background-image:url(<?php assets(); ?>/images/post_11.jpg)"></div>
                                    <div class="card-body">
                                        <div class="card-title card-title-small"><a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo $post->post_title; ?></a>
                                        </div>
                                        <small class="post_meta"><a href="#">Katy Liu</a><span>Sep 29, 2017 at 9:48
                                                am</span></small>
                                    </div>
                                </div>

                                        <?php
                                    elseif (in_array($key, [9, 10])) :
                                        ?>
                                <!-- Default Card With Background -->
                                <div class="card card_default card_default_with_background grid-item">
                                    <div class="card_background"
                                        style="background-image:url(<?php assets(); ?>/images/post_12.jpg)"></div>
                                    <div class="card-body">
                                        <div class="card-title card-title-small"><a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo $post->post_title; ?></a></div>
                                    </div>
                                </div>
                                    <?php endif;
                                endforeach; ?>

                            </div>

                        </div>
                    </div>

                </div>
                <div class="load_more">
                    <div id="load_more" class="load_more_button text-center trans_200">Load More</div>
                </div>
            </div>

            <!-- Sidebar -->

            <?php get_sidebar('right'); ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>
