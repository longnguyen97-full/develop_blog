<?php get_header(); ?>

<!-- Home -->

<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="<?php assets(); ?>/images/post.jpg" data-speed="0.8"></div>
    <div class="home_content">
        <div class="post_category trans_200"><a href="category.html" class="trans_200"><?php echo get_the_category(get_the_ID())[0]->name; ?></a></div>
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
                        <?php $author_id = get_post_field('post_author', get_the_ID()); ?>
                        <div class="post_meta"><a href="#"><?php the_author_meta( 'user_nicename' , $author_id ); ?></a><span><?php echo get_the_date('F j, Y', get_the_ID()) . ' at ' . get_the_date('g:i a', get_the_ID()); ?></span></div>
                        <div class="post_share ml-sm-auto">
                            <span>share</span>
                            <ul class="post_share_list">
                                <li class="post_share_item"><a href="#"><i class="fa fa-facebook"
                                            aria-hidden="true"></i></a></li>
                                <li class="post_share_item"><a href="#"><i class="fa fa-twitter"
                                            aria-hidden="true"></i></a></li>
                                <li class="post_share_item"><a href="#"><i class="fa fa-google"
                                            aria-hidden="true"></i></a></li>
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
                                <li class="post_share_item"><a href="#"><i class="fa fa-facebook"
                                            aria-hidden="true"></i></a></li>
                                <li class="post_share_item"><a href="#"><i class="fa fa-twitter"
                                            aria-hidden="true"></i></a></li>
                                <li class="post_share_item"><a href="#"><i class="fa fa-google"
                                            aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Similar Posts -->
                    <div class="similar_posts">
                        <div class="grid clearfix">

                            <?php
                            $args = ['numberposts' => 3, 'category__in' => wp_get_post_categories(get_the_ID()), 'post__not_in' => array(get_the_ID())];
                            $related_posts = get_posts($args);
                            ?>

                            <?php foreach ($related_posts as $post) : ?>
                            <!-- Small Card With Image -->
                            <div class="card card_small_with_image grid-item">
                                <img class="card-img-top" src="<?php assets(); ?>/images/post_25.jpg"
                                    alt="https://unsplash.com/@jakobowens1">
                                <div class="card-body">
                                    <div class="card-title card-title-small"><a href="post.html"><?php $post->post_title; ?></a></div>
                                    <small class="post_meta"><a href="#"><?php the_author_meta( 'user_nicename' , $author_id ); ?></a><span><?php echo get_the_date('F j, Y', get_the_ID()) . ' at ' . get_the_date('g:i a', get_the_ID()); ?></span></small>
                                </div>
                            </div>
                            <?php endforeach; ?>

                        </div>

                        <!-- Post Comment -->
                        <div class="post_comment">
                            <div class="post_comment_title">Post Comment</div>
                            <div class="row">
                                <div class="col-xl-8">
                                    <div class="post_comment_form_container">
                                        <form action="#">
                                            <input type="text" class="comment_input comment_input_name"
                                                placeholder="Your Name" required="required">
                                            <input type="email" class="comment_input comment_input_email"
                                                placeholder="Your Email" required="required">
                                            <textarea class="comment_text" placeholder="Your Comment"
                                                required="required"></textarea>
                                            <button type="submit" class="comment_button">Post Comment</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Comments -->
                        <div class="comments">
                            <?php $comments = get_comments( ['post_id' => get_the_ID()] ); ?>
                            <div class="comments_title">Comments <span>(<?php echo count($comments); ?>)</span></div>
                            <div class="row">
                                <div class="col-xl-8">
                                    <div class="comments_container">
                                        <ul class="comment_list">
                                            <li class="comment">
                                                <div class="comment_body">
                                                    <div
                                                        class="comment_panel d-flex flex-row align-items-center justify-content-start">
                                                        <div class="comment_author_image">
                                                            <div><img src="<?php assets(); ?>/images/comment_author_1.jpg" alt=""></div>
                                                        </div>
                                                        <small class="post_meta"><a href="#">Katy Liu</a><span>Sep 29,
                                                                2017 at 9:48 am</span></small>
                                                        <button type="button"
                                                            class="reply_button ml-auto">Reply</button>
                                                    </div>
                                                    <div class="comment_content">
                                                        <p>Pick the yellow peach that looks like a sunset with its red,
                                                            orange, and pink coat skin, peel it off with your teeth.
                                                            Sink them into unripened.</p>
                                                    </div>
                                                </div>

                                                <!-- Reply -->
                                                <ul class="comment_list">
                                                    <li class="comment">
                                                        <div class="comment_body">
                                                            <div
                                                                class="comment_panel d-flex flex-row align-items-center justify-content-start">
                                                                <div class="comment_author_image">
                                                                    <div><img src="<?php assets(); ?>/images/comment_author_2.jpg" alt="">
                                                                    </div>
                                                                </div>
                                                                <small class="post_meta"><a href="#">Katy
                                                                        Liu</a><span>Sep 29, 2017 at 9:48
                                                                        am</span></small>
                                                                <button type="button"
                                                                    class="reply_button ml-auto">Reply</button>
                                                            </div>
                                                            <div class="comment_content">
                                                                <p>Nulla facilisi. Aenean porttitor quis tortor id
                                                                    tempus. Interdum et malesuada fames ac ante ipsum
                                                                    primis in faucibus. Vivamus molestie varius
                                                                    tincidunt. Vestibulum congue sed libero ac sodales.
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <!-- Reply -->
                                                        <ul class="comment_list">

                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <?php foreach ($comments as $comment) : ?>
                                            <li class="comment">
                                                <div class="comment_body">
                                                    <div
                                                        class="comment_panel d-flex flex-row align-items-center justify-content-start">
                                                        <div class="comment_author_image">
                                                            <div><img src="<?php assets(); ?>/images/comment_author_1.jpg" alt=""></div>
                                                        </div>
                                                        <small class="post_meta"><a href="#"><?php echo $comment->comment_author; ?></a><span><?php echo $comment->comment_date; ?></span></small>
                                                        <button type="button"
                                                            class="reply_button ml-auto">Reply</button>
                                                    </div>
                                                    <div class="comment_content">
                                                        <p><?php echo $comment->comment_content; ?></p>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php Loadmore::button(); ?>
            </div>

            <!-- Sidebar -->

            <?php get_sidebar('right'); ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>
