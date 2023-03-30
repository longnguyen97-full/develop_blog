<?php
class Comment
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'loadScripts']);
        add_action('wp_ajax_comment', [$this, 'callbackAjax']);
        add_action('wp_ajax_nopriv_comment', [$this, 'callbackAjax']);
    }

    public function loadScripts()
    {
        wp_enqueue_script(TEXT_DOMAIN . '-comment', getAssets() . '/js/comment.js', array('jquery'), wp_get_theme()->get('Version'), true);
        wp_localize_script(TEXT_DOMAIN . '-comment', 'params', array(
            'ajaxurl' => site_url('/wp-admin/admin-ajax.php'),
        ));
    }

    public function callbackAjax()
    {
        $field          = isset($_POST['field']) ? $_POST['field'] : '';
        $post_id        = isset($_POST['post_id']) ? $_POST['post_id'] : '';
        $comment_id     = self::add($field, $post_id);
        $current_user   = wp_get_current_user();
        ?>
        <li class="comment">
            <div class="comment_body">
                <div class="comment_panel d-flex flex-row align-items-center justify-content-start">
                    <div class="comment_author_image">
                        <div><img src="<?php echo get_avatar_url($current_user->ID, ['size' => '25']); ?>" alt=""></div>
                    </div>
                    <small class="post_meta"><a href="#"><?php echo $current_user->display_name; ?></a><span><?php current_datetime(); ?></span></small>
                    <button type="button" class="reply_button ml-auto">Reply</button>
                    <input type="hidden" value="<?php echo $comment_id; ?>">
                </div>
                <div class="comment_content">
                    <p><?php echo $field['comment_content']; ?></p>
                </div>
            </div>
        </li>
        <?php exit();
    }

    public static function form($post_id)
    {
        if (!is_user_logged_in()) {
            return false;
        }
        ?>
        <div class="post_comment">
            <div class="post_comment_title">Post Comment</div>
            <div class="row">
                <div class="col-xl-8">
                    <div class="post_comment_form_container">
                        <form>
                            <textarea class="comment_text comment_content" placeholder="Your Comment" required="required" name="comment_content"></textarea>
                            <input class="comment_parent" type="hidden" value="" name="comment_parent">
                            <input class="post_id" type="hidden" value="<?php echo $post_id; ?>">
                            <button type="submit" class="comment_button" id="comment_submit" name="comment_submit">Post Comment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public static function list($post_id)
    {
        $args = [
            'user_id'   => get_current_user_id(),
            'post_type' => 'comment',
            'icon'      => 'like',
        ];
        ?>
        <div class="comments">
            <div class="comments_title">Comments <span>(<?php echo get_comments_number($post_id); ?>)</span></div>
            <div class="row">
                <div class="col-xl-8">
                    <div class="comments_container">
                        <ul class="comment_list">
                            <?php
                            $comments = get_comments(['post_id' => $post_id, 'parent' => 0]);
                            foreach ($comments as $comment) : ?>
                                <li class="comment">
                                    <div class="comment_body">
                                        <div class="comment_panel d-flex flex-row align-items-center justify-content-start">
                                            <div class="comment_author_image">
                                                <div><img src="<?php echo get_avatar_url($comment->user_id, ['size' => '25']); ?>" alt=""></div>
                                            </div>
                                            <small class="post_meta"><a href="#"><?php echo $comment->comment_author; ?></a><span><?php echo $comment->comment_date; ?></span></small>
                                            <button type="button" class="reply_button ml-auto">Reply</button>
                                            <input type="hidden" value="<?php echo $comment->comment_ID; ?>">
                                        </div>
                                        <div class="comment_content">
                                            <p><?php echo $comment->comment_content; ?></p>
                                            <?php Reaction::icon($comment->comment_ID, $args); ?>
                                        </div>
                                    </div>
                                    <?php
                                    $child_comments = get_comments(['post_id' => $post_id, 'parent' => $comment->comment_ID]);
                                    foreach ($child_comments as $child_comment) : ?>
                                        <ul class="comment_list comment_list_child-<?php echo $comment->comment_ID; ?>">
                                            <li class="comment">
                                                <div class="comment_body">
                                                    <div class="comment_panel d-flex flex-row align-items-center justify-content-start">
                                                        <div class="comment_author_image">
                                                            <div><img src="<?php echo get_avatar_url($comment->user_id, ['size' => '25']); ?>" alt=""></div>
                                                        </div>
                                                        <small class="post_meta"><a href="#"><?php echo $child_comment->comment_author; ?></a><span><?php echo $child_comment->comment_date; ?></span></small>
                                                        <button type="button" class="reply_button ml-auto">Reply</button>
                                                        <input type="hidden" value="<?php echo $comment->comment_ID; ?>">
                                                    </div>
                                                    <div class="comment_content">
                                                        <p><?php echo $child_comment->comment_content; ?></p>
                                                        <?php Reaction::icon($child_comment->comment_ID, $args); ?>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    <?php endforeach; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public static function add($field, $post_id)
    {
        $current_user = wp_get_current_user();

        if (comments_open($post_id)) {
            $data = array(
                'comment_post_ID'      => $post_id,
                'comment_content'      => $field['comment_content'],
                'comment_parent'       => $field['comment_parent'],
                'user_id'              => $current_user->ID,
                'comment_author'       => $current_user->user_login,
                'comment_author_email' => $current_user->user_email,
                'comment_author_url'   => $current_user->user_url,
            );

            $comment_id = wp_insert_comment($data);
            if (!is_wp_error($comment_id)) {
                return $comment_id;
            }
        }

        return false;
    }
}
$comment = new Comment();
