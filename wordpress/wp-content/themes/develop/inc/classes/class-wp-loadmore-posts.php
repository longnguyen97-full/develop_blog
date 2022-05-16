<?php
class LoadmorePosts
{
    public $page_name   = 'Loadmore';
    public $page_slug   = 'cybridge-loadmore';
    public $parent_slug = 'cybridge-helper';

    /**
     * Start up
     */
    public function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'loadScripts'));
        add_action('wp_ajax_loadmore', array($this, 'loadmoreAjaxCallback'));
        add_action('wp_ajax_nopriv_loadmore', array($this, 'loadmoreAjaxCallback'));
    }

    public function queryVar($key = '', $is_wp_query = false)
    {
        global $wp_query;

        $var = (int) get_query_var($key);

        if ($is_wp_query === true) {
            $var = (int) $wp_query->{$key};
        }

        return $var;
    }

    public function loadScripts()
    {
        global $wp_query;

        wp_enqueue_style(TEXT_DOMAIN . '-loadmore-theme', getAssets() . '/css/loadmore.css', array(), wp_get_theme()->get('Version'));
        wp_register_script(TEXT_DOMAIN . '-loadmore-script', getAssets() . '/js/loadmore.js', array('jquery'), wp_get_theme()->get('Version'), true);
        wp_localize_script(TEXT_DOMAIN . '-loadmore-script', 'loadmore_params', array(
            'ajaxurl'      => site_url() . '/wp-admin/admin-ajax.php',
            'posts'        => json_encode($this->wp_query->query_vars),
            'current_page' => $this->queryVar('paged'),
            'max_page'     => $this->queryVar('max_num_pages', true),
        ));
        wp_enqueue_script(TEXT_DOMAIN . '-loadmore-script');
    }

    public function loadmoreButton()
    {
        $current_page = $this->queryVar('paged');
        $max_page     = $this->queryVar('max_num_pages', true);
        if ( $max_page > 1 && $max_page !== $current_page ) {
            echo '<div class="loadmore_button">More posts</div>';
        }
    }

    public function loadmoreAjaxCallback()
    {
        $args                   = isset($_POST['query']) ? json_decode( stripslashes( $_POST['query'] ), true ) : array();
        $args['paged']          = (int) isset($_POST['page']) ? $_POST['page'] + 1 : 0;
        $args['post_status']    = 'publish';
        $args['offset']         = (int) isset($_POST['offset']) ? $_POST['offset'] : 0;
        $args['posts_per_page'] = 5;

        query_posts( $args );

        if ( have_posts() ) :

            while ( have_posts() ): the_post();

                get_template_part( 'template-parts/content' );

            endwhile;

        endif;
        die;
    }
}
$LoadmorePosts = new LoadmorePosts();
