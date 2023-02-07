<!-- Home Slider -->

<div class="home_slider_container">
    <div class="owl-carousel owl-theme home_slider">

        <?php
        $args = [
            'numberposts' => 3
        ];
        $posts = get_posts($args);

        $post_url = get_permalink( $post->ID );
        $category = get_the_category($post->ID)[0];
        ?>

        <?php foreach ($posts as $post) : ?>
            <div class="owl-item">
                <div class="home_slider_background" style="background-image:url(<?php assets(); ?>/images/home_slider.jpg)"></div>
                <div class="home_slider_content_container">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="home_slider_content">
                                    <div class="home_slider_item_category trans_200"><a href="<?php echo get_category_link($category->term_id); ?>"
                                            class="trans_200"><?php echo $category->name; ?></a></div>
                                    <div class="home_slider_item_title">
                                        <a href="<?php echo $post_url; ?>"><?php echo $post->post_title; ?></a>
                                    </div>
                                    <div class="home_slider_item_link">
                                        <a href="<?php echo $post_url; ?>" class="trans_200">Continue Reading
                                            <svg version="1.1" id="link_arrow_1"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                width="19px" height="13px" viewBox="0 0 19 13"
                                                enable-background="new 0 0 19 13" xml:space="preserve">
                                                <polygon fill="#FFFFFF"
                                                    points="12.475,0 11.061,0 17.081,6.021 0,6.021 0,7.021 17.038,7.021 11.06,13 12.474,13 18.974,6.5 " />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Similar Posts -->
                <div class="similar_posts_container">
                    <div class="container">
                        <div class="row d-flex flex-row align-items-end">

                            <?php
                            $args = ['numberposts' => 3, 'category__in' => wp_get_post_categories($post->ID), 'post__not_in' => array($post->ID)];
                            $related_posts = get_posts($args);
                            ?>

                            <?php foreach ($related_posts as $post) : ?>
                            <!-- Similar Post -->
                            <div class="col-lg-3 col-md-6 similar_post_col">
                                <div class="similar_post trans_200">
                                    <a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo $post->post_title; ?></a>
                                </div>
                            </div>
                            <?php endforeach; ?>

                        </div>
                    </div>

                    <div class="home_slider_next_container">
                        <div class="home_slider_next" style="background-image:url(<?php assets(); ?>/images/home_slider_next.jpg)">
                            <div class="home_slider_next_background trans_400"></div>
                            <div class="home_slider_next_content trans_400">
                                <div class="home_slider_next_title">next</div>
                                <div class="home_slider_next_link">How Did van Gogh’s Turbulent Mind Depict One
                                    of the Most Complex Concepts in Physics?</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>

    </div>

    <div class="custom_nav_container home_slider_nav_container">
        <div class="custom_prev custom_prev_home_slider">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                x="0px" y="0px" width="7px" height="12px" viewBox="0 0 7 12"
                enable-background="new 0 0 7 12" xml:space="preserve">
                <polyline fill="#FFFFFF"
                    points="0,5.61 5.609,0 7,0 7,1.438 2.438,6 7,10.563 7,12 5.609,12 -0.002,6.39 " />
            </svg>
        </div>
        <ul id="custom_dots" class="custom_dots custom_dots_home_slider">
            <li class="custom_dot custom_dot_home_slider active"><span></span></li>
            <li class="custom_dot custom_dot_home_slider"><span></span></li>
            <li class="custom_dot custom_dot_home_slider"><span></span></li>
        </ul>
        <div class="custom_next custom_next_home_slider">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                x="0px" y="0px" width="7px" height="12px" viewBox="0 0 7 12"
                enable-background="new 0 0 7 12" xml:space="preserve">
                <polyline fill="#FFFFFF"
                    points="6.998,6.39 1.389,12 -0.002,12 -0.002,10.562 4.561,6 -0.002,1.438 -0.002,0 1.389,0 7,5.61 " />
            </svg>
        </div>
    </div>

</div>