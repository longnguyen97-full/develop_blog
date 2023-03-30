<?php get_header();
$post_id = get_the_ID();
?>

<!-- Home -->

<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="<?php assets(); ?>/images/post.jpg" data-speed="0.8"></div>
    <div class="home_content">
        <div class="post_category trans_200"><a href="category.html" class="trans_200"><?php echo get_the_category($post_id)[0]->name; ?></a></div>
        <div class="post_title"><?php the_title(); ?></div>
    </div>
</div>


<!-- Page Content -->

<div class="page_content">
    <div class="container">
        <div class="row row-lg-eq-height">

            <!-- Post Content -->

            <div class="col-lg-9">
                <div class="post_content">

                    <!-- Top Panel -->
                    <div class="post_panel post_panel_top d-flex flex-row align-items-center justify-content-start">
                        <div class="author_image">
                            <div><img src="<?php assets(); ?>/images/author.jpg" alt=""></div>
                        </div>
                        <?php $author_id = get_post_field('post_author', $post_id); ?>
                        <div class="post_meta"><a href="#"><?php the_author_meta('user_nicename', $author_id); ?></a><span><?php echo get_the_date('F j, Y', $post_id) . ' at ' . get_the_date('g:i a', $post_id); ?></span></div>
                        <div class="post_share ml-sm-auto">
                            <span>share</span>
                            <ul class="post_share_list">
                                <li class="post_share_item"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li class="post_share_item"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li class="post_share_item"><a href="#"><i class="fa fa-google" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Post Body -->

                    <div class="post_body">
                        <?php the_content(); ?>
                    </div>

                    <!-- Bottom Panel -->
                    <div class="post_panel bottom_panel d-flex flex-row align-items-center justify-content-start">
                        <div class="author_image">
                            <div><img src="<?php assets(); ?>/images/author.jpg" alt=""></div>
                        </div>
                        <div class="post_meta"><a href="#">Katy Liu</a><span>Sep 29, 2017 at 9:48 am</span></div>
                        <div class="post_share ml-sm-auto">
                            <span>share</span>
                            <ul class="post_share_list">
                                <li class="post_share_item"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li class="post_share_item"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li class="post_share_item"><a href="#"><i class="fa fa-google" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Similar Posts -->
                    <div class="similar_posts">
                        <div class="grid clearfix">

                            <?php
                            $args = ['numberposts' => 3, 'category__in' => wp_get_post_categories($post_id), 'post__not_in' => array($post_id)];
                            $related_posts = get_posts($args);
                            ?>

                            <?php foreach ($related_posts as $post) : ?>
                                <!-- Small Card With Image -->
                                <div class="card card_small_with_image grid-item">
                                    <img class="card-img-top" src="<?php assets(); ?>/images/post_25.jpg" alt="https://unsplash.com/@jakobowens1">
                                    <div class="card-body">
                                        <div class="card-title card-title-small"><a href="post.html"><?php $post->post_title; ?></a></div>
                                        <small class="post_meta"><a href="#"><?php the_author_meta('user_nicename', $author_id); ?></a><span><?php echo get_the_date('F j, Y', $post_id) . ' at ' . get_the_date('g:i a', $post_id); ?></span></small>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        </div>

                        <!-- Post Comment -->
                        <?php Comment::form($post_id); ?>

                        <!-- Comments -->
                        <?php Comment::list($post_id); ?>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->

            <?php get_sidebar('right'); ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>