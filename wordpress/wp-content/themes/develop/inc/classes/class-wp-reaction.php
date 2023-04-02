<?php
class Reaction
{
    public function __construct()
    {
        add_action('admin_init', [$this, 'setup']);
        add_action('wp_enqueue_scripts', [$this, 'loadScripts']);
        add_action('wp_ajax_reaction', [$this, 'callbackAjax']);
        add_action('wp_ajax_nopriv_reaction', [$this, 'callbackAjax']);
    }

    public function setup()
    {
        global $wpdb;
        $table_name = "{$wpdb->prefix}reactions";
        $wpdb_collate = $wpdb->collate;
        $sql =
            "CREATE TABLE IF NOT EXISTS $table_name (
                id bigint unsigned NOT NULL AUTO_INCREMENT,
                object_id bigint NOT NULL,
                user_id bigint NOT NULL,
                post_type varchar(20) NOT NULL,
                icon varchar(20) DEFAULT 'like' NOT NULL,
                PRIMARY KEY (id)
            )
            COLLATE $wpdb_collate";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    public function loadScripts()
    {
        wp_enqueue_script(TEXT_DOMAIN . '-reaction', getAssets() . '/js/reaction.js', array('jquery'), wp_get_theme()->get('Version'), true);
        wp_localize_script(TEXT_DOMAIN . '-reaction', 'params', array(
            'ajaxurl' => site_url('/wp-admin/admin-ajax.php'),
        ));
    }

    public function callbackAjax()
    {
        // setup data
        $object_id = isset($_POST['object_id']) ? $_POST['object_id'] : '';
        $user_id   = isset($_POST['user_id']) ? $_POST['user_id'] : '';
        $post_type = isset($_POST['post_type']) ? $_POST['post_type'] : '';
        $icon      = isset($_POST['icon']) ? $_POST['icon'] : '';
        $active    = isset($_POST['active']) ? $_POST['active'] : '';
        global $wpdb;
        $table  = "{$wpdb->prefix}reactions";
        $where  = ['object_id' => $object_id, 'user_id' => $user_id, 'post_type' => $post_type, 'icon' => $icon];
        $format = ['%d', '%d', '%s', '%s'];

        // Add/Delete reaction record
        !empty($active) ? $wpdb->delete($table, $where) : $wpdb->insert($table, $where, $format);
    }

    public static function icon($object_id = 0, $args = [])
    {
        if ($args['icon'] == 'like') :
            $active  = self::check(array_merge($args, ['object_id' => $object_id])) ? 'toggle-active' : '';
            $checked = !empty($active) ? 'checked' : '';
            $class   = !empty($args['class']) ? implode(' ', $args['class']) : '';
            ?>
            <p class="reaction cursor-pointer <?php echo $active; ?> <?php echo $class; ?>" data-object_id="<?php echo $object_id; ?>" data-user_id="<?php echo $args['user_id']; ?>" data-post_type="<?php echo $args['post_type']; ?>" data-icon="<?php echo $args['icon']; ?>"><i class="fa-regular fa-thumbs-up"></i></p>
            <input type="checkbox" name="reaction-active" class="reaction-active hide" value="<?php echo $checked; ?>" <?php echo $checked; ?>>
            <?php
        endif;
    }

    public static function check($args)
    {
        global $wpdb;
        $table = "{$wpdb->prefix}reactions";
        $where = "object_id = $args[object_id] && user_id = $args[user_id] && post_type = '$args[post_type]' && icon = '$args[icon]'";
        $sql   = "SELECT * FROM $table WHERE $where";

        $reaction = $wpdb->get_row($wpdb->prepare($sql));
        return !empty($reaction) ? true : false;
    }
}
$reaction = new Reaction();
