<?php if ( post_type_supports( get_post_type(), 'author' ) ) : ?>
<div class="widget entry-author">
    <h3 class="widget-title"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>">ABOUT THE AUTHOR</a></h3>
    <div class="widget-content clearfix">
        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>" class="avatar-thumb">
        <img src="<?php echo get_avatar_url(get_the_author_meta( 'ID' )) ?>" alt="<?php echo esc_html( get_the_author_meta( 'display_name' ) ) ?>">
        </a>
        <h5 class="author-name"><?php echo esc_html( get_the_author_meta( 'display_name' ) ) ?></h5>
        <p><?php echo nl2br(get_the_author_meta('description')); ?></p>
        <?php if ($url = get_the_author_meta( 'url')) {
            echo '<p>Website: <a href="'.$url.'">'.$url.'</a></p>';
        }
        ?>
    </div>
</div>
<?php endif; ?>
