<?php
class BookmarkPost
{
    public $page_name   = 'Bookmark';
    public $page_slug   = 'cybridge-bookmark';
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
        add_action('wp_ajax_bookmark', array($this, 'bookmarkAjaxCallback'));
        add_action('wp_ajax_nopriv_bookmark', array($this, 'bookmarkAjaxCallback'));
    }

    public function loadScripts()
    {
        wp_enqueue_style(TEXT_DOMAIN . '-bookmark-theme', getAssets() . '/css/bookmark.css', array(), wp_get_theme()->get('Version'));
        wp_register_script(TEXT_DOMAIN . '-bookmark-script', getAssets() . '/js/bookmark.js', array('jquery'), wp_get_theme()->get('Version'), true);
        wp_localize_script(TEXT_DOMAIN . '-bookmark-script', 'bookmark_params', array(
            'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
        ));
        wp_enqueue_script(TEXT_DOMAIN . '-bookmark-script');
    }

    public function bookmarkAjaxCallback()
    {
        if (!is_user_logged_in()) {
            wp_send_json_success('[REQUIRE_LOGIN]');
            die();
        }

        $user_id     = get_current_user_id();
        $post_id     = isset($_POST['post_id']) ? $_POST['post_id'] : '';
        $bookmark_id = $this->hasMark( $user_id, $post_id );
        $executed    = !empty( $bookmark_id ) ? $this->unmark( $bookmark_id ) : $this->mark( $user_id, $post_id );
        die();
    }

    public function hasMark( $user_id = 0, $post_id = 0 )
    {
        return $this->wpdb->get_row($this->wpdb->prepare("SELECT bookmark_id FROM wp_bookmarks WHERE user_id = %d AND post_id = %d", $user_id, $post_id))->bookmark_id;
    }

    public function mark( $user_id = 0, $post_id = 0 )
    {
        return $this->wpdb->insert('wp_bookmarks', array('user_id' => $user_id, 'post_id' => $post_id), array('%d', '%d'));
    }

    public function unmark( $bookmark_id = 0 )
    {
        return $this->wpdb->delete('wp_bookmarks', array('bookmark_id' => $bookmark_id), array('%d'));
    }

    public function bookmarkForm()
    {
        if ( !is_user_logged_in() ) {
            return;
        }
        $user_id = get_current_user_id();
    	$post_id = get_the_ID();
        $marked  = !empty( $this->hasMark( $user_id, $post_id ) ) ? ' marked' : ' unmarked';
    	?>
    	<form class="form_bookmark mb-2">
    		<input type="hidden" class="post_id" value="<?php echo $post_id; ?>">
    		<input type="submit" class="btn btn-dark btn-sm border-light text-light button_bookmark<?php echo $marked; ?>" value="Bookmark">
    	</form>
    	<?php
    }
}
$BookmarkPost = new BookmarkPost();
