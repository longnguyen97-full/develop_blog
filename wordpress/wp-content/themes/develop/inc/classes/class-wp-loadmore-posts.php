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
        global $wp_query;
        $this->wp_query = $wp_query;

        add_action('wp_enqueue_scripts', array($this, 'loadScripts'));
        add_action('wp_ajax_loadmore', array($this, 'loadmoreAjaxCallback'));
        add_action('wp_ajax_nopriv_loadmore', array($this, 'loadmoreAjaxCallback'));
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
        wp_enqueue_style(TEXT_DOMAIN . '-loadmore-theme', getAssets() . '/css/loadmore.css', array(), wp_get_theme()->get('Version'));
        wp_register_script(TEXT_DOMAIN . '-loadmore-script', getAssets() . '/js/loadmore.js', array('jquery'), wp_get_theme()->get('Version'), true);
        wp_localize_script(TEXT_DOMAIN . '-loadmore-script', 'loadmore_params', array(
            'ajaxurl'      => site_url() . '/wp-admin/admin-ajax.php',
            'loaded_posts' => get_loaded_posts(),
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

        // Count total posts in order to specific page
        $total_posts  = wp_count_posts()->publish;
        $category     = $this->queryVar('cat');
        $tag          = $this->queryVar('tag_id');
        $author       = $this->queryVar('author');
        $total_posts  = $category ? count_cat_posts($category) : $total_posts;
        $total_posts  = $tag ? count_tag_posts($tag) : $total_posts;
        $total_posts  = $author ? count_author_posts($author) : $total_posts;

        $loaded_posts = get_loaded_posts();
        $remaining_posts = $total_posts - $loaded_posts;

        if ( $max_page > 1 && $max_page !== $current_page ) {
            echo "<div class='loadmore_button'>More posts ({$remaining_posts} Posts)</div>";
        }
    }

    public function loadmoreAjaxCallback()
    {
        $args                   = isset($_POST['query']) ? json_decode( stripslashes( $_POST['query'] ), true ) : array();
        $args['paged']          = (int) isset($_POST['page']) ? $_POST['page'] + 1 : 0;
        $args['offset']         = (int) isset($_POST['offset']) ? $_POST['offset'] : 0;
        $args['posts_per_page'] = 10;
        $args['post_status']    = 'publish';
        $args['post__not_in']   = is_home() ? get_option( 'sticky_posts' ) : '';

        query_posts( $args );

        if ( have_posts() ) :

            while ( have_posts() ): the_post();

                get_template_part( 'template-parts/content' );

                count_loaded_posts();

            endwhile;

            $loaded_posts = get_loaded_posts();
            echo "<div class='loaded_posts hide'>Loaded More Posts ({$loaded_posts} Posts)</div>";

        endif;

        die;
    }
}
$LoadmorePosts = new LoadmorePosts();
