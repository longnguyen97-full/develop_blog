<?php
class QnpEditTemplate
{
    public $nonce = '_nonce_';
    public $id    = '';
    public $title = '';
    public $file  = '';
    public $languages = array(
        'en' => array(
            'title'              => 'Edit File',
            'button_update'      => 'Update',
            'not_file_create_it' => 'Not found template file. Create it?',
            'code_valid'         => 'Code is valid.',
            'code_note_valid'    => 'Code is not valid PHP code.',
            'failed_create_tmp'  => 'Failed to create tmp folders for check code.',
            'unknown'            => 'Unknown?',
            'file_saved'         => ' File saved.',
            'file_not_saved'     => ' File not saved!',
            'not_change_editor'  => 'You can\'t change this content. Because you changed page template or slug name. F5 for page refresh.',
        ),
        'ja' => array(
            'title'              => 'ファイルの編集',
            'button_update'      => '更新',
            'not_file_create_it' => 'テンプレートファイルは見つかりません。作成したいですか？',
            'code_valid'         => 'コードは有効です。',
            'code_note_valid'    => 'コードは無効です。',
            'failed_create_tmp'  => 'コードチェック用のtmpフォルダの作成に失敗しました。',
            'unknown'            => '不明なエラーです。',
            'file_saved'         => '　ファイルは保存されました。',
            'file_not_saved'     => '　ファイルは保存されませんでした。',
            'not_change_editor'  => 'このコンテンツは変更できません。テンペレートページまたはスラッグ名を変更したためです。ページリフレッシュのためF5を押します。',
        ),
    );
    public $lang = array();

    public function __construct()
    {
        if ( is_admin() ) {
            session_start();
            add_action( 'load-post.php',     array( $this, 'init_metabox' ) );
            // add_action( 'load-post-new.php', array( $this, 'init_metabox' ) );
            add_action( 'admin_init',        array( $this, 'print_error'  ) );

            $this->lang  = $this->languages[substr(get_locale(), 0, 2)];
            $this->id    = 'edit_file_page';
            $this->title = $this->lang['title'];
            $this->nonce = $this->nonce . $this->id;
        }
    }

    /**
     * init_metabox
     */
    public function init_metabox()
    {
        add_action('admin_enqueue_scripts', array( $this, 'enqueue'  ) );
        add_action('add_meta_boxes',        array( $this, 'register' ), 10, 2);
        add_action('save_post',             array( $this, 'saved'    ), 10, 2);
    }

    /**
     * register
     * @param  [type] $post_type
     */
    public function register($post_type)
    {
        $this->file  = $this->get_template_exists();
        $this->title = $this->title . $this->_title();
        add_meta_box( $this->id, $this->title, array( $this, 'html' ), 'page', 'normal', 'high' );
    }

    /**
     * html
     * @param  [type] $post
     * @param  [type] $args
     * @return string html
     */
    public function html($post, $args)
    {
        wp_nonce_field( basename(__FILE__), $this->nonce );
        $slug    = $post->post_name;
        $content = '';
        if ( file_exists($this->file) ) {
            $content = file_get_contents($this->file);
        }
        ?>
        <textarea name="sourcecode" id="sourcecode_val" rows="10" cols="100" autocapitalize="off" autocorrect="off" wrap="off"><?php echo htmlentities( $content) ?></textarea>
        <button id="btn_sourcecode_save" class="button button-large button-green"><?php echo $this->lang['button_update'] ?></button>
        <?php if (empty($this->file)): ?>
        <p style="padding: 10px;margin: 0;"><label for="btn_create_file"><input type="checkbox" name="createfile" id="btn_create_file" value="create"> <?php echo $this->lang['not_file_create_it'] ?></label></p>
        <?php endif; ?>
        <input type="hidden" name="has_change_slug" id="has_change_slug" value="">
        <input type="hidden" name="has_change_template" id="has_change_template" value="">
        <?php
    }

