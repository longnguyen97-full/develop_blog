<?php
class CountPostView
{
    public function __construct()
    {
        add_action('admin_init', [$this, 'setup']);
    }

    public function setup()
    {
        global $wpdb;
        $table   = "{$wpdb->prefix}count_post_views";
        $collate = $wpdb->collate;
        $sql =
            "CREATE TABLE IF NOT EXISTS $table (
                id bigint unsigned NOT NULL AUTO_INCREMENT,
                post_id bigint NOT NULL,
                views bigint NOT NULL,
                date_views datetime DEFAULT '0000-00-00 00:00:00',
                PRIMARY KEY (id)
            )
            COLLATE $collate";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    public static function getViews($post_id)
    {
        global $wpdb;
        $table = "{$wpdb->prefix}count_post_views";
        return $wpdb->get_row($wpdb->prepare("SELECT views FROM $table WHERE post_id = %d", $post_id))->views;
    }

    public static function countViews($post_id)
    {
        // setup date
        $views = self::getViews($post_id) ?: 0;
        $data  = ['views' => $views + 1, 'date_views' => current_time('mysql')];
        $where = ['post_id' => $post_id];
        global $wpdb;
        $table = "{$wpdb->prefix}count_post_views";
        // update or insert count_post_view record
        $update_id = $wpdb->update($table, $data, $where);
        if (false === $update_id || $update_id < 1) {
            $data = array_merge($data, $where);
            $wpdb->insert($table, $data);
        }
    }

    public static function form($post_id)
    {
        ?>
        <span class="mr-1"><i class="fas fa-eye"></i><sub><?php echo self::getViews($post_id) ?: 0; ?></sub></span>
        <?php
    }

    public static function getViewsByDate($date)
    {
        global $wpdb;
        $table   = "{$wpdb->prefix}count_post_views";
        $select  = 'post_id';
        $oderby1 = 'date_views';
        $oderby2 = 'views';
        switch ($date) {
            case 'day':
                $query = "SELECT $select, RANK() OVER (ORDER BY $oderby1 DESC, $oderby2 DESC) AS 'rank' FROM $table";
                break;
            case 'week':
                $query = "SELECT $select FROM $table WHERE $oderby1 >= NOW() - INTERVAL 8 DAY AND $oderby1 < NOW() + INTERVAL 1 DAY ORDER BY $oderby1 DESC";
                break;
            case 'month':
                $query = "SELECT $select, RANK() OVER (ORDER BY $oderby1 DESC, $oderby2 DESC) AS 'rank' FROM $table WHERE MONTH($oderby1) = MONTH(CURRENT_DATE()) AND YEAR($oderby1) = 
                YEAR(CURRENT_DATE())";
                break;
        };
        $results  = $wpdb->get_results($wpdb->prepare($query));
        $post_ids = array_column( $results, $select );
        $args = [
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'post__in'       => $post_ids,
            'orderby'        => 'post__in',
            'posts_per_page' => 10,
        ];
        return get_posts($args) ?: [];
    }
}
$countPostView = new CountPostView();
