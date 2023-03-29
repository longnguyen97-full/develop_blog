<?php
class Loadmore
{
    /**
     * Start up
     */
    public function __construct()
    {
        global $wp_query;
        $this->wp_query = $wp_query;

        add_action('wp_enqueue_scripts', array($this, 'loadScripts'));
        add_action('wp_ajax_loadmore', array($this, 'callback'));
        add_action('wp_ajax_nopriv_loadmore', array($this, 'callback'));
    }

    public function queryVar($key = '', $is_wp_query = false)
    {
        $var = (int) get_query_var($key);

        if ($is_wp_query === true) {
            $var = (int) $this->wp_query->{$key};
        }

        return $var;
    }

    public function loadScripts()
    {
        wp_enqueue_style(TEXT_DOMAIN . '-loadmore', getAssets() . '/css/loadmore.css', array(), wp_get_theme()->get('Version'));
        wp_register_script(TEXT_DOMAIN . '-loadmore', getAssets() . '/js/loadmore.js', array('jquery'), wp_get_theme()->get('Version'), true);
        wp_localize_script(TEXT_DOMAIN . '-loadmore', 'params', array(
            'ajaxurl'      => site_url() . '/wp-admin/admin-ajax.php',
            'loaded_posts' => get_loaded_posts(),
            'query_posts'  => json_encode($this->wp_query->query_vars),
            'current_page' => $this->queryVar('paged'),
            'max_page'     => $this->queryVar('max_num_pages', true),
            'site_url'     => site_url(),
        ));
        wp_enqueue_script(TEXT_DOMAIN . '-loadmore');
    }

    public function callback()
    {
        $args['paged']          = (int) isset($_POST['page']) ? $_POST['page'] + 1 : 0;
        $args['offset']         = (int) isset($_POST['offset']) ? $_POST['offset'] : 0;
        $args['posts_per_page'] = 11;
        $args['post_status']    = 'publish';
        $args['post__not_in']   = is_home() ? get_option('sticky_posts') : '';
        
        query_posts($args);
        if (have_posts()) :
            $key = 0;

            echo '<div class="grid clearfix">';

            while (have_posts()) : the_post();
                get_template_part('template-parts/content-loadmore', get_post_type(), ['key' => $key++]);

            endwhile;

            echo '</div>';

        endif;

        exit();
    }

    public static function button($total_posts = 0, $limit = 11)
    {
        if ($total_posts > $limit) {
            ?>
            <div class="load_more">
                <div id="load_more" class="load_more_button text-center trans_200">Load More (<?php echo $total_posts - $limit; ?>)</div>
            </div>
            <?php
        }
    }
}
$Loadmore = new Loadmore();
