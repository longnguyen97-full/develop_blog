<?php
// Register and load the widget
add_action( 'widgets_init', function() {
    register_widget( 'theme_widget_list_category' );
} );

class theme_widget_list_category extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'theme_widget_list_category',
            'List category',
            array( 'description' => 'Show category as an list', )
        );
    }

    public function widget( $args, $instance )
    {
        echo $args['before_widget'];

        $categories = get_categories( array(
            'orderby' => 'name',
            'order'   => 'ASC',
            'number' => $instance['limit']
        ) );

        foreach( $categories as $category ) {
            echo '<ul><li><a href="' . get_category_link( $category->term_id ) . '">' . esc_html( $category->name ) . ' (' . $category->category_count . ')' . '</a></li></ul>';
        }

        echo $args['after_widget'];
    }

    public function form( $instance )
    {
        $limit      = isset($instance['limit']) ? $instance['limit'] : 10;
        $limit      = $this->range($limit);
        $limit_id   = $this->get_field_id('limit');
        $limit_name = $this->get_field_name('limit');

        echo "<input type='number' id='{$limit_id}' name='{$limit_name}' value='{$limit}' min='1', max='99' placeholder='How many category will be display? Type an expected number...'>";
        echo "<h5 class='text-danger'>Min 1 | Max 99</h5>";
    }

    function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['limit'] = $new_instance['limit'];

        return $instance;
    }

    function range($value)
    {
        if ( $value < 1 ) {
            return 1;
        }

        if ( $value > 99 ) {
            return 99;
        }
    }
}
