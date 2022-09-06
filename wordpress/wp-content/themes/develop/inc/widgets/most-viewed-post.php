<?php
// Register and load the widget
add_action( 'widgets_init', function() {
    register_widget( 'theme_widget_most_viewed_post' );
} );

class theme_widget_most_viewed_post extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'theme_widget_most_viewed_post',
            'Most viewed post',
            array( 'description' => 'Show most viewed posts as a list', )
        );
    }

    public function widget( $args, $instance )
    {
        $weekly_posts  = get_posts_view( '1 week ago' );
        $monthly_posts = get_posts_view( '1 month ago' );

        echo $args['before_widget'];
        ?>

        <div id="tabs">

            <ul class="nav nav-pills nav-fill">
                <li class="nav-item">
                    <a class="nav-link tabs-1 most-viewed-post active" data-tab="tabs-1" aria-current="page" href="#tabs-1">Weekly</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link tabs-2 most-viewed-post" data-tab="tabs-2" href="#tabs-2">Monthly</a>
                </li>
            </ul>

            <div id="tabs-1">
                <ol>
                    <?php foreach ( $weekly_posts as $post ) : ?>
                        <li><?php echo $post->post_title ?></li>
                    <?php endforeach; ?>
                </ol>
            </div>
            <div id="tabs-2">
                <ol>
                    <?php foreach ( $monthly_posts as $post ) : ?>
                        <li><?php echo $post->post_title ?></li>
                    <?php endforeach; ?>
                </ol>
            </div>

        </div>

        <?php
        echo $args['after_widget'];
    }

    public function form( $instance )
    {
        ?>
            <div class="mt-3">
                <a href="<?php echo site_url() ?>">Visit ranking post</a>
            </div>
        <?php

    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        return $instance;
    }
}
