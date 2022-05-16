<?php
// Register and load the widget
add_action( 'widgets_init', function() {
    register_widget( 'theme_widget_article_by_category' );
} );

class theme_widget_article_by_category extends WP_Widget
{
    function __construct() {
        parent::__construct(
            'theme_widget_article_by_category',
            'Article by category',
            array( 'description' => 'Danh sách bài viết theo danh mục', )
        );
    }

    public function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', $instance['title'] );
        $type = $instance['type'] ?? 'style1';
        if ($type == 'slider') {
            $type = 'slick_slider style4';
        }
        $cat = $instance['cat'] ?? 0;
        $per_page = $instance['per_page'] ?? 4;

        // before and after widget arguments are defined by themes
        echo $before_widget;
        if ( ! empty( $title ) ) {
            echo $before_title . $title . $after_title;
        }

        $args = array(
            'paged' => 1,
            'posts_per_page' => $per_page,
            'ignore_sticky_posts' => true,
        );
        if ((int)$cat > 0) {
            $args['cat'] = $cat;
        }
        $query = new WP_Query($args);
        if ($query->have_posts()) :
        ?>
        <div class="widget-content <?php echo $type ?>">
            <?php while ($query->have_posts()) : $query->the_post(); ?>
            <div class="media">
                <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                    <?php the_post_thumbnail('post-thumbnail',['class' => 'img-fluid mr-3']) ?>
                </a>
                <div class="media-body">
                    <div class="title">
                        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </div>
                    <span class="meta section-meta"><?php the_time( get_option( 'date_format' ) ); ?></span>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <?php
        wp_reset_query(); wp_reset_postdata(); unset($query);
        endif;
        echo $after_widget;
    }

    public function form( $instance ) {
        $title      = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
        $title_id   = $this->get_field_id('title');
        $title_name = $this->get_field_name('title');
        $type      = isset($instance['type']) ? $instance[ 'type' ] : 'style1';
        $type_id   = $this->get_field_id('type');
        $type_name = $this->get_field_name('type');
        $title_name = $this->get_field_name('title');
        $per_page      = isset($instance['per_page']) ? $instance[ 'per_page' ] : 4;
        $per_page_id   = $this->get_field_id('per_page');
        $per_page_name = $this->get_field_name('per_page');
        $title_name = $this->get_field_name('title');
        $cat      = isset($instance['cat']) ? $instance[ 'cat' ] : 4;
        $cat_id   = $this->get_field_id('cat');
        $cat_name = $this->get_field_name('cat');

        $this->field(__( 'Title:' ), $title_id, $title_name, $title, ['type' => 'text']);
        // $this->field(__( 'Danh mục:' ), $cat_id, $cat_name, $cat, ['type' => 'select', 'options' => ['style1'=>'Kiểu 1','style2'=>'Kiểu 2','style3'=>'Kiểu 3','style4'=>'Kiểu 4', 'slider'=>'Kiểu slide']]);

        echo '<p>';
        echo "<label for=\"{$cat_id}\">".__( 'Danh mục:' )."</label>";
        $dropdown_args = array(
            'taxonomy'          => 'category',
            'id'                => $cat_id,
            'name'              => $cat_name,
            'class'             => 'widefat',
            'selected'          => $cat,
            'show_option_none'  => 'Select category',
            'show_count'        => 1,
            'hierarchical'      => true,
            'echo'              => 1,
            'hide_if_empty'     => false,
            'hide_empty'        => 0,
            'required'          => false,
        );
        wp_dropdown_categories( $dropdown_args );
        echo '</p>';

        $this->field(__( 'Kiểu hiển thị:' ), $type_id, $type_name, $type, ['type' => 'select', 'options' => ['style1'=>'Kiểu 1','style2'=>'Kiểu 2','style3'=>'Kiểu 3','style4'=>'Kiểu 4', 'slider'=>'Kiểu slide']]);
        $this->field(__( 'Số bài viết hiển thị:' ), $per_page_id, $per_page_name, $per_page, ['type' => 'number', 'min' => 1, 'max' => 30]);
    }

    function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

        $instance['type'] = $new_instance['type'];
        $instance['per_page'] = $new_instance['per_page'];
        $instance['cat'] = $new_instance['cat'];

        return $instance;
    }

    function field($title, $id, $name, $value, $args)
    {
        $type = $args['type'] ?? 'text';
        echo '<p>';
        echo "<label for=\"{$id}\">{$title}</label>";
        switch ($type) {
            case 'text':
                echo "<input id=\"{$id}\" name=\"{$name}\" class=\"widefat\" type=\"text\" value=\"{$value}\">";
                break;
            case 'number':
                $min = $args['min'] ?? 0;
                $max = $args['max'] ?? 999;
                echo "<input id=\"{$id}\" name=\"{$name}\" class=\"tiny-text\" type=\"number\" step=\"1\" min=\"{$min}\" max=\"{$max}\" value=\"{$value}\">";
                break;
            case 'select':
                echo "<select id=\"{$id}\" name=\"{$name}\" class=\"widefat\">";
                $options = $args['options'] ?? [];
                foreach ($options as $val => $text) {
                    echo "<option value=\"{$val}\" ".($value == $val ? 'selected' : '').">{$text}</option>";
                }
                echo "</select>";
                break;

            default:
                # code...
                break;
        }
        echo '</p>';
    }
}
