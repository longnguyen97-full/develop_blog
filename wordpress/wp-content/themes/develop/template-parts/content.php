<article <?php post_class('article mb-3'); ?> id="post-<?php the_ID(); ?>">
    <div class="article-content article-row">
        <div class="article-column article-left text-center text-justify">
            <a href="<?php the_permalink() ?>">
                <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail('post-thumbnail',['class' => 'img-fluid']) ?>
                <?php else: ?>
                    <img src="https://phuquang.mimup.net/assets/admin/media/photos/photo21.jpg" alt="" width="240" height="150">
                <?php endif; ?>
            </a>
        </div>
        <div class="article-column article-right">
            <h5 class="article-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
            <div class="article-text">
                <?php the_excerpt(); ?>
            </div>
            <div class="entry-meta">
                <ul>
                <?php
                // Author
                if ( post_type_supports( get_post_type(), 'author' ) ) {
                ?>
                    <li class="post-author">
                        <?php
                        printf(
                            /* translators: %s: Author name. */
                            __( 'By %s', 'themestandard' ),
                            '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author_meta( 'display_name' ) ) . '</a>'
                        );
                        ?>
                    </li>
                <?php
                }
                ?>
                    <li class="post-date">
                        <span>posted </span>
                        <a href="<?php the_permalink(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a>
                    </li>
                <?php
                // Sticky
                if ( is_sticky() ) {
                    ?>
                    <li class="post-sticky"><?php _e( 'Sticky post', 'themestandard' ); ?></li>
                    <?php
                }
                // Comments link
                if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
                    ?>
                    <li class="post-comment-link">, <?php comments_popup_link(); ?></li>
                    <?php
                }

                edit_post_link(__( 'Edit', 'themestandard' ), '<li>, ', '</li>');
                ?>
                </ul>
            </div>
        </div>
    </div>
</article><!-- .post -->
