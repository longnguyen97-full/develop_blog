<?php
$args = [
    'numberposts' => 12
];
$posts = get_posts($args);
$sidebar_posts[] = array_slice($posts, 0, 4);
$sidebar_posts[] = array_slice($posts, 4, 4);
$sidebar_posts[] = array_slice($posts, 8, 4);

for ($i = 0; $i < 3; $i++) {
?>
    <!-- Top Stories Slider Item -->
    <div class="owl-item">

        <?php

        if (!empty($sidebar_posts[$i])) :
            foreach ($sidebar_posts[$i] as $post) :
                $post_id   = $post->ID;
                $author_id = get_post_field('post_author', $post_id);
                $post_thumbnail = get_the_post_thumbnail_url($post->ID, 'post-thumbnail-200') ?: assets(true) . '/images/top_1.jpg';
        ?>
                <!-- Sidebar Post -->
                <div class="side_post">
                    <a href="<?php echo get_permalink($post_id); ?>">
                        <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                            <div class="side_post_image">
                                <div><img src="<?php echo $post_thumbnail; ?>" alt="<?php echo $post->post_title; ?>"></div>
                            </div>
                            <div class="side_post_content">
                                <div class="side_post_title"><?php echo $post->post_title; ?></div>
                                <small class="post_meta"><?php the_author_meta('user_nicename', $author_id); ?><span><?php echo get_the_date('F j', $post_id); ?></span></small>
                            </div>
                        </div>
                    </a>
                </div>
        <?php endforeach;
        endif; ?>

    </div>
<?php
} ?>