    /**
     * saved
     * @param  integer $post_id
     */
    public function saved($post_id)
    {
        $is_save_file = false;

        // Add nonce for security and authentication.
        $nonce_name = isset( $_POST[$this->nonce] ) ? $_POST[$this->nonce] : '';

        // Check if nonce is set.
        if ( ! isset( $nonce_name ) ) {
            return;
        }

        // Check if nonce is valid.
        if ( ! wp_verify_nonce( $nonce_name, basename(__FILE__) ) ) {
            return;
        }

        // Check if user has permissions to save data.
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        // Check if not an autosave.
        if ( wp_is_post_autosave( $post_id ) ) {
            return;
        }

        // Check if not a revision.
        if ( wp_is_post_revision( $post_id ) ) {
            return;
        }

        global $post;
        $slug = $post->post_name;

        $content = empty($_POST['sourcecode']) ? '' : $_POST['sourcecode'];
        $content = stripslashes($content);

        $result_check_syntax = $this->_check_syntax($content);

        $error_msg = $this->_check_syntax_msg($result_check_syntax);

        $file = $this->get_template_exists();

        // Kiểm tra cú pháp đúng
        if ( $result_check_syntax === 1 ) {
            $has_change_template = isset($_POST['has_change_template']) ? $_POST['has_change_template'] : '';
            $has_change_slug     = isset($_POST['has_change_slug']) ? $_POST['has_change_slug'] : '';

            // Khi chọn tạo file mới
            if ( !empty($_POST['createfile']) && $_POST['createfile'] == 'create' ) {
                $this->_create_file($slug, $content);
            }

            $is_save_file = true;

            // Khi đã có template và thay đổi template
            if ( $file && $has_change_template === 'changed' ) {
                $is_save_file = false;
            }
            // Khi đã có template và thay đổi slug
            if ( $file && $has_change_slug === 'changed' ) {
                $is_save_file = false;
            }
        }

        if ( $is_save_file === true ) {
            $result_saved_file = $this->_saved_file($file, $content);
            $error_msg .= $result_saved_file ? $this->lang['file_saved'] : $this->lang['file_not_saved'];
        }

        $_SESSION['CBA_MESSAGE'] = $error_msg;
        $_SESSION['CBA_MESSAGE_CODE'] = $result_check_syntax;
    }

    /**
     * print_error
     */
    public function print_error()
    {
        if ( !empty($_SESSION['CBA_MESSAGE']) ) {
            add_action('admin_notices', function() {
                $msg      = $_SESSION['CBA_MESSAGE'];
                $msg_code = $_SESSION['CBA_MESSAGE_CODE'];
                $classe   = $msg_code === 1 ? 'info' : 'error';
                $classe   = "notice notice-{$classe} is-dismissible code-{$msg_code}";
                $message  = $msg;
                printf( '<div class="%1$s"><p>%2$s</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>', esc_attr( $classe ), esc_html( $message ) );
                unset($_SESSION['CBA_MESSAGE']);
                unset($_SESSION['CBA_MESSAGE_CODE']);
            });
        }
    }

    /**
     * enqueue
     * @param  string $hook
     */
    public function enqueue($hook)
    {
        if ( in_array($hook, array('post.php','post-new.php')) ) {
            $dir_css = get_template_directory_uri() . '/assets/admin-css';
            $dir_js = get_template_directory_uri() . '/assets/admin-js';
            $dir_cm = get_template_directory_uri() . '/assets/admin-js/codemirror';
            wp_enqueue_style('codemirror', $dir_cm . '/codemirror.css');
            wp_enqueue_style('codemirror-addon-foldgutter', $dir_cm . '/addon/fold/foldgutter.css');
            wp_enqueue_style('codemirror-addon-dialog', $dir_cm . '/addon/dialog/dialog.css');
            wp_enqueue_style('codemirror-theme-monokai', $dir_cm . '/theme/monokai.css');
            wp_enqueue_style('qnp-edit-template', $dir_css . '/qnp-edit-template.css');

            wp_enqueue_script('codemirror', $dir_cm . '/codemirror.js');
            wp_enqueue_script('codemirror-addon-searchcursor', $dir_cm . '/addon/search/searchcursor.js');
            wp_enqueue_script('codemirror-addon-search', $dir_cm . '/addon/search/search.js');
            wp_enqueue_script('codemirror-addon-dialog', $dir_cm . '/addon/dialog/dialog.js');
            wp_enqueue_script('codemirror-addon-matchbrackets', $dir_cm . '/addon/edit/matchbrackets.js');
            wp_enqueue_script('codemirror-addon-closebrackets', $dir_cm . '/addon/edit/closebrackets.js');
            wp_enqueue_script('codemirror-addon-comment', $dir_cm . '/addon/comment/comment.js');
            wp_enqueue_script('codemirror-addon-hardwrap', $dir_cm . '/addon/wrap/hardwrap.js');
            wp_enqueue_script('codemirror-addon-foldcode', $dir_cm . '/addon/fold/foldcode.js');
            wp_enqueue_script('codemirror-addon-brace-fold', $dir_cm . '/addon/fold/brace-fold.js');
            wp_enqueue_script('codemirror-mode-xml', $dir_cm . '/mode/xml/xml.js');
            wp_enqueue_script('codemirror-mode-clike', $dir_cm . '/mode/clike/clike.js');
            wp_enqueue_script('codemirror-mode-javascript', $dir_cm . '/mode/javascript/javascript.js');
            wp_enqueue_script('codemirror-mode-css', $dir_cm . '/mode/css/css.js');
            wp_enqueue_script('codemirror-mode-php', $dir_cm . '/mode/php/php.js');
            wp_enqueue_script('codemirror-mode-htmlmixed', $dir_cm . '/mode/htmlmixed/htmlmixed.js');
            wp_enqueue_script('codemirror-keymap-sublime', $dir_cm . '/keymap/sublime.js');
            wp_enqueue_script('qnp-edit-template', $dir_js . '/qnp-edit-template.js');
            wp_enqueue_media();
        }
    }

