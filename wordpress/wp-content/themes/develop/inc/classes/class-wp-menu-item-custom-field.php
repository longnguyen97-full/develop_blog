<?php
class MenuItemCustomField
{
    /**
     * Start up
     */
    public function __construct()
    {
        add_action('wp_nav_menu_item_custom_fields', array($this, 'addMenuItemCustomField'), 10, 2);
        add_action('wp_update_nav_menu_item', array($this, 'saveMenuItemCustomField'), 10, 2);
        add_action('nav_menu_item_title', array($this, 'showMenuItemCustomField'), 10, 2);
    }

    public function addMenuItemCustomField($item_id, $item)
    {
        $menu_item_class = get_post_meta($item_id, '_menu_item_class', true);
        ?>
        <p class="field-class description description-wide">
            <label for="edit-menu-item-class-<?php echo $item_id; ?>"><?php _e("Class", 'menu-item-class'); ?><br>
                <input type="text" id="edit-menu-item-class-<?php echo $item_id; ?>" class="widefat code edit-menu-item-class" name="menu-item-class[<?php echo $item_id; ?>]" value="<?php echo esc_attr($menu_item_class); ?>">
            </label>
        </p>
        <?php
    }

    public function saveMenuItemCustomField($menu_id, $menu_item_db_id)
    {
        if (isset($_POST['menu-item-class'][$menu_item_db_id])) {
            $sanitized_data = sanitize_text_field($_POST['menu-item-class'][$menu_item_db_id]);
            update_post_meta($menu_item_db_id, '_menu_item_class', $sanitized_data);
        } else {
            delete_post_meta($menu_item_db_id, '_menu_item_class');
        }
    }

    public function showMenuItemCustomField($title, $item)
    {
        if (is_object($item) && isset($item->ID)) {
            $menu_item_class = get_post_meta($item->ID, '_menu_item_class', true);
            if (!empty($menu_item_class)) {
                $title = "<span class='menu-item-class {$menu_item_class}'>$title</span>";
            }
        }
        return $title;
    }
}
$menu_item_custom_field = new MenuItemCustomField();
