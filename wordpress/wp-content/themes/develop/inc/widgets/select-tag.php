<?php
// Register and load the widget
add_action( 'widgets_init', function() {
    register_widget( 'theme_widget_select_tag' );
} );

class theme_widget_select_tag extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'theme_widget_select_tag',
            'Select tag',
            array( 'description' => 'Show selected tag as an block', )
        );
    }

    public function widget( $args, $instance )
    {
        echo $args['before_widget'];

        $tag = get_tag( $instance['tag'] );
        $tag_link = get_tag_link( $tag->term_id );
        $args = array(
            'posts_per_page' => 10,
            'tax_query' => array(
                array(
                    'taxonomy' => 'post_tag',
                    'field'    => 'slug',
                    'terms'    => $tag->slug
                )
            )
        );
        $the_query = new WP_Query( $args );

        $this->excerptLength( 15 );

        echo "<div class='border bg-light rounded-top mt-3 pb-3 px-3'>";
            echo "<h3 class='mt-3'><a href='{$tag_link}'>#{$tag->name}</a></h3>";

            if ( $the_query->have_posts() ) :
                while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

                    <div class="card mt-3">
                        <article class="card-body">
                            <h6><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h6>
                            <p><?php the_excerpt() ?></p>
                        </article>
                    </div>

                <?php wp_reset_postdata();
                endwhile;
            endif;
        echo "</div>";

        echo $args['after_widget'];
    }

    public function form( $instance )
    {
        $tag      = isset($instance['tag']) ? $instance['tag'] : '';
        $tag_id   = $this->get_field_id('tag');
        $tag_name = $this->get_field_name('tag');

        $tags = get_tags();
        ?>
        <select name="<?php echo $tag_name ?>" id="<?php echo $tag_id ?>">
            <?php foreach ( $tags as $tag ) : ?>
                <option value="<?php echo $tag->term_id ?>"><?php echo $tag->name ?></option>
            <?php endforeach; ?>
        </select>
        <?php
    }

    function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['tag'] = $new_instance['tag'];

        return $instance;
    }

    function excerptLength( $length = 100 )
    {
        add_filter( 'excerpt_length', function() use( $length ) {
            return $length;
        } );
    }
}
