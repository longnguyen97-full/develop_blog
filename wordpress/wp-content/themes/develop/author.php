<?php get_header(); ?>

<!-- Home -->

<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="<?php assets(); ?>/images/category.jpg" data-speed="0.8"></div>
</div>

<!-- Page Content -->

<div class="page_content">
    <div class="container">

        <div class="author-profile">
            <div class="row">
                <div class="col-3">
                    <img src="<?php echo get_image('user-avatar.jpg') ?>" alt="author-avatar" class="author-avatar" width="250" height="250">
                </div>
                <div class="col-9">
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
            <?php
            if (have_posts()) :

                while (have_posts()) : the_post();

                    get_template_part('template-parts/content', get_post_format());

                // count_loaded_posts();

                endwhile;
                wp_reset_postdata();

            // the_loadmore();

            else :

                get_template_part('template-parts/content', 'none');

            endif;
            ?>
        </div>

    </div>
</div>

<?php get_footer(); ?>