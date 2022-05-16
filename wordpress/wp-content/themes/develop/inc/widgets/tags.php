<?php
// Register and load the widget
add_action( 'widgets_init', function() {
    register_widget( 'theme_widget_tags' );
} );

class theme_widget_tags extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'theme_widget_tags',
            'Tags',
            array( 'description'  => 'Display a list of all tags', )
        );
    }

    // Front page
    public function widget( $args, $instance )
    {
        $this->setTags( $this->getTags() );
        $this->viewList( true );
    }

    // Back page
    public function form( $instance )
    {
        $this->setTags( $this->getTags() );
        $this->viewList();
    }

    public function getTags()
    {
        return get_tags(array(
            'hide_empty' => false
        ));
    }

    public function setTags($tags = array())
    {
        $this->tags = $tags;
    }

    public function viewList($is_front = false)
    {
        $tags = $this->tags;
        if (!empty($tags)) : ?>
            <ul>
                <?php foreach ($tags as $tag) : ?>
                    <?php if ($is_front === true) : ?>
                        <li><a href="<?php echo get_tag_link($tag); ?>"><?php echo $tag->name; ?></a></li>
                    <?php else : ?>
                        <li><a href="<?php echo get_tag_link($tag); ?>" target="_blank" rel="noreferrer noopener"><?php echo $tag->name; ?></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        <?php endif;
    }
}
