<?php
class Authentication
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'loadScripts']);
        add_action('wp_ajax_authentication', [$this, 'callbackAjax']);
        add_action('wp_ajax_nopriv_authentication', [$this, 'callbackAjax']);
        add_action('wp_logout', [$this, 'logout']);
    }

    public function loadScripts()
    {
        wp_enqueue_script(TEXT_DOMAIN . '-authentication', getAssets() . '/js/authentication.js', array('jquery'), wp_get_theme()->get('Version'), true);
        wp_localize_script(TEXT_DOMAIN . '-authentication', 'params', array(
            'ajaxurl' => site_url('/wp-admin/admin-ajax.php'),
        ));
    }

    public function callbackAjax()
    {
        // setup data
        $user_name        = isset($_POST['user_name']) ? $_POST['user_name'] : '';
        $user_email       = isset($_POST['user_email']) ? $_POST['user_email'] : '';
        $user_password    = isset($_POST['user_password']) ? $_POST['user_password'] : '';
        $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
        $button           = isset($_POST['button']) ? $_POST['button'] : '';

        // Register new user
        if ($button == 'register') {
            $registerd = self::register($user_name, $user_email, $user_password, $confirm_password);
            $registerd == 'success' ? wp_send_json_success($button) : wp_send_json_error($button, 500);
        }
        // Login
        if ($button == 'login') {
            $logged_in = self::login($user_name, $user_password);
            $logged_in == 'success' ? wp_send_json_success($button) : wp_send_json_error($button, 500);
        }
    }

    public static function form()
    {
        if (!is_user_logged_in()) : ?>
            <nav class="main_nav" style="margin-left: -20px">
                <ul>
                    <li><a href="#" id="open_form_register"><span><span class="menu-item-class require_nologin">Register</span></span></a></li>
                    <li><a href="#" id="open_form_login"><span><span class="menu-item-class require_nologin">Login</span></span></a></li>
                </ul>
            </nav>
        <?php else : ?>
            <nav class="main_nav" style="margin-left: 0px">
                <ul>
                    <li><a href="<?php echo wp_logout_url(get_permalink()); ?>"><span><span class="menu-item-class require_login">Logout</span></span></a></li>
                </ul>
            </nav>
        <?php endif;
    }

    public static function register($user_name, $user_email, $user_password, $confirm_password)
    {
        if ($user_password != $confirm_password) {
            return false;
        }

        $user_id = username_exists($user_name);
        if (!empty($user_id) && email_exists($user_email)) {
            return false;
        }

        return wp_create_user($user_name, $user_password, $user_email);
    }

    public static function login($user_name, $user_password)
    {
        if (!is_user_logged_in()) {
            $creds['user_login']    = $user_name ?: '';
            $creds['user_password'] = $user_password ?: '';
            $user = wp_signon($creds, false);
            if (!is_wp_error($user)) {
                return 'success';
            }
        }
        return 'failed';
    }

    public function logout()
    {
        if (!empty(self::onUserScreen())) {
            self::redirectUser('logout');
            exit;
        }
    }

    public static function onUserScreen($username = '')
    {
        $referrer = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : $_SERVER['PHP_SELF'];
        $referrer = add_query_arg('result', 'failed', $referrer);
        $referrer = add_query_arg('username', $username, $referrer);

        if (!empty($referrer) && !strstr($referrer, 'wp-login') && !strstr($referrer, 'wp-admin')) {
            return true;
        }

        return false;
    }

    public static function redirectUser($status = '')
    {
        $with_status = !empty($status) ? "?login={$status}" : '';
        $url_ref     = $_SERVER['HTTP_REFERER'];
        $url         = strpos($url_ref, '?login=') !== false ? strstr($url_ref, '?login=', true) : $url_ref;
        $url         = $status == 'success' ? str_replace('/login', '/', $url) : $url;
        $url         = $status == 'logout' ? home_url('/login') : $url;
        wp_redirect($url . '/' . $with_status);
        exit;
    }
}
$authentication = new Authentication();
