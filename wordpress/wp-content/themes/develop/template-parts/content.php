<article class="mb-3" id="post-<?php the_ID(); ?>">
    <div class="row">
        <div class="col-3 pl-5">
            <a href="<?php the_permalink() ?>">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('post-thumbnail', ['class' => 'img-fluid']) ?>
                <?php else : ?>
                    <img src="https://phuquang.mimup.net/assets/admin/media/photos/photo21.jpg" alt="" width="240" height="150">
                <?php endif; ?>
            </a>
        </div>
        <div class="col-9">
            <h5><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
            <div>
                <?php echo wp_trim_words(get_the_content(), 11); ?>
            </div>
            <div>
                <ul class="d-flex p-2">
                    <?php
                    // Author
                    if (post_type_supports(get_post_type(), 'author')) {
                    ?>
                        <li class="mr-2">
                            <?php
                            printf(
                                /* translators: %s: Author name. */
                                __('By %s', 'themestandard'),
                                '<a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author_meta('display_name')) . '</a>'
                            );
                            ?>
                        </li>
                    <?php
                    }
                    ?>
                    <li>
                        <span>posted </span>
                        <a href="<?php the_permalink(); ?>"><?php the_time(get_option('date_format')); ?></a>
                    </li>
                    <?php
                    // Sticky
                    if (is_sticky()) {
                    ?>
                        <li><?php _e('Sticky post', 'themestandard'); ?></li>
                    <?php
                    }
                    // Comments link
                    if (!post_password_required() && (comments_open() || get_comments_number())) {
                    ?>
                        <li>, <?php comments_popup_link(); ?></li>
                    <?php
                    }

                    edit_post_link(__('Edit', 'themestandard'), '<li>, ', '</li>');
                    ?>
                </ul>
            </div>
        </div>
    </div>
</article><!-- .post -->