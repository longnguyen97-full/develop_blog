<article <?php post_class('article mb-3'); ?> id="post-<?php the_ID(); ?>">
    <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('post-thumbnail',['class' => 'img-fluid']) ?></a>
    <div class="article-content">
        <h5 class="article-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
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
        <div class="article-text">
            <?php the_excerpt(); ?>
            <a href="<?php the_permalink(); ?>"><?php _e('Continue reading', 'themestandard'); ?></a>
        </div>
    </div>
</article><!-- .post -->
