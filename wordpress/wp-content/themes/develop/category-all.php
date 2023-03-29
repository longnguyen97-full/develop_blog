<?php get_header(); ?>

<!-- Home -->

<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="<?php assets(); ?>/images/category.jpg" data-speed="0.8"></div>
</div>

<!-- Page Content -->

<div class="page_content">
    <div class="container">
        <div class="row row-lg-eq-height">

            <!-- Main Content -->

            <div class="col-lg-9 mb-5">
                <div class="main_content">

                    <!-- Category -->

                    <div class="category">
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
                        <div class="section_content loadmore_hook">
                            <div class="grid clearfix">

                                <?php
                                $args = [
                                    'numberposts' => 11,
                                    'post_status' => 'publish',
                                ];
                                $posts = get_posts($args);
                                foreach ($posts as $key => $post) :
                                    $post_link   = get_permalink($post->ID);
                                    $post_title  = $post->post_title;
                                    $post_date   = date('M d, Y \a\t g:i A', strtotime($post->post_date));
                                    $post_author = get_the_author_posts_link_outside_loop($post);

                                    if (in_array($key, [0, 2, 3, 6])) :
                                ?>

                                        <!-- Small Card With Image -->
                                        <div class="card card_small_with_image grid-item">
                                            <img class="card-img-top" src="<?php assets(); ?>/images/post_10.jpg" alt="">
                                            <div class="card-body">
                                                <div class="card-title card-title-small"><a href="<?php echo $post_link; ?>"><?php echo $post_title; ?></a></div>
                                                <small class="post_meta"><?php echo $post_author; ?><span><?php echo $post_date; ?></span></small>
                                            </div>
                                        </div>

                                    <?php
                                    elseif (in_array($key, [1, 7, 8])) :
                                    ?>
                                        <!-- Small Card Without Image -->
                                        <div class="card card_default card_small_no_image grid-item">
                                            <div class="card-body">
                                                <div class="card-title card-title-small"><a href="<?php echo $post_link; ?>"><?php echo $post_title; ?></a></div>
                                                <small class="post_meta"><?php echo $post_author; ?><span><?php echo $post_date; ?></span></small>
                                            </div>
                                        </div>
                                    <?php
                                    elseif (in_array($key, [4, 5])) :
                                    ?>
                                        <!-- Small Card With Background -->
                                        <div class="card card_default card_small_with_background grid-item">
                                            <div class="card_background" style="background-image:url(<?php assets(); ?>/images/post_11.jpg)"></div>
                                            <div class="card-body">
                                                <div class="card-title card-title-small"><a href="<?php echo $post_link; ?>"><?php echo $post_title; ?></a></div>
                                                <small class="post_meta"><?php echo $post_author; ?><span><?php echo $post_date; ?></span></small>
                                            </div>
                                        </div>

                                    <?php
                                    elseif (in_array($key, [9, 10])) :
                                    ?>
                                        <!-- Default Card With Background -->
                                        <div class="card card_default card_default_with_background grid-item">
                                            <div class="card_background" style="background-image:url(<?php assets(); ?>/images/post_12.jpg)"></div>
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
                <?php
                $total_posts = count(get_posts([
                    'numberposts' => -1,
                    'post_status' => 'publish',
                ]));
                Loadmore::button($total_posts);
                ?>
            </div>

            <!-- Sidebar -->

            <?php get_sidebar('right'); ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>