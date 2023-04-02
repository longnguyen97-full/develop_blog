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
        $data  = ['views' => $views + 1];
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
        <span class="text-light-blue mr-1"><i class="fas fa-eye"></i><sub><?php echo self::getViews($post_id) ?: 0; ?></sub></span>
        <?php
    }
}
$countPostView = new CountPostView();
