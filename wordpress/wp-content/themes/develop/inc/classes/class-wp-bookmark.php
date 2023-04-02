<?php
class Bookmark
{
    public function __construct()
    {
        add_action('admin_init', [$this, 'setup']);
        add_action('wp_enqueue_scripts', [$this, 'loadScripts']);
        add_action('wp_ajax_bookmark', [$this, 'callbackAjax']);
        add_action('wp_ajax_nopriv_bookmark', [$this, 'callbackAjax']);
    }

    public function setup()
    {
        global $wpdb;
        $table_name = "{$wpdb->prefix}bookmarks";
        $wpdb_collate = $wpdb->collate;
        $sql =
            "CREATE TABLE IF NOT EXISTS $table_name (
                id bigint unsigned NOT NULL AUTO_INCREMENT,
                post_id bigint NOT NULL,
                user_id bigint NOT NULL,
                PRIMARY KEY (id)
            )
            COLLATE $wpdb_collate";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    public function loadScripts()
    {
        wp_enqueue_script(TEXT_DOMAIN . '-bookmark', getAssets() . '/js/bookmark.js', array('jquery'), wp_get_theme()->get('Version'), true);
        wp_localize_script(TEXT_DOMAIN . '-bookmark', 'params', array(
            'ajaxurl' => site_url('/wp-admin/admin-ajax.php'),
        ));
    }

    public function callbackAjax()
    {
        // setup data
        $post_id   = isset($_POST['post_id']) ? $_POST['post_id'] : '';
        $user_id   = isset($_POST['user_id']) ? $_POST['user_id'] : '';
        $active    = isset($_POST['active']) ? $_POST['active'] : '';
        global $wpdb;
        $table  = "{$wpdb->prefix}bookmarks";
        $where  = ['post_id' => $post_id, 'user_id' => $user_id];
        $format = ['%d', '%d'];

        // Add/Delete bookmark record
        !empty($active) ? $wpdb->delete($table, $where) : $wpdb->insert($table, $where, $format);
    }

    public static function form($post_id)
    {
        $user_id = get_current_user_id();
        $post_id = $post_id ?: get_the_ID();
        $active  = self::check(['post_id' => $post_id, 'user_id' => $user_id]) ? 'toggle-active' : '';
        $checked = !empty($active) ? 'checked' : '';
        ?>
        <span class="mr-1">
            <i class="far fa-bookmark bookmark cursor-pointer <?php echo $active; ?>" data-post_id="<?php echo $post_id; ?>" data-user_id="<?php echo $user_id; ?>"></i>
            <input type="checkbox" name="bookmark-active" class="bookmark-active hide" value="<?php echo $checked; ?>" <?php echo $checked; ?>>
        </span>
        <?php
    }

    public static function check($args)
    {
        global $wpdb;
        $table = "{$wpdb->prefix}bookmarks";
        $where = "post_id = $args[post_id] && user_id = $args[user_id]";
        $sql   = "SELECT * FROM $table WHERE $where";

        $bookmark = $wpdb->get_row($wpdb->prepare($sql));
        return !empty($bookmark) ? true : false;
    }
}
$bookmark = new Bookmark();