    /**
     * _saved_file
     * @param  string $name
     * @param  string $content
     * @return boolean
     */
    private function _saved_file($name, $content)
    {
        if ( empty($name) ) {
            return false;
        }

        if ( !file_exists($name) ) {
            return false;
        }

        $handle = fopen($name, 'w');
        fwrite($handle, $content);
        fclose($handle);

        return true;
    }

    /**
     * _check_syntax
     * @param  string $content
     * @return integer
     */
    private function _check_syntax($content)
    {
        $dir = get_template_directory().'/tmp';
        if ( !is_dir($dir) && !mkdir($dir, 0777, true) ) {
            // Failed to create folders
            return 3;
        }
        $tmp = $dir.'/checkcode-'.date('Ymd').rand(100,999).'.php';
        file_put_contents($tmp, $content);
        exec('php -l '.$tmp, $output, $result);
        unlink($tmp);
        if ( $result == 0 ) {
            // Code is valid
            return 1;
        } else {
            // Code is not valid PHP code
            return 2;
        }
    }

    /**
     * _check_syntax_msg
     * @param  integer $num
     * @return string
     */
    private function _check_syntax_msg($num)
    {
        $error_msg = '';
        switch ( $num ) {
            case 1:
                $error_msg = $this->lang['code_valid'];
                break;
            case 2:
                $error_msg = $this->lang['code_note_valid'];
                break;
            case 3:
                $error_msg = $this->lang['failed_create_tmp'];
                break;
            default:
                $error_msg = $this->lang['unknown'];
                break;
        }
        return $error_msg;
    }

    /**
     * _title
     * @return string
     */
    private function _title()
    {
        global $post;
        $slug = $post->post_name;
        $str  = '';
        if ( !empty($slug) && !empty($this->file) ) {
            $str = ' ('.$this->file.')';
        }
        return $str;
    }

    /**
     * _create_file
     * @param  string $slug
     * @param  string $content
     * @return boolean
     */
    private function _create_file($slug, $content = '')
    {
        if ( empty($content) ) {
            return false;
        }

        if ( $handle = fopen(get_template_directory().'/template-pages/page-'.$slug.'.php', 'w') ) {
            /*$content = "<?php\n// something\n?>\n";*/
            fwrite($handle, $content);
            fclose($handle);
            return true;
        }
        return false;
    }

    /**
     * get_template_exists
     * @return string
     */
    public function get_template_exists()
    {
        global $post;

        if ( empty($post->post_name) ) {
            return '';
        }

        $page_template = get_post_meta( $post->ID, '_wp_page_template', true );

        if ( $page_template && $page_template !== 'default' ) {
            return get_page_template();
        } else if ( file_exists(get_template_directory().'/page-'.$post->post_name.'.php') ) {
            return get_template_directory().'/page-'.$post->post_name.'.php';
        } else if ( file_exists(get_template_directory().'/page-'.$post->ID.'.php') ) {
            return get_template_directory().'/page-'.$post->ID.'.php';
        } else if ( file_exists(get_template_directory().'/template-pages/page-'.$post->post_name.'.php') ) {
            return get_template_directory().'/template-pages/page-'.$post->post_name.'.php';
        }
        return '';
    }
}

/**
 * Run Class QnpEditTemplate
 */
new QnpEditTemplate();
