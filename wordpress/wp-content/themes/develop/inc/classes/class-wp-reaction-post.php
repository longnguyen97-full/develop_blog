<?php
class ReactionPost
{
    public $page_name   = 'Reaction';
    public $page_slug   = 'cybridge-reaction';
    public $parent_slug = 'cybridge-helper';

    /**
     * Start up
     */
    public function __construct()
    {
        global $wp_query, $wpdb;
        $this->wp_query = $wp_query;
        $this->wpdb     = $wpdb;

        add_action('wp_enqueue_scripts', array($this, 'loadScripts'));
        add_action('wp_ajax_reaction', array($this, 'reactionAjaxCallback'));
        add_action('wp_ajax_nopriv_reaction', array($this, 'reactionAjaxCallback'));
    }

    public function setData($id = 0, $post_type = '')
    {
        $this->id        = $id;
        $this->post_type = $post_type;

        // detect current user like or not, change background for like button
        $has_like    = $this->hasLike(get_current_user_id(), $this->id, $this->post_type);
        $this->liked = !empty($has_like) ? 'liked' : '';

        ?>
            <input type="hidden" class="set_data_post_id__emoji-<?php echo $post_type . '-' . $id; ?>" value="<?php echo $id; ?>">
            <input type="hidden" class="set_data_post_type__emoji-<?php echo $post_type . '-' . $id; ?>" value="<?php echo $post_type; ?>">
        <?php

    }

    public function loadScripts()
    {
        wp_enqueue_style(TEXT_DOMAIN . '-reaction-theme', getAssets() . '/css/reaction.css', array(), wp_get_theme()->get('Version'));
        wp_register_script(TEXT_DOMAIN . '-reaction-script', getAssets() . '/js/reaction.js', array('jquery'), wp_get_theme()->get('Version'), true);
        wp_localize_script(TEXT_DOMAIN . '-reaction-script', 'reaction_params', array(
            'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
        ));
        wp_enqueue_script(TEXT_DOMAIN . '-reaction-script');
    }

    public function getData()
    {
        $this->viewReaction();
    }

    public function viewReactionCounter($reactions = array(), $total = 0)
    {
        ?>
        <div class="reaction_counter mb-3">
            <span class="reaction_by_user__emoji-<?php echo $this->post_type . '-' . $this->id; ?>"></span>
        </div>
        <?php

    }

    public function viewReaction()
    {

        ?>
        <div class="emoji__container">
            <div class="emoji emoji__like emoji-<?php echo $this->post_type . '-' . $this->id . ' ' . $this->liked; ?>">
                <i class="fa-regular fa-thumbs-up"></i>
            </div>
            <div class="reaction_counter mb-3">
                <span class="font-weight-bold reaction_by_user__emoji-<?php echo $this->post_type . '-' . $this->id; ?>">
                    <?php echo $this->getReactionByUser(); ?>
                </span>
            </div>
        </div>
        <?php

    }

    public function reactionAjaxCallback()
    {
        if (!is_user_logged_in()) {
            wp_send_json_success('[REQUIRE_LOGIN]');
            die();
        }

        $user_id   = get_current_user_id();
        $post_id   = isset($_POST['post_id']) ? $_POST['post_id'] : '';
        $post_type = isset($_POST['post_type']) ? $_POST['post_type'] : '';
        $emoji     = isset($_POST['emoji']) ? $_POST['emoji'] : '';

        $reaction_id = $this->hasLike($user_id, $post_id, $post_type);

        $executed = !empty($reaction_id) ? $this->unlike($reaction_id) : $this->like($user_id, $post_id, $post_type, $emoji);
        die();
    }

    public function getReactionByUser($post_id = 0, $post_type = '')
    {
        $post_id   = !empty($post_id) ? $post_id : $this->id;
        $post_type = !empty($post_type) ? $post_type : $this->post_type;

        $reaction_id = $this->hasLike(get_current_user_id(), $post_id, $post_type);
        $reactions   = $this->hasOtherLike($post_id, $post_type);
        $total       = count($reactions);

        return $total;
    }

    public function hasLike($user_id = 0, $post_id = 0, $post_type = '')
    {
        return $this->wpdb->get_row($this->wpdb->prepare("SELECT reaction_id FROM wp_reactions WHERE user_id = %d AND post_id = %d AND post_type = %s", $user_id, $post_id, $post_type))->reaction_id;
    }

    public function hasOtherLike($post_id = 0, $post_type = '')
    {
        return $this->wpdb->get_results($this->wpdb->prepare("SELECT user_id FROM wp_reactions WHERE post_id = %d AND post_type = %s", $post_id, $post_type));
    }

    public function like($user_id = 0, $post_id = 0, $post_type = '', $emoji = '')
    {
        return $this->wpdb->insert('wp_reactions', array('user_id' => $user_id, 'post_id' => $post_id, 'post_type' => $post_type, 'emoji' => $emoji), array('%d', '%d', '%s', '%s'));
    }

    public function unlike($reaction_id = 0)
    {
        return $this->wpdb->delete('wp_reactions', array('reaction_id' => $reaction_id), array('%d'));
    }

}
$ReactionPost = new ReactionPost();
