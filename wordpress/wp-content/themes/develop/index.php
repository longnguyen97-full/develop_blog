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
                            $categories = get_categories(['number' => 10, 'post_status' => 'publish']);
                            $categories_default = array_slice($categories, 0, 3);
                            $categories_more = array_slice($categories, 3);
                            ?>
                            <div class="section_tags ml-auto">
                                <ul>
                                    <li class="active"><a href="<?php echo site_url('category/all'); ?>">all</a></li>
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
                                    'numberposts' => 8,
                                    'post_status' => 'publish'
                                ];
                                $posts = get_posts($args);
                                foreach ($posts as $key => $post) :
                                    $post_link    = get_permalink($post->ID);
                                    $post_title   = $post->post_title;
                                    $post_author  = get_author_name($post->post_author);
                                    $post_date    = date('M d, Y \a\t g:i A', strtotime($post->post_date));
                                    $post_content = wp_trim_words($post->post_content, 11);
                                    $author_link  = get_author_posts_url($post->post_author);
                                    
                                    if ($key == 0) :
                                        $post_thumbnail = get_the_post_thumbnail_url($post->ID) ?: assets(true).'/images/post_1.jpg';
                                ?>
                                        <!-- Largest Card With Image -->
                                        <div class="card card_largest_with_image grid-item">
                                            <img class="card-img-top" src="<?php echo $post_thumbnail; ?>" alt="https://unsplash.com/@cjtagupa">
                                            <div class="card-body">
                                                <div class="card-title"><a href="<?php echo $post_link; ?>"><?php echo $post_title; ?></a></div>
                                                <p class="card-text"><?php echo $post_content; ?></p>
                                                <small class="post_meta"><a href="<?php echo $author_link; ?>"><?php echo $post_author; ?></a><span><?php echo $post_date; ?></span></small>
                                            </div>
                                        </div>

                                    <?php
                                    elseif ($key == 1) :
                                    ?>

                                        <!-- Small Card Without Image -->
                                        <div class="card card_default card_small_no_image grid-item">
                                            <div class="card-body">
                                                <div class="card-title card-title-small"><a href="<?php echo $post_link; ?>"><?php echo $post_title; ?></a></div>
                                                <small class="post_meta"><a href="<?php echo $author_link; ?>"><?php echo $post_author; ?></a><span><?php echo $post_date; ?></span></small>
                                            </div>
                                        </div>

                                    <?php
                                    elseif ($key == 2) :
                                        $post_thumbnail = get_the_post_thumbnail_url($post->ID) ?: assets(true).'/images/post_4.jpg';
                                    ?>
                                        <!-- Small Card With Background -->
                                        <div class="card card_default card_small_with_background grid-item">
                                            <div class="card_background" style="background-image:url(<?php echo $post_thumbnail; ?>)"></div>
                                            <div class="card-body">
                                                <div class="card-title card-title-small"><a href="<?php echo $post_link; ?>"><?php echo $post_title; ?></a></div>
                                                <small class="post_meta"><a href="<?php echo $author_link; ?>"><?php echo $post_author; ?></a><span><?php echo $post_date; ?></span></small>
                                            </div>
                                        </div>

                                    <?php
                                    elseif (in_array($key, [3, 4])) :
                                        $post_thumbnail = get_the_post_thumbnail_url($post->ID) ?: assets(true).'/images/post_2.jpg';
                                    ?>

                                        <!-- Small Card With Image -->
                                        <div class="card card_small_with_image grid-item">
                                            <img class="card-img-top" src="<?php echo $post_thumbnail; ?>" alt="https://unsplash.com/@jakobowens1">
                                            <div class="card-body">
                                                <div class="card-title card-title-small"><a href="<?php echo $post_link; ?>"><?php echo $post_title; ?></a></div>
                                                <small class="post_meta"><a href="<?php echo $author_link; ?>"><?php echo $post_author; ?></a><span><?php echo $post_date; ?></span></small>
                                            </div>
                                        </div>

                                    <?php
                                    elseif ($key > 4) :
                                    ?>

                                        <!-- Default Card No Image -->

                                        <div class="card card_default card_default_no_image grid-item">
                                            <div class="card-body">
                                                <div class="card-title card-title-small"><a href="<?php echo $post_link; ?>"><?php echo $post_title; ?></a></div>
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
                                    <li class="active"><a href="<?php echo site_url('category/all'); ?>">all</a></li>
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
                                    'numberposts' => 8,
                                    'post_status' => 'publish'
                                ];
                                $posts = get_posts($args);
                                foreach ($posts as $key => $post) :
                                    $post_link   = get_permalink($post->ID);
                                    $post_title  = $post->post_title;
                                    $post_author = get_author_name($post->post_author);
                                    $post_date   = date('M d, Y \a\t g:i A', strtotime($post->post_date));
                                    $author_link = get_author_posts_url($post->post_author);

                                    if ($key == 0) :
                                        $post_thumbnail = get_the_post_thumbnail_url($post->ID) ?: assets(true).'/images/post_8.jpg';
                                ?>
                                        <!-- Large Card With Background -->
                                        <div class="card card_large_with_background grid-item">
                                            <div class="card_background" style="background-image:url(<?php echo $post_thumbnail; ?>)"></div>
                                            <div class="card-body">
                                                <div class="card-title"><a href="<?php echo $post_link; ?>"><?php echo $post_title; ?></a></div>
                                                <small class="post_meta"><a href="<?php echo $author_link; ?>"><?php echo $post_author; ?></a><span><?php echo $post_date; ?></span></small>
                                            </div>
                                        </div>

                                    <?php
                                    elseif ($key == 1) :
                                        $post_thumbnail = get_the_post_thumbnail_url($post->ID) ?: assets(true).'/images/post_9.jpg';
                                    ?>
                                        <!-- Large Card With Image -->
                                        <div class="card grid-item card_large_with_image">
                                            <img class="card-img-top" src="<?php echo $post_thumbnail; ?>" alt="">
                                            <div class="card-body">
                                                <div class="card-title"><a href="<?php echo $post_link; ?>"><?php echo $post_title; ?></a></div>
                                                <p class="card-text"><?php echo $post_content; ?></p>
                                                <small class="post_meta"><a href="<?php echo $author_link; ?>"><?php echo $post_author; ?></a><span><?php echo $post_date; ?></span></small>
                                            </div>
                                        </div>

                                    <?php
                                    elseif ($key == 2) :
                                        $post_thumbnail = get_the_post_thumbnail_url($post->ID) ?: assets(true).'/images/post_5.jpg';
                                    ?>

                                        <!-- Default Card With Image -->
                                        <div class="card card_small_with_image grid-item">
                                            <img class="card-img-top" src="<?php echo $post_thumbnail; ?>" alt="">
                                            <div class="card-body">
                                                <div class="card-title card-title-small"><a href="<?php echo $post_link; ?>"><?php echo $post_title; ?></a></div>
                                                <small class="post_meta"><a href="<?php echo $author_link; ?>"><?php echo $post_author; ?></a><span><?php echo $post_date; ?></span></small>
                                            </div>
                                        </div>

                                    <?php
                                    elseif (in_array($key, [4, 6])) :
                                    ?>
                                        <!-- Default Card No Image -->
                                        <div class="card card_default card_default_no_image grid-item">
                                            <div class="card-body">
                                                <div class="card-title card-title-small"><a href="<?php echo $post_link; ?>"><?php echo $post_title; ?></a></div>
                                            </div>
                                        </div>

                                    <?php
                                    elseif (in_array($key, [3, 7])) :
                                        $post_thumbnail = get_the_post_thumbnail_url($post->ID) ?: assets(true).'/images/post_7.jpg';
                                    ?>

                                        <!-- Default Card With Background -->

                                        <div class="card card_default card_default_with_background grid-item">
                                            <div class="card_background" style="background-image:url(<?php echo $post_thumbnail; ?>)"></div>
                                            <div class="card-body">
                                                <div class="card-title card-title-small"><a href="<?php echo $post_link; ?>"><?php echo $post_title; ?></a></div>
                                            </div>
                                        </div>

                                <?php endif;
                                endforeach; ?>
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
                                    'numberposts' => 11,
                                    'post_status' => 'publish'
                                ];
                                $posts = get_posts($args);
                                foreach ($posts as $key => $post) :
                                    $post_link   = get_permalink($post->ID);
                                    $post_title  = $post->post_title;
                                    $post_author = get_author_name($post->post_author);
                                    $post_date   = date('M d, Y \a\t g:i A', strtotime($post->post_date));
                                    $author_link = get_author_posts_url($post->post_author);

                                    if (in_array($key, [0, 2, 3, 6])) :
                                        $post_thumbnail = get_the_post_thumbnail_url($post->ID) ?: assets(true).'/images/post_10.jpg';
                                ?>

                                        <!-- Small Card With Image -->
                                        <div class="card card_small_with_image grid-item">
                                            <img class="card-img-top" src="<?php echo $post_thumbnail; ?>" alt="">
                                            <div class="card-body">
                                                <div class="card-title card-title-small"><a href="<?php echo $post_link; ?>"><?php echo $post_title; ?></a></div>
                                                <small class="post_meta"><a href="<?php echo $author_link; ?>"><?php echo $post_author; ?></a><span><?php echo $post_date; ?></span></small>
                                            </div>
                                        </div>

                                    <?php
                                    elseif (in_array($key, [1, 7, 8])) :
                                    ?>
                                        <!-- Small Card Without Image -->
                                        <div class="card card_default card_small_no_image grid-item">
                                            <div class="card-body">
                                                <div class="card-title card-title-small"><a href="<?php echo $post_link; ?>"><?php echo $post_title; ?></a></div>
                                                <small class="post_meta"><a href="<?php echo $author_link; ?>"><?php echo $post_author; ?></a><span><?php echo $post_date; ?></span></small>
                                            </div>
                                        </div>
                                    <?php
                                    elseif (in_array($key, [4, 5])) :
                                        $post_thumbnail = get_the_post_thumbnail_url($post->ID) ?: assets(true).'/images/post_11.jpg';
                                    ?>
                                        <!-- Small Card With Background -->
                                        <div class="card card_default card_small_with_background grid-item">
                                            <div class="card_background" style="background-image:url(<?php echo $post_thumbnail; ?>)"></div>
                                            <div class="card-body">
                                                <div class="card-title card-title-small"><a href="<?php echo $post_link; ?>"><?php echo $post_title; ?></a></div>
                                                <small class="post_meta"><a href="<?php echo $author_link; ?>"><?php echo $post_author; ?></a><span><?php echo $post_date; ?></span></small>
                                            </div>
                                        </div>

                                    <?php
                                    elseif (in_array($key, [9, 10])) :
                                        $post_thumbnail = get_the_post_thumbnail_url($post->ID) ?: assets(true).'/images/post_12.jpg';
                                    ?>
                                        <!-- Default Card With Background -->
                                        <div class="card card_default card_default_with_background grid-item">
                                            <div class="card_background" style="background-image:url(<?php echo $post_thumbnail; ?>)"></div>
                                            <div class="card-body">
                                                <div class="card-title card-title-small"><a href="<?php echo $post_link; ?>"><?php echo $post_title; ?></a></div>
                                            </div>
                                        </div>
                                <?php endif;
                                endforeach; ?>

                            </div>

                        </div>
                    </div>

                </div>
                <br>
            </div>

            <!-- Sidebar -->

            <?php get_sidebar('right'); ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>