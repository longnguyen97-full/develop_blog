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

        // /* Popup to show number of reaction */
        // add_action('wp_footer', array($this, 'loadViewPopup'));
    }

    public function setData($id = 0, $post_type = '')
    {
        $this->id        = $id;
        $this->post_type = $post_type;

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

        // // Popup to show number of reaction
        // wp_enqueue_script(TEXT_DOMAIN. '-reaction-counter-popup', getAssets() . '/js/reaction-counter-popup.js', array('jquery'), '', true);
    }

    /**
     * Popup functions 🡓 🡓 🡓
     */
    /*
    public function loadViewPopup()
    {
    add_thickbox();
    $this->viewPopup();
    }
     */

    /*
    public function viewPopup()
    {
    ?>
    <div id="thickbox-id-reaction-counter" style="display:none;">
    <div id="container">
    <input type="text" id="field_emoji" value="">
    </div>
    </div>
    <?php

    }
     */

    public function getData()
    {
        // $emojis = $this->getReactions();
        // $emojis = array_column( $emojis, 'emoji' );
        // $emojis = array_count_values( $emojis );
        // arsort($emojis);

        // $i = 0;
        // foreach ($emojis as $emoji => $number_of_emoji) {
        //     $i++;
        //     if ($i > 3) {
        //         break;
        //     }
        //     $reactions['emoji'][]           = $emoji;
        //     $reactions['number_of_emoji'][] = $number_of_emoji;
        // }

        // $total = count($emojis);
        $this->viewReactionCounter($reactions, $total);
        $this->viewReaction();
    }

    /*
    public function getReactions()
    {
    $tb_reactions = $this->wpdb->prefix . 'reactions';
    $tb_emojis    = $this->wpdb->prefix . 'emojis';

    return $this->wpdb->get_results("SELECT emoji FROM $tb_reactions INNER JOIN $tb_emojis ON $tb_reactions.emoji_id = $tb_emojis.emoji_id WHERE post_id = {$this->id}", OBJECT);
    }
     */

    public function viewReactionCounter($reactions = array(), $total = 0)
    {
        ?>
        <div class="reaction_counter mb-3">
            <span class="reaction_by_user__emoji-<?php echo $this->post_type . '-' . $this->id; ?>">
                <?php echo $this->getReactionByUser(); ?>
            </span>
            <!--
            <?php /*foreach ($reactions['emoji'] as $emoji) :*/;?>
                <?php /*$this->getEmojiIcon($emoji);*/;?>
            <?php /*endforeach;*/;?>
            <span class="reaction_total">
                <?php /*echo $total;*/;?>
            </span>
            <input type="hidden" id="reaction_total" value="<?php /*echo $total;*/;?>">
            -->
        </div>
        <?php

    }

    /*
    public function getEmojiIcon($emoji = '')
    {
    if ($emoji === 'like') {
    $icon = 'fa-thumbs-up';
    }

    if ($emoji === 'love') {
    $icon = 'fa-heart';
    }

    if ($emoji === 'haha') {
    $icon = 'fa-face-grin-squint';
    }

    if ($emoji === 'wow') {
    $icon = 'fa-face-surprise';
    }

    if ($emoji === 'huhu') {
    $icon = 'fa-face-sad-cry';
    }

    if ($emoji === 'angry') {
    $icon = 'fa-face-angry';
    }

    ?>
    <a href="#TB_inline?&width=300&height=300&inlineId=thickbox-id-reaction-counter" class="thickbox emoji__popup__<?php echo $emoji; ?>"><i class="fa-regular <?php echo $icon; ?>"></i></a>
    <?php
    }
     */

    public function viewReaction()
    {

        ?>
        <div class="emoji__container my-3">
            <div class="emoji emoji__like emoji-<?php echo $this->post_type . '-' . $this->id; ?>">
                <i class="fa-regular fa-thumbs-up"></i>
            </div>
            <!--
            <div class="emoji emoji__love">
                <i class="fa-regular fa-heart"></i>
            </div>
            <div class="emoji emoji__haha">
                <i class="fa-regular fa-face-grin-squint"></i>
            </div>
            <div class="emoji emoji__wow">
                <i class="fa-regular fa-face-surprise"></i>
            </div>
            <div class="emoji emoji__huhu">
                <i class="fa-regular fa-face-sad-cry"></i>
            </div>
            <div class="emoji emoji__angry">
                <i class="fa-regular fa-face-angry"></i>
            </div>
            -->
        </div>
        <?php

    }

    public function reactionAjaxCallback()
    {
        $user_id   = get_current_user_id();
        $post_id   = isset($_POST['post_id']) ? $_POST['post_id'] : '';
        $post_type = isset($_POST['post_type']) ? $_POST['post_type'] : '';
        $emoji     = isset($_POST['emoji']) ? $_POST['emoji'] : '';

        $reaction_id = $this->hasLike($user_id, $post_id, $post_type);

        $executed = !empty($reaction_id) ? $this->unlike($reaction_id) : $this->like($user_id, $post_id, $post_type, $emoji);

        $message = $this->getReactionByUser($post_id, $post_type);

        wp_send_json_success($message);
        die();
    }

    public function getReactionByUser($post_id = 0, $post_type = '')
    {
        $post_id   = !empty($post_id) ? $post_id : $this->id;
        $post_type = !empty($post_type) ? $post_type : $this->post_type;

        $reaction_id = $this->hasLike(get_current_user_id(), $post_id, $post_type);
        $reactions   = $this->hasOtherLike($post_id, $post_type);
        $total       = count($reactions) - 1;

        // greater than 3 people include current user
        if (!empty($reaction_id) && $total >= 3) {
            foreach ($reactions as $key => $reaction) {
                if ($reaction->user_id == get_current_user_id()) {
                    continue;
                }
                if ($key > 1) {
                    break;
                }
                $others .= get_user_meta($reaction->user_id, 'nickname', true) . ', ';
            }
            $others = rtrim($others, ', ');
            return "You, {$others} and others are liked this {$post_type}";
        }

        // there are 2 or 3 people, include current user
        if (!empty($reaction_id) && $total > 0 && $total <= 2) {
            foreach ($reactions as $reaction) {
                if ($reaction->user_id == get_current_user_id()) {
                    continue;
                }
                $others .= get_user_meta($reaction->user_id, 'nickname', true) . ', ';
            }
            $others = rtrim($others, ', ');
            return "You and {$others} are liked this {$post_type}";
        }

        // only current user
        if (!empty($reaction_id) && $total == 0) {
            return "You liked this {$post_type}";
        }

        // only one people, not current user
        if (empty($reaction_id) && !empty($reactions) && $total == 0) {
            $other = get_user_meta($reactions[0]->user_id, 'nickname', true);
            return "{$other} liked this {$post_type}";
        }

        // there are 3 people, not include current user
        if (empty($reaction_id) && !empty($reactions) && $total > 0 && $total <= 2) {
            foreach ($reactions as $reaction) {
                $others .= get_user_meta($reaction->user_id, 'nickname', true) . ', ';
            }
            $others = rtrim($others, ', ');
            return "{$others} liked this {$post_type}";
        }

        // greater than 3 people, not include current user
        if (empty($reaction_id) && !empty($reactions) && $total >= 3) {
            foreach ($reactions as $key => $reaction) {
                if ($key > 2) {
                    break;
                }
                $others .= get_user_meta($reaction->user_id, 'nickname', true) . ', ';
            }
            $others = rtrim($others, ', ');
            return "{$others} and others liked this {$post_type}";
        }

        // no one
        if (empty($reaction_id) && empty($reactions)) {
            return "";
        }
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
