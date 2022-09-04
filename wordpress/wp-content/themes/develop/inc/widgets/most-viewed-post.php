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
        $this->toggleTab();

        $weekly_posts  = get_posts_view( '1 week ago' );
        $monthly_posts = get_posts_view( '1 month ago' );

        echo $args['before_widget'];
        ?>

        <div id="tabs">

            <ul class="nav nav-pills nav-fill">
                <li class="nav-item">
                    <a class="nav-link tabs-1 active" data-tab="tabs-1" aria-current="page" href="#tabs-1">Weekly</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link tabs-2" data-tab="tabs-2" href="#tabs-2">Monthly</a>
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

    public function toggleTab()
    {
        ?>
        <script>
            $( function() {
                $( "#tabs" ).tabs();
                $( ".nav-link" ).click( function() {
                    // 1. get current tab that just is clicked
                    let tab = $( this );
                    let new_tab = tab.data( 'tab' );

                    // 2. toggle active state for 2 tabs
                    let old_tab = localStorage.getItem( 'old_tab' );
                    if ( old_tab !== new_tab ) {
                        let tabClass = localStorage.getItem( 'old_tab' );
                        $( "." + tabClass ).removeClass( 'active' );
                    }

                    // 3. save current tag to storage
                    localStorage.setItem( 'old_tab', new_tab );

                    // 4. active/deactive current tab
                    tab.hasClass( 'active' ) ? tab.removeClass( 'active' ) : tab.addClass( 'active' );
                } );
            } );
        </script>
        <?php
    }
}
