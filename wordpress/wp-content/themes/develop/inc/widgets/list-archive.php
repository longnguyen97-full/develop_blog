<?php
// Register and load the widget
add_action('widgets_init', function () {
    register_widget('theme_widget_list_archive');
});

class theme_widget_list_archive extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'theme_widget_list_archive',
            'List archive',
            array('description' => 'Show archive as an list',)
        );
    }

    public function widget($args, $instance)
    {
        echo $args['before_widget'];

        // $categories = get_categories(array(
        //     'orderby' => 'name',
        //     'order'   => 'ASC',
        //     'number' => $instance['limit']
        // ));

        // foreach ($categories as $archive) {
        //     echo '<ul><li><a href="' . get_archive_link($archive->term_id) . '">' . esc_html($archive->name) . ' (' . $archive->archive_count . ')' . '</a></li></ul>';
        // }

        global $wpdb;
        $years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date) FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' ORDER BY post_date DESC");
        if (!empty($years)) {
            $html = '<ul class="footer-list">';
            foreach ($years as $year) {
                // $html .= '<li class="year_month"><a href="' . get_year_link($year) . '">' . $year . '</a>';
                // $html .= '<ul class="monthlist">';
                $months = $wpdb->get_col($wpdb->prepare("SELECT DISTINCT MONTH(post_date) FROM $wpdb->posts WHERE post_type='post' AND post_status='publish' AND YEAR(post_date) = %d ORDER BY post_date ASC", $year));
                foreach ($months as $month) {
                    $dateObj   = DateTime::createFromFormat('!m', $month);
                    $monthName = $dateObj->format('F');
                    $html .= '<li class="year_month"><a href="' . get_month_link($year, $month) . '">' . $monthName . '</a>&nbsp;<a href="' . get_year_link($year) . '">' . $year . '</a></li>';
                }
                // $html .= '</ul>';
                $html .= '</li>';
            }
            $html .= '</ul>';
        }
        echo $html;

        echo $args['after_widget'];
    }

    public function form($instance)
    {
        $limit      = isset($instance['limit']) ? $instance['limit'] : 10;
        $limit      = $this->range($limit);
        $limit_id   = $this->get_field_id('limit');
        $limit_name = $this->get_field_name('limit');

        echo "<input type='number' id='{$limit_id}' name='{$limit_name}' value='{$limit}' min='1', max='99' placeholder='How many archive will be display? Type an expected number...'>";
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
        if ($value < 1) {
            return 1;
        }

        if ($value > 99) {
            return 99;
        }
    }
}